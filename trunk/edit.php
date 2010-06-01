<?
        include 'fetchdatabase.php';
        $sql="SELECT * FROM sections WHERE username='$user'";
        $result=mysql_query($sql);
        $sections=mysql_fetch_array($result);
?>

<html>

<head>
        <title>edit - Resume Bakery</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css" />
        <link rel="stylesheet" type="text/css" href="editmystyle.css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript">
                function update_info(type,value,fn)
                {
                        $.ajax({
                                type: 'POST',
                                url: "updateinfo.php",
                                data: "infotype=" +type +"&infovalue=" +value,
                                success: function(){
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
                                success: function(){
                                        var section="#"+type;
                                        var add="#add_"+type;
                                        var sec="#sec_"+type;
                                        if(value=="1")
                                        {
                                                $(section).show();
                                                $(add).hide();
                                                $(sec).show();
                                        }
                                        else
                                        {
                                                $(section).hide();
                                                $(add).show();
                                                $(sec).hide();
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
                        $("#file_upload").hide();
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
                        $("#profile_pic p").click(function(){
                                refresh_info();
                                $(this).hide();
                                $("#file_upload").show();
                        });
                        $("#preview").click(function(){
                                window.location.replace("preview.php");
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
                        
                        
                        <?
                        function section_hide($type)
                        {
                                echo '$("#'.$type.'").hide();';
                                echo '$("#sec_'.$type.'").hide();';
                                echo '$("#add_'.$type.'").show();';
                        }
                        function section_show($type)
                        {
                                echo '$("#'.$type.'").show();';
                                echo '$("#sec_'.$type.'").show();';
                                echo '$("#add_'.$type.'").hide();';
                        }
                        if($data['summary']==NULL)
                            echo '$("#summary p").html("Click to edit description");';
                        if($data['skills']==NULL)
                            echo '$("#skills p").html("Click to edit description");';
                        if($data['experience']==NULL)
                            echo '$("#experience p").html("Click to edit description");';
                        if($data['studies']==NULL)
                            echo '$("#studies p").html("Click to edit description");';
                        if($data['interests']==NULL)
                            echo '$("#interests p").html("Click to edit description");';
                        if($data['hobbies']==NULL)
                            echo '$("#hobbies p").html("Click to edit description");';
                        if($data['languages']==NULL)
                            echo '$("#languages p").html("Click to edit description");';
                        if($data['certificates']==NULL)
                            echo '$("#certificates p").html("Click to edit description");';
                        if($data['publications']==NULL)
                            echo '$("#publications p").html("Click to edit description");';
                        if($data['awards']==NULL)
                            echo '$("#awards p").html("Click to edit description");';

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
			<div id="sideline"><a href="logout.php" title="Log out">Logout</a></div>
			<div id="title">Resume-Bakery</div>
                        <div id="tagline">easy resume management</div>
		</div>
		<div id="body">
                        <div id="personal_info">
                                <div id="profile_pic">
                                        <img src="<?echo $data['profile_pic']?>" height="120" width="120">
                                        <p align="center" style="cursor: pointer;"> Upload photo</p>
                                        <form id="file_upload" action="addphoto.php" method="post" enctype="multipart/form-data" style="margin-top: 5px; background-color: white; color: red;">
                                            <input id="pic" name="myphoto" type="file" size="3" style="margin-bottom: 3px;">
                                            <input value="save" type="submit"><button id="cancel">cancel</button>
                                        </form>
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
                                                        <option id="male">Male</option>
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
                                                        <option id="single">Single</option>
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
                            <tr class="section" id="summary">
                                <td class="title"><h3>Summary</h3></td>
                                <td><p><?echo $data['summary'];?></p>
                                    <div class="summary_edit">
                                        <textarea id="edit_summary" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="skills">
                                <td class="title"><h3>Skills</h3></td>
                                <td><p><?echo $data['skills'];?></p>
                                    <div class="skills_edit">
                                        <textarea id="edit_skills" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="experience">
                                <td class="title"><h3>Experience</h3></td>
                                <td><p><?echo $data['experience'];?></p>
                                    <div class="experience_edit">
                                        <textarea id="edit_experience" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="studies">
                                <td class="title"><h3>Studies</h3></td>
                                <td><p><?echo $data['studies'];?></p>
                                    <div class="studies_edit">
                                        <textarea id="edit_studies" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="interests">
                                <td class="title"><h3>Interests</h3></td>
                                <td><p><?echo $data['interests'];?></p>
                                    <div class="interests_edit">
                                        <textarea id="edit_interests" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="hobbies">
                                <td class="title"><h3>Hobbies</h3></td>
                                <td><p><?echo $data['hobbies'];?></p>
                                    <div class="hobbies_edit">
                                        <textarea id="edit_hobbies" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="languages">
                                <td class="title"><h3>Languages</h3></td>
                                <td><p><?echo $data['languages'];?></p>
                                    <div class="languages_edit">
                                        <textarea id="edit_languages" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="certificates">
                                <td class="title"><h3>Certificates</h3></td>
                                <td><p><?echo $data['certificates'];?></p>
                                    <div class="certificates_edit">
                                        <textarea id="edit_certificates" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="publications">
                                <td class="title"><h3>Publications</h3></td>
                                <td><p><?echo $data['publications'];?></p>
                                    <div class="publications_edit">
                                        <textarea id="edit_publications" cols="60" rows="8"></textarea>
                                        <button class="save">save</button><button class="cancel">cancel</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="section" id="awards">
                                <td class="title"><h3>Awards</h3></td>
                                <td><p><?echo $data['awards'];?></p>
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
                <p class="sec_views" id="sec_summary">- Summary</p>
                <p class="sec_views" id="sec_skills">- Skills</p>
                <p class="sec_views" id="sec_experience">- Experience</p>
                <p class="sec_views" id="sec_studies">- Studies</p>
                <p class="sec_views" id="sec_interests">- Interests</p>
                <p class="sec_views" id="sec_hobbies">- Hobbies</p>
                <p class="sec_views" id="sec_languages">- Languages</p>
                <p class="sec_views" id="sec_certificates">- Certificates</p>
                <p class="sec_views" id="sec_publications">- Publications</p>
                <p class="sec_views" id="sec_awards">- Awards</p>
                <select name="add_section">
                    <option id="add_title">add Section</option>
                    <option class="add_new" id="add_summary">Summary</option>
                    <option class="add_new" id="add_skills">Skills</option>
                    <option class="add_new" id="add_experience">Experience</option>
                    <option class="add_new" id="add_studies">Studies</option>
                    <option class="add_new" id="add_interests">Interests</option>
                    <option class="add_new" id="add_hobbies">Hobbies</option>
                    <option class="add_new" id="add_languages">Languages</option>
                    <option class="add_new" id="add_certificates">Certificates</option>
                    <option class="add_new" id="add_publications">Publications</option>
                    <option class="add_new" id="add_awards">Awards</option>
                </select>
            </div>
	</div>

</body>

</html>
