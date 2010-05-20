<?
session_start();
if(!session_is_registered(myusername)){
header("location:login.php");
}
?>

<html>

<head>

<link rel="stylesheet" type="text/css" href="style.css"/>

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
