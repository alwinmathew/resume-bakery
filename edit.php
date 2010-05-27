<?
        include 'fetchdatabase.php';
        $sql="SELECT * FROM sections WHERE username='$user'";
        $result=mysql_query($sql);
        $sections=mysql_fetch_array($result);
?>

<html>

<head>
        <link rel="stylesheet" type="text/css" href="stylesheet.css" />
        <link rel="stylesheet" type="text/css" href="editmystyle.css" />
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="js/ajaxfileupload.js"></script>
        <script type="text/javascript">
                function update_section(type,value)
                {
                        $.ajax({
                                type: 'POST',
                                url: "updatesection.php",
                                data: "sectiontype=" +type +"&sectionvalue=" +value,
                                success: function(){
                                        location.reload();
                                }
                        });
                }

                $(document).ready(function(){
                        $("#file_upload").hide();
                        document.getElementById("add_title").defaultSelected = true;
                        $("#profile_pic p").click(function(){
                                $(this).hide();
                                $("#file_upload").show();
                        });
                        $("#preview").click(function(){
                                window.location.replace("preview.php");
                        });
                        $("#first_name,#last_name,#gender,#dob,#marital_status,#phone,#email,#mobile,#website,#address,.section p").mouseover(function(){
                                $(this).css("background-color", "#ffffdd");
                        });
                        $("#first_name,#last_name,#gender,#dob,#marital_status,#phone,#email,#mobile,#website,#address,.section p").mouseout(function(){
                                $(this).css("background-color", "white");
                        });
                        $("#first_name").click(function(){
                                var f_name=$("#first_name").val();
                                $(this).html(f_name);
                                
                        });
                        $("#add_summary").click(function(){
                                update_section("summary","1");
                        });
                        $("#add_skills").click(function(){
                                update_section("skills","1");
                        });
                        $("#add_experience").click(function(){
                                update_section("experience","1");
                        });
                        $("#add_studies").click(function(){
                                update_section("studies","1");
                        });
                        $("#add_interests").click(function(){
                                update_section("interests","1");
                        });
                        $("#add_hobbies").click(function(){
                                update_section("hobbies","1");
                        });
                        $("#add_languages").click(function(){
                                update_section("languages","1");
                        });
                        $("#add_certificates").click(function(){
                                update_section("certificates","1");
                        });
                        $("#add_publications").click(function(){
                                update_section("publications","1");
                        });
                        $("#add_awards").click(function(){
                                update_section("awards","1");
                        });
                        $("#sec_summary").click(function(){
                                update_section("summary","0");
                        });
                        $("#sec_skills").click(function(){
                                update_section("skills","0");
                        });
                        $("#sec_experience").click(function(){
                                update_section("experience","0");
                        });
                        $("#sec_studies").click(function(){
                                update_section("studies","0");
                        });
                        $("#sec_interests").click(function(){
                                update_section("interests","0");
                        });
                        $("#sec_hobbies").click(function(){
                                update_section("hobbies","0");
                        });
                        $("#sec_languages").click(function(){
                                update_section("languages","0");
                        });
                        $("#sec_certificates").click(function(){
                                update_section("certificates","0");
                        });
                        $("#sec_publications").click(function(){
                                update_section("publications","0");
                        });
                        $("#sec_awards").click(function(){
                                update_section("awards","0");
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
			<div id="tagline">Enter a tagline here</div>
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
                                                <span id="first_name"><?echo $data['first_name']?></span>
                                                <span id="last_name">&nbsp;<?echo $data['last_name']?></span>
                                        </div>
                                        <table>
                                        <tr><td id="gender" onclick=""><?echo $data['gender']==NULL?'+ add gender':$data['gender']=='M'?'Male':'Female';?></td>
                                            <td id="dob"><?echo $data['dob']==NULL?'+ add date of birth':$data['dob'];?></td>
                                            <td id="marital_status"><?echo $data['marital_status']==NULL?'+ add marital status':$data['marital_status']=='S'?'Single':'Married';?></td></tr>
                                        
                                        <tr><td id="phone"><?echo $data['phone']==NULL?'+ add phone':$data['phone'];?></td>
                                            <td id="email"><?echo $data['email']==NULL?'+ add email':$data['email'];?></td></tr>
                                        
                                        <tr><td id="mobile"><?echo $data['mobile']==NULL?'+ add mobile':$data['mobile'];?></td>
                                            <td id="website"><?echo $data['website']==NULL?'+ add website/blog URL':$data['website'];?></td></tr>
                                        
                                        <tr id="address"><td><?echo $data['address']==NULL?'+ add address':$data['address'];?></td></tr>
                                        </table>
                                </div>
                        </div>
                        <table>
                            <tr class="section" id="summary">
                                <td class="title"><h3>Summary</h3></td>
                                <td><p><?echo $data['summary'];?></p></td>
                            </tr>
                            <tr class="section" id="skills">
                                <td class="title"><h3>Skills</h3></td>
                                <td><p><?echo $data['skills'];?></p></td>
                            </tr>
                            <tr class="section" id="experience">
                                <td class="title"><h3>Experience</h3></td>
                                <td><p><?echo $data['experience'];?></p></td>
                            </tr>
                            <tr class="section" id="studies">
                                <td class="title"><h3>Studies</h3></td>
                                <td><p><?echo $data['studies'];?></p></td>
                            </tr>
                            <tr class="section" id="interests">
                                <td class="title"><h3>Interests</h3></td>
                                <td><p><?echo $data['interests'];?></p></td>
                            </tr>
                            <tr class="section" id="hobbies">
                                <td class="title"><h3>Hobbies</h3></td>
                                <td><p><?echo $data['hobbies'];?></p></td>
                            </tr>
                            <tr class="section" id="languages">
                                <td class="title"><h3>Languages</h3></td>
                                <td><p><?echo $data['languages'];?></p></td>
                            </tr>
                            <tr class="section" id="certificates">
                                <td class="title"><h3>Certificates</h3></td>
                                <td><p><?echo $data['certificates'];?></p></td>
                            </tr>
                            <tr class="section" id="publications">
                                <td class="title"><h3>Publications</h3></td>
                                <td><p><?echo $data['publications'];?></p></td>
                            </tr>
                            <tr class="section" id="awards">
                                <td class="title"><h3>Awards</h3></td>
                                <td><p><?echo $data['awards'];?></p></td>
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
