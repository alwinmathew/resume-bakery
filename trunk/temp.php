
<html>

<head>
<link href="temp.css" rel="stylesheet" type="text/css"/>
<link href="editmystyle.css" rel="stylesheet" type="text/css"/>

<title>title</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript">

                $(document).ready(function(){

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
                        }); });


	function load_edit()
	{
		$("#container").load("edit.php #body");
	}

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
				</div></br>
				

				<!--	<div id="button">
					<a href="javascript:#login_form;">
						<img src="images/submitt.png" border="0" />
						</a>
						</div> --> 
				
					<button id="button" type="submit">Login</button>
				
		</form>
				


				<div id="container_middle3">
			
					 Forgot password &nbsp;| Not registered yet?
						    
				</div>

		</div>



	</div>


	<div id="footer">
	Copright Reserved
	</div>



</body>

</html>
