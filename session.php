<?php
        if(!isset ($_COOKIE['user']))
        {
                setcookie("user","",time()-3600);
                setcookie("page","",time()-3600);
                header("location: .");
        }
        $user=$_COOKIE['user'];
        setcookie("user",$user,time()+3600);
?>
