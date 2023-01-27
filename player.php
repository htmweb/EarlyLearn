<?php 
require_once 'inc/con.php';
session_start();
if (!isset($_SESSION['grade'])) {
  header('Location:login.php');
}
if (!isset($_GET['id'])&& !isset($_GET['type'])) {
    header('Location:login.php');

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <title>Player</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" type="text/css" href="css/player.css">
  </head>
  <body> 
    <div class="container-fluid"> 
      <?php require_once 'inc/nav.php'; ?>
      <div class="row" style="margin-top: 60px;">
        <?php 
         $id =$_GET['id'];
         $type=$_GET['type'];
         if ($type=='live') {
          $db='live_classes';
         }
         else{
          $db='videos';
         }
         $sql="SELECT*FROM ".$db." WHERE id='{$id}'";
         $q=mysqli_query($con,$sql);
         $res = mysqli_fetch_assoc($q);
         if ($res['link']=='') {
           echo "<h2 class='err'>This live has not started yet.</h2>";
         }else{
         echo '<div class="vid">'.$res['link'].'</div>';
         }
         ?>
      </div>

  

   </div>
    
      <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
 
