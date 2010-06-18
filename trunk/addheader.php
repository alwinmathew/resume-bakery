<?php
        include 'session.php';
        include 'fetchdatabase.php';

        $target_path="tmp/$user"."_header.jpg";

       /* if($data['profile_pic']=="0")
        {
                $sql="UPDATE $tbl_name SET profile_pic='1' WHERE username='$user' AND area_of_work='general'";
                $result=mysql_query($sql);
        }*/
        if(move_uploaded_file($_FILES['myheader']['tmp_name'],$target_path))
        {
                $image=new Imagick($target_path);
                $image->setImageFormat('jpg');
                $image->setImageFileName($target_path."_temp");
                $image->writeImage();
                rename($target_path."_temp",$target_path);
                system("convert $target_path -resize x80  $target_path");
                chmod($target_path,0755);
                header("Location: design");
        }
        else
                die("error!");
?>