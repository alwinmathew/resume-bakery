
<html>

<head>
<link href="temp.css" rel="stylesheet" type="text/css"/>
<link href="editmystyle.css" rel="stylesheet" type="text/css"/>

<title>title</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/common.js"></script>
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
                                                              load_edit();
                                                        else
                                                                $("#error_login").html("Invalid Login! Try again.");

                                                }
                                        });
                                }
                                return false;
                        }); 

	function load_edit()
	{
$("#container").load("edittemp.php #resume_body");
	}


 $("#register").click(function(){
                                $("#container").fadeTo("fast",0.1);
                                load_show();
                        });

	function load_show()
	{
 $("#popup").show();
	}

                        $("#popup_close").click(function(){
                                $("#popup").hide();
                                $("#signup_username").val("");
                                $("#signup_password").val("");
                                $("#error_signup").html("");
                                $("#container").fadeTo("fast",1);
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

<title>title</title>
</head>

<body>

<div id="tp">


	<a href="#">TIPS FOR A GOOD RESUME </a>
	<a href="#">SAMPLE RESUME</a>
	<a href="#">ABOUT US</a>
	<a href="#">HELP</a>
	<br></br>

		<img src="images/abc.png"/>&nbsp;&nbsp;&nbsp;
		<img src="images/arrow.gif"/>&nbsp;&nbsp;&nbsp;&nbsp;
		<img src="images/a.png" onmouseover="this.src='images/amouse.png';" onmouseout="this.src='images/a.png';" />
		<br></br>
		<marquee style="color:brown; font-size=16px;">Easy and Smart Resume generator. &nbsp;&nbsp;Experience it.</marquee>
</div>


<div id="rightsidebar">
	<font face="palatino, times, times new roman" size=3>
	<a href='#'><b>Design  Template</b></a></br>You can create layouts of your resumes. This help to keep up identity. Be different and attractive.
	<br></br><a href='#'><b>Manage   Groups</b></a></br>Maintain groups. Admin have options to set a common template for all users.
	<br></br><a href='#'><b>Create   Resume</b></a></a></br>
	Its very easy to customize and update your resume to suit your needs .
	<br></br><a href='#'><b>Preview   Resume</b></a></a></br>Preview your resume as you write it at each step. <br></br>
	<br></br><br></br><br></br></font>

</div>


<div id="container">
	<div id="leftsidebar">
	Why to choose Resume bakery.
	</div>


	<div id="middlesidebar">

		<div id="heading">

			<font face="palatino, times, times new roman"><b>&nbsp;Create a Professional Resume</b></font> 
		</div></br>
	
	<span style="color:#C7A317">home >></span> </br>
	<img src="images/goldLine.gif">
	<br></br><font face="palatino, times, times new roman" size=3>
	This is an ultimate Resume management system that help you to create resumes as u dream,this helps you to market yourself well. It improves 
	your chances of landing on a dream job. There are only four stages for this easy resume creation:</n><br></br>&nbsp;&nbsp;&nbsp;
		<b><span style="color:maroon">Step one : Create Resume</b></span> <hr><br></br> to put picture here after developing create 		page<br>	<br>&nbsp;&nbsp;&nbsp;&nbsp;     <b><span style="color:maroon">Step two : Generate resume </span></b><hr><br></br>picture<br></br> 		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> <span style="color:maroon">Step three : Print or send</span></b>  <hr><br></br>picture<br></br>
	</font>
	<hr>
	<br></br>
		



		<div id="container_middle1">
			<font face="palatino, times, times new roman" size=3>
			<b>With a good resume advertise yourself.</b>
				</font>
		</div>



		<div id="container_middle2">
			<font face="palatino, times, times new roman" size=3>
			Login to continue.
			</font>
		</div>




			<form id="login_form" >

				<div id="tab">
						<table align="center">
							<br></br><br></br>
							<tr><td><b> <span style="color:maroon">Username :</b></span> </td>
							<td><input name="myusername" type="text" id="login_username"></td></tr>
							<tr/><tr/><tr/><tr/>
							<tr><td><b> <span style="color:maroon">Password :</b></span> </td>
							<td><input name="mypassword" type="password" id="login_password"></td></tr>
							<tr/><tr/><tr/><tr/><tr/><tr/></table>
							<button id="login_button" type="submit">   </button>
							 
				</div></br>
				
				
			<div id="error_login"> </div>	
					
				
		</form>
				


				<div id="container_middle3">
			
					 Forgot password &nbsp;|  <a id="register" title="Register as new user" onclick='$("#popup").show();'>Not yet Registered</a>
						    
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



		</div>



	</div>


	<div id="footer">
	Copright Reserved
	</div>



</body>

</html>
