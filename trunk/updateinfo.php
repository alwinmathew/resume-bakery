<?php
    include 'session.php';
    include 'logininfo.php';
    $area_of_work=$_POST['resume'];
    $sql="SELECT * FROM personalinfo WHERE username='$user' AND area_of_work='$area_of_work'";
    $result=mysql_query($sql);
    $data=mysql_fetch_array($result);
    
    $type=$_POST['infotype'];
    $value=$_POST['infovalue'];

    if($type=="profile_pic"&&$value=="0")               //removes profile pic
            unlink("files/$user-$area_of_work.jpg");
    if($value!="")
            $sql="UPDATE personalinfo SET $type='$value' WHERE username='$user' AND area_of_work='$area_of_work'";  //sets to specified value
    else
            $sql="UPDATE personalinfo SET $type=DEFAULT WHERE username='$user' AND area_of_work='$area_of_work'";   //sets to default value
    $result=mysql_query($sql);
    die;
?>
