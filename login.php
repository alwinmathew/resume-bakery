<html>

<head>
        <title>login - Resume Bakery</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css" />
	<style type="text/css">
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
                cursor: pointer;
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
	#error_login, #error_signup
	{
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		color: red;
		font-size: 10px;
		font-weight: bold;
		text-align: center;
	}

        #popup
        {
                top: 202px; /*202px;*/
                left: 536px; /*536px;*/
                border: 2px solid teal;
                background-color: #b8dbe6;
		width: 200px;
		margin-left: auto;
		margin-right: auto;
		padding: 81px;
                padding-top: 26px;
		height:307px;
                position: fixed;
        }

        #popup button
        {
                width: 160px;
                margin-top: 15px;
		margin-left: 21px;
		height: 40px;
		background: url('images/blue.gif') repeat-x left top;
		font-family: "Trebuchet MS", Helvetica, sans-serif;
		font-size: 14px;
		color: white;
		border-width: 0px;
       	}
	#popup button:hover
	{
		background: url('images/blue_invert.gif') repeat-x left top;
	}
        
        #popup_close
        {
                width:13px;
                height:13px;
                position:relative;
                cursor:pointer;
                background-color: teal;
                left:250px;
                text-align:center;
                top:-15px;
                border: 1px solid red;
        }
	</style>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">

                $(document).ready(function(){
                        $("#popup").hide();
                	$("#login_form").submit(function(){
                                var username=$("#login_username").val();
                                var password=$("#login_password").val();
                                if(username==""&&password=="")
                                        $("#error_login").html("Username & password cannot be blank!");
                                else if(username=="")
                                        $("#error_login").html("Username cannot be blank!");
                                else if(password=="")
                                        $("#error_login").html("Password cannot be blank!");
                                else
                                {
                                        $.ajax({
                                                type: "POST",
                                                url: "checklogin.php",
                                                data: "myusername=" +username +"&mypassword=" +password,
                                                success: function(data){
                                                        if(data=="success")
                                                                window.location.replace("edit.php");
                                                        else
                                                                $("#error_login").html("Invalid Login! Try again.");

                                                }
                                        });
                                }
                                return false;
                        });
                        $("#register").click(function(){
                                $("#page").fadeTo("fast",0.1);
                                $("#popup").show();
                        });
                        $("#popup_close").click(function(){
                                $("#popup").hide();
                                $("#signup_username").val("");
                                $("#signup_password").val("");
                                $("#error_signup").html("");
                                $("#page").fadeTo("fast",1);
                        });
                        $("#signup_form").submit(function(){
                                var username=$("#signup_username").val();
                                var password=$("#signup_password").val();
                                if(username==""&&password=="")
                                        $("#error_signup").html("Username & password cannot be blank!");
                                else if(username=="")
                                        $("#error_signup").html("Username cannot be blank!");
                                else if(password=="")
                                        $("#error_signup").html("Password cannot be blank!");
                                else
                                {
                                        $.ajax({
                                                type: "POST",
                                                url: "addmember.php",
                                                data: "myusername=" +username +"&mypassword=" +password,
                                                success: function(data){
                                                        if(data=="success")
                                                                $("#error_signup").html("Success! You may login now.");
                                                        else
                                                                $("#error_signup").html("Username already exists! Use a different name.");
                                                }
                                        });
                                }
                                return false;
                        });
		});

	</script>

</head>

<body>

	
	
	<div id="page">
		<div id="header">
			<div id="sideline"><a href="login.php" title="Login to your account">Login</a> | <a id="register" title="Register as new user" onclick='$("#popup").show();'>Register</a></div>
			<div id="title"><a href="main.html">Resume-Bakery</a></div>
			<div id="tagline">easy resume management</div>
		</div>

            <div id="login_box">
                    <form id="login_form"><div id="table">
			<table align="center">
			<th>Member Login</th>
			<tr><td>Username</td></tr>
			<tr><td><input name="myusername" type="text" id="login_username"></td></tr>
			<tr/><tr/><tr/><tr/><tr/><tr/>
			<tr><td>Password</td></tr>
			<tr><td><input name="mypassword" type="password" id="login_password"></td></tr>
			<tr/><tr/><tr/><tr/><tr/><tr/></table></div>
			<button id="login_button" type="submit">Login</button>
                    </form>
                    <p><a href="">Forgot password?</a></p>
                    <div id="error_login"> </div>
		</div>
	</div>

        <div id="popup">
                <div id="popup_close"></div>
                <div id="sign_up" style='font-family: "Trebuchet MS", Helvetica, sans-serif;'>
                    <form id="signup_form">
                        <table align="center">
                        <th style="padding-bottom: 30px; font-size: 18px;">New Account?</th>
			<tr><td style="font-size: 14px; width: 50px;">Username</td></tr>
                        <tr><td style="width: 50px;"><input name="myusername" type="text" id="signup_username"></td></tr>
			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
			<tr><td style='font-size: 14px; width: 50px;'>Password</td></tr>
			<tr><td><input name="mypassword" type="password" id="signup_password"></td></tr>
                        <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr></table>
        		<button id="signup_button" type="submit">Register</button>
                    </form>
                    <p id="error_signup"></p>
                </div>
        </div>

</body>

</html>