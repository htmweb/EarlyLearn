<?php
 require_once 'inc/con.php';
 if (isset($_POST['submit'])) {
   	$usr = $_POST['user_name'];
   	$name = $_POST['name'];
   	$school = $_POST['school'];
   	$grade = $_POST['grade'];
   	$mail = $_POST['email'];
   	$pass_txt = $_POST['password'];
    $password = md5($pass_txt);
   	$sql = mysqli_query($con,"INSERT INTO students (username,name,school,level,email,password) VALUES ('{$usr}','{$name}','{$school}','{$grade}','{$mail}','{$password}')");
   	if ($sql) {
   		header("Location:index.php");
   	}

   }  
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/register.css">
  </head>
  <body background="img/bg.jpg">
  	<div class="col-12 bg">
    <div class="container-fluid">
    	<div class="row">
    		
    		<div class="d-none d-md-block col-md-6 col-lg-6 col-xl-6">
    			<div class="txt_box">
    			<div class="col-12 bodytxt_b">
    			<h2 class="body_txt">Get Learn</h2>
    			<h2 class="body_txt">Get Marks</h2>
    			<h2 class="body_txt">Get Reward</h2>
    		</div>
    		</div>
    		</div>
    		<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 box_log">
    			<div class="box_pos">
    				<form method="post" action="register.php">
    				<h3 class="reg_txt">Register</h3>

    				<input type="text" name="name" placeholder="Name" class="col-12 input_b" required><br>
    				<input type="text" name="user_name" placeholder="User name" class="col-12 input_b" required><br>
    				<input type="text" name="school" placeholder="School" class="col-12 input_b" required><br>
    				<input type="text" name="grade" placeholder="Grade" class="col-12 input_b" required><br>
    				<input type="text" name="email" placeholder="Email" class="col-12 input_b" required><br>
    				<input type="password" name="password" placeholder="Password" class="col-12 input_b" required>
    				<input type="submit" name="submit" value="Sign Up" class="col-12 input_button">
    			</form>
    			</div>
    		</div>
    	</div>
    	</div>
    </div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>