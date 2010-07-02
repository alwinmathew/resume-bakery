<?php
        include 'session.php';
        include 'logininfo.php';
        $area_of_work=$_POST['resume'];
        $sql="SELECT * FROM personalinfo WHERE username='$user' AND area_of_work='$area_of_work'";
        $result=mysql_query($sql);
        $data=mysql_fetch_array($result);

        $target_path="files/$user-$area_of_work.jpg";

        if($data['profile_pic']=="0")
        {
                $sql="UPDATE personalinfo SET profile_pic='1' WHERE username='$user' AND area_of_work='$area_of_work'";
                $result=mysql_query($sql);
        }
        move_uploaded_file($_FILES['myphoto']['tmp_name'],$target_path);
        list($width,$height,$type,$attr)=getimagesize($target_path);
        $image=new Imagick($target_path);
        $image->setImageFormat('jpg');
        $image->setImageFileName($target_path."_temp");
        $image->writeImage();
        rename($target_path."_temp",$target_path);
        if($height>$width)
                system("convert $target_path -resize x120  $target_path");
        else
                system("convert $target_path -resize 120x  $target_path");
        chmod($target_path,0755);
?>