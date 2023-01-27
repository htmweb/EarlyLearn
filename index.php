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
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EarlyLearn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
  </head>
  <body> 
    <div class="container-fluid"> 
      <?php require_once 'inc/nav.php'; ?>
      <div class="row main">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
          <h1 class="cover_cap">Let's make a new chapter in online education.The most valuable elearning website.Start from now!</h1>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
          <img class="cover" src="img/learning.jpg">
        </div>  
      </div>

     
        <div class="row">
        <div data-aos="zoom-in">
        <div class="col-12">
          <h2 class="subjects" id="subjects">Subjetcs</h2>
        </div>
      </div>
       

      <?php 
        $sub= array('Maths','Science','ICT','Sinhala','History','Buddhism','English','Civics','Geography','P.T.S',);
        $i=0;
        $g=$_SESSION['grade'];
        while($i<10){
          echo '<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3" data-aos="fade-Up">
       <div class="card mb-3" style="max-width: 18rem;">
       <div class="card-header bg-transparent">'.$sub[$i].'</div>
       <div class="card-body text-success">
         <img class="card_pic" src="img/pic.jpg">
       </div>
       <div class="card-footer bg-transparent">
         <div class="row">
           <a class="col-6 card_a" href="live.php?g='.$g.'&&sub='.$sub[$i].'"><button class="card_btn">Learn</button></a>
         <a class="col-6 card_a" href="dailyquiz.php?g='.$g.'&&sub='.$sub[$i].'"><button class="card_btn">Quiz</button></a>
         </div>
       </div>
       </div>
      </div>
'; $i+=1;
        }
       ?>
      
      </div>


     <div data-aos="fade-Up">
        <div class="row">
          <center><h3 class="users"><?php 
          $users_sql = "SELECT*FROM students";
          $stu_q=mysqli_query($con,$users_sql);
          echo mysqli_num_rows($stu_q); ?>+ Users</h3></center>
        </div>
     </div>
  
     <div class="row">
      <div data-aos="zoom-in">
        <div class="col-12">
          <h2 class="subjects" id="op">Get the opportunities</h2>
        </div>
      </div>
       <div data-aos="fade-Up" class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 img_o">
        <div class="box_t">
         <img class="col-12 img_f mx-auto d-block " src="img/learn.png">
         <h3 class="col-12 img_t">Learn</h3>
       </div>
       </div>
        <div data-aos="fade-Up" class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 img_o">
         <div class="box_t">
         <img class="col-12 img_f mx-auto d-block " src="img/check.png">
         <h3 class="col-12 img_t">Check you knowledge</h3>
       </div>
       </div>
        <div data-aos="fade-Up" class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 img_o">
         <div class="box_t">
           <img class="col-12 img_f mx-auto d-block " src="img/read.png">
           <h3 class="col-12 img_t">Oppurtunity to learn extra knowledge.</h3>
         </div>
         </div>
       </div>
     
       
     <div class="footer">
     <div class="row">
       <div class="col-12 colsm12 col-md-6 col-lg-3 col-xl-4">
         <h3 class="footer_h">About-Us</h3>
         <p class="about_txt">We are trying to open a new chapter in e-learning.</p>
       </div>
       <div class="col-12 colsm12 col-md-6 col-lg-3 col-xl-4">
         <h3 class="footer_h">Quick Links</h3>
         <ul class="q_links">
           <li><a href="index.php"><span>&#x2714; </span>Home</a></li>
           <li><a href="account.php"><span>&#x2714; </span>Account</a></li>
           <li><a href="read.php"><span>&#x2714; </span>Read</a></li>
           <li><a href="index.php#subjects"><span>&#x2714; </span>Subjects</a></li>
         </ul>
       </div>
       <div class="col-12 colsm12 col-md-6 col-lg-3 col-xl-4">
         <h3 class="footer_h">Contact-Us</h3>
         <ul class="contact_ul">
           <li><img src="img/gmail.png" class="img_ic">example@domain.com</li>
           <li><a href="#"><img src="img/facebook.png" class="img_ic">Facebook</a></li>
           <li><a href="#"><img src="img/instagram.png" class="img_ic">Instagram</a></li>
           <li><a href="#"><img src="img/twitter.png" class="img_ic">Twitter</a></li>
         </ul>
       </div>
     </div> 
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
 
