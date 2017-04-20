<?php

session_start();
$_SESSION['user_id'] = 1;

require __DIR__ .'/../vendor/autoload.php';

$dropboxKey = '	wq3fab002kdzkur';
$dropboxSecret = 'p8ffrfjhjeqewur';
$appName = 'dynomo';

$appInfo = new Dropbox\AppInfo($dropboxKey, $dropboxSecret);

//Store CSRF token
$csrfTokenStore = new Dropbox\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');

// Define auth details
$webAuth = new Dropbox\WebAuth($appInfo, $appName, 'http://localhost:82/API/dropbox_finish.php', $csrfTokenStore);

$db = new PDO('mysql:host=localhost;dbname=api', 'root', '');

// User details
$user = $db->prepare("SELECT * FROM users WHERE id = :user_id");
$user->execute(array('user_id'=> $_SESSION['user_id']));

$user = $user->fetchObject();
var_dump($user);

?>


