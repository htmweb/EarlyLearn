<?php
  require_once 'inc/con.php';
   if (isset($_GET['g'])&&isset($_GET['sub'])) {
    $sty="'display:block;'";
    $empty_msg="'display:none'";
     $grade = $_GET['g'];
     $sub = $_GET['sub'];
     $sql="SELECT*FROM quiz WHERE grade='{$grade}' and subject='{$sub}'";
     $q = mysqli_query($con,$sql);
     if (mysqli_num_rows($q)==0) {
              $sty='"display:none"';
              $empty_msg="'display:block'";
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
    <title>Quiz <?php echo $sub; ?></title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" type="text/css" href="css/quiz.css">
  </head>
  <body> 
    <div class="container-fluid"> 
      <?php require_once 'inc/nav.php'; ?>
    	<div class="row">
        <div class="title col-12" style=<?php echo $sty; ?>>
          <h2>Start Now!</h2>

        </div>
 <form action="marks.php" method="post">
        <div class="col-12">
         <?php 
         if (isset($q)) {
          $id=1;
          $fid=1;
           while ($r=mysqli_fetch_assoc($q)) {

             $db_id = $r['id'];
             $que = $r['question'];
             $a1 = $r['a1'];
             $a2 = $r['a2'];
             $a3 = $r['a3'];
             $a4 = $r['a4'];
           
           $f2 = $fid;
           $f3 = $f2+1;
           $f4 = $f3+1;
           $f5 = $f4+1;
          echo '<div class="quiz_box row">
            <div class="col-12">
              <p class="quiz">'.$id.') '.$que.'</p>
            </div>
              <input class="answercheck col-2 col-sm-2 col-md-2 col-lg-2 col-xl-1" type="radio" name='.$db_id.' id='.$f2.' value="'.$a1.'">
              <label class="answer col-10 col-sm-10 col-md-10 col-lg-4 col-xl-2" for='.$f2.'>'.$a1.'</label>
              <input class="answercheck col-2 col-sm-2 col-md-2 col-lg-2 col-xl-1" type="radio" name='.$db_id.' id='.$f3.' value="'.$a2.'">
              <label class="answer col-10 col-sm-10 col-md-10 col-lg-4 col-xl-2" for='.$f3.'>'.$a2.'</label>
              <input class="answercheck col-2 col-sm-2 col-md-2 col-lg-2 col-xl-1" type="radio" name='.$db_id.' id='.$f4.' value="'.$a3.'">
              <label class="answer col-10 col-sm-10 col-md-10 col-lg-4 col-xl-2" for='.$f4.'>'.$a3.'</label>
              <input class="answercheck col-2 col-sm-2 col-md-2 col-lg-2 col-xl-1" type="radio" name='.$db_id.' id='.$f5.' value="'.$a4.'">
              <label class="answer col-10 col-sm-10 col-md-10 col-lg-4 col-xl-2" for='.$f5.'>'.$a4.'</label>
             
          </div>';
          $id=$id+1;
          $fid = $f5+1;
        }
        }
          ?>
         

    	</div>
      <input type="text" value="<?php echo $grade; ?>" name="grade" style="display: none;">
      <input type="text" value="<?php echo $sub; ?>" name="sub" style="display: none;">
      <center style="margin-top: 60px;"><h3 style=<?php echo $empty_msg ?>>No questions found.</h3></center>
      <button name="submit" class="submit" style=<?php echo $sty; ?>>Submit</button>
</form>
    </div>

   </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>