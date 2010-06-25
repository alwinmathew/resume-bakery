<?php
    include 'session.php';
    include 'fetchdatabase.php';
    $type=$_POST['infotype'];
    $value=$_POST['infovalue'];

    //$field=$_POST['field'];
   /* if($field!="text")
    {
        $type=str_replace(' p','',$type);
        $value=str_replace(' ','&nbsp;',$value);
        $sql="UPDATE personalinfo SET skills='$type' WHERE username='$user'";
        $result=mysql_query($sql);
    }*/

    

    if($type=="profile_pic"&&$value=="0")
            unlink("files/$user.jpg");
    if($value!="")
            $sql="UPDATE personalinfo SET $type='$value' WHERE username='$user' AND area_of_work='general'";
    else
            $sql="UPDATE personalinfo SET $type=DEFAULT WHERE username='$user' AND area_of_work='general'";
    $result=mysql_query($sql);
    die;
?>
