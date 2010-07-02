<?php
        include 'session.php';
        include 'logininfo.php';

        $type=$_POST['type'];
        $value=$_POST['value'];

        if($type=='add')
        {
            $sql="INSERT INTO personalinfo (username,area_of_work) VALUES('$user','$value')";
            $result=mysql_query($sql);
            $sql="INSERT INTO sections (username,area_of_work) VALUES('$user','$value')";
            $result=mysql_query($sql);
            die("success");
        }
        if($type=='delete')
        {
            $sql="DELETE FROM personalinfo WHERE username='$user' AND area_of_work='$value'";
            $result=mysql_query($sql);
            $sql="DELETE FROM sections WHERE username='$user' AND area_of_work='$value'";
            $result=mysql_query($sql);
            die("success");
        }
?>
