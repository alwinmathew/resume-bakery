<?php
    include 'session.php';
    include 'logininfo.php';
    $area_of_work=$_POST['resume'];
    $sql="SELECT * FROM personalinfo WHERE username='$user' AND area_of_work='$area_of_work'";
    $result=mysql_query($sql);
    $data=mysql_fetch_array($result);
    
    $type=$_POST['sectiontype'];
    $value=$_POST['sectionvalue'];
    if($type=="sharing")        //changes sharing status
    {
            $sql="SELECT * FROM sections WHERE username='$user' AND area_of_work='$area_of_work'";
            $result=mysql_query($sql);
            $sections=mysql_fetch_array($result);
            if($sections['sharing']=='1')       //toggles between private & public status
                $value='0';
            else
                $value='1';
    }
    $sql="UPDATE sections SET $type='$value' WHERE username='$user' AND area_of_work='$area_of_work'";
    $result=mysql_query($sql);
    die($value);
?>
