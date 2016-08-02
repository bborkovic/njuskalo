<!DOCTYPE html>
<html>
<head>
	<title>Njuskalo</title>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<!-- Bootstrap -->
  <link href="../stylesheets/bootstrap.min.css" rel="stylesheet">
	<link href="../stylesheets/mystyle.css" rel="stylesheet">
	<script src="../javascrips/bootstrap.min.js"></script>

</head>
<body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
    <!-- <div class="navbar navbar-inverse navbar-static-top"> -->
      <div class="container">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Njuskalo</a>
        </div> <!-- <div class="navbar-header"> -->

        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $logged_user->username;?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>

        </div><!--/.nav-collapse -->

      </div>
    </nav>


	<div class="container">
	  <div class="panel panel-default">
	    <div class="panel-heading">
	    	<h4>Njuskalo, Admin area</h4>
	    </div>
	    
