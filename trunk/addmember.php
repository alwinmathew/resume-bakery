<?php
	include 'logininfo.php';
	$user_tbl="members"; // Table name
        $data_tbl="personalinfo";

	// username and password sent from form
	$myusername=$_POST['myusername'];
	$mypassword=$_POST['mypassword'];

	// To protect MySQL injection (more detail about MySQL injection)
	$myusername=stripslashes($myusername);
	$mypassword=stripslashes($mypassword);
        $mypassword=md5($mypassword);
        
        /*$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);*/

	// Connect to server and select databse.
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

        $sql="SELECT * FROM $tbl_name WHERE username='$myusername'";
	$result=mysql_query($sql);

	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);
	// If result matched $myusername and $mypassword, table row must be 1 row
        $status="success";
	if($count==0)
        {
            $sql="INSERT INTO $user_tbl VALUES('$myusername','$mypassword')";
            $result=mysql_query($sql);
            $sql="INSERT INTO $data_tbl (username,area_of_work) VALUES('$myusername','general')";
            $result=mysql_query($sql);
        }
        else
            $status="error";

        die($status);
?>
