<?php
        include 'session.php';
        include 'fetchdatabase.php';

        $target_path="tmp/$user"."_header.jpg";

        if(move_uploaded_file($_FILES['myheader']['tmp_name'],$target_path))
        {
                $image=new Imagick($target_path);
                $image->setImageFormat('jpg');
                $image->setImageFileName($target_path."_temp");
                $image->writeImage();
                rename($target_path."_temp",$target_path);
                system("convert $target_path -resize x60  $target_path");
                chmod($target_path,0755);
        }
        else
                die("error!");
?>