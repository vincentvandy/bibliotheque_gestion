<!-- Ce fichier fait office de container pour mon site la nav se fait via GET -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dwm Gestion de la bibliothèque</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dwm Gestion de la bibliothèque">
    <meta name="author" content="Vandy Vincent">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    
    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 60px;
      }

      /* Custom container */
      .container {
        margin: 0 auto;
        max-width: 1000px;
      }
      .container > hr {
        margin: 60px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 80px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 100px;
        line-height: 1;
      }
      .jumbotron .lead {
        font-size: 24px;
        line-height: 1.25;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }

      /* Customize the navbar links to be fill the entire space of the .navbar */
      .navbar .navbar-inner {
        padding: 0;
      }
      .navbar .nav {
        margin: 0;
        display: table;
        width: 100%;
      }
      .navbar .nav li {
        display: table-cell;
        width: 1%;
        float: none;
      }
      .navbar .nav li a {
        font-weight: bold;
        text-align: center;
        border-left: 1px solid rgba(255,255,255,.75);
        border-right: 1px solid rgba(0,0,0,.1);
      }
      .navbar .nav li:first-child a {
        border-left: 0;
        border-radius: 3px 0 0 3px;
      }
      .navbar .nav li:last-child a {
        border-right: 0;
        border-radius: 0 3px 3px 0;
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

  </head>

  <body>
    <div class='container'>
<?php
error_reporting(E_ALL ^ E_NOTICE);

//une petite bulle info minforme si mon formulaire a ete envoyé ou minvite a recommencer
if($_GET['succes']==1)
{
  echo("
          <div class='alert alert-success'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      <strong>Yes!</strong> L'emprunt a été validé</div>");
}

if($_GET['oups']==1)
{
  echo("
      <div class='alert alert-error'>
  <button type='button' class='close' data-dismiss='alert'>&times;</button>
  <strong>oops!</strong>Remplissez correctement les champs s'il vous plait...
</div>");}

include 'lib.php.';

//jutilise un GET pour charger les diff. tableaux dans ma page
//suivant la valeur du get le tableau affiché par 'lister.php' est diff.
$i= $_GET['tab'];

switch ($i) {
  case 'home':
    include "justified-nav.html";
    break;

  case 'emprunts':
    include "lister.php";
    break;

  case 'membres':
  include "lister.php";
    break;

  case 'livres':
  include "lister.php";
    break;

    default:
    include "justified-nav.html";
    break;
}

?>
      <hr>

      <div class="footer">
        <p>&copy; 2013 Vandy Vincent</p>
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== 
    Ce code vient de bootstrap, framework front-end open-source: http://twitter.github.io/bootstrap/
    Tout comme le css-->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
