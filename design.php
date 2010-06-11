<?
        include 'session.php';
        include 'fetchdatabase.php';
        $sql="SELECT * FROM sections WHERE username='$user'";
        $result=mysql_query($sql);
        $sections=mysql_fetch_array($result);
?>

<html>

<head>
        <title>design - Resume Bakery</title>
        <link rel="stylesheet" type="text/css" media="screen" href="cssdesign.php"/>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jscolor/jscolor.js"></script>
        <script type="text/javascript">
                function update_info(type,value)
                {
                        $.ajax({
                                type: 'POST',
                                url: "updateinfo.php",
                                data: "infotype=" +type +"&infovalue=" +value
                        });
                }
                $(document).ready(function(){
                        var def_font,def_ftsize,def_mgwidth,def_mgcolor,def_bdwidth,def_bgcolor;
                        def_font=$(".section p").css("font-family");
                        def_ftsize=$(".section p").css("font-size");
                        def_mgwidth=$("#resume_body").css("margin");
                        def_mgcolor=$("#resume_body").css("border-color");
                        def_bdwidth=$("#resume_body").css("border-width");
                        def_bgcolor=$("#preview_popup").css("background-color");
                        document.getElementById("new_font").defaultSelected = true;
                        $("#preview_popup").hide();
                        $("#show").click(function(){
                                $("#page").fadeTo("fast",0.1);
                                $("#control").hide();
                                var font=$("#font option:selected").val();
                                var ftsize=$("#font_size").val();
                                var mgwidth=$("#margin_width").val();
                                var mgcolor=$("#margin_color").val();
                                var bdwidth=$("#border_width").val();
                                var bgcolor=$("#background_color").val();
                                if(font!="default")
                                        $(".section p,#info").css("font-family",font);
                                else
                                        $(".section p,#info").css("font-family",def_font);
                                if(ftsize!="")
                                {
                                        ftsize+="px";
                                        $(".section p").css("font-size",ftsize);
                                }
                                else
                                        $(".section p").css("font-size",def_ftsize);
                                if(mgwidth!="")
                                {
                                        mgwidth+="mm";
                                        $("#resume_body").css("margin",mgwidth);
                                }
                                else
                                        $("#resume_body").css("margin",def_mgwidth);
                                if(mgcolor!="")
                                {
                                        mgcolor="#"+mgcolor;
                                        $("#resume_body").css("border-color",mgcolor);
                                }
                                else
                                        $("#resume_body").css("border-color",def_mgcolor);
                                if(bdwidth!="")
                                {
                                        $("#resume_body").css("border-width",bdwidth);
                                }
                                else
                                        $("#resume_body").css("border-width",def_bdwidth);
                                if(bgcolor!="")
                                {
                                        bgcolor="#"+bgcolor;
                                        $("#preview_popup").css("background-color",bgcolor);
                                }
                                else
                                        $("#preview_popup").css("background-color",def_bgcolor);
                                $("#preview_popup").show();
                                $("#popup_close").click(function(){
                                        $("#preview_popup").hide();
                                        $("#control").show();
                                        $("#page").fadeTo("fast",1);
                                });
                        });
                        $("#save").click(function(){
                                var font=$("#font option:selected").val();
                                var ftsize=$("#font_size").val();
                                var mgwidth=$("#margin_width").val();
                                var mgcolor=$("#margin_color").val();
                                var bdwidth=$("#border_width").val();
                                var bgcolor=$("#background_color").val();
                                if(font!="default")
                                        update_info("font_family",font);
                                if(ftsize!="")
                                        update_info("font_size",ftsize);
                                if(mgwidth!="")
                                {
                                        mgwidth+="mm";
                                        update_info("margin_width",mgwidth);
                                }
                                if(mgcolor!="")
                                {
                                        mgcolor="#"+mgcolor;
                                        update_info("margin_color",mgcolor);
                                }
                                if(bdwidth!="")
                                {
                                        update_info("border_width",bdwidth);
                                }
                                if(bgcolor!="")
                                {
                                        bgcolor="#"+bgcolor;
                                        update_info("background_color",bgcolor);
                                }
                                $("#font_size").val("");
                                $("#margin_width").val("");
                                $("#border_width").val("");
                                def_font=font;
                                def_ftsize=ftsize;
                                def_mgwidth=mgwidth;
                                def_mgcolor=mgcolor;
                                def_bdwidth=bdwidth;
                                def_bgcolor=bgcolor;
                        });
                        <?
                        if(($data['gender']==NULL)||($data['dob']==NULL&&$data['marital_status']==NULL))
                            echo '$("#g").hide();';
                        if($data['dob']==NULL||$data['marital_status']==NULL)
                            echo '$("#d").hide();';
                        if($data['gender']==NULL)
                            echo '$("#gender").hide();';
                        if($data['dob']==NULL)
                            echo '$("#dob").hide();';
                        if($data['marital_status']==NULL)
                            echo '$("#marital_status").hide();';
                        if($data['phone']==NULL)
                            echo '$("#phone").hide();';
                        if($data['email']==NULL)
                            echo '$("#email").hide();';
                        if($data['mobile']==NULL)
                            echo '$("#mobile").hide();';
                        if($data['website']==NULL)
                            echo '$("#website").hide();';
                        if($data['address']==NULL)
                            echo '$("#address").hide();';

                        function section_hide($type)
                        {
                                echo '$("#'.$type.'").hide();';
                        }
                        function section_show($type)
                        {
                                echo '$("#'.$type.'").show();';
                        }
                        if($sections['summary']=='0')
                        {
                            section_hide("summary");
                        }
                        else
                        {
                            section_show("summary");
                        }
                        if($sections['skills']=='0')
                        {
                            section_hide("skills");
                        }
                        else
                        {
                            section_show("skills");
                        }
                        if($sections['experience']=='0')
                        {
                            section_hide("experience");
                        }
                        else
                        {
                            section_show("experience");
                        }
                        if($sections['studies']=='0')
                        {
                            section_hide("studies");
                        }
                        else
                        {
                            section_show("studies");
                        }
                        if($sections['interests']=='0')
                        {
                            section_hide("interests");
                        }
                        else
                        {
                            section_show("interests");
                        }
                        if($sections['hobbies']=='0')
                        {
                            section_hide("hobbies");
                        }
                        else
                        {
                            section_show("hobbies");
                        }
                        if($sections['languages']=='0')
                        {
                            section_hide("languages");
                        }
                        else
                        {
                            section_show("languages");
                        }
                        if($sections['certificates']=='0')
                        {
                            section_hide("certificates");
                        }
                        else
                        {
                            section_show("certificates");
                        }
                        if($sections['publications']=='0')
                        {
                            section_hide("publications");
                        }
                        else
                        {
                            section_show("publications");
                        }
                        if($sections['awards']=='0')
                        {
                            section_hide("awards");
                        }
                        else
                        {
                            section_show("awards");
                        }
                        ?>
                        
                });

        </script>
