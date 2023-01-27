<?php
 require_once 'inc/con.php';
 session_start();
 if (isset($_POST['submitin'])) {
   	$mail = $_POST['email'];
   	$pass_txt = $_POST['password'];
    $md5pss= md5($pass_txt);
   	$q = mysqli_query($con,"SELECT*FROM teachers WHERE email='{$mail}' and password='{$md5pss}' LIMIT 1");
    $result = mysqli_fetch_assoc($q);
    if(empty($result)){
    	$msg="Incorrect username or password.";
    }
    else{
    	$_SESSION['t_subject'] = $result['subject'];
        $_SESSION['t_id'] = $result['id'];
        $_SESSION['t_name'] = $result['username'];
    	header('Location:teacher_account.php');
    }
    

   }  
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LogIn</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
  </head>
  <body background="img/bg.jpg">
  	<div class="col-12 bg">
    <div class="container-fluid">
    	<div class="row">
    		
    		<div class="d-none d-md-block col-md-6 col-lg-6 col-xl-6">
    			<div class="txt_box">
    			<div class="col-12 bodytxt_b">
    			<h2 class="body_txt"> Welcome Again.<br><br>Continue Your teaching now...<br></h2>
    			
    		</div>
    		</div>
    		</div>
    		<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 box_log">
    			<div class="box_pos">
    				<form method="post" action="teacherlogin.php">
    				<h3 class="reg_txt">SignIn</h3>
    				<p class="red_msg"><?php if(isset($msg)){echo $msg;}?></p>
    				<input type="text" name="email" placeholder="Email" class="col-12 input_b" required><br>
    				<input type="password" name="password" placeholder="Password" class="col-12 input_b" required>
    				<input type="submit" name="submitin" value="Sign In" class="col-12 input_button">
    			</form>
    			</div>
    		</div>
    	</div>
    	</div>
    </div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>