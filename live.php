<?php 
require_once 'inc/con.php';
session_start();
if (!isset($_SESSION['grade'])) {
  header('Location:login.php');
}
if (!isset($_GET['grade'])&& !isset($_GET['sub'])) {
    header('Location:login.php');

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Classes</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" type="text/css" href="css/live.css">
  </head>
  <body> 
    <div class="container-fluid"> 
      <?php require_once 'inc/nav.php'; ?>
      <div class="row" style="margin-top: 60px;">
      <div class="col-12">
        <h2 class="live">Live Classes</h2>
      </div>
       <div class="row">
         <?php 
       $sql="SELECT*FROM live_classes WHERE grade='{$_SESSION['grade']}' and subject='{$_GET['sub']}' ORDER BY id DESC";
       $q = mysqli_query($con,$sql);
       if (mysqli_num_rows($q)==0) {
         echo "<center> No live classes upload yet. </center>";
       }
       while ($r = mysqli_fetch_assoc($q)) {
         $id = $r['id'];
         $title = $r['title'];
         $des = $r['des'];
         $link = $r['link'];
         
         echo '<div class="class col-12 col-sm-12 col-md-12 col-lg-4 col-xl-3">
         <div class="row">
           <p class="title">'.$title.'</p>
           <p class="des">'.$des.'</p>
           <a class="live_btn" href="player.php?id='.$id.'&&type=live"><button>Join</button></a>
         </div>
       </div>
      ';
       }
        ?>
       </div>
       <h2 class="col-12 video">Video Lessons</h2>
        <div class="row"> 
     <?php 
       $sqlv="SELECT*FROM videos WHERE grade='{$_SESSION['grade']}' and subject='{$_GET['sub']}' ORDER BY id DESC";
       $qv = mysqli_query($con,$sqlv);
       if (mysqli_num_rows($qv)==0) {
         echo "<center> No classes upload yet. </center>";
       }
       while ($rv = mysqli_fetch_assoc($qv)) {
         $idv = $rv['id'];
         $titlev = $rv['title'];
         $desv = $rv['des'];
         $linkv = $rv['link'];
         echo '<div class="class col-12 col-sm-12 col-md-12 col-lg-4 col-xl-3">
         <div class="row ">
           <p class="title">'.$titlev.'</p>
           <p class="des">'.$desv.'</p>
           <a class="live_btn" href="player.php?id='.$idv.'&&type=class"><button>Learn</button></a>
         </div>
       </div>
      ';
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
 
