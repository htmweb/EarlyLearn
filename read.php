<?php 
require_once 'inc/con.php';
session_start();
if (!isset($_SESSION['grade'])) {
  header('Location:login.php');
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <title>Classes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" type="text/css" href="css/read.css">
  </head>
  <body> 
    <div class="container-fluid"> 
      <?php require_once 'inc/nav.php'; ?>
      <div class="row" style="margin-top: 60px;">
        <div class="col-12">
          <?php 
          $grade=$_SESSION['grade'];
          $sql="SELECT*FROM posts WHERE grade='{$grade}' ORDER BY id DESC";
          $q = mysqli_query($con,$sql);
          while ($result=mysqli_fetch_assoc($q)) {
            $title=$result['title'];
            $des = $result['des'];
            $sender = $result['teacher'];
            $img = $result['img'];

            echo '  <div class="row msg">
            <a class="col-12 col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 img_a" href="posts/'.$img.'"> <img  class="col-12 imgsend" src="posts/'.$img.'"></a>
            <div class="col-12 col-xs-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">
              <h3 class="col-12 title">'.$title.'</h3>
              <p class="col-12 des">'.$des.'</p>
              <p class="col-12 sender">By teacher : '.$sender.'</p>
            </div>
          </div>';
          }
           ?>
    
        </div>
      </div>



   </div>
    
      <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
 
