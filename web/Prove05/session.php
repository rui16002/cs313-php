<?php
session_start();

if (!(empty($_REQUEST["tab"]))) {
  $_SESSION['lastContent'] = $_REQUEST["tab"];
}
echo $_SESSION['lastContent'];

?>