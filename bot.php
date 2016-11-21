<?php
  /* Your Data*/
  $csc = '5dba7b5e31d22c110ae84c75f82b90f4';
  $token = 'Yh9WBt5/mhi9VnFR3EPckw23Bd5hnm3zinl+danH68ntVDqA/LUOwAprQf3lZQEoYkNZMng7Hdaw5OLD+lTb2xjIAYp2EIVPtuZj8D4B4Au3JWklZSJ50Rlcen5jc3JqaTJci5ZLCTuY3RAPZ5ZK6wdB04t89/1O/w1cDnyilFU=';

  require './vendor/autoload.php';
  require 'db.php';

  $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($token);
  $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $csc]);

  // Get POST body content
  $content = file_get_contents('php://input');
  // Parse JSON
  $events = json_decode($content, true);
  // Validate parsed JSON data
  if (!is_null($events['events'])) {
  	// Loop through each event
  	foreach ($events['events'] as $event) {
  		// Reply only when message sent is in 'text' format
  		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
  			// Get text sent
  			$text = $event['message']['text'];
  			// Get replyToken
  			$replyToken = $event['replyToken'];

        //Process text

        //Check Rude Word
        $ret = contains($text, $rudes);

        if($ret){

          $answer = $rudes[rand(0,sizeof($rudes))];
          sendText($bot, $answer);

          /*
          $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($answer);
          $response = $bot->replyMessage($replyToken, $textMessageBuilder);
          if ($response->isSucceeded()) {
              echo 'Successed';
          }else{
            echo $response->getHTTPStatus . ' ' . $response->getRawBody();
          }
          */

        }

        //Check verbs
        $verb = contains($text, $verbs);
        if($verb){
          //Have 0 text 1 category
          shuffle($profiles);
          $ret = contains($verb[1], $profiles);

          //Have 0 text 1 category
          shuffle($images);
          $ret_img = contains($verb[1], $images);

          if($ret){
            sendText($bot, $ret[1]);
            /*
            $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($ret[1]);
            $response = $bot->replyMessage($replyToken, $textMessageBuilder);
            if ($response->isSucceeded()) {
                echo 'Successed';
            }else{
              echo $response->getHTTPStatus . ' ' . $response->getRawBody();
            }
            */
          }

          if($ret_img){

            sendImage($bot, $ret_img[1], $ret_img[1]);
            /*
            $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder($ret_img[1], $ret_img[1]);
            $response = $bot->replyMessage($replyToken, $textMessageBuilder);
            if ($response->isSucceeded()) {
                echo 'Images Successed';
            }else{
              echo $response->getHTTPStatus . ' ' . $response->getRawBody();
            }
            */
          }

        }else if($answer == ''){

          sendText($bot, 'ขอตังไปเพิ่มสกิลหน่อย');
          /*
          $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ขอตังไปเพิ่มสกิลหน่อย');
          $response = $bot->replyMessage($replyToken, $textMessageBuilder);
          if ($response->isSucceeded()) {
              echo 'Successed';
          }else{
            echo $response->getHTTPStatus . ' ' . $response->getRawBody();
          }
          */

        }

        //Create Message
        /*
        if(sendText($text)){
          echo 'successed';
        }else {
          // Failed
          echo $response->getHTTPStatus . ' ' . $response->getRawBody();
        }
        */

/*
  			// Build message to reply back
  			$messages = [
  				'type' => 'text',
  				'text' => $text
  			];

  			// Make a POST Request to Messaging API to reply to sender
  			$url = 'https://api.line.me/v2/bot/message/reply';
  			$data = [
  				'replyToken' => $replyToken,
  				'messages' => [$messages],
  			];
  			$post = json_encode($data);
  			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

  			$ch = curl_init($url);
  			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  			$result = curl_exec($ch);
  			curl_close($ch);

  			echo $result . "\r\n";
*/
  		}
  	}
  }

  function sendText($bot, $m_text){
    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($m_text);
    $response = $bot->replyMessage($replyToken, $textMessageBuilder);
    if ($response->isSucceeded()) {
        return true;
    }else{
      echo $response->getHTTPStatus . ' ' . $response->getRawBody();
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
      echo $response->getHTTPStatus . ' ' . $response->getRawBody();
      return false;
    }
  }

  echo "OK";
?>
