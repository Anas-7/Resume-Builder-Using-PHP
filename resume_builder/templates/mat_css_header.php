<?php 
  if(session_status() == PHP_SESSION_NONE){
    session_start();
  }
  if(!isset($_SESSION['recruiter_result']) && empty($_SESSION['recruiter_result'])){
    $_SESSION['recruiter_result'] = '';
  }
  if(!isset($_SESSION['student_result']) && empty($_SESSION['student_result'])){
    $_SESSION['student_result'] = '';
  }
  $recruiter_result = $_SESSION['recruiter_result'];
  $student_result = $_SESSION['student_result'];

?>

<head>
	<title>Brilliant Resumes</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style type="text/css">
	  .brand{
	  	background: #000000  !important;
	  }
  	form{
  		max-width: 460px;
  		margin: 20px auto;
  		padding: 20px;
  	}
    body{
      background-image: url("https://images.template.net/wp-content/uploads/2016/11/21131124/polygonal.jpg");
      background-size: cover;
    }
  </style>
</head>
<body>
	<nav class="transparent">
    <div class="nav-wrapper">
      <a href="index.php" class="brand-logo center" style="color: #ff6d00">Brilliant Resumes</a>
    </div>
  </nav>
