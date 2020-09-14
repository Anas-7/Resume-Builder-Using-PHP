<?php 
	include("config/db_connect.php");
	if(!isset($email)){
		$email='';
	}
	if(!isset($password)){
		$password='';
	}
	$errors = array('email'=>'','password'=>'','both'=>'');
	if(isset($_POST['submit'])){

		//Check if both fields are empty
		if(empty($_POST['email']) && empty($_POST['password'])){
			$errors['both'] = 'Please enter the details.';
		}
		//If email is provided but password isnt
		else if(!empty($_POST['email']) && empty($_POST['password'])){
			$errors['password'] = 'Please enter the password';
		}
		//If password is provided but email isnt
		else if(!empty($_POST['password']) && empty($_POST['email'])){
			$errors['email'] = 'Please enter the email id.';
		}
		else if(!empty($_POST['password']) && !empty($_POST['email'])){
			//Check if email is in valid format
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('^[A-Za-z0-9._%+-]+@spit.ac.in$', $email)){
				$errors['email'] = 'Email id must be a valid email address.';
			}
			else{
				$email = mysqli_escape_string($conn,$_POST['email']);
				$password = mysqli_escape_string($conn,$_POST['password']);
				$sql = "SELECT * FROM students WHERE semail='$email'";
				$result = mysqli_query($conn,$sql);
				$result = mysqli_fetch_assoc($result);
				if(empty($result)){
					$errors['email'] = 'Email id doesnt exist. Please check spelling or sign up.';
				}
				else{
					if($result['spwd']!=$password){
						$errors['password'] = "Password is incorrect. Please try again.";
					}
					else{
						if(session_status() == PHP_SESSION_NONE){
	    				session_start();
	  					}
	  					$_SESSION['student_result'] = $result;
	  					header('Location: student_home.php');
					}
				}
			}
		}
	}

 ?>


<html>
	<?php include('templates/mat_css_header.php') ?>
	<form class="amber lighten-1" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<div class="red-text"><?php echo $errors['both']; ?></div>
		<label class="black-text">Email ID:</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
		<div class="red-text"><?php echo $errors['email']; ?></div>
		<label class="black-text">Password:</label>
		<input type="password" name="password" value="<?php echo htmlspecialchars($password) ?>">
		<div class="red-text"><?php echo $errors['password']; ?></div>
		<div>
			<input type="submit" name="submit" value="Log In" class="btn brand z-depth-0 right-align">
			<a href="student_signup.php" name="signup" value="Sign Up" class="btn brand z-depth-0 left-align">Sign Up</a>
		</div>

	</form>

	<?php include('templates/footer.php') ?>
</html>