<?php
        include 'session.php';
        include 'fetchdatabase.php';
        $sql="SELECT * FROM sections WHERE username='$user' AND area_of_work='general'";
        $result=mysql_query($sql);
        $sections=mysql_fetch_array($result);
        $id=$data['template_id'];
        $sql="SELECT * FROM templates WHERE template_key='$id'";
        $result=mysql_query($sql);
        $templates=mysql_fetch_array($result);
        $sql="SELECT template_name,template_key FROM templates WHERE users='$user'";
        $result=mysql_query($sql);
        
?>

<html>

<head>
        <title>preview - Resume Bakery</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="mystyle.php"/>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript">
                function update_template(type)
                {
                        var id=$("#user_templates option:selected").val();
                        $.ajax({
                                type: 'POST',
                                url: "updatetemplate.php",
                                data: "type=" +type+"&value=" +id,
                                success: function(){
                                        window.location.reload();
                                }
                        });
                }
                function add_template()
                {
                        var key=$("#shared_key").val();
                        if(key!="")
                        {
                                $.ajax({
                                        type: 'POST',
                                        url: "updatetemplate.php",
                                        data: "type=add_shared&value=" +key,
                                        success: function(data){
                                                if(data=="success")
                                                        window.location.reload();
                                        }
                                });
                        }
                        $("#add_share").css("display","none");
                        $("#add_template").show();
                }
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
            <div id="resume_body">
                        <?echo ($templates['header_image']!="0")?('<img id="header_image" src="files/'.$templates['template_key'].'_header.jpg">'):'';?>
                        <div id="personal_info">
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
            <div id="edit" onclick='window.location="edit";'>Edit</div>
            <div id="pdf"><a href="saveaspdf">Save as PDF</a></div>
            <div id="new_template" onclick='window.location="design?type=new";'>Create new template</div>
            <div class="share_temp" id="add_template" onclick='$(this).hide();$("#add_share").css("display","block");'>Add shared template</div>
            <div class="share_temp" id="add_share" style="display: none;">Enter template key: <input id="shared_key" type="text" size="14" maxlength="16"><button id="addshare_ok" onclick="add_template();">OK</button></div>
            <div id="design_resume"><a href="design">Design your Resume</a></div>
            <div class="templates">Choose your Template :
                <select id="user_templates" onchange="update_template('change');">
                        <?
                            while($user_templates=mysql_fetch_array($result))
                            {
                                    echo '<option'.(($user_templates['template_key']==$id)?' selected ':'').' value="'.$user_templates['template_key'].'">'.$user_templates['template_name'].'</option>';
                            }
                        ?>
                        
                </select>
            </div>
            <div id="remove_template" onclick="update_template('remove');">Remove this template</div>
	</div>
        </div>
</body>

</html>
