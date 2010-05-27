<?php
    include 'fetchdatabase.php';
    $type=$_POST['sectiontype'];
    $value=$_POST['sectionvalue'];
    $sql="UPDATE sections SET $type='$value' WHERE username='$user'";
    $result=mysql_query($sql);
    die;
?>
