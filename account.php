<?php 
require_once 'inc/con.php';
session_start();
if (!isset($_SESSION['grade']) or !isset($_SESSION['id'])) {
  header('Location:login.php');
}
else{
  if (isset($_POST['logout_btn'])) {
    session_destroy();
    header('Location:login.php');
  }
  if (isset($_POST['delete_acc'])) {
    $sql="DELETE FROM students WHERE id='{$_SESSION['id']}'";
    $qu=mysqli_query($con,$sql);
    session_destroy();
    header('Location:register.php');
  }
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
    <link rel="stylesheet" type="text/css" href="css/account.css">
    <link rel="stylesheet" type="text/css" href="css/live.css">
  </head>
  <body> 
    <div class="container-fluid"> 
     <?php require_once 'inc/nav.php'; ?>
      <div class="row" style="margin-top: 60px;">
        <h2 class="main_headings">Live Classes</h2>
      <div class="row">
        <?php 
       $sqlv="SELECT*FROM live_classes WHERE grade='{$_SESSION['grade']}' ORDER BY id DESC";
       $qv = mysqli_query($con,$sqlv);
       while ($rv = mysqli_fetch_assoc($qv)) {
         $idv = $rv['id'];
         $titlev = $rv['title'];
         $desv = $rv['des'];
         $sub = $rv['subject'];
         $linkv = $rv['link'];
         echo '<div class="class col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
         <div class="row">
           <p class="title">'.$titlev.'( '.$sub.' )</p>
           <p class="des">'.$desv.'</p>
           <a class="live_btn" href="player.php?id='.$idv.'&&type=class"><button>Learn</button></a>
         </div>
       </div>
      ';
       }
        ?>
      </div>

        



        <h2 class="main_headings">Account options</h2>
          <form action="account.php" method="post">
            <div class="row btn_im">
              <button name="logout_btn" class="col-12 ">LogOut</button>
            </div>
          </form>
          <form action="account.php" method="post">
            <div class="row btn_del">
              <button name="delete_acc" class="col-12 ">Delete</button>
            </div>
          </form>
        
      </div>
    </div>
    
      <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
 
