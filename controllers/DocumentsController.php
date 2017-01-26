<?php

namespace app\controllers;

use Yii;
use app\models\Documents;
use app\models\DocumentsSearch;
use app\models\Download;
use app\models\DownloadSearch;
use app\models\Uploads;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\html;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;


/**
* DocumentsController implements the CRUD actions for Documents model.
 */
class DocumentsController extends Controller
{
	
	/**
	* @inheritdoc
	     */
	public function behaviors()
	{
		return [
			'verbs' => [
		    'class' => VerbFilter::className(),
		    'actions' => [
		      'delete' => ['POST'],
		    ],
		  ],
		  'access' => [
		    'class' => AccessControl::className(),
		    'rules' => [
		      [
		        'allow' => true,
		        'actions' => ['index','view'],
		        'roles' => ['?'],
		      ],
		      [
		        'allow' => true,
		        'actions' => ['admin','index','view','create','update','delete','download'],
		        'roles' => ['@'] ,
		      ],    
		    ],                
		  ],
		];
	}
	
	
	/**
	* Lists all Documents models.
	     * @return mixed
	     */
	public function actionIndex()
	{
		$searchModel = new DocumentsSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->sort->defaultOrder = ['id'=>'DESC'];
		$dataProvider->pagination->pageSize=30;		
		return $this->render('index', [
		            'searchModel' => $searchModel,
		            'dataProvider' => $dataProvider,
		        ]);
	}
	
