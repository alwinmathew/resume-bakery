<?php
        if(isset ($_COOKIE['user']))
        {
                $user=$_COOKIE['user'];
                unlink("tmp/$user"."_header.jpg");
        }
        setcookie("user","",time()-3600);
        header("location: main.html");
?>
