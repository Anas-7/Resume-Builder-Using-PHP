<?php 
	if(session_status() == PHP_SESSION_NONE){
    session_start();
  	}
	if(isset($_GET['rollno'])){
		include('config/db_connect.php');

		$rollno = mysqli_escape_string($conn,$_GET['rollno']);
		$rollno = (int) $rollno;
		$sql = "SELECT * FROM students WHERE sid=$rollno";
		$result = mysqli_query($conn,$sql);
		$result = mysqli_fetch_assoc($result);
		$year='';
		if($result['syear']==1){
			$year='First Year';
		}
		else if($result['syear']==2){
			$year='Second Year';
		}
		else if($result['syear']==3){
			$year='Third Year';
		}
		else if($result['syear']==4){
			$year='Fourth Year';
		}

		$skill_set=explode(',',$result['skills']);
	}

 ?>
<html>
	<?php include('templates/mat_css_header.php'); ?>
	<div class="container  amber lighten-1" style="margin-top: 5%;">
    	<div class="divider red"></div>
		  <div class="section">
		    <h5 style="color: #ff1744;margin-left: 10px">Personal Information</h5>

		    <h6 style="color: #304ffe;margin-left: 10px ">Name: <?php echo ucwords($result['sname']); ?></h6>
		    <h6 style="color: #304ffe;margin-left: 10px ">Email: <?php echo $result['semail']; ?></h6>
		    <h6 style="color: #304ffe;margin-left: 10px ">Phone No: <?php echo $result['phonenum']; ?></h6>
		    <h6 style="color: #304ffe;margin-left: 10px ">Description: <?php echo $result['sinfo']; ?></h6>
		  </div>
		  <div class="divider red"></div>
		  <div class="section">
		    <h5 style="color: #ff1744;margin-left: 10px">Education</h5>
		    <h6 style="color: #304ffe;margin-left: 10px ">10th Standard: <?php echo $result['s10']."%"; ?></h6>
		    <h6 style="color: #304ffe;margin-left: 10px ">12th Standard: <?php echo $result['s12']."%" ?></h6>
		    <h6 style="color: #304ffe;margin-left: 10px ">Current Class: <?php echo $year." (".$result['sbranch'].")" ?></h6>
		    <h6 style="color: #304ffe;margin-left: 10px ">CGPA: <?php echo $result['cgpa']; ?></h6>
		  </div>
		  <div class="divider red"></div>
		  <div class="section">
		    <h5 style="color: #ff1744;margin-left: 10px">Skills</h5>
		    <?php foreach ($skill_set as $skill) {?>
		    <h6 style="color: #304ffe;margin-left: 10px "><?php echo ucwords($skill); ?></h6>
			<?php } ?>
		  </div>
	</div>

	<?php include('templates/footer.php') ?>
</html>