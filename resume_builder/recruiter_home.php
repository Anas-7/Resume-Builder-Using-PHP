<?php

	include('config/db_connect.php');
	$name = $skills = '';
	$errors = ['name'=>'','skills'=>'','both'=>''];

	if(isset($_POST['submit'])){
		//Check if both fields are empty
		if(empty($_POST['name']) && empty($_POST['skills'])){
			$errors['both'] = 'Please enter atleast one skill or search by name';
		}
		//If name is provided but skills arent
		else if(!empty($_POST['name']) && empty($_POST['skills'])){

			$name = ucwords(mysqli_escape_string($conn,$_POST['name']));
			if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
				$errors['name'] = 'Name must be letters and spaces only';
			}
			else{
				$sql = "SELECT * FROM students WHERE sname='$name'";
				$results = mysqli_query($conn,$sql);
				$results = mysqli_fetch_all($results,MYSQLI_ASSOC);
				if(empty($results)){
					$errors['name'] = "Name doesn't exist in database. Please check spelling and try again.";
				}
				//This data is to be sent to recruiter_result.php
				else{
					if(session_status() == PHP_SESSION_NONE){
	    				session_start();
	  				}
					$_SESSION['recruiter_result'] = $results;
					header('Location: recruiter_result.php');
				}
			}
		}
		//If only skills are provided
		else if(!empty($_POST['skills']) && empty($_POST['name'])){
			$skills = strtolower(mysqli_escape_string($conn,$_POST['skills']));
			if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/',$skills)){
				$errors['skills'] = 'Please enter the skills in comma separated manner using letters and numbers.';
			}else{
			$skillset = explode(',',$skills);
			$sql = "SELECT * FROM students";
			$results = mysqli_query($conn,$sql);
			$results = mysqli_fetch_all($results,MYSQLI_ASSOC);
			if(empty($results)){
				$errors['skills'] = "Database is empty.";
			}
			//This data is to be sent to recruiter_result.php
			else{
					if(session_status() == PHP_SESSION_NONE){
	    				session_start();
	  				}
	  				$skill_results=array();
	  				foreach ($results as $result) {
	  					$skill_count=0;
	  					foreach ($skillset as $skill) {
	  						if(stristr($result['skills'],$skill)){
	  							$skill_count=$skill_count+1;
	  						}
	  						else{
	  							break;
	  						}
	  					}
	  					//All the skills required are present.
	  					if($skill_count==count($skillset)){
	  						array_push($skill_results, $result);
	  					}
	  				}
	  				if(empty($skill_results)){
	  					$errors['skills'] = "The particular set of skill(s) doesn't exist in database. Please try a different combination.";
	  				}
	  				else{
						$_SESSION['recruiter_result'] = $skill_results;
						header('Location: recruiter_result.php');
					}
				}
			}
		}
		//Both fields are provided
		else if(!empty($_POST['skills']) && !empty($_POST['name'])){
			$name = ucwords(mysqli_escape_string($conn,$_POST['name']));
			$skills = strtolower(mysqli_escape_string($conn,$_POST['skills']));
			if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
				$errors['name'] = 'Name must be letters and spaces only';
			}
			else if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/',$skills)){
				$errors['skills'] = 'Please enter the skills in comma separated manner using letters and numbers.';
			}
			else{
				$skillset = explode(',',$skills);
				$sql = "SELECT * FROM students WHERE sname='$name'";
				$results = mysqli_query($conn,$sql);
				$results = mysqli_fetch_all($results,MYSQLI_ASSOC);
				if(empty($results)){
					$errors['name'] = "Name doesn't exist in database. Please check spelling and try again.";
				}
				//This data is to be sent to recruiter_result.php
				else{
					if(session_status() == PHP_SESSION_NONE){
	    				session_start();
	  				}
	  				$skill_results=array();
	  				foreach ($results as $result) {
	  					$skill_count=0;
	  					foreach ($skillset as $skill) {
	  						if(stristr($result['skills'],$skill)){
	  							$skill_count=$skill_count+1;
	  						}
	  						else{
	  							break;
	  						}
	  					}
	  					//All the skills required are present.
	  					if($skill_count==count($skillset)){
	  						array_push($skill_results, $result);
	  					}
	  				}
	  				if(empty($skill_results)){
	  				   $errors['skills'] = "The particular set of skill(s) doesn't exist for the given name. Please try a different combination.";
	  				}
	  				else{
						$_SESSION['recruiter_result'] = $skill_results;
						header('Location: recruiter_result.php');
					}
				}
			}
		}
	}

 ?>

<!DOCTYPE html>
<html>

<?php include('templates/mat_css_header.php')  ?>

<section class="container ">
		<form class="amber lighten-1" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
			<div class="red-text"><?php echo $errors['both']; ?></div>
			<label class="black-text">Name (Optional)</label>
			<input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
			<div class="red-text"><?php echo $errors['name']; ?></div>
			<label class="black-text">Skills (Comma Separated)</label>
			<input type="text" name="skills" value="<?php echo htmlspecialchars($skills) ?>">
			<div class="red-text"><?php echo $errors['skills']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Search" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

<?php include('templates/footer.php') ?>
</html>
