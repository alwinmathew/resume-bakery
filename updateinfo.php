<?php
    include 'session.php';
    include 'fetchdatabase.php';
    $type=$_POST['infotype'];
    $value=$_POST['infovalue'];

    //$field=$_POST['field'];
   /* if($field!="text")
    {
        $type=str_replace(' p','',$type);
        $value=str_replace(' ','&nbsp;',$value);
        $sql="UPDATE personalinfo SET skills='$type' WHERE username='$user'";
        $result=mysql_query($sql);
    }*/
    if($value=="status_temp")
            die(file_exists("tmp/$user"."_header"));
    else if($value=="remove_temp")
    {
            unlink("tmp/$user"."_header");
            die;
    }
    else if($value=="remove_header")
    {
            unlink("files/$user"."_header");
            $value="0";
    }
    else if($value=="check_header")
    {
            if(file_exists("tmp/$user"."_header"))
            {
                    rename("tmp/$user"."_header","files/$user"."_header");
                    $value="1";
            }
            else
                    die;
    }
//    if($type=="header_image"&&$value=="1")
//            rename("tmp/$user"."_header","files/$user"."_header");
//    else if($type=="header_image"&&$value=="0")
//            unlink("files/$user"."_header");
    if($type=="profile_pic")
            unlink("files/$user");
    if($value!="")
            $sql="UPDATE personalinfo SET $type='$value' WHERE username='$user' AND area_of_work='general'";
    else
            $sql="UPDATE personalinfo SET $type=DEFAULT WHERE username='$user' AND area_of_work='general'";
    $result=mysql_query($sql);
    die;
?>
