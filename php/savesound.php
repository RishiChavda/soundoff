<?php
session_start();

if(isset($_REQUEST['save'])){

    $acpic=$_SESSION['userpic'];
    $acname=$_SESSION['username'];
    $acdescription=mysql_real_escape_string($_POST['audiodescription']);
    $aclip=$_POST['audioclip'];
    $flagged=0;
    
    $saveclip=mysqli_query(cons(),"INSERT INTO audioclips(acpic,acname,acdescription,aclip,flagged) VALUES('$acpic','$acname','$acdescription','$aclip','$flagged')");

    if($saveclip==true){header("location: ../index.php?saved");}

    else{header("location: ../index.php?error");}

}

?>