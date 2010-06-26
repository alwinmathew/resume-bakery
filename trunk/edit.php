<?
        include 'session.php';
        include 'fetchdatabase.php';
        $sql="SELECT * FROM sections WHERE username='$user' AND area_of_work='general'";
        $result=mysql_query($sql);
        $sections=mysql_fetch_array($result);
?>

<html>

<head>
        <title>edit - Resume Bakery</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css" />
        <link rel="stylesheet" type="text/css" href="editmystyle.css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/ajaxupload.js"></script>
        <script type="text/javascript">
                function update_info(type,value,fn)
                {
                        $.ajax({
                                type: 'POST',
                                url: "updateinfo.php",
                                data: "infotype=" +type +"&infovalue=" +value,
                                success: function(){
                                        if(type=="profile_pic")
                                                return;
                                        $(".section div").hide();
                                        $(".info_edit").hide();
                                        $(fn).show();
                                        if(type=="dob")
                                        {
                                                if(value=="")
                                                    $(fn).html("+ add date of birth");
                                                else
                                                    $(fn).html($("#dob_day option:selected").val()+" "+$("#dob_month option:selected").html()+" "+$("#dob_year option:selected").val());
                                                return;
                                        }
                                        if(value=="")
                                            if(fn.indexOf(" p")>=0)
                                                value="Click to edit description";
                                            else
                                            {
                                                value=(type=="marital_status")?"+ add marital status":"+ add "+type;
                                                value=value+(type=="website"?"/blog URL":"");
                                                if(type=="first_name")
                                                    value="firstname";
                                                else if(type=="last_name")
                                                    value="lastname";
                                            }
                                        $(fn).html(value);
                                }
                        });
                }

                function update_section(type,value)
                {
                        $.ajax({
                                type: 'POST',
                                url: "updatesection.php",
                                data: "sectiontype=" +type +"&sectionvalue=" +value,
                                success: function(data){
                                        if(type=="sharing")
                                        {
                                            if(data=="1")
                                                $("#share span").html("Public");
                                            else
                                                $("#share span").html("Private");
                                            return;
                                        }
                                        var section="#"+type;
                                        var add="#add_"+type;
                                        var sec="#sec_"+type;
                                        if(value=="1")
                                        {
                                                $(section).css("display","block");
                                                $(add).css("display","none");
                                                $(sec).css("display","block");
                                        }
                                        else
                                        {
                                                $(section).css("display","none");
                                                $(add).css("display","block");
                                                $(sec).css("display","none");
                                        }
                                }
                        });
                }
                function refresh_info()
                {
                        $(".info_edit").hide();
                        $("#first_name,#last_name,#info p").show();
                        $("#file_upload").hide();
                        $("#profile_pic p").show();
                }
                function refresh_section()
                {
                        $(".section div").hide();
                        $(".section p").show();
                }
                function edit_info(type)
                {
                        var edit="#"+type +"_edit";
                        var sec="#edit_"+type;
                        var fn="#"+type;
                        var selection="#add_"+type;
                        var data=$(fn).html();
                        refresh_info();
                        if(data.substr(0,5)=="+ add"||data=="firstname"||data=="lastname")
                            data="";
                        $(fn).hide();
                        $(edit).show();
                        $(sec).val(data);
                        $(".save").click(function(){
                                if(type=="gender"||type=="marital_status")
                                        data=$(selection+" option:selected").val();
                                else
                                        data=$(sec).val();
                                if(data=="--")
                                        data="";
                                update_info(type,data,fn);
                        });
                        $(".cancel").click(function(){
                                refresh_info();
                        });
                }
                function edit_section(type)
                {
                        var edit="."+type +"_edit";
                        var sec="#edit_"+type;
                        var fn="#"+type +" p";
                        var data=$(fn).html();
                        refresh_section();
                        if(data=="Click to edit description")
                            data="";
                        $(edit).show();
                        $(fn).hide();
                        $(sec).val(data);
                        $(".save").click(function(){
                                data=$(sec).val();
                                update_info(type,data,fn);
                        });
                        $(".cancel").click(function(){
                                refresh_section();
                        });
                }
                function edit_date()
                {
                        var day,month,year,value;
                        refresh_info();
                        $("#dob").hide();
                        $("#dob_edit").show();
                        $(".save").click(function(){
                                day=$("#dob_day option:selected").val();
                                month=$("#dob_month option:selected").val();
                                year=$("#dob_year option:selected").val();
                                value=year+"-"+month+"-"+day;
                                if(day=="--"||month=="--"||year=="--")
                                    value="";
                                update_info("dob",value,"#dob");
                        });
                        $(".cancel").click(function(){
                                refresh_info();
                        });
                }

                $(document).ready(function(){
                        $(".file_upload").hide();
                        refresh_info();
                        refresh_section();
                        document.getElementById("add_title").defaultSelected = true;
                        document.getElementById("male").defaultSelected = true;
                        document.getElementById("single").defaultSelected = true;
                        var i;
                        for(i=2010;i>=1900;i--)
                                $("#dob_year").append("<option value='"+i +"'>"+i +"</option>");
                        for(i=1;i<=31;i++)
                        {
                                var option="<option value='";
                                if(i<10)
                                    option+="0";
                                option+=i+"'>"+i +"</option>";
                                $("#dob_day").append(option);
                        }
                        new AjaxUpload('upload', {
                                action: 'addphoto.php',
                                name: 'myphoto',
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
                                        window.location.reload();
                                }
                        });
                        $("#remove").click(function(){
                                update_info("profile_pic","0","");
                                window.location.reload();
                        });
                        $("#preview").click(function(){
                                window.location="preview";
                        });
                        $("#share span").click(function(){
                                update_section("sharing","");
                        });
                        $("#first_name,#last_name,#info td,.section p").mouseover(function(){
                                $(this).css("background-color", "#ffffdd");
                        });
                        $("#first_name,#last_name,#info td,.section p").mouseout(function(){
                                $(this).css("background-color", "white");
                        });
                        
                        $("#personal_info,#section_view").click(function(){
                                refresh_section();
                        });
                        $(".section,#section_view").click(function(){
                                refresh_info();
                        });

                        $(".fields").click(function(){
                                var id=$(this).attr("id");
                                edit_info(id);
                        });
                        $("#dob").click(function(){
                                edit_date();
                        });
                        $(".section").mouseover(function(){
                                var id=$(this).attr("id");
                                $("p").click(function(){
                                        edit_section(id);
                                });
                        });
                        $(".add_new").click(function(){
                                var id=$(this).attr("id");
                                var section=id.substr(4);
                                update_section(section,"1");
                        });
                        $(".sec_views").click(function(){
                                var id=$(this).attr("id");
                                var section=id.substr(4);
                                update_section(section,"0");
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
		<div id="resume_body">
                        <div id="personal_info">
                                <div id="profile_pic" align="center">
                                        <span><img src="files/<?echo ($data['profile_pic']=="0")?"default.jpg":$user.".jpg";?>"></span>
                                        <p><span id="upload" style="cursor: pointer;">+ Upload</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="remove" style="cursor: pointer;">- Remove</span></p>
                                        <p id="response" style="color: red;"></p>
                                </div>
                                <div id="info">
                                        <div class="name">
                                                <span class="fields" id="first_name"><?echo $data['first_name'];?></span>
                                                <span class="info_edit" id="first_name_edit">
                                                    <input id="edit_first_name" type="text">
                                                    <button class="save">save</button><button class="cancel">cancel</button>
                                                </span>
                                                &nbsp;
                                                <span class="fields" id="last_name"><?echo $data['last_name'];?></span>
                                                <span class="info_edit" id="last_name_edit">
                                                    <input id="edit_last_name" type="text">
                                                    <button class="save">save</button><button class="cancel">cancel</button>
                                                </span>
                                        </div>
                                        <table>
                                            <tr><td><p class="fields" id="gender"><?echo $data['gender']==NULL?'+ add gender':($data['gender']=='M'?'Male':'Female');?></p>
                                                <span class="info_edit" id="gender_edit">
                                                    <select id="add_gender">
                                                        <option>--</option>
                                                        <option selected id="male">Male</option>
                                                        <option id="female">Female</option>
                                                    </select><br>
                                                    <button class="save">save</button><button class="cancel">cancel</button>
                                                </span></td>
                                                <td><p id="dob"><?echo $data['dob']==NULL?'+ add date of birth':date('d M Y',strtotime($data['dob']));?></p>
                                                <span class="info_edit" id="dob_edit">
                                                    <select id="dob_day">
                                                            <option>--</option>
                                                    </select>
                                                    <select id="dob_month">
                                                            <option value="01">Jan</option>
                                                            <option value="02">Feb</option>
                                                            <option value="03">Mar</option>
                                                            <option value="04">Apr</option>
                                                            <option value="05">May</option>
                                                            <option value="06">Jun</option>
                                                            <option value="07">Jul</option>
                                                            <option value="08">Aug</option>
                                                            <option value="09">Sep</option>
                                                            <option value="10">Oct</option>
                                                            <option value="11">Nov</option>
                                                            <option value="12">Dec</option>
                                                            <option>--</option>
                                                    </select>
                                                    <select id="dob_year">
                                                            <option>--</option>
                                                    </select><br>
                                                    <button class="save">save</button><button class="cancel">cancel</button>
                                                </span></td>
                                                <td><p class="fields" id="marital_status"><?echo $data['marital_status']==NULL?'+ add marital status':($data['marital_status']=='S'?'Single':'Married');?></p>
                                                <span class="info_edit" id="marital_status_edit">
                                                    <select id="add_marital_status">
                                                        <option>--</option>
                                                        <option selected id="single">Single</option>
                                                        <option id="married">Married</option>
                                                    </select><br>
                                                    <button class="save">save</button><button class="cancel">cancel</button>
                                                </span></td></tr>
                                        
                                            <tr><td><p class="fields" id="phone"><?echo $data['phone']==NULL?'+ add phone':$data['phone'];?></p>
                                                <span class="info_edit" id="phone_edit">
                                                    <input id="edit_phone" type="text">
                                                    <button class="save">save</button><button class="cancel">cancel</button>
                                                </span></td>
                                                <td><p class="fields" id="email"><?echo $data['email']==NULL?'+ add email':$data['email'];?></p>
                                                <span class="info_edit" id="email_edit">
                                                    <input id="edit_email" type="text">
                                                    <button class="save">save</button><button class="cancel">cancel</button>
                                                </span></td></tr>
                                        
                                            <tr><td><p class="fields" id="mobile"><?echo $data['mobile']==NULL?'+ add mobile':$data['mobile'];?></p>
                                                <span class="info_edit" id="mobile_edit">
                                                    <input id="edit_mobile" type="text">
                                                    <button class="save">save</button><button class="cancel">cancel</button>
                                                </span></td>
                                                <td><p class="fields" id="website"><?echo $data['website']==NULL?'+ add website/blog URL':$data['website'];?></p>
                                                <span class="info_edit" id="website_edit">
                                                    <input id="edit_website" type="text">
                                                    <button class="save">save</button><button class="cancel">cancel</button>
                                                </span></td></tr>
                                        
                                            <tr><td><p class="fields" id="address"><?echo $data['address']==NULL?'+ add address':$data['address'];?></p>
                                                <span class="info_edit" id="address_edit">
                                                    <input id="edit_address" type="text">
                                                    <button class="save">save</button><button class="cancel">cancel</button>
                                                </span></td></tr>
                                        </table>
                                </div>
                        </div>
                        <table>
                            <tr class="section" id="summary" style="display: <?echo ($sections['summary']!="0")?"block":"none";?>;">
                                <td class="title"><h3>Summary</h3></td>
                                <td><p><?echo ($data['summary']!=NULL)?$data['summary']:"Click to edit description";?></p>
                                    <div class="summary_edit">
                                        <textarea id="edit_summary" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="skills" style="display: <?echo ($sections['skills']!="0")?"block":"none";?>;">
                                <td class="title"><h3>Skills</h3></td>
                                <td><p><?echo ($data['skills']!=NULL)?$data['skills']:"Click to edit description";?></p>
                                    <div class="skills_edit">
                                        <textarea id="edit_skills" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="experience" style="display: <?echo ($sections['experience']!="0")?"block":"none";?>;">
                                <td class="title"><h3>Experience</h3></td>
                                <td><p><?echo ($data['experience']!=NULL)?$data['experience']:"Click to edit description";?></p>
                                    <div class="experience_edit">
                                        <textarea id="edit_experience" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="studies" style="display: <?echo ($sections['studies']!="0")?"block":"none";?>;">
                                <td class="title"><h3>Studies</h3></td>
                                <td><p><?echo ($data['studies']!=NULL)?$data['studies']:"Click to edit description";?></p>
                                    <div class="studies_edit">
                                        <textarea id="edit_studies" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="interests" style="display: <?echo ($sections['interests']!="0")?"block":"none";?>;">
                                <td class="title"><h3>Interests</h3></td>
                                <td><p><?echo ($data['interests']!=NULL)?$data['interests']:"Click to edit description";?></p>
                                    <div class="interests_edit">
                                        <textarea id="edit_interests" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="hobbies" style="display: <?echo ($sections['hobbies']!="0")?"block":"none";?>;">
                                <td class="title"><h3>Hobbies</h3></td>
                                <td><p><?echo ($data['hobbies']!=NULL)?$data['hobbies']:"Click to edit description";?></p>
                                    <div class="hobbies_edit">
                                        <textarea id="edit_hobbies" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="languages" style="display: <?echo ($sections['languages']!="0")?"block":"none";?>;">
                                <td class="title"><h3>Languages</h3></td>
                                <td><p><?echo ($data['languages']!=NULL)?$data['languages']:"Click to edit description";?></p>
                                    <div class="languages_edit">
                                        <textarea id="edit_languages" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="certificates" style="display: <?echo ($sections['certificates']!="0")?"block":"none";?>;">
                                <td class="title"><h3>Certificates</h3></td>
                                <td><p><?echo ($data['certificates']!=NULL)?$data['certificates']:"Click to edit description";?></p>
                                    <div class="certificates_edit">
                                        <textarea id="edit_certificates" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="publications" style="display: <?echo ($sections['publications']!="0")?"block":"none";?>;">
                                <td class="title"><h3>Publications</h3></td>
                                <td><p><?echo ($data['publications']!=NULL)?$data['publications']:"Click to edit description";?></p>
                                    <div class="publications_edit">
                                        <textarea id="edit_publications" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="awards" style="display: <?echo ($sections['awards']!="0")?"block":"none";?>;">
                                <td class="title"><h3>Awards</h3></td>
                                <td><p><?echo ($data['awards']!=NULL)?$data['awards']:"Click to edit description";?></p>
                                    <div class="awards_edit">
                                        <textarea id="edit_awards" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                        </table>
		</div>
            <div id="preview">Preview</div>
            <div id="section_view">
                <p class="sec_views" id="sec_summary" style="display: <?echo ($sections['summary']!="0")?"block":"none";?>;">- Summary</p>
                <p class="sec_views" id="sec_skills" style="display: <?echo ($sections['skills']!="0")?"block":"none";?>;">- Skills</p>
                <p class="sec_views" id="sec_experience" style="display: <?echo ($sections['experience']!="0")?"block":"none";?>;">- Experience</p>
                <p class="sec_views" id="sec_studies" style="display: <?echo ($sections['studies']!="0")?"block":"none";?>;">- Studies</p>
                <p class="sec_views" id="sec_interests" style="display: <?echo ($sections['interests']!="0")?"block":"none";?>;">- Interests</p>
                <p class="sec_views" id="sec_hobbies" style="display: <?echo ($sections['hobbies']!="0")?"block":"none";?>;">- Hobbies</p>
                <p class="sec_views" id="sec_languages" style="display: <?echo ($sections['languages']!="0")?"block":"none";?>;">- Languages</p>
                <p class="sec_views" id="sec_certificates" style="display: <?echo ($sections['certificates']!="0")?"block":"none";?>;">- Certificates</p>
                <p class="sec_views" id="sec_publications" style="display: <?echo ($sections['publications']!="0")?"block":"none";?>;">- Publications</p>
                <p class="sec_views" id="sec_awards" style="display: <?echo ($sections['awards']!="0")?"block":"none";?>;">- Awards</p>
                <select name="add_section">
                    <option selected id="add_title">+ add Section</option>
                    <option class="add_new" id="add_summary" style="display: <?echo ($sections['summary']=="0")?"block":"none";?>;">Summary</option>
                    <option class="add_new" id="add_skills" style="display: <?echo ($sections['skills']=="0")?"block":"none";?>;">Skills</option>
                    <option class="add_new" id="add_experience" style="display: <?echo ($sections['experience']=="0")?"block":"none";?>;">Experience</option>
                    <option class="add_new" id="add_studies" style="display: <?echo ($sections['studies']=="0")?"block":"none";?>;">Studies</option>
                    <option class="add_new" id="add_interests" style="display: <?echo ($sections['interests']=="0")?"block":"none";?>;">Interests</option>
                    <option class="add_new" id="add_hobbies" style="display: <?echo ($sections['hobbies']=="0")?"block":"none";?>;">Hobbies</option>
                    <option class="add_new" id="add_languages" style="display: <?echo ($sections['languages']=="0")?"block":"none";?>;">Languages</option>
                    <option class="add_new" id="add_certificates" style="display: <?echo ($sections['certificates']=="0")?"block":"none";?>;">Certificates</option>
                    <option class="add_new" id="add_publications" style="display: <?echo ($sections['publications']=="0")?"block":"none";?>;">Publications</option>
                    <option class="add_new" id="add_awards" style="display: <?echo ($sections['awards']=="0")?"block":"none";?>;">Awards</option>
                </select>
            </div>
            <div id="share">Your Resume is : <span><?echo ($sections['sharing']=='1')?"Public":"Private";?></span><br>
                <a href="resume?id=<?echo $user;?>">View your public resume</a>
            </div>
	</div>

</body>

</html>
