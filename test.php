<?php

  //$text = $event['message']['text'];
  $text = 'สูง';

  require 'db.php';

  $answer = '';

  //Check Rude Word
  $ret = contains($text, $rudes);

  if($ret){
    $answer = $rudes[rand(0,sizeof($rudes))];
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

    if($ret)
      echo $ret[1];

    if($ret_img)
      echo $ret_img[1];

  }
?>
