
<html>

<head>
<link href="stylesheet.css" rel="stylesheet" type="text/css"/>
<link href="editmystyle.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" media="screen" href="mystyle.php"/>
<link rel="stylesheet" type="text/css" media="screen" href="cssdesign.php"/>

<title>Resume Bakery</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/ajaxupload.js"></script>
<script type="text/javascript" src="js/jscolor/jscolor.js"></script>
<script type="text/javascript">
        var page;
        function height(diff)
        {
                var ht=$("#container").css("height");
                ht=ht.substring(0,ht.length-2);
                ht=parseInt(ht);
                ht-=diff;
                ht+="px";
                $("#rightsidebar").css("height",ht);
        }
        function load_edit()
        {
                page="edit";
                createPageCookie(page);
                $("#container").load("edit.php #resume_body",function(){
                        edit_page_js();
                });
                $("#rightsidebar").load("edit.php #rightbar",function(){
                        edit_page_js();
                });
        }
        function load_preview()
        {
                page="preview";
                createPageCookie(page);
                $("#container").load("preview.php #preview_body",function(){
                        preview_page_js();
                });
                $("#rightsidebar").load("preview.php #preview_rightbar",function(){
                        preview_page_js();
                });
        }
        function load_design(param)
        {
                page="design"+param;
                createPageCookie(page);
                $("#container").load("design.php"+param +" #preview_popup",function(){
                        design_page_js();
                });
                $("#rightsidebar").load("design.php"+param +" #control",function(){
                        design_page_js();
                });
        }
        function createPageCookie(type)
	{
		var date = new Date();
		date.setTime(date.getTime()+(1*60*60*1000));
		var expires = "; expires="+date.toGMTString();
                document.cookie="page="+type+expires+"; path=/";
        }
        function readCookie(type)
        {
                var nameEQ=type+"=";
                var ca = document.cookie.split(';');
                for(var i=0;i<ca.length;i++)
                {
                        var c=ca[i];
                        while(c.charAt(0)==' ')
                                c=c.substring(1,c.length);
                        if(c.indexOf(nameEQ)==0)
                                return c.substring(nameEQ.length,c.length);
                }
                return null;
        }
        function load_page()
        {
                var page=readCookie("page");
                if(page==null)
                        return null;
                if(page=="edit")
                        load_edit();
                else if(page=="preview")
                        load_preview();
                else if(page=="design")
                        load_design("");
                else if(page=="design?type=new")
                        load_design("?type=new");
                return page;
        }
        function logout()
        {
                var date = new Date();
		date.setTime(date.getTime()+(-1*60*60*1000));
		var expires = "; expires="+date.toGMTString();
                document.cookie="page="+null+expires+"; path=/";
                $.ajax({
                        url: "logout.php",
                        success: function(){
                                window.location.reload();
                        }
                });
        }
        $(document).ready(function(){
                if(load_page()==null)
                        $("#rightsidebar").html('<div align="justify"><font face="palatino, times, times new roman" size=3><a href="#"><b>Create Resume</b></a><br>It is very easy to customize and update your resume to suit your needs.<br><br><a href="#"><b>Design Template</b></a><br>You can create layouts of your resume. This helps to keep up identity. Be different and attractive.<br><br><a href="#"><b>Preview   Resume</b></a><br>Preview your resume as you write it at each step. <br><br><a href="#"><b>Manage Groups</b></a><br>You can easily manage groups. The owner can set a common template for all its users.<br><br><br><br><br><br><br></font></div><div align="center"><img src="images/res.jpg"></div> <span style="color:red"><br><br> CREATE YOUR RESUME </span><br><br>');
                height(32);
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
                $("#register").click(function(){
                        $("#page_body").fadeTo("fast",0.1);
                        $("#popup").css("display","block");
                });
                $("#popup_close").click(function(){
                        $("#popup").css("display","none");
                        $("#signup_username").val("");
                        $("#signup_password").val("");
                        $("#error_signup").html("");
                        $("#page_body").fadeTo("fast",1);
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
    <div id="page_body">
    
        <div id="tp">
                <div id="topbar" align="center">
                        <a href="#">TIPS FOR A GOOD RESUME</a>
                        <a href="#">SAMPLE RESUME</a>
                        <a href="#">ABOUT US</a>
                        <a href="#">HELP</a>
                </div>
                <br>
                <div id="user" style="float: right;color: maroon;font-size: 10px;display: none;"><span>Welcome <b style="color: red;font-weight: bold;font-size: 12px;"></b></span>&nbsp; | &nbsp;<span id="logout" style="cursor: pointer;color: maroon;" onclick="logout();">Log Out</span></div>
                <img src="images/abc.png"/>&nbsp;&nbsp;&nbsp;
                <img style="vertical-align: super;" src="images/arrow.gif"/>&nbsp;&nbsp;&nbsp;&nbsp;
                <img src="images/a.png" onmouseover="this.src='images/amouse.png';" onmouseout="this.src='images/a.png';" />
                <br><br>
                <marquee style="color: brown;">Easy and Smart Resume generator. &nbsp;&nbsp;Experience it.</marquee>
        </div>

        
        <div id="rightsidebar">
                
        </div>
        <div id="container" align="center">
                <div id="leftsidebar" align="justify">
                        <p align="center"><b>Why to choose Resume Bakery?</b></p><br>
                        <div align="center"><img src="images/aa.jpg"></div>
		        <p style="color:red; text-align: center;"><br><br>Are you confused?</p><br><br>
			<img src="images/redball.gif"/> Resume Bakery takes stress out of your job search.<br>
                        <img src="images/redball.gif"/> It create resumes based on your current career level, background and career objectives.<br><br><br><br><br>
                        <p align="center"><b>Be confident </b></p><div align="center"><img src="images/ss.jpeg"/><br>Find Your Dream Job<br>With a Good Resume</div>
                </div>
                <div id="middlesidebar" align="left">
                        <div id="heading">
                                <font face="palatino, times, times new roman"><b>&nbsp;Create a Professional Resume</b></font>
                        </div><br>
                        <span style="color:#C7A317">home >></span> <br>
                        <img src="images/goldLine.gif"><br><br>
                        <font face="palatino, times, times new roman" size=3>
                        This is an ultimate Resume management system that help you to create resumes as u dream,this helps you to market yourself well. It improves
                        your chances of landing on a dream job. There are only four stages for this easy resume creation:<br><br>&nbsp;&nbsp;&nbsp;
                        <span style="color:maroon"><b>Step one : Create Resume</b></span> <hr><br><br> to put picture here after developing create page<br><br>&nbsp;&nbsp;&nbsp;&nbsp;     <b><span style="color:maroon">Step two : Generate resume </span></b><hr><br><br>picture<br><br> 		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> <span style="color:maroon">Step three : Print or send</span></b>  <hr><br><br>picture<br><br>
                        </font>
                        <hr>
                        <br><br>

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
                                        <br><br><br><br>
                                        <table align="center">
                                                <tr><td><span style="color:maroon"><b>Username :</b></span> </td>
                                                <td><input name="myusername" type="text" id="login_username"></td></tr>
                                                <tr/><tr/><tr/><tr/>
                                                <tr><td><span style="color:maroon"><b>Password :</b></span> </td>
                                                <td><input name="mypassword" type="password" id="login_password"></td></tr>
                                                <tr/><tr/><tr/><tr/><tr/><tr/>
                                        </table>
				</div><br>
				
                                <div align="center"><button id="login_button" type="submit">  </button></div>
								
                        </form>
				
                        <div id="error_login"> </div>
                                <div id="container_middle3">
			
					 Forgot password &nbsp;|&nbsp; <a id="register" title="Register as new user" onclick='$("#popup").show();'>Not yet Registered</a>
						    
				</div>
                </div>
        </div>

        <div id="footer">
                Copright Reserved
	</div>
    </div>
    <div id="popup" style="display: none;">
                <div id="popup_close"></div>
                <div id="sign_up" style='font-family: "Trebuchet MS", Helvetica, sans-serif;'>
                    <form id="signup_form">
                        <table align="center">
                        <tr><th style="padding-bottom: 30px; font-size: 18px;">New Account?</th></tr>
			<tr><td style="font-size: 14px; width: 50px;">Username</td></tr>
                        <tr><td style="width: 50px;"><input name="myusername" type="text" id="signup_username" size="18"></td></tr>
			<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
			<tr><td style='font-size: 14px; width: 50px;'>Password</td></tr>
                        <tr><td><input name="mypassword" type="password" id="signup_password" size="18"></td></tr>
                        <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr></table>
        		<button id="signup_button" type="submit">   </button>
                    </form>
                    <p id="error_signup"></p>
                </div>
        </div>
</body>

</html>
