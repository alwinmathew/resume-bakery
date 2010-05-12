<html>

<head>
	<style type="text/css">
	body
	{
/*		background-color: #12b2e7;*/
		background: url('images/header_repeat.jpg') repeat-x left top;
	}

	#page
	{
		background-color: white;
		width: 900px;
		margin-top: 20px;
		margin-bottom: 20px;
		margin-left: auto;
		margin-right: auto;
		padding: 10px;
		min-height:640px;
	}

	#header
	{
		background: url('images/dot.gif') repeat-x left bottom;
		margin-bottom: 60px;
	}

	#sideline
	{
		text-align: right;
		font-size: 12px;
		font-family: Arial, Helvetica, sans-serif;
	}

	#sideline a
	{
		text-decoration: none;
		color: #1272c1;
	}
	#sideline a:visited
	{
		text-decoration: none;
		color: #1272c1;
	}
	#sideline a:hover
	{
		text-decoration:none;
		font-size: 14px;
		font-style: bold;
		color: #12b2e7;
	}

	#title
	{
		font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
		font-size: 50px;
		padding-left: 20px;
		padding-top: 10px;
	}
	#title a
	{
		text-decoration: none;
		color: black;
	}

	#tagline
	{
		padding-left: 22px;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		font-size: 13px;
		padding-bottom: 5px;
	}

	#login_box
	{
		background-color: #b8dbe6;
		width: 200px;
		margin-left: auto;
		margin-right: auto;
		padding: 80px;
		padding-top: 40px;
		height:294px;
	}
	#login_box table
	{
		font-family: "Trebuchet MS", Helvetica, sans-serif;
	}
	#login_box th
	{
		font-size: 18px;
		padding-bottom: 30px;
		
	}
	#login_box td
	{
		font-size: 14px;
		width: 50px;
	}
	#login_box p
	{
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		padding-top: 8px;
		padding-left: 18px;
	}
	#login_box p a
	{
		font-size: 11px;
		color: #1272c1;
	}
	#login_box p a:hover
	{
		font-size: 10px;
		font-weight: bold;
	}
	#login_box button
	{
		width: 160px;
		margin-top: 15px;
		margin-left: 20px;
		height: 40px;
		background: url('images/blue.gif') repeat-x left top;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		font-size: 14px;
		color: white;
		border-width: 0px;
	}
	#login_box button:hover
	{
		background: url('images/blue_invert.gif') repeat-x left top;
	}
	#response
	{
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		color: red;
		font-size: 10px;
		font-weight: bold;
		text-align: center;
	}
	</style>

</head>

<body>

	<script type="text/javascript">

	function loadXMLDoc()
	{
		if(window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("response").innerHTML=xmlhttp.responseText;
			}
		}
		var username=document.getElementById("myusername").value;
		var password=document.getElementById("mypassword").value;
		if(username==""&&password=="")
			xmlhttp.open("GET","err_3.txt",true);
		else if(username=="")
			xmlhttp.open("GET","err_1.txt",true);
		else if(password=="")
			xmlhttp.open("GET","err_2.txt",true);
		else
			return true;
		xmlhttp.send();
		return false;
	}

	</script>

	<div id="page">
		<div id="header">
			<div id="sideline"><a href="login.php" title="Login to your account">Login</a> | <a href="register.php" title="Register as new user">Register</a></div>
			<div id="title"><a href="main.html">Resume-Bakery</a></div>
			<div id="tagline">Enter a tagline here</div>
		</div>

		<div id="login_box"><form name="form1" method="post" action="checklogin.php" onsubmit="return loadXMLDoc()"><div id="table">
			<table align="center">
			<th>Member Login</th>
			<tr>
			<td>Username</td>
			</tr>
			<tr>
			<td><input name="myusername" type="text" id="myusername"></td>
			</tr>
			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
			<tr>
			<td>Password</td>
			</tr>
			<tr>
			<td><input name="mypassword" type="password" id="mypassword"></td>
			</tr>
			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr></table></div>
			<button type="submit">Login</button>
			</form>
			<p><a href="">Forgot password?</a></p>
			<div id="response"> </div>
		</div>
	</div>

</body>

</html>
