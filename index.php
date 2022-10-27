<?php
$conn = mysqli_connect('localhost','u874471053_syedmomin','8:Y]|NI+d','u874471053_game');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
 

if(isset($_POST['save']))
{	 

    $corct = $_POST['corect'];
    $wrng = $_POST['wrong'];
    $ans = $corct*100/12;
$mail = new PHPMailer();
// $mail->IsSMTP();
$mail->CharSet="UTF-8";
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.hostinger.com';
$mail->Port = 465;
$mail->Username = 'admin@infotechabout.com';
$mail->Password = 'Admin123456#$';
$mail->SMTPAuth = true;

$mail->From = 'admin@infotechabout.com';
$mail->FromName = 'Level UP Game';
$mail->AddAddress('ayesha.javaid@dawoodhercules.com');
$mail->AddReplyTo('admin@infotechabout.com', 'technology');

$mail->IsHTML(true);
$mail->Subject    = "Dataminds Technology"; 

$mail->Body    = "Email ".$_POST['mail']." <br/> Result ".$_POST['nam']." => Total Correct Answer ".$corct." Total Wrong Answer " .$wrng." percentage".$ans."%";

if(!$mail->Send())
{
  echo "Mailer Error: " . $mail->ErrorInfo;
}

echo "<script>window.location.href = 'index.php';</script>";
}
if(isset($_POST['corct'])){
 $max = mysqli_query($conn,"SELECT MAX(st_cnfrm)+1 FROM login where mal = '".$_SESSION['nam']."'");
  $max_row = mysqli_fetch_row($max);
  if($max_row[0] != null)
  {
      $corect_ans = $max_row[0] ;
  }
  else{
      $corect_ans = 1;
  }  
mysqli_query($conn,"UPDATE login set st_cnfrm = '".$corect_ans."' where mal = '".$_SESSION['nam']."'");
}
if(isset($_POST['wrng'])){
  $max = mysqli_query($conn,"SELECT MAX(st_wrng)+1 FROM login where mal = '".$_SESSION['nam']."'");
  $max_row = mysqli_fetch_row($max);
  if($max_row[0] != null)
  {
      $wrong_ans = $max_row[0];
  }
  else{
      $wrong_ans = 1;
  } 
mysqli_query($conn,"UPDATE login set st_wrng = '".$wrong_ans."' where mal = '".$_SESSION['nam']."'");   
}
if(isset($_POST['sid'])){
  mysqli_query($conn, "UPDATE login set timr3 = '".$_POST['sid']."' where mal = '".$_SESSION['nam']."'");
}
if(isset($_POST['fin'])){
  mysqli_query($conn, "UPDATE login set status3 = '".$_POST['fin']."' where mal = '".$_SESSION['nam']."'");
}
if(isset($_POST['ste'])){
  mysqli_query($conn, "UPDATE login set kelu = '".$_POST['ste']."' where mal = '".$_SESSION['nam']."'");
}

if(!isset($_SESSION['nam'])){
  header("location:index.php");
  die();  
}
// else{
//   $sam = mysqli_query($conn,"select * from login where nam = '".$_SESSION['nam']."' ");
//   $de = mysqli_fetch_array($sam);
//   header('Location: '.$de['kelu']);
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script src="game.js"></script>
</head>
<style>
body {
  <?php 
if(isset($_GET['ck'])){
 $s = mysqli_query($conn,"SELECT * FROM questions where id = '".$_GET['ck']."'");
 $s1  = mysqli_fetch_array($s);
 ?>
 background: url(<?php echo $s1['bg'] ?>);
 <?php }else{ ?>
  background: url(bg.jpg);
  <?php }?> 
  background-repeat: round;
  background-attachment:fixed;
  overflow-y: hidden; 
  overflow-x: hidden; 
    margin: 0;
}

.hero-image {
      visibility:hidden;
background-image: url("Male-climb.gif");
    height: auto;
background-repeat: round;
background-attachment: fixed;
}
.hero-image1{
visibility:hidden;
background-image: url("Female-climb.gif");
    height: auto;
background-repeat: round;
background-attachment: fixed;
}

