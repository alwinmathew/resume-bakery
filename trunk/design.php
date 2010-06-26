<?
        include 'session.php';
        include 'fetchdatabase.php';
        $sql="SELECT * FROM sections WHERE username='$user' AND area_of_work='general'";
        $result=mysql_query($sql);
        $sections=mysql_fetch_array($result);
        $param=($_GET['type']=="new")?TRUE:FALSE;
        $id=$data['template_id'];
        $sql="SELECT * FROM templates WHERE template_key='$id'";
        $result=mysql_query($sql);
        $templates=mysql_fetch_array($result);
?>

<html>

<head>
        <title>design - Resume Bakery</title>
        <link rel="stylesheet" type="text/css" media="screen" href="cssdesign.php"/>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jscolor/jscolor.js"></script>
        <script type="text/javascript" src="js/ajaxupload.js"></script>
        <script type="text/javascript">
                function update_template(type,value)
                {
                        $.ajax({
                                type: 'POST',
                                url: "updatetemplate.php",
                                data: "type=" +type +"&value=" +value,
                                success: function(){
                                        if(value=="remove_temp"||value=="remove_header")
                                                window.location.reload();
                                        if(value=="status_temp")
                                                return data;
                                }
                        });
                }
                function save_template(type){
                        var name=$("#template_name").val();
                        var font=$("#font option:selected").val();
                        var ftsize=$("#font_size").val();
                        var mgwidth=$("#margin_width").val();
                        var mgcolor=$("#margin_color").val();
                        var bdwidth=$("#border_width").val();
                        var bgcolor=$("#background_color").val();
                        if(type)
                        {
                                update_template("new",name);
                                if ($("#read_only").is(':checked'))
                                        update_template("read_only","1");
                                else
                                        update_template("read_only","0");
                        }
                        if(font!="default")
                                update_template("font_family",font);
                        if(ftsize!="")
                                update_template("font_size",ftsize);
                        if(mgwidth!="")
                        {
                                mgwidth+="mm";
                                update_template("margin_width",mgwidth);
                        }
                        if(mgcolor!="")
                        {
                                mgcolor="#"+mgcolor;
                                update_template("margin_color",mgcolor);
                        }
                        if(bdwidth!="")
                        {
                                update_template("border_width",bdwidth);
                        }
                        if(bgcolor!="")
                        {
                                bgcolor="#"+bgcolor;
                                update_template("background_color",bgcolor);
                        }
                        update_template("header_image","check_header");
                        window.location="preview";
                }
                $(document).ready(function(){
                        var def_font,def_ftsize,def_mgwidth,def_mgcolor,def_bdwidth,def_bgcolor;
                        def_font=$(".section p").css("font-family");
                        def_ftsize=$(".section p").css("font-size");
                        def_mgwidth=$("#resume_body").css("margin");
                        def_mgcolor=$("#resume_body").css("border-color");
                        def_bdwidth=$("#resume_body").css("border-width");
                        def_bgcolor=$("#preview_popup").css("background-color");
                        $("#preview_popup").hide();
                        $(".remove").mouseover(function(){
                                $(this).css('text-decoration','underline');
                        });
                        $(".remove").mouseout(function(){
                                $(this).css('text-decoration','none');
                        });
                        $("#remove").click(function(){
                                update_template("header_image","remove_temp");
                        });
                        $("#remove_header").click(function(){
                                update_template("header_image","remove_header");
                        });
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
                                        //$("#header_image").css("height",(mgwidth-1)+"mm");
                                        if(8-mgwidth>0)
                                                $("#header_image").css("margin-right",(8-mgwidth)+"mm");
                                        else
                                                $("#header_image").css("margin-right",0);
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
                                var user=$("#sideline b").html();
                                if(update_template("header_image","status_temp"))
                                        $("#image_header").html('<img id="header_image" src="tmp/'+user +'_header.jpg">');
                                $("#preview_popup").show();
                                $("#popup_close").click(function(){
                                        $("#preview_popup").hide();
                                        $("#control").show();
                                        $("#page").fadeTo("fast",1);
                                });
                        });
                        new AjaxUpload('header_upload', {
                                action: 'addheader.php',
                                name: 'myheader',
                                autoSubmit: true,
                                onSubmit : function(file,ext){
                                        //disable upload button
                                        this.disable();
                                        if (!(ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
                                                // extension is not allowed
                                                $("#response").html("Invalid file extension!");
                                                this.enable();
                                                // cancel upload
                                                return false;
                                        }
                                },
                                onComplete: function(){
                                        // enable upload button
                                        this.enable();
                                        $("#image_header").load("design.php #image_header");
                                        $("#personal_info").load("design.php #personal_info");
                                }
                        });
                });

        </script>
</head>

