<?php
        include 'session.php';
        include 'fetchdatabase.php';

        $target_path="files/$user";

        if($data['profile_pic']=="0")
        {
                $sql="UPDATE $tbl_name SET profile_pic='1' WHERE username='$user' AND area_of_work='general'";
                $result=mysql_query($sql);
        }
        move_uploaded_file($_FILES['myphoto']['tmp_name'],$target_path);
        chmod($target_path,0755);
?>