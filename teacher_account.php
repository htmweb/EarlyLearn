<?php 
require_once 'inc/con.php';
session_start();
if (!isset($_SESSION['t_subject']) or !isset($_SESSION['t_id']) or !isset($_SESSION['t_name'])) {
  header('Location:teacherlogin.php');
}
else{

  if (isset($_POST['logout_btn'])) {
    session_destroy();
    header('Location:teacherlogin.php');
  }
  if (isset($_POST['delete_acc'])) {
    $sql="DELETE FROM teachers WHERE id='{$_SESSION['t_id']}'";
    $qu=mysqli_query($con,$sql);
    session_destroy();
    header('Location:teacher_register.php');
  }
  if (isset($_POST['submit'])) {
    $dbv='';
    $title = $_POST['title']; 
    $link = $_POST['link'];
    $des = $_POST['des'];
    $type = $_POST['type'];
    $grade = $_POST['grade'];
    if ($type=='video') {
      $dbv='videos';
    }
    if ($type=='live') {
      $dbv='live_classes';
    }
    $upload_sql = "INSERT INTO {$dbv} (title,grade,subject,link,des) VALUES ('{$title}','{$grade}','{$_SESSION['t_subject']}','{$link}','{$des}')";
    $upload_q = mysqli_query($con,$upload_sql);
    if ($upload_q) {
      header('Location:teacher_account.php#'.$dbv.'');
    }
  }
  if (isset($_POST['del_live'])) {
    $live_id=$_POST['idl'];
    $sql_del_live = "DELETE FROM live_classes WHERE id='{$live_id}'";
    $del_live_q = mysqli_query($con,$sql_del_live);
    if ($del_live_q) {
      header("Location:teacher_account.php");
    }
  }
  if (isset($_POST['del_vid'])) {
    $vid_id=$_POST['idv'];
    $sql_del_vid = "DELETE FROM videos WHERE id='{$vid_id}'";
    $del_vid_q = mysqli_query($con,$sql_del_vid);
    if ($del_vid_q) {
      header("Location:teacher_account.php");
    }
  }
  if (isset($_POST['submit_p']) && isset($_FILES['img_post'])) {
    $title_p= $_POST['title_p'];
    $grade_p=$_POST['grade_q'];
    $des_p = $_POST['des_p'];
    $upload_name = $title_p.$grade_p.$_FILES['img_post']['name'];
    $imgp = $_FILES['img_post']['tmp_name'];
    $type_p = (pathinfo(basename($_FILES['img_post']['name']),PATHINFO_EXTENSION));
    $dir='posts/';
    $file_err=array();
    if (filesize($imgp)>500000000) {
      $file_err[0] = 'File size too large';
    }
    if ($type_p!='jpg' && $type_p!='JPG' && $type_p!='jpeg' && $type_p!='JPEG' && $type_p!='png' && $type_p!='PNG') {
      $file_err[1] = ''.$type_p.'Invalid file';
    }
    if (empty($file_err)) {
     $post_sql = "INSERT INTO posts (title,des,img,teacher,grade) VALUES('{$title_p}','{$des_p}','{$upload_name}','{$_SESSION['t_name']}','{$grade_p}')";
     $post_q = mysqli_query($con,$post_sql);
     move_uploaded_file($imgp, $dir.$upload_name);
     
    }

  }
    if (isset($_POST['submit_vid']) && isset($_FILES['video'])) {
    $title_vid= $_POST['title_vid'];
    $grade_vid=$_POST['grade_vid'];
    $des_vid = $_POST['des_vid'];
    $upload_namev = $title_vid.$grade_vid.$_FILES['video']['name'];
    $vid = $_FILES['video']['tmp_name'];
    $type_v = (pathinfo(basename($_FILES['video']['name']),PATHINFO_EXTENSION));
    $dir='vid/g'.$grade_vid.'/'.$upload_namev;
    $link_vid = '<video src='.$dir.' height="80%" width="100%" controls="show" autoplay="true"></video>';
    $file_errvid=array();
    if (filesize($vid)>1073741824) {
      $file_errvid[0] = 'File size too large';
    }
    if ($type_v!='mp4' && $type_v!='3gp' && $type_v!='mov') {
      $file_errvid[1] = ''.$type_v.'Invalid file';
    }
    if (empty($file_errvid)) {
     $uploadvid_sql = "INSERT INTO videos (title,grade,subject,link,des) VALUES ('{$title_vid}','{$grade_vid}','{$_SESSION['t_subject']}','{$link_vid}','{$des_vid}')";
    $uploadvid_q = mysqli_query($con,$uploadvid_sql);
     move_uploaded_file($vid,$dir);
     
    }

  }
  if (isset($_POST['del_post'])) {
    $id=$_POST['idp'];
    $p_del_sql="DELETE FROM posts WHERE id='{$id}'";
    $p_del_q = mysqli_query($con,$p_del_sql);
    if ($p_del_sql) {
      header('Location:teacher_account.php#posts');
    }
  }
  if (isset($_POST['upload_quiz'])) {
    $ques=$_POST['question'];
    $a1 = $_POST['a1'];
    $a2 = $_POST['a2'];
    $a3 = $_POST['a3'];
    $a4 = $_POST['a4'];
    $ac = $_POST['ac'];
    $g_q = $_POST['grade_q'];
    $d_q = date('Y-m-d',time());
    $d_compare = strtotime($d_q);
    $quizsql="SELECT*FROM quiz WHERE grade='{$g_q}' and subject='{$_SESSION['t_subject']}'";
    $quizq = mysqli_query($con,$quizsql);
    while ($qr=mysqli_fetch_assoc($quizq)) {
      $date_q = strtotime($qr['date_p']);

      $idq = $qr['id'];
      if ($d_compare>$date_q) {
        $q_del = "DELETE FROM quiz WHERE id='{$idq}'";
        $qq = mysqli_query($con,$q_del);
        
        }
      }
       $quiz_ins="INSERT INTO quiz (question,a1,a2,a3,a4,correct,date_p,grade,subject) VALUES ('{$ques}','{$a1}','{$a2}','{$a3}','{$a4}','{$ac}','{$d_q}','{$g_q}','{$_SESSION['t_subject']}')";
          echo "string";
          $ins_q=mysqli_query($con,$quiz_ins);
          if ($ins_q) {
            header('Location:teacher_account.php');
          }

    }
  
 
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher account</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" type="text/css" href="css/account.css">
    <link rel="stylesheet" type="text/css" href="css/live.css">
    <link rel="stylesheet" type="text/css" href="css/teacher_account.css">

  </head>
  <body> 
    <div class="container-fluid"> 
      <div class="row">
         <div class="teacher_nav col-12">
       <h3 class="name">EarlyLearn</h3>
     </div>
        <h2 id="live_classes" class="main_headings" style="margin-top: 90px;"><?php echo $_SESSION['t_subject']; ?> live Classes</h2>
      <div class="row">
        <?php 
       $sqlv="SELECT*FROM live_classes WHERE subject='{$_SESSION['t_subject']}' ORDER BY id DESC";
       $qv = mysqli_query($con,$sqlv);
       while ($rv = mysqli_fetch_assoc($qv)) {
         $title = $rv['title'];
         $des = $rv['des'];
         $sub = $rv['subject'];
         $idl=$rv['id'];
         echo '<div class="class col-12 col-sm-12 col-md-12 col-lg-4 col-xl-3">
         <div class="row">
         <form action="teacher_account.php" method="post">
           <p class="col-12 title">'.$title.'</p>
           <p class="col-12 des">'.$des.'</p>
           <input class="col-12" name="idl" value='.$idl.' style="display:none"/>
           <button class="delete"  name="del_live">Delete</button>
          </form>
         </div>
         
      
       </div>
      ';
       }
        ?>
      </div>
       
        <h2 id="videos" class="main_headings" style="margin-top: 60px;"><?php echo $_SESSION['t_subject']; ?> Video Classes</h2>
      <div class="row">
        <?php 
       $sqlv="SELECT*FROM videos WHERE subject='{$_SESSION['t_subject']}' ORDER BY id DESC";
       $qv = mysqli_query($con,$sqlv);
       while ($rv = mysqli_fetch_assoc($qv)) {
         $titlev = $rv['title'];
         $desv = $rv['des'];
         $idv = $rv['id'];
         echo '<div class="class col-12 col-sm-12 col-md-12 col-lg-4 col-xl-3">
         <div class="row"> 
         <form action="teacher_account.php" method="post">
           <p class="col-12 title">'.$titlev.'</p>
           <p class="col-12 des">'.$desv.'</p>
           <input class="col-12" name="idv" value='.$idv.' style="display:none"/>
           <button class="delete" name="del_vid">Delete</button>
           </form>
         </div>
        
       </div>
      ';
       }
        ?>
      </div>






        <h2 id="posts" class="main_headings" style="margin-top: 60px;">Upload Posts</h2>
      <div class="row">
        <?php 
       $sqlp="SELECT*FROM posts WHERE teacher='{$_SESSION['t_name']}' ORDER BY id DESC";
       $qp = mysqli_query($con,$sqlp);
       if (mysqli_num_rows($qp)==0) {
         echo "<center>No posts uploaded yet.</center>";
       }
       while ($rp = mysqli_fetch_assoc($qp)) {
         $titlep = $rp['title'];
         $imgp = $rp['img'];
         $desp = $rp['des'];
         $idp = $rp['id'];
         echo '

         <div class="class col-12 col-sm-12 col-md-12 col-lg-4 col-xl-3">         
           <form action="teacher_account.php" method="post">
           <p class="col-12 title">'.$titlep.'</p>
           <p class="col-12 des">'.$desp.'</p>
           <input class="col-12" name="idp" value='.$idp.' style="display:none"/>
           <button class="delete" name="del_post">Delete</button>
           </form>
           
         </div>
        
      ';
       }
        ?>
      </div>


      <div class="row">
        <h2 class="main_headings">Setup a class</h2>
        <div class="upload">
        <form action="teacher_account.php" method="post">
          <input class="input_box col-12" type="text" name="title" placeholder="Title" required>
          <input class="input_box col-12" type="text" name="link" placeholder="Link" required>   
            <select name="grade" class="input_box col-12">
            <option value="6">Grade 6</option>
            <option value="7">Grade 7</option>
            <option value="8">Grade 8</option>
            <option value="9">Grade 9</option>
          </select>                             
          <textarea  class="input_box col-12"name="des" placeholder="Description" required></textarea>
          <input class="input_box" type="radio" name="type" id="1" value="video" required><label for="1">Video</label>
          <input class="input_box" type="radio" name="type" id="2" value="live" required><label for="2">Live</label>
          <button name="submit" class="upload_btn">Upload</button>
        </form>
      </div>
      </div>

       <div class="row">
        <h2 class="main_headings">Upload video class</h2>
        <div class="upload">
          <p class="err"><?php if (!empty($file_errvid)) {
            foreach ($file_errvid as $errv) {
              echo $errv;
            }
          } ?></p>
        <form action="teacher_account.php" method="post" enctype="multipart/form-data">
          <input class="input_box col-12" type="text" name="title_vid" placeholder="Title" required>
          <input type="file" name="video" class="input_box col-12">
            <select name="grade_vid" class="input_box col-12">
            <option value="6">Grade 6</option>
            <option value="7">Grade 7</option>
            <option value="8">Grade 8</option>
            <option value="9">Grade 9</option>
          </select>                             
          <textarea  class="input_box col-12"name="des_vid" placeholder="Description" required></textarea>
          <button name="submit_vid" class="upload_btn">Upload</button>
        </form>
      </div>
      </div>

  
     <div class="row">
        <h2 class="main_headings">Setup a quiz</h2>
        <div class="upload">
        <form action="teacher_account.php" method="post">
          <select name="grade_q" class="input_box col-12">
            <option value="6">Grade 6</option>
            <option value="7">Grade 7</option>
            <option value="8">Grade 8</option>
            <option value="9">Grade 9</option>
          </select> 
          <textarea class="input_box col-12" type="text" name="question" placeholder="Add Question 1" required></textarea>
          <input class="input_box col-4" type="text" name="a1" placeholder="Answer 1" required>   
          <input class="input_box col-4" type="text" name="a2" placeholder="Answer 2" required>
          <input class="input_box col-4" type="text" name="a3" placeholder="Answer 3" required>
          <input class="input_box col-4" type="text" name="a4" placeholder="Answer 4" required>
          <input class="input_box col-4" type="text" name="ac" placeholder="Correct Answer" required>                          
          <button name="upload_quiz" class="upload_btn">Add</button>
        </form>
      </div>
      </div>

      <div class="row">
        <h2 class="main_headings" id="posts">Setup Post</h2>
        <div class="upload">
        <form action="teacher_account.php" method="post" enctype="multipart/form-data">
          <input class="input_box col-12" type="text" name="title_p" placeholder="Title" required> 
          <select name="grade_q" class="input_box col-12">
            <option value="6">Grade 6</option>
            <option value="7">Grade 7</option>
            <option value="8">Grade 8</option>
            <option value="9">Grade 9</option>
          </select>     
          <textarea  class="input_box col-12"name="des_p" placeholder="Description" required></textarea>
          <p class="err"><?php if (!empty($file_err)) {
            foreach ($file_err as $err) {
              echo $err;
            }
          } ?></p>
          <input class="col-12 input_box" type="file" name="img_post">
          <button name="submit_p" class="upload_btn">Upload post</button>
        </form>
      </div>
      </div>
        <h2 class="main_headings">Account options</h2>
          <form action="teacher_account.php" method="post">
            <div class="row btn_im">
              <button name="logout_btn" class="col-12 ">LogOut</button>
            </div>
          </form>
          <form action="teacher_account.php" method="post">
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
 
