<?
session_start();
if(!session_is_registered(myusername)){
header("location:login.php");
}
?>

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
		min-height:800px;
	}

	#header
	{
		background: url('images/dot.gif') repeat-x left bottom;
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

	#body
	{
		margin-top:10px;
		background-color: #b8dbe6;
		min-height:677px;
		padding: 20px;
	}

	#profile_pic
	{
		width: 100px;
		height: 100px;
		background-color: white;
	}

	div.name
	{
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		color: red;
		font-size: 30px;
		font-weight: bold;		
	}

	#f_name
	{
		width: 100px;
	}

	</style>
</head>

<body>

	<div id="page">
		<div id="header">
			<div id="sideline"><a href="login.php" title="Login to your account">Logout</a></div>
			<div id="title"><a href="main.html">Resume-Bakery</a></div>
			<div id="tagline">Enter a tagline here</div>
		</div>
		<?$f_name="FirstName"; $l_name="LastName";?>
		<div id="body">
			<div id="profile_pic"></div>
			<div class="name" id="f_name"><?echo $f_name?> id="l_name"><?echo $l_name?></div>
		</div>
	</div>

</body>

</html>
