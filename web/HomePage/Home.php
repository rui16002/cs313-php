<!DOCTYPE html>
<html>
<head>
<title>Home page</title>
<!-- The following line is required for bootstrap and must come before any stylesheet-->
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="styles.css">

</head>
<body>
  <div class="jumbotron text-center">
  <h1>CS-313</h1>
    <p><em>Web Engineering II</em></p>
    </div>
     <p class="time">
      <?php
date_default_timezone_set('America/Boise');
echo(strftime("BYU time: %Y. %B %d. %A. %X %Z <br>"));
date_default_timezone_set('Europe/Madrid');
echo(strftime("My time: %Y. %B %d. %A. %X %Z"));
?>
    </p>
  <div class="row profile">
    <div class="col-sm-4 text-center">
      <img src="martinfierro.jpg" class="img-circle person" alt="Martin Fierro">
    </div>
    <div class="col-sm-8 text-center">   
      <h3><strong>Martin Fierro</strong></h3>   
      <h5>Martín Fierro, also known as El Gaucho Martín Fierro, is a 2,316-line epic poem by the Argentine writer José Hernández. The poem was originally published in two parts, El Gaucho Martín Fierro and La Vuelta de Martín Fierro.</h5>
    </div>
    </div>
<!-- Container (Assignments Section) -->
<div class="container-fluid text-center">
  <h3>Assignment index</h3>
  <br>
  <div class="row">
    <div class="col-sm-4 assignment">
      <span class="glyphicon glyphicon-wrench logo-small"></span>
      <h4>Assignment 01</h4>
      <p>Comming soon...</p>
    </div>
    <div class="col-sm-4 assignment">
      <span class="glyphicon glyphicon-wrench logo-small"></span>
      <h4>Assignment 02</h4>
      <p>Comming soon...</p>
    </div>
    <div class="col-sm-4 assignment">
      <span class="glyphicon glyphicon-wrench logo-small"></span>
      <h4>Assignment 03</h4>
      <p>Comming soon...</p>
    </div>
  </div>
  <br><br>
  <div class="row">
    <div class="col-sm-4 assignment">
      <span class="glyphicon glyphicon-wrench logo-small"></span>
      <h4>Assignment 04</h4>
      <p>Comming soon...</p>
    </div>
    <div class="col-sm-4 assignment">
      <span class="glyphicon glyphicon-wrench logo-small"></span>
      <h4>Assignment 05</h4>
      <p>Comming soon...</p>
    </div>
    <div class="col-sm-4 assignment">
      <span class="glyphicon glyphicon-wrench logo-small"></span>
      <h4>Assignment 06</h4>
      <p>Comming soon...</p>
    </div>
  </div>
</div>
      
    </div>
  </div>

</body>
</html>