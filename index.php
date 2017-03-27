<?php
  /* Your Data*/
  $csc = ' a6b4b1a80d9f25eb0a719fc92cef7d86 ';
  $token = '3/cEBpOR0mjAMUtnHKrSrx3N6FnMVNPYfXBIwMO6HNGaljxuxTxZz2fGrmZYFwqfV3dvAWMa7FEGrmOONfbZ7or1wxYgpjbtFMS0Mkk+RftjvYSrUpThxAHGiivf2M662z2zM5P8BSKby0dJiBG3GQdB04t89/1O/w1cDnyilFU=';

  require './vendor/autoload.php';

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

        //Create Message
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($text);
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
        if ($response->isSucceeded()) {
            echo 'success';
            return;
        }

        // Failed
        echo $response->getHTTPStatus . ' ' . $response->getRawBody();

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

  echo "OK";
?>
