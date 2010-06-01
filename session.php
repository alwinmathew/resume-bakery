<?php
        if(!isset ($_COOKIE['user']))
        {
                setcookie("user","",time()-3600);
                header("location: login");
        }
        $user=$_COOKIE['user'];
        setcookie("user",$user,time()+3600);
?>
