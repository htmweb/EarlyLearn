<?php 
require_once 'inc/con.php';
if(isset($_POST['submit'])){
  $grade = $_POST['grade'];
  $subject = $_POST['sub'];
   $sqlcheck = "SELECT*FROM quiz WHERE grade='{$grade}' and subject='{$subject}'";
   $q= mysqli_query($con,$sqlcheck);

   $marks=0;
   $wrong_answers = array();
   $correct_of_wrong = array();
   while ($r=mysqli_fetch_assoc($q)) {
   	 $db_id = $r['id'];
   	 $a_correct = $r['correct'];
   	 $str_db_id = (string)$db_id;
   	 $user_answ = $_POST[$str_db_id];
   	 $question=$r['question'];
   	 if ($a_correct==$user_answ) {
   	 	$marks+=2;
   	 }
   	 else{
   	 	$wrong_answers[$question]=$user_answ;
   	 	$correct_of_wrong[$question]=$a_correct;

   	 }
    
   }

}
else{
	header("Location:index.php");
}


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <title>Quiz +id</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" type="text/css" href="css/marks.css">
  </head>
  <body> 
    <div class="container-fluid"> 
      <?php require_once 'inc/nav.php'; ?>
      <div class="row">
      	<div class="col-12">
      	<div class="box1">
      		<p class="marks"><?php 
      		  if (isset($marks)) {
      		  	echo 'Your Marks <p class="marks_num">'.$marks.'</p>';
      		  }
      		 ?></p>
      		<?php 
      		if (empty($wrong_answers)) {
      			echo "<p class='wish'>Good</p>";
      		}

      		 ?>
      		
      	</div>

          <?php 
            if (!empty($wrong_answers)) {
            	echo '<div class="col-12">
                       	<p class="des_title">Correct answer(s) for your wrong answer(s).Green color is the correct answer and the red colour is the wrong answer you submitted.</p>
                      </div>';
            	$n_id=1;
            	foreach ($wrong_answers as $ques => $w_ans) {
            		$c_ans = $correct_of_wrong[$ques];
            		echo '
      	                 <div class="quesbox">
      	                   <div class="row">
      	  	                  <p class="col-12 ques">'.$ques.'</p>
      	  	                  <input class="col-2 col-sm-2 col-md-1 col-lg-1 col-xl-1 correct" type="radio" name="" id="'.$n_id.'" checked="true"><label class="c_txt col-10 col-sm-10 col-md-5 col-lg-5 col-xl-5" for="'.$n_id.'">'.$c_ans.'</label>
      	  	                  <input class="col-2 col-sm-2 col-md-1 col-lg-1 col-xl-1 wrong" type="radio" name="" id="'.$n_id.'" checked="true"><label class="w_txt col-10 col-sm-10 col-md-5 col-lg-5 col-xl-5" for="'.$n_id.'">'.$w_ans.'</label>
      	                  </div>
      	                </div>';
      	            $n_id+=1;    
            	}
            }
           ?>

      	</div>

   </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
 
