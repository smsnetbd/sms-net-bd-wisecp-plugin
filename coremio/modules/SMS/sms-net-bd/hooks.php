<?php 
 Hook::add('ClientCreated', 1, function ($params = []) {
    $ExampleSMS = new ExampleSMS();
    $message = "ClientCreated";
    $ExampleSMS->submit("title", $message ,"8801775051601");
});

// $ExampleSMS = new ExampleSMS();

// $ExampleSMS->submit("title","Message","8801775051601");

