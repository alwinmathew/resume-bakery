<?php
	$host="localhost"; // Host name
	$username="root"; // Mysql username
	$password="neenujacob"; // Mysql password
	$db_name="test"; // Database name
	$tbl_name="members"; // Table name

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
            $sql="INSERT INTO $tbl_name VALUES ('$myusername','$mypassword')";
            $result=mysql_query($sql);
        }
        else
            $status="error";
        die($status);
?>
