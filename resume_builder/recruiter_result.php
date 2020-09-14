<?php 
	if(session_status() == PHP_SESSION_NONE){
	    session_start();
	 }
 ?>

<!DOCTYPE html>
<html>
	<?php include('templates/mat_css_header.php') ?>
	<ul class="collection">
	<div class="divider red"></div>
    <div class="divider red"></div>
    <div class="divider red"></div>
	<?php foreach ($recruiter_result as $result) {?>
    <li class="collection-item avatar amber lighten-1">
      <span class="title"><strong>Name:</strong> <?php echo ucwords($result['sname']); ?></span>
      <p><strong>Skills:</strong> <?php echo ucwords($result['skills']); ?>		
      </p>
      <span><a href="view_resume.php?rollno=<?php echo $result['sid'] ?>" class="btn waves-effect waves-light secondary-content" name="view_resume">View Resume<i class="material-icons right">send</i></a></span>
    </li>
    <div class="divider red"></div>
    <div class="divider red"></div>
    <div class="divider red"></div>
<?php } ?>
  	</ul>
	<?php include('templates/footer.php') ?>
</html>