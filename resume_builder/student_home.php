<?php 

	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
	if($_SESSION['student_result']==''){
		header("Location: student_login.php");
	}
	 

 ?>


<html>
	<?php include('templates/mat_css_header.php'); ?>
	<div class="container center" style="margin-top: 5%">
		<a href="view_resume.php?rollno=<?php echo $student_result['sid'] ?>" class="waves-effect waves-light btn amber lighten-1 black-text" style="margin-right: 5px">View Resume</a>
		<a href="build_res.php" class="waves-effect waves-light btn amber lighten-1 black-text" style="margin-right: 5px">Edit Resume</a>
		<a href="logout.php" class="waves-effect waves-light btn amber lighten-1 black-text">Log Out</a>
	</div>
	<?php include('templates/footer.php'); ?>
</html>