	public function actionAdmin()
	{
		if(Yii::$app->user->identity->role == 1){
			$searchModel = new DocumentsSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			$dataProvider->pagination->pageSize=20;
			return $this->render('admin', [
		            'searchModel' => $searchModel,
		            'dataProvider' => $dataProvider,
		        ]);
		}else{
			$searchModel = new DocumentsSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			$dataProvider->pagination->pageSize=20;
			return $this->render('index',[
		            'searchModel' => $searchModel,
		            'dataProvider' => $dataProvider,
		    ]);
		}
	}
	
	
	/**
	* Displays a single Documents model.
	     * @param string $id
	     * @return mixed
	     */
	public function actionView($id)
	{
		return $this->render('view', ['model' => $this->findModel($id),]);
	}
	
	
	/**
	* Creates a new Documents model.
	     * If creation is successful, the browser will be redirected to the 'view' page.
	     * @return mixed
	     */
	public function actionCreate()
	{
		if(Yii::$app->user->identity->role == 1){		
			$model = new Documents();
		
			if ($model->load(Yii::$app->request->post()) ) {
			
				$this->CreateDir($model->ref);
				$model->others = $this->uploadSingleFile($model);
				$model->docs = $this->uploadMultipleFile($model);
			
				if($model->save()){
					return $this->redirect(['view', 'id' => $model->id]);
				}			
			}else{
				$model->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
			}	
			return $this->render('create', ['model' => $model,]);
		}else{
			$searchModel = new DocumentsSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			return $this->render('index',[
		            'searchModel' => $searchModel,
		            'dataProvider' => $dataProvider,
		    ]);
		}		
	}
	
	
	/**
	* Updates an existing Documents model.
	     * If update is successful, the browser will be redirected to the 'view' page.
	     * @param string $id
	     * @return mixed
	     */
	public function actionUpdate($id)
	{
		if(Yii::$app->user->identity->role == 1){		
			$model = $this->findModel($id);
			$tempCovenant = $model->others;
			//$		tempDocs     = $model->docs;
			if ($model->load(Yii::$app->request->post())) {
			
				$this->CreateDir($model->ref);
				$model->others = $this->uploadSingleFile($model,$tempCovenant);
				//$			model->docs = $this->uploadMultipleFile($model,$tempDocs);
				if($model->save()){
					return $this->redirect(['view', 'id' => $model->id]);
				}
			}
			return $this->render('update', ['model' => $model]);
		}else{
			$searchModel = new DocumentsSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			return $this->render('index',[
		            'searchModel' => $searchModel,
		            'dataProvider' => $dataProvider,
		    ]);
		}				
	}
	
	
	/**
	* Deletes an existing Documents model.
	     * If deletion is successful, the browser will be redirected to the 'index' page.
	     * @param string $id
	     * @return mixed
	     */
	public function actionDelete($id)
	{
		if(Yii::$app->user->identity->role == 1){
			$model = $this->findModel($id);
		//remove upload file & data
		    $this->removeUploadDir($model->ref);
			Uploads::deleteAll(['ref'=>$model->ref]);
			$model->delete();
			return $this->redirect(['index']);
		}else{
			$searchModel = new DocumentsSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			return $this->render('index',[
		            'searchModel' => $searchModel,
		            'dataProvider' => $dataProvider,
		    ]);
		}		
	}
	
	
	/**
	* Finds the Documents model based on its primary key value.
	     * If the model is not found, a 404 HTTP exception will be thrown.
	     * @param string $id
	     * @return Documents the loaded model
	     * @throws NotFoundHttpException if the model cannot be found
	     */
	protected function findModel($id)
	{
		if (($model = Documents::findOne($id)) !== null) {
			return $model;
		}
		else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
	
	public function actionDeletefile($id,$field,$fileName)
	{
		$status = ['success'=>false];
		if(in_array($field, ['others'])){
			$model = $this->findModel($id);
			$files =  Json::decode($model->{
				$field
			}
			);
			if(array_key_exists($fileName, $files)){
				if($this->deleteFile('file',$model->ref,$fileName)){
					$status = ['success'=>true];
					unset($files[$fileName]);
					$model->{
						$field
					}
					= Json::encode($files);
					$model->save();
				}
			}
		}
		echo json_encode($status);
	}
	
	private function deleteFile($type='file',$ref,$fileName)
	{
		if(in_array($type, ['file','thumbnail'])){
			if($type==='file'){
				$filePath = Documents::getUploadPath().$ref.'/'.$fileName;
			}
			else {
				$filePath = Documents::getUploadPath().$ref.'/thumbnail/'.$fileName;
			}
			@unlink($filePath);
			return true;
		}
		else{
			return false;
		}
	}
	
	public function actionDownload($id){

		$model = $this->findModel($id);  

    $download = new Download();
		$download->ref = $model->ref;
		$download->download_by  = Yii::$app->user->identity->id;
		$download->download_date  = date('Y-m-d H:i:s');
        $download->save();
        $data = $model->others;
        $files = Json::decode($data);
        if(is_array($files)){
            foreach ($files as $key => $value) {
                Yii::$app->response->sendFile($model->getUploadPath().'/'.$model->ref.'/'.$key,$value);
            }
        }
    }


/**
* Upload & Rename file
     * @return mixed
     */
  private function uploadSingleFile($model,$tempFile=null)
	{
	$file = [];
	$json = '';
	try {
		$UploadedFile = UploadedFile::getInstance($model,'others');
		if($UploadedFile !== null){
			$oldFileName = $UploadedFile->basename.'.'.$UploadedFile->extension;
			$newFileName = md5($UploadedFile->basename.time()).'.'.$UploadedFile->extension;
			$UploadedFile->saveAs(Documents::UPLOAD_FOLDER.'/'.$model->ref.'/'.$newFileName);
			$file[$newFileName] = $oldFileName;
			$json = Json::encode($file);
            $upload  = new Uploads();
			$upload->ref             = $model->ref;
			$upload->file_name       = $oldFileName;
			$upload->real_filename   = $newFileName;
			$upload->save();
		}
		else{
			$json=$tempFile;
		}
	}
	catch (Exception $e) {
		$json=$tempFile;
	}
	return $json ;
}

private function uploadMultipleFile($model,$tempFile=null)
{
	$files = [];
	$json = '';
	$tempFile = Json::decode($tempFile);
	$UploadedFiles = UploadedFile::getInstances($model,'docs');
	if($UploadedFiles!==null){
		foreach ($UploadedFiles as $file) {
			try {
				$oldFileName = $file->basename.'.'.$file->extension;
				$newFileName = md5($file->basename.time()).'.'.$file->extension;
				$file->saveAs(Documents::UPLOAD_FOLDER.'/'.$model->ref.'/'.$newFileName);
				$files[$newFileName] = $oldFileName ;
			}
			catch (Exception $e) {
				
			}
		}
		$json = json::encode(ArrayHelper::merge($tempFile,$files));
	}
	else{
		$json = $tempFile;
	}
	return $json;
}

private function CreateDir($folderName)
{
	if($folderName != NULL){
		$basePath = Documents::getUploadPath();
		if(BaseFileHelper::createDirectory($basePath.$folderName,0777)){
			BaseFileHelper::createDirectory($basePath.$folderName.'/thumbnail',0777);
		}
	}
	return;
}

private function removeUploadDir($dir)
{
	BaseFileHelper::removeDirectory(Documents::getUploadPath().$dir);
}

}
