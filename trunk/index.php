
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
        function height(diff)       //to adjust height of sidebars according to content in container
        {
                var ht=$("#container").css("height");
                ht=ht.substring(0,ht.length-2);
                ht=parseInt(ht);
                ht-=diff;
                ht+="px";
                $("#rightsidebar").css("height",ht);
        }
        function load_edit(resume)      //to load edit page dynamically
        {
                page="edit";
                createCookie("page",page);
                createCookie("resume",resume);
                $("#container").load("edit.php?resume="+resume +" #resume_body",function(){
                        edit_page_js();
                });
                $("#rightsidebar").load("edit.php?resume="+resume +" #rightbar",function(){
                        edit_page_js();
                });
        }
        function load_preview(resume)   //to load preview page dynamically
        {
                page="preview";
                createCookie("page",page);
                $("#container").load("preview.php?resume="+resume +" #preview_body",function(){
                        preview_page_js();
                });
                $("#rightsidebar").load("preview.php?resume="+resume +" #preview_rightbar",function(){
                        preview_page_js();
                });
        }
        function load_design(resume,param)  //to load design page dynamically
        {
                page="design"+param;
                createCookie("page",page);
                $("#container").load("design.php?resume="+resume +param +" #preview_popup",function(){
                        design_page_js();
                });
                $("#rightsidebar").load("design.php?resume="+resume +param +" #control",function(){
                        design_page_js();
                });
        }
        function createCookie(type,val)     //to create cookies for identifying current resume in use & also the current page (in case of reload)
	{
		var date = new Date();
		date.setTime(date.getTime()+(1*60*60*1000));
		var expires = "; expires="+date.toGMTString();
                document.cookie=type+"="+val+expires+"; path=/";
        }
        function readCookie(type)       //to read cookie value
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
        function load_page()    //to load the correct page & resume based on cookie value
        {
                var page=readCookie("page"),resume=readCookie("resume");
                if(page==null)
                        return null;
                if(page=="edit")
                        load_edit(resume);
                else if(page=="preview")
                        load_preview(resume);
                else if(page=="design")
                        load_design(resume,"");
                else if(page=="design&type=new")
                        load_design(resume,"&type=new");
                return page;
        }
        function logout()   //logouts user
        {
                var date = new Date();
		date.setTime(date.getTime()+(-1*60*60*1000));
		var expires = "; expires="+date.toGMTString();
                document.cookie="page="+null+expires+"; path=/";
                document.cookie="resume="+null+expires+"; path=/";
                $.ajax({
                        url: "logout.php",
                        success: function(){
                                window.location.reload();
                        }
                });
        }
        $(document).ready(function(){
                if(load_page()==null)
                        $("#rightsidebar").html('<div align="justify"><a href="#"><b>Create Resume</b></a><br>It is very easy to customize and update your resume to suit your needs.<br><br><br><a href="#"><b>Design Template</b></a><br>You can create layouts of your resume. This helps to keep up identity. Be different and attractive.<br><br><br><a href="#"><b>Preview Resume</b></a><br>Preview your resume as you write it at each step. <br><br><br><a href="#"><b>Manage Groups</b></a><br>You can easily manage groups. The owner can set a common template for all its users.<br><br><br><br><br><br><br><br><br></div><div align="center"><img src="images/res.jpg"></div> <span style="color:red"><br><br> CREATE YOUR RESUME </span><br><br>');
                else if(load_page()=="edit")
                        $("#head_pic").html('<img src="images/edit2.png">');
                else if(load_page()=="preview")
                        $("#head_pic").html('<img src="images/preview.png">');
                else if(load_page()=="design"||load_page()=="design?type=new")
                        $("#head_pic").html('<img src="images/design.png">');
                height(32);         //adjusts the height of sidebars..
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
                                                {
                                                        load_edit("General");       //sets area_of_work as "General" (default)
                                                        $("#head_pic").html('<img src="images/edit2.png">');
                                                }
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

                var body=$("body").css("width"),page=$("#page_body").css("width");
                body=body.substring(0,body.length-2);
                page=page.substring(0,page.length-2);
                body=parseInt(body);
                page=parseInt(page);
                var left=(body-page)/2;
                $("#head_popups").css("left",left+"px");        //positions the header popups according to different screen resolutions
                $("#tips").mouseover(function(){
                        $("#headpopup1").css("display","block");
                });
                $("#tips").mouseout(function(){
                        $("#headpopup1").css("display","none");
                });
		$("#sample").mouseover(function(){
                        $("#headpopup2").css("display","block");
                });
                $("#sample").mouseout(function(){
                        $("#headpopup2").css("display","none");
                });
		$("#about").mouseover(function(){
                        $("#headpopup3").css("display","block");
                });
                $("#about").mouseout(function(){
                        $("#headpopup3").css("display","none");
                });
		$("#help").mouseover(function(){
                        $("#headpopup4").css("display","block");
                });
                $("#help").mouseout(function(){
                        $("#headpopup4").css("display","none");
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
                        <a id="tips"> TIPS FOR A GOOD RESUME</a>
                        <a id="sample"> SAMPLE RESUME</a>
                        <a id="about"> ABOUT US </a>
                        <a id="help"> HELP </a>
                </div>
                <br>
                <div id="user" style="float: right;color: maroon;font-size: 10px;display: none;"><span>Welcome <b style="color: red;font-weight: bold;font-size: 12px;"></b></span>&nbsp; | &nbsp;<span id="logout" style="cursor: pointer;color: maroon;" onclick="logout();">Log Out</span></div>
                <img src="images/abc.png"/>&nbsp;&nbsp;&nbsp;
                <img style="vertical-align: super;" src="images/arrow.gif"/>&nbsp;&nbsp;&nbsp;&nbsp;
                <span id="head_pic"><img src="images/a.png" onclick='$("#page_body").fadeTo("fast",0.1);$("#popup").css("display","block");' onmouseover="this.src='images/amouse.png';" onmouseout="this.src='images/a.png';"></span>
                <br><br>
                <marquee style="color: brown;">Easy and Smart Resume Generator. &nbsp;&nbsp;Experience it !</marquee>
        </div>

        
        <div id="rightsidebar" style="color: #330033;font-size: 14px;font-family: Trebuchet MS, Helvetica, sans-serif;">
                
        </div>
        <div id="container" align="center">
                <div id="leftsidebar" align="justify" style="color: #330033;font-size: 14px;font-family: Trebuchet MS, Helvetica, sans-serif;">
                        <p align="center"><b>Why to choose Resume Bakery?</b></p><br>
                        <div align="center"><img src="images/aa.jpg"></div>
		        <p style="color:red; text-align: center;"><br><br>Are you confused?</p><br><br>
			<img src="images/redball.gif"/> Resume Bakery takes stress out of your job search.<br><br>
                        <img src="images/redball.gif"/> It create resumes based on your current career level, background and career objectives.<br><br><br><br><br>
                        <p align="center"><b>Be confident </b></p><div align="center"><img src="images/ss.jpeg"/><br>Find Your Dream Job<br>With a Good Resume</div>
                </div>
                <div id="middlesidebar" align="left">
                        <div id="heading">
                                <font face="palatino, times, times new roman"><b>Create a Professional Resume</b></font>
                        </div>
                        <br>
                        
                        <font face="palatino, times, times new roman" size=3>
                        <div align="justify" style="color: #330033;">
                            Resume Bakery is an ultimate resume management system that helps you to create resumes as u wish. This helps you to market yourself well. It improves your chances of landing on a dream job. There are only three stages for this easy resume creation :
                        </div><br><br>&nbsp;&nbsp;&nbsp;
                        <span style="color:maroon"><b>Step 1 : Create Resume</b></span>   <hr><br><img src="images/edit1.png">
                        <span style="color:maroon;float: right;width: 290px;font-size: 14px;">Create resumes easily<br><br> <img src="images/redball.gif"/> easy photo upload<br><br> <img src="images/redball.gif"/> inline editing option <br><br> <img src="images/redball.gif"/> flexiblity to add sections<br><br><img src="images/redball.gif"/> options to share resume </span><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;
                        <b><span style="color:maroon">Step 2 : Preview Resume </span></b>
                        <hr><br><img src="images/design1.png"><span style="color:maroon;float: right;width: 290px;font-size: 14px;">Give resumes a smart and formal look <br><br> <img src="images/redball.gif"/> option to generate pdf copy <br><br>  <img src="images/redball.gif"/> flexibility to choose from shared templates <br><br> <img src="images/redball.gif"/> option to edit as and when required </span><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <b> <span style="color:maroon;">Step 3 : Design Template</span></b>  <hr><br><img src="images/preview1.png"><span style="color:maroon;float: right;width: 290px;font-size: 14px;">Design your template easily & be different!<br><br> <img src="images/redball.gif"/> facility to generate resume templates <br><br><img src="images/redball.gif"/> different style elements to design your resume <br><br>  <img src="images/redball.gif"/> option to share your template with friends  </span><br><br><br>
                        <hr>

                        </font>
                        
                        <br><br>

                        <div id="container_middle1">
                                <font face="palatino, times, times new roman" size=3>
                                        <b>Advertise yourself with a good resume !</b>
				</font>
                        </div>

                        <div id="container_middle2">
                                <font face="palatino, times, times new roman" size=3>
                                        Login to continue.
                                </font>
                        </div>

                        <form id="login_form" >
                                <div id="tab">
                                        <br><br>
                                        <table align="center">
                                                <tr><td><span style="color:maroon"><b>Username </b></span> </td>
                                                <td>: <input name="myusername" type="text" id="login_username"></td></tr>
                                                <tr/><tr/><tr/><tr/>
                                                <tr><td><span style="color:maroon"><b>Password </b></span> </td>
                                                <td>: <input name="mypassword" type="password" id="login_password"></td></tr>
                                                <tr/><tr/><tr/><tr/><tr/><tr/>
                                        </table>
				</div><br>
				
                                <div align="center"><button id="login_button" type="submit">  </button></div>
								
                        </form>
				
                        <div id="error_login"> </div>
                                <div id="container_middle3">
			
					 Forgot password &nbsp;|&nbsp; <span id="register" title="Register as new user" style="cursor: pointer;" onclick='$("#popup").show();'>Not yet registered?</span>
						    
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
    <div id="head_popups">
            <div id="headpopup1" style="text-align: justify;left: 180px;">
                    <img src="images/redball.gif"> Leaving out Job Objective! If you don't show a sense of direction, employers won't be interested.<br><br>
                    <img src="images/redball.gif"> Remove everything that starts with "responsibilities included" and replace it with on-the-job accomplishments. <br><br>
                    <img src="images/redball.gif"> Your address, contact details should be neatly presented, with date of birth, nationality and marital status also possible here.<br><br>
                    <img src="images/redball.gif"> Employers are usually more interested in activities which require you to show team commitment or personal initiative and drive.
            </div>
            <div id="headpopup2" style="left: 300px;width: 405px;">
                    <img src="images/sample.png">
            </div>
            <div id="headpopup3" style="text-align: justify;left: 530px;">
                    We provide you with a smart and efficient Resume Management software. This Resume management tool helps to make you a sucessfull individual by helping you land on your dream job. We provide options to Edit Resume, Modify Resume, Save Resume and Generate Resume PDF. There are additional options to maintain groups, design your own template , share resume etc. So go ahead & try it out!
            </div>
            <div id="headpopup4" style="left: 660px;width: 160px;">
                    CONTACT US<br><br>
                    <img src="images/redball.gif" style="vertical-align: middle;"> sarathlakshman@gmail.com<br>
                    <img src="images/redball.gif" style="vertical-align: middle;"> alwinmathew316@gmail.com<br>
                    <img src="images/redball.gif" style="vertical-align: middle;"> neenujacob123@gmail.com
            </div>
    </div>

</body>

</html>
