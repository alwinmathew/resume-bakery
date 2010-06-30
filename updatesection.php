<?php
    include 'session.php';
    include 'fetchdatabase.php';
    $type=$_POST['sectiontype'];
    $value=$_POST['sectionvalue'];
    if($type=="sharing")
    {
            $sql="SELECT * FROM sections WHERE username='$user'";
            $result=mysql_query($sql);
            $sections=mysql_fetch_array($result);
            if($sections['sharing']=='1')
                $value='0';
            else
                $value='1';
    }
    $sql="UPDATE sections SET $type='$value' WHERE username='$user'";
    $result=mysql_query($sql);
    die($value);
?>
