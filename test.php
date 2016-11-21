<?php
  /* Your Data*/
  $csc = '5dba7b5e31d22c110ae84c75f82b90f4';
  $token = 'Yh9WBt5/mhi9VnFR3EPckw23Bd5hnm3zinl+danH68ntVDqA/LUOwAprQf3lZQEoYkNZMng7Hdaw5OLD+lTb2xjIAYp2EIVPtuZj8D4B4Au3JWklZSJ50Rlcen5jc3JqaTJci5ZLCTuY3RAPZ5ZK6wdB04t89/1O/w1cDnyilFU=';

  require './vendor/autoload.php';
  require 'db.php';

  //$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($token);
  //$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $csc]);

  //$text = $event['message']['text'];
  $text = 'สูง';
  $text = $_REQUEST['text'];

  $answer = '';

  //Check Rude Word
  $ret = contains($text, $rudes);

  if($ret){
    $answer = $rudes[rand(0,sizeof($rudes))];
    echo $answer;
    //sendText($bot, $answer);
  }

  //Check verbs
  $verb = contains($text, $verbs);
  if($verb){

    print_r($verb[1]);
    echo '<br>';

    //Have 0 text 1 category
    shuffle($profiles);
    $ret = contains($verb[1], $profiles);

    print_r($ret);

    //Have 0 text 1 category
    shuffle($images);
    $ret_img = contains($verb[1], $images);

    if($ret)
      echo $ret[1];
      //sendText($bot, $ret[1]);

    if($ret_img)
      echo $ret_img[1];
      //sendImage($bot, $ret_img[1]);

  }



    function sendText($bot, $m_text){
      $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($m_text);
      $response = $bot->replyMessage($replyToken, $textMessageBuilder);
      if ($response->isSucceeded()) {
          return true;
      }else{
        return false;
      }
    }

    function sendImage($bot, $m_image, $m_preview){
      //$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder($m_image);
      $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder($m_image, $m_preview);
      $response = $bot->replyMessage($replyToken, $textMessageBuilder);
      if ($response->isSucceeded()) {
          return true;
      }else{
        return false;
      }
    }
?>