.background-image {
  visibility:hidden;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
    background-size: auto;
    background-attachment: fixed;
    -webkit-animation:linear infinite alternate;
    -webkit-animation-name: yeep;
    -webkit-animation-duration: 3s;
}
@-webkit-keyframes yeep {
    0% {
      left: 100%;
    }
    100% {
      left: 0;
    }
}
#mot{
  height: -webkit-fill-available;
  position: absolute;
    left: -100%;
}

.unbox{
  width: 700px;
  height: auto;
  background-color: #ffffffc4;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
  padding: 5px;
  position: absolute;
  bottom:0;
  left :29%;
}
.box {
  width: 420px;
  height: auto;
  background-color: #ffffffff;
  color: #000;
  border-radius: 20px;
  padding: 20px;
  position: absolute;
  top:5%;
  left:38%;
}
.box.arrow-bottom:after {
  content: " ";
  position: absolute;
  right: 30px;
  bottom: -15px;
  border-top: 15px solid #ffffffff;
  border-right: 15px solid transparent;
  border-left: 15px solid transparent;
  border-bottom: none;
}
.tooltipp {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltipp .tooltiptext {
   visibility: hidden;
    width: 400px;
    background-color: #ffffffe6;
    color: #000;
    box-shadow: rgb(0 0 0 / 35%) 0px 5px 15px;
    border-radius: 6px;
    padding: 7px;
    position: absolute;
    z-index: 1;
    bottom: 111%;
    left: 30%;
    margin-left: -60px;
    font-size: 15px;
    font-weight: 500;
}

.tooltipp:hover .tooltiptext{
  visibility: visible;
}
.count{
      width:100px;
      height: 35px;
      border: 2px solid rgb(104, 106, 112);
      border-radius: 50px;
      font-size: 20px;
     font-weight:bolder;
     margin:0 auto;
      margin-bottom:5px;
}
 .counttxt{
   font-size: 20px;
   font-weight: bold;
   color: rgb(104, 106, 112);
}
.uperr{
  height: 440px;
  visibility:hidden;
  position:absolute;
  bottom:5%;
  animation: linear infinite alternate;
  animation-name: sam;
  animation-duration: 3s;
}
@-webkit-keyframes sam {
     <?php
 $sl = mysqli_query($conn,"SELECT * FROM questions where id = '".$_GET['ck']."'");
 $ss  = mysqli_fetch_array($sl);
 ?> 
   0% {
      left : <?php echo ($_GET['ck']) ?  $ss['lft'] : 0 ; ?>;
    }
    100% {
      left : <?php echo ($_GET['ck']) ?  $ss['lft2'] : 0 ; ?> ;
    }
}
.chr{
  height: 440px;
  position:absolute;
  bottom:5%;
  <?php 
if(isset($_GET['ck'])){ ?>
 left : <?php echo $ss['lft2'] ?>;  
 <?php }else{ ?>
  left : 0;  
  <?php }?>
}

@media only screen and (min-width:1100px) and (max-width: 1370px){
  .box {
    width: 470px;
    left: 32%;
    top:6%;
  }
  .unbox {
    width: 700px;
    height: 80px;
    left: 25%;
  }
  .chr{
  height: 350px;
  bottom:4%;
  }
  .uperr{
  height: 350px;
  bottom:4%;
  }
}
</style>
<body>
<img style="display:none" src="wronganswer.png"/>
<img style="display:none" src="correctanswer.png"/>
<img style="display:none" src="bg.jpg"/>
<img style="display:none" src="bg2.jpg"/>
<img style="display:none" src="bg3.jpg"/>
<img style="display:none" src="bg4.jpg"/>
<img style="display:none" src="move1.jpg"/>
<img style="display:none" src="move2.jpg"/>
<img style="display:none" src="move3.jpg"/>
<img style="display:none" src="Male-climb.gif"/>
<img style="display:none" src="Female-climb.gif"/>
<?php
 $sw = mysqli_query($conn,"SELECT * FROM login where mal = '".$_SESSION['nam']."'");
 $so  = mysqli_fetch_array($sw);
 ?> 


<!----------------------------------------------------------- move background -------------------------------------------------->
<div class="hero-image"></div>
<div class="hero-image1"></div>
<div class="background-image">
<?php
 $sl = mysqli_query($conn,"SELECT * FROM questions where id = '".$_GET['ck']."'");
 $ss  = mysqli_fetch_array($sl);
 ?> 
<img id="mot" src="<?php echo $ss['bg'] ?>" >
</div>
<!----------------------------------------------------------- Timer -------------------------------------------------->
<?php
     $stt = mysqli_query($conn,"SELECT * FROM login where mal = '".$_SESSION['nam']."'");
     $fis  = mysqli_fetch_array($stt);
    if($fis['status3'] == "successful"){
    ?>
    <div style="background-color:white;width:100%;height:100%;position: absolute;">
     <h1 class="text-center" style="color: #1C2754;margin-top:10%">Application Submitted Sucessfully</br>Thanks for Playing Game</br>Have a Nice Day!</h1>
    </div>
<?php
    }else{ ?>
<div class="count d-flex justify-content-center">
              <?php
              if(!empty($_SESSION['nam'])){
                $sqq = mysqli_query($conn,"SELECT * FROM login where mal = '".$_SESSION['nam']."'");
                $upp  = mysqli_fetch_array($sqq); 
                $timer = explode(':', $upp['timr3']);
                ?>
             <p id="deep"><label id="minutes" class="counttxt"><?php echo @$timer[0] ?></label>:<label id="seconds" class="counttxt"><?php echo @$timer[1]  ?></label></p>
             <?php
              }else{ 
                  ?>
              <p id="deep"><label id="minutes" class="counttxt">00</label>:<label id="seconds" class="counttxt">00</label></p>
              <?php
              }?>
              
</div>


<!----------------------------------------------------------- Character -------------------------------------------------->

<?php
$stt = mysqli_query($conn,"SELECT * FROM login where mal = '".$_SESSION['nam']."'");
$down  = mysqli_fetch_array($stt); 
if($down['gen'] == 'Male'){
?>
<div>
<img class="chr" src="male.png" />
<img class="uperr" src="malee.gif"/>
</div>
<?php }else{ ?>
<div >
<img class="chr"  src="female1.png" >
<img class="uperr" src="female.gif"/>

</div>
<?php }?>

<!----------------------------------------------------------- Messasge Box -------------------------------------------------->
<script>


    function clickk(){
    $(".chr").css("visibility","hidden");
    $(".uperr").css("visibility","visible");
    setTimeout(function() { 
      $(".chr").css("visibility","visible");
    $(".uperr").css("visibility","hidden");}
        ,3000);
  }   
function move() {
  $(".chr").css("visibility","hidden");
  $(".uperr").css("visibility","visible");
  $(".box").css("visibility","hidden");
  $(".background-image").css("visibility","visible");
//   setTimeout(function() { 
      window.location.href = "index.php?ck=4&mt=4";}
        // ,1000);  }

function move2() {
  $(".chr").css("visibility","hidden");
  $(".uperr").css("visibility","visible");
  $(".box").css("visibility","hidden");
  $(".background-image").css("visibility","visible");
//   setTimeout(function() { 
      window.location.href = "index.php?ck=7&mt=7";}
        // ,1000);  }

        function move3() {
          $(".chr").css("visibility","hidden");
  $(".uperr").css("visibility","visible");
  $(".box").css("visibility","hidden");
  $(".background-image").css("visibility","visible");
//   setTimeout(function() { 
      window.location.href = "index.php?ck=10&mt=10";}
        // ,1000);  }

</script>
<div class="box arrow-bottom">
<?php 
if(isset($_GET['ck'])){

  if($_GET['ck'] == 13){
      sleep(1);
    echo "<script>move()</script>";
 $stt = mysqli_query($conn,"SELECT * FROM questions where id = '".$_GET['ck']."'");
 $que  = mysqli_fetch_array($stt);
  }elseif($_GET['ck'] == 14){
      sleep(1);
    echo "<script>move2()</script>";
    $stt = mysqli_query($conn,"SELECT * FROM questions where id = '".$_GET['ck']."'");
    $que  = mysqli_fetch_array($stt);
  }elseif($_GET['ck'] == 15){
      sleep(1);
    echo "<script>move3()</script>";
    $stt = mysqli_query($conn,"SELECT * FROM questions where id = '".$_GET['ck']."'");
    $que  = mysqli_fetch_array($stt);
  }elseif($_GET['ck'] == 1){
    $stt = mysqli_query($conn,"SELECT * FROM questions where id = '".$_GET['ck']."'");
    $que  = mysqli_fetch_array($stt);
  }elseif($_GET['ck'] == 4){
      sleep(2);
    $stt = mysqli_query($conn,"SELECT * FROM questions where id = '".$_GET['ck']."'");
    $que  = mysqli_fetch_array($stt);
  }elseif($_GET['ck'] == 7){
      sleep(2);
    $stt = mysqli_query($conn,"SELECT * FROM questions where id = '".$_GET['ck']."'");
    $que  = mysqli_fetch_array($stt);
  }elseif($_GET['ck'] == 10){
      sleep(2);
    $stt = mysqli_query($conn,"SELECT * FROM questions where id = '".$_GET['ck']."'");
    $que  = mysqli_fetch_array($stt);
  }elseif($_GET['ck'] == 18){
      sleep(1);
    $sp = mysqli_query($conn,"SELECT * FROM login where mal = '".$_SESSION['nam']."'");
    $dot  = mysqli_fetch_array($sp);
    if($dot['gen'] == 'Male'){ 
    echo '<script type="text/javascript">
    $(".chr").css("visibility","hidden");
    $(".box").css("visibility","hidden");
     $(".hero-image").css({"height":"1000px","visibility":"visible"});
    setTimeout(function() {
      screenshot(); },11000);
          </script>';
    }else{
      echo '<script type="text/javascript">
    $(".chr").css("visibility","hidden");
    $(".box").css("visibility","hidden");
    $(".hero-image1").css({"height":"1000px","visibility":"visible"});
    setTimeout(function() {
      screenshot(); },11000);
          </script>';
    }
  }elseif($_GET['ck'] == $_GET['mt']){
    sleep(2);
     echo "<script>clickk();</script>";
    $stt = mysqli_query($conn,"SELECT * FROM questions where id = '".$_GET['ck']."'");
    $que  = mysqli_fetch_array($stt);
  }else{
    sleep(2);
    echo "<script>clickk();</script>";
    $stt = mysqli_query($conn,"SELECT * FROM questions where id = '".$_GET['ck']."'");
    $que  = mysqli_fetch_array($stt);
  }
}else{

  $sam = mysqli_query($conn,"select * from login where mal = '".$_SESSION['nam']."' ");
  $de = mysqli_fetch_array($sam);
  if(empty($de['kelu'])){
    $stt = mysqli_query($conn,"SELECT * FROM questions where id = '1'");
    $que  = mysqli_fetch_array($stt);  
  }else{
    echo "<script>window.location='".$de['kelu']."'</script>";
  }
}
if($_GET['ck']){
?>
<center><h4><?php echo $que['ques']?></h4></center>
<p style="font-weight: 600;line-height: initial;"><?php echo $que['des']?></p>
<center><div>
<a href="index.php?ck=<?php echo $que['yellow']?>" class="btn btn-primary" id="w3s" onclick="slt('<?php echo $que['yellow']?>')" style="height: 40px; width: 40px; background-color: #FFEB93; border-color: #FFEB93;"></a>&nbsp;&nbsp;
<a href="index.php?ck=<?php echo $que['blue']?>" class="btn btn-primary" id="w3s" onclick="slt2('<?php echo $que['blue']?>')" style="height: 40px; width: 40px;background-color: #043B72;border-color: #043B72"></a>&nbsp;&nbsp;
<a href="index.php?ck=<?php echo $que['geen']?>"  class="btn btn-primary" id="w3s" onclick="slt3('<?php echo $que['geen']?>')" style="height: 40px; width: 40px;background-color: #8DFA78; border-color:#8DFA78;"></a>&nbsp;&nbsp;
<a href="index.php?ck=<?php echo $que['red']?>"  class="btn btn-primary" id="w3s" onclick="slt4('<?php echo $que['red']?>')" style="background-color: #F85B5B;height: 40px; width: 40px; border-color: #F85B5B;"></a></div></div></center>
<?php 
}else{
?>
<center><h4>Game Instructions </h4></center>
<p style="font-weight: 700;text-align: center">Answer these questions and complete the quest by choosing the color that corresponds to your choice.<br/>Rapid correct answers will win you a higher score.</p>

<center><div><a href="index.php?ck=1&mt=1" style="background-color: #1c2754" class="btn btn-primary">Lets go</a></div></center>
<?php }?>
</div>



<!----------------------------------------------------------- bottom box -------------------------------------------------->


<div class="unbox">
<div class="container">
<div class="row">
<div class="col-3 tooltipp"><input class="btn btn-primary" type="button" style="height: 40px; width: 40px; background-color: #8DFA78; border-color: #8DFA78;margin-left: 49px;"><center><p style="font-size:12px;font-weight: 700;margin:0;"><span class="tooltiptext">Procedural or Human Error resulting in violation of company’s existing policies and procedures except those categorized under other colors</span>Procedural or Human Error resulting</p></center></div>
<div class="col-3 tooltipp"><input class="btn btn-primary" type="button" style="height: 40px; width: 40px; background-color: #043B72; border-color: #043B72;margin-left: 49px;"><center><p style="font-size:12px;font-weight: 700;margin:0;"><span class="tooltiptext">Finance / Payments or matters involving financial impact of above 0.5 million</span>Finance / Payments or matters involving</p></center></div>
<div class="col-3 tooltipp"><input class="btn btn-primary" type="button" style="height: 40px; width: 40px; background-color: #F85B5B; border-color: #F85B5B;margin-left: 49px;"><center><p style="font-size:12px;font-weight: 700;margin:0;"><span class="tooltiptext">Financial Irregularity involving fraud, damage to company’s asset or reputation, serious ethical non-compliance, violation of insider trading policy</span>Financial Irregularity involving fraud</p></center></div>
<div class="col-3 tooltipp"><input class="btn btn-primary" type="button" style="height: 40px; width: 40px; background-color: #FFEB93; border-color: #FFEB93;margin-left: 49px;"><center><p style="font-size:12px;font-weight: 700;margin:0;"><span class="tooltiptext">Unauthorized use of company’s property, conflict of interest, occurrence of events that impacts operation or smooth functioning , data loss</span>Unauthorized use of company’s property</p></center></div>
</div>
</div>
</div>
<?php 
}?>

<!----------------------------------------------------------- POST DATA -------------------------------------------------->


<form method="POST">
    <input type="hidden" name="corect" value="<?php echo $so['st_cnfrm'] ?>" id="corect" >
<input type="hidden" name="wrong" value="<?php echo $so['st_wrng'] ?>" id="wrng">
<input type="hidden" name="nam" value="<?php echo $so['nam'] ?>" id="nam">
<input type="hidden" name="mail" value="<?php echo $so['mal'] ?>" id="mail">
    <input type="submit" name="save" id="sett" hidden/>
</form>

<!----------------------------------------------------------- Modal box -------------------------------------------------->



<div class="modal" id="sumt" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
              <div class="modal-header justify-content-center" style="border-bottom:none">
                <img  src="submit.png" style="height:90px;"/>
              </div>
          </div>
</div>

 <div class="modal fade" id="#myModa"> 
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-header justify-content-center" style="border-bottom:none">
                <img  src="correctanswer.png" style="height:90px;"/>
              </div>
          </div>
        </div>

        <div class="modal fade" id="#myModal">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-header justify-content-center" style="border-bottom:none">
               <img  src="wronganswer.png" style="height: 90px;"/>
              </div>
          </div>
        </div>
<!----------------------------------------------------------- Script -------------------------------------------------->

<script>

function submit(){
     
 }
function screenshot() {
      $("#sumt").modal({backdrop: "static", keyboard: false});
      setTimeout(function() {
    $.ajax({
  url : "index.php",
  type : "POST",
  data :  {fin: "successful"},
  success : function(data){
console.log('catt');
  } 
});
document.getElementById("sett").click();
},3000);
    //          var nam = $("#nam").val();
    //          var eml = $("#mail").val();
    //          var corect = $("#corect").val();
    //          var wrng = $("#wrng").val();
    //         var ans =  corect*100/12;
    //          Email.send({
    //     Host : "smtp.titan.email",
    //     Username : "admin@infotechabout.com",
    //     Password : "Admin123456#$",
    //     // To : 'ayesha.javaid@dawoodhercules.com',
    //     To : 'syedmomin168@gmail.com',
    //     From : "admin@infotechabout.com",
    //     Subject : "Dataminds "+ nam + " " + eml,
    //     Body : "Result => "+ nam + " Total Correct Answer  " + corect +" Total Wrong Answer " + wrng +" percentage " + ans+"%",
    // }).then(
    //   message => alert(message),
    // );
    }

function slt(name){
    split_string = name.split(/(\d+)/);
    var toll = split_string[1];
    var toll2 = split_string[3]; 
     if(toll == toll2){
          $('#\\#myModal').modal('show');
         $.ajax({
              url : "index.php",
              type : "POST",
              data :  { wrng: 'wrng'},
              success : function(data){
            console.log('wrng');
              } 
            });
             }else{
             $('#\\#myModa').modal('show');
                $.ajax({
              url : "index.php",
              type : "POST",
              data :  { corct : 'corct'},
              success : function(data){
            console.log('corct');
              } 
            });
             
          }
}

function slt2(name){
    split_string = name.split(/(\d+)/);
    var toll = split_string[1];
    var toll2 = split_string[3]; 
     if(toll == toll2){
          $('#\\#myModal').modal('show');
         $.ajax({
              url : "index.php",
              type : "POST",
              data :  { wrng: 'wrng'},
              success : function(data){
            console.log('wrng');
              } 
            });
             }else{
             $('#\\#myModa').modal('show');
                $.ajax({
              url : "index.php",
              type : "POST",
              data :  { corct : 'corct'},
              success : function(data){
            console.log('corct');
              } 
            });
             
          }
}

function slt3(name){
    split_string = name.split(/(\d+)/);
    var toll = split_string[1];
    var toll2 = split_string[3]; 
     if(toll == toll2){
          $('#\\#myModal').modal('show');
         $.ajax({
              url : "index.php",
              type : "POST",
              data :  { wrng: 'wrng'},
              success : function(data){
            console.log('wrng');
              } 
            });
             }else{
             $('#\\#myModa').modal('show');
                $.ajax({
              url : "index.php",
              type : "POST",
              data :  { corct : 'corct'},
              success : function(data){
            console.log('corct');
              } 
            });
             
          }
}

function slt4(name){
    split_string = name.split(/(\d+)/);
    var toll = split_string[1];
    var toll2 = split_string[3]; 
     if(toll == toll2){
          $('#\\#myModal').modal('show');
         $.ajax({
              url : "index.php",
              type : "POST",
              data :  { wrng: 'wrng'},
              success : function(data){
            console.log('wrng');
              } 
            });
             }else{
             $('#\\#myModa').modal('show');
                $.ajax({
              url : "index.php",
              type : "POST",
              data :  { corct : 'corct'},
              success : function(data){
            console.log('corct');
              } 
            });
             
          }
}
var st = $('#deep').text();
var a = st.split(':');
var seconds = (+a[0]) * 60 + (+a[1]);
var minutesLabel = document.getElementById("minutes");
var secondsLabel = document.getElementById("seconds");
var totalSeconds = seconds;
setInterval(setTime, 1000);
function setTime() {
 ++totalSeconds;
 gn();
 if(totalSeconds == 2700){
  screenshot();
}
 secondsLabel.innerHTML = pad(totalSeconds % 60);
minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
}
function pad(val) {
var valString = val + "";
if (valString.length < 2) {
   return "0" + valString;
  } else {
    return valString;
  }
}
</script>
 
</body>
</html>