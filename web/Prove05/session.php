<?php
session_start();

if (!(isset($_SESSION['lastContent']))) {
  $_SESSION['lastContent'] = 'clientes';
}

  if (!(empty($_REQUEST["tab"]))) {
    $_SESSION['lastContent'] = $_REQUEST["tab"];
  }
  echo $_SESSION['lastContent'];
    
  ?>