<body>

	<div id="page">
		<div id="header">
			<div id="sideline">Welcome <b><?echo $user;?></b>&nbsp;|&nbsp;<a href="logout.php" title="Log out">Logout</a></div>
                        <div id="title">Resume-Bakery</div>
                        <div id="tagline">easy resume management</div>
		</div>
		<div id="body">
                        <div id="control">
                                <h3><?echo ($param)?"New Template":"Edit template : ".$templates['template_name'];?> ?</h3>

                                <table>
                                    <?echo ($param)?' <tr><td class="head">Template Name</td>
                                        <td class="field"> : <input id="template_name" type="text" maxlength="32"></td>
                                    </tr>':'';?>
                                    <tr>            <td class="head" id="head_image">Header image</td>
                                                    <td class="field"> : <span id="header_upload" style="cursor: pointer;">Upload</span>
                                                        <p id="response" style="color: red;"></p>
                                                        <span id="remove" class="remove" style="color: red;font-size: 11px;cursor: pointer;">- remove</span><br>
                                                        &nbsp;&nbsp;<span id="remove_header" class="remove" style="color: red;font-size: 11px;cursor: pointer;">- remove saved header</span>
                                                    </td>
                                        <td class="head" id="section_font">Section font </td>
                                        <td class="field"> :
                                        <select id="font">
                                            <option selected id="new_font" value="default">&lt;Change Font&gt;</option>
                                            <option value='Arial Black, Gadget, sans-serif' style='font-family: Arial Black, Gadget, sans-serif;'>Arial Black</option>
                                            <option value='Courier New, Courier, monospace' style='font-family: Courier New, Courier, monospace;'>Courier New</option>
                                            <option value='Lucida Console, Monaco, monospace' style='font-family: Lucida Console, Monaco, monospace;'>Lucida Console</option>
                                            <option value='Palatino Linotype, Book Antiqua, Palatino, serif' style='font-family: Palatino Linotype, Book Antiqua, Palatino, serif;'>Palatino Linotype</option>
                                            <option value='Times New Roman, Times, serif' style='font-family: Times New Roman, Times, serif;'>Times New Roman</option>
                                            <option value='Trebuchet MS, Helvetica, sans-serif' style='font-family: Trebuchet MS, Helvetica, sans-serif;'>Trebuchet MS</option>
                                        </select>
                                        <input id="font_size" type="text" size="1" maxlength="2" value="<?echo ($param)?'12':$templates['font_size']?>"> px
                                        </td>
                                    </tr>
                                    <tr><td class="head">Margin width</td>
                                        <td class="field">: <input  id="margin_width" type="text" size="1" maxlength="2" value="<?echo ($param)?'8':(int)$templates['margin_width']?>"> mm</td>
                                        <td class="head">Margin color</td>
                                        <td class="field">: <input id="margin_color" class="color {required:false}" size="4" maxlength="6" value="<?echo ($param)?'FFFFFF':$templates['margin_color']?>"></td>
                                    </tr>
                                    <tr><td class="head">Border width</td>
                                        <td class="field">: <input id="border_width" type="text" size="1" maxlength="1" value="<?echo ($param)?'0':$templates['border_width']?>"> px</td>
                                        <td class="head">Background color</td>
                                        <td class="field">: <input id="background_color" class="color {required:false}" size="4" maxlength="6" value="<?echo ($param)?'FFFFFF':$templates['background_color']?>"></td>
                                    </tr>
                                    <?
                                    echo ($param)?
                                    '<tr><td class="head">Set template as Read-only</td>
                                         <td class="field">: <input id="read_only" checked type="checkbox" value="read"></td>
                                     </tr>':'';
                                    ?>
                                </table>
                                <div id="change" align="center"><br><br><br>
                                    <span id="show" title="Click to see Preview">Show Preview</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="save" title="Save Template" onclick="save_template(<?echo ($param)?"true":"false";?>);">Save <?echo ($param)?"Template":"Changes";?></span>
                                </div>
                        </div>
                        
		</div>
                <div id="preview" onclick="window.location='preview';">Preview</div>
	</div>
        <div id="preview_popup">
                <div id="popup_close"></div>
                <div id="resume_body">
                        <div id="image_header">
                        <?  if(file_exists("tmp/$user"."_header.jpg"))
                                    echo '<img id="header_image" align="right" src="tmp/'.$user.'_header.jpg">';
                            else if(!$param)
                                    if($templates['header_image']!="0")
                                            echo '<img id="header_image" align="right" src="files/'.$templates['template_key'].'_header.jpg">';?>
                        </div>
                        <div id="personal_info" style="margin-top: <?  if(file_exists("tmp/$user"."_header.jpg"))
                                    echo 60+10;
                                else if(!$param)
                                    if($templates['header_image']!="0")
                                        echo 60+10;
                                    else
                                        echo 0;
                                else
                                    echo 0;?>px;">
                                <div id="profile_pic" align="center">
                                        <?echo ($data['profile_pic']!="0")?('<img src="files/'.$user.'.jpg">'):'';?>
                                </div>
                                <div id="info">
                                        <div class="name">
                                                <span id="first_name"><?echo $data['first_name']?></span>&nbsp;&nbsp;&nbsp;
                                                <span id="last_name"><?echo $data['last_name']?><br></span>
                                                <?
                                                    if($data['gender']!=NULL)
                                                        echo '<span id="gender">'.(($data['gender']=='M')?'Male':'Female').'</span>';
                                                    echo (($data['gender']==NULL)||($data['dob']==NULL&&$data['marital_status']==NULL))?'':'<span id="g">, </span>';
                                                    echo ($data['dob']!=NULL)?('<span id="dob">'.$data['dob'].'</span>'):'';
                                                    echo ($data['dob']==NULL||$data['marital_status']==NULL)?'':'<span id="d">, </span>';
                                                    if($data['marital_status']!=NULL)
                                                        echo '<span id="marital_status">'.(($data['marital_status']=='S')?'Single':'Married').'</span>';
                                                ?>
                                        </div>
                                        <table>
                                        <tr><?echo ($data['mobile']!=NULL)?'<td id="mobile">Mobile: '.$data['mobile'].'</td>':'';
                                            echo ($data['email']!=NULL)?'<td id="email">Email: '.$data['email'].'</td>':'';?></tr>

                                        <tr><?echo ($data['phone']!=NULL)?'<td id="phone">Phone: '.$data['phone'].'</td>':'';
                                            echo ($data['website']!=NULL)?'<td id="website">Website/blog: '.$data['website'].'</td>':'';?></tr>
                                        </table>
                                        <?echo ($data['address']!=NULL)?'<p id="address">'.$data['address'].'</p>':'';?>
                                    </div>
                        </div>
                        <table>
                                <tr class="section" id="summary" style="display: <?echo ($sections['summary']!="0")?"block":"none";?>;">
                                        <td class="title"><h3>Summary</h3></td>
                                        <td class="data"><p><?echo $data['summary'];?></p></td>
                                </tr>
                                <tr class="section" id="skills" style="display: <?echo ($sections['skills']!="0")?"block":"none";?>;">
                                        <td class="title"><h3>Skills</h3></td>
                                        <td class="data"><p><?echo $data['skills'];?></p></td>
                                </tr>
                                <tr class="section" id="experience" style="display: <?echo ($sections['experience']!="0")?"block":"none";?>;">
                                        <td class="title"><h3>Experience</h3></td>
                                        <td class="data"><p><?echo $data['experience'];?></p></td>
                                </tr>
                                <tr class="section" id="studies" style="display: <?echo ($sections['studies']!="0")?"block":"none";?>;">
                                        <td class="title"><h3>Studies</h3></td>
                                        <td class="data"><p><?echo $data['studies'];?></p></td>
                                </tr>
                                <tr class="section" id="interests" style="display: <?echo ($sections['interests']!="0")?"block":"none";?>;">
                                        <td class="title"><h3>Interests</h3></td>
                                        <td class="data"><p><?echo $data['interests'];?></p></td>
                                </tr>
                                <tr class="section" id="hobbies" style="display: <?echo ($sections['hobbies']!="0")?"block":"none";?>;">
                                        <td class="title"><h3>Hobbies</h3></td>
                                        <td class="data"><p><?echo $data['hobbies'];?></p></td>
                                </tr>
                                <tr class="section" id="languages" style="display: <?echo ($sections['languages']!="0")?"block":"none";?>;">
                                        <td class="title"><h3>Languages</h3></td>
                                        <td class="data"><p><?echo $data['languages'];?></p></td>
                                </tr>
                                <tr class="section" id="certificates" style="display: <?echo ($sections['certificates']!="0")?"block":"none";?>;">
                                        <td class="title"><h3>Certificates</h3></td>
                                        <td class="data"><p><?echo $data['certificates'];?></p></td>
                                </tr>
                                <tr class="section" id="publications" style="display: <?echo ($sections['publications']!="0")?"block":"none";?>;">
                                        <td class="title"><h3>Publications</h3></td>
                                        <td class="data"><p><?echo $data['publications'];?></p></td>
                                </tr>
                                <tr class="section" id="awards" style="display: <?echo ($sections['awards']!="0")?"block":"none";?>;">
                                        <td class="title"><h3>Awards</h3></td>
                                        <td class="data"><p><?echo $data['awards'];?></p></td>
                                </tr>
                        </table>
                 </div>
        </div>
	

</body>

</html>
