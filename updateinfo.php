<?php
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
    $sql="UPDATE personalinfo SET $type='$data' WHERE username='$user'";
    $result=mysql_query($sql);
    die;
?>