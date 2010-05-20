<html>

<head>

<link rel="stylesheet" type="text/css" href="style.css"/>

	<script type="text/javascript" src="jquery.js"></script>
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
                                                                $("#error_login").html("Login Successful!");
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
			<div id="tagline">Enter a tagline here</div>
		</div>

            <div id="login_box"><form id="login_form"><div id="table">
			<table align="center">
			<th>Member Login</th>
			<tr><td>Username</td></tr>
			<tr><td><input name="myusername" type="text" id="login_username"></td></tr>
			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
			<tr><td>Password</td></tr>
			<tr><td><input name="mypassword" type="password" id="login_password"></td></tr>
			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr></table></div>
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
