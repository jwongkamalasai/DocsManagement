<?php 
namespace frontend\controllers; 
use frontend\models\LineBot; 
use frontend\modules\forum\models\Thread; 
use yii\helpers\Url; 

class LineBotController extends \yii\web\Controller 
{ 
  public function actionCurl() 
  { 
    /* * ส่งจาก Forum */ 
    $last_thread = LineBot::findOne(['type' => 'forum']); 
    $thread = Thread::find()->orderBy(['id' => SORT_DESC])->one(); 
    if(!$last_thread)
    { 
      $last_thread = new LineBot(); 
      $last_thread->type = 'forum'; 
      $last_thread->last_id = $thread->id; 
      $last_thread->save(); 
      $message = $thread->subject.' '.Url::to('http://laosuaekok.go.th'.$thread->id); 
      $res = $this->notify_message($message); 
    }else{ 
      if($last_thread->last_id != $thread->id)
      { 
        $message = $thread->subject.' '.Url::to('http://laosuaekok.go.th'.$thread->id); 
        $res = $this->notify_message($message); 
        $last_thread->last_id = $thread->id; $last_thread->save(); 
      } 
    }
  } 
  
  public function notify_message($message) 
  { 
    $line_api = 'https://notify-api.line.me/api/notify'; 
    $line_token = 'YOUR-TOKEN'; $queryData = array('message' => $message); 
    $queryData = http_build_query($queryData,'','&'); 
    $headerOptions = array( 'http'=>array( 'method'=>'POST', 'header'=> "Content-Type: application/x-www-form-urlencoded\r\n" ."Authorization: Bearer ".$line_token."\r\n" ."Content-Length: ".strlen($queryData)."\r\n", 'content' => $queryData ) ); 
    $context = stream_context_create($headerOptions); 
    $result = file_get_contents($line_api, FALSE, $context); 
    $res = json_decode($result); return $res; 
  } 
}