</head>

<body>

	<div id="page">
		<div id="header">
			<div id="sideline">Welcome <b><?echo $user;?></b>&nbsp;|&nbsp;<a href="logout.php" title="Log out">Logout</a></div>
                        <div id="title" class="color">Resume-Bakery</div>
                        <div id="tagline">easy resume management</div>
		</div>
		<div id="body">
                        <div id="control">
                                <table><tr>
                                        <td class="head" id="header_image">
                                            Header image </td><td class="field"> : <input type="file" size="8">
                                </td>
                                <td class="head" id="section_font">
                                    Section font </td><td class="field"> :
                                        <select id="font">
                                            <option id="new_font" value="default">&lt;Change Font&gt;</option>
                                            <option value='Arial Black, Gadget, sans-serif' style='font-family: Arial Black, Gadget, sans-serif;'>Arial Black</option>
                                            <option value='Courier New, Courier, monospace' style='font-family: Courier New, Courier, monospace;'>Courier New</option>
                                            <option value='Lucida Console, Monaco, monospace' style='font-family: Lucida Console, Monaco, monospace;'>Lucida Console</option>
                                            <option value='Palatino Linotype, Book Antiqua, Palatino, serif' style='font-family: Palatino Linotype, Book Antiqua, Palatino, serif;'>Palatino Linotype</option>
                                            <option value='Times New Roman, Times, serif' style='font-family: Times New Roman, Times, serif;'>Times New Roman</option>
                                            <option value='Trebuchet MS, Helvetica, sans-serif' style='font-family: Trebuchet MS, Helvetica, sans-serif;'>Trebuchet MS</option>
                                        </select>
                                <input id="font_size" type="text" size="1" maxlength="2"> px</td></tr></table>
                                <table>
                                        <tr><td class="head">Margin width</td>
                                            <td class="field">: <input  id="margin_width" type="text" size="1" maxlength="2"> mm</td>
                                            <td class="head">Margin color</td>
                                            <td class="field">: <input id="margin_color" class="color {required:false}" size="4" maxlength="6"></td>
                                        </tr>
                                        <tr><td class="head">Border width</td>
                                            <td class="field">: <input id="border_width" type="text" size="1" maxlength="1"> px</td>
                                            <td class="head">Background color</td>
                                            <td class="field">: <input id="background_color" class="color {required:false}" size="4" maxlength="6"></td>
                                        </tr>
                                </table>
                                <div id="change"><br><br><br>
                                        <span id="show">Show Preview &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span id="save">Save Changes</span>
                                </div>
                        </div>
                        
		</div>

	</div>
        <div id="preview_popup">
                <div id="popup_close"></div>
                <div id="resume_body">
                        <div id="personal_info">
                                <div id="profile_pic">
                                        <?echo ($data['profile_pic']!="0")?('<img src="files/'.$user.'" height="120" width="120">'):'';?>
                                </div>
                                <div id="info">
                                        <div class="name">
                                                <span id="first_name"><?echo $data['first_name']?></span>&nbsp;&nbsp;&nbsp;
                                                <span id="last_name"><?echo $data['last_name']?><br></span>
                                                <span id="gender"><?echo $data['gender']=='M'?'Male':'Female';?></span><span id="g">, </span>
                                                <span id="dob"><?echo $data['dob'];?></span><span id="d">, </span>
                                                <span id="marital_status"><?echo $data['marital_status']=='S'?'Single':'Married';?></span>
                                        </div>
                                        <table>
                                        <tr><td id="mobile"><?echo "Mobile: ".$data['mobile'];?></td>
                                            <td id="email"><?echo "Email: ".$data['email'];?></td></tr>

                                        <tr><td id="phone"><?echo "Phone: ".$data['phone'];?></td>
                                            <td id="website"><?echo "Website/Blog: ".$data['website'];?></td></tr>
                                        </table>
                                        <p id="address"><?echo $data['address'];?></p>

                                    </div>
                        </div>
                        <table>
                                <tr class="section" id="summary">
                                        <td class="title"><h3>Summary</h3></td>
                                        <td class="data"><p><?echo $data['summary'];?></p></td>
                                </tr>
                                <tr class="section" id="skills">
                                        <td class="title"><h3>Skills</h3></td>
                                        <td class="data"><p><?echo $data['skills'];?></p></td>
                                </tr>
                                <tr class="section" id="experience">
                                        <td class="title"><h3>Experience</h3></td>
                                        <td class="data"><p><?echo $data['experience'];?></p></td>
                                </tr>
                                <tr class="section" id="studies">
                                        <td class="title"><h3>Studies</h3></td>
                                        <td class="data"><p><?echo $data['studies'];?></p></td>
                                </tr>
                                <tr class="section" id="interests">
                                        <td class="title"><h3>Interests</h3></td>
                                        <td class="data"><p><?echo $data['interests'];?></p></td>
                                </tr>
                                <tr class="section" id="hobbies">
                                        <td class="title"><h3>Hobbies</h3></td>
                                        <td class="data"><p><?echo $data['hobbies'];?></p></td>
                                </tr>
                                <tr class="section" id="languages">
                                        <td class="title"><h3>Languages</h3></td>
                                        <td class="data"><p><?echo $data['languages'];?></p></td>
                                </tr>
                                <tr class="section" id="certificates">
                                        <td class="title"><h3>Certificates</h3></td>
                                        <td class="data"><p><?echo $data['certificates'];?></p></td>
                                </tr>
                                <tr class="section" id="publications">
                                        <td class="title"><h3>Publications</h3></td>
                                        <td class="data"><p><?echo $data['publications'];?></p></td>
                                </tr>
                                <tr class="section" id="awards">
                                        <td class="title"><h3>Awards</h3></td>
                                        <td class="data"><p><?echo $data['awards'];?></p></td>
                                </tr>
                        </table>
                 </div>
        </div>
	

</body>

</html>
