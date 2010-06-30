<?php
        include 'logininfo.php';
        $tbl_name="personalinfo"; // Table name

        mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

        $sql="SELECT * FROM $tbl_name WHERE username='$user'";
        $result=mysql_query($sql);
        $data=mysql_fetch_array($result);
?>
