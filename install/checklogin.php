<?php
        include 'logininfo.php';
	
	$tbl_name="members"; // Table name

	// username and password sent from form
	$myusername=$_POST['myusername'];
	$mypassword=$_POST['mypassword'];

	// To protect MySQL injection (more detail about MySQL injection)
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
        $mypassword=md5($mypassword);

	/*$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);*/

	// Connect to server and select databse.
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

	$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
	$result=mysql_query($sql);

	// Mysql_num_row is counting table row
        //count must be 1
	$count=mysql_num_rows($result);
        if($count==0)
                die("error");
        $data=mysql_fetch_array($result);
        if(strcmp($data['username'],$myusername)!=0||strcmp($data['password'],$mypassword)!=0)
                die("error");

        setcookie("user",$myusername,time()+3600);      //starts user session
        session_start();
        die("success");
?>
