<?php
require_once('connection.php');

if (isset($_GET['controller'])) {
  $controller = $_GET['controller'];
  if (isset($_GET['action'])) {
    $action = $_GET['action'];
  } else {
    $action = 'index';
  } 
  if (isset($_GET['params'])) {
    $params = $_GET['params'];
  } else if (!empty($_POST)) {
    $params = $_POST;
  }else{
    $params = "";
  }
} else {
  $params = "";
  $controller = 'pages';
  $action = 'home';
}
require_once('routes.php');