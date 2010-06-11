<?php
    include 'session.php';
    include 'fetchdatabase.php';
    $type=$_POST['infotype'];
    $data=$_POST['infovalue'];
    //$field=$_POST['field'];
   /* if($field!="text")
    {
        $type=str_replace(' p','',$type);
        $data=str_replace(' ','&nbsp;',$data);
        $sql="UPDATE personalinfo SET skills='$type' WHERE username='$user'";
        $result=mysql_query($sql);
    }*/
    if($type=="profile_pic")
            unlink("files/$user");
    if($data!="")
            $sql="UPDATE personalinfo SET $type='$data' WHERE username='$user' AND area_of_work='general'";
    else
            $sql="UPDATE personalinfo SET $type=DEFAULT WHERE username='$user' AND area_of_work='general'";
    $result=mysql_query($sql);
    die;
?>
