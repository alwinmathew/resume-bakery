<?php
        include 'session.php';
        include 'logininfo.php';
        $area_of_work=$_GET['resume'];
        $sql="SELECT * FROM personalinfo WHERE username='$user' AND area_of_work='$area_of_work'";
        $result=mysql_query($sql);
        $data=mysql_fetch_array($result);

        $sql="SELECT * FROM sections WHERE username='$user' AND area_of_work='$area_of_work'";
        $result=mysql_query($sql);
        $sections=mysql_fetch_array($result);
        $id=$data['template_id'];
        $sql="SELECT * FROM templates WHERE template_key='$id'";
        $result=mysql_query($sql);
        $templates=mysql_fetch_array($result);
        if(file_exists("tmp/$user"."_header.jpg"))
                unlink("tmp/$user"."_header.jpg");
        $width=(int)$templates['margin_width'];
        $height=297-(2*$width);
        $sql="SELECT template_name,template_key FROM templates WHERE users='$user'";
        $result=mysql_query($sql);
        
?>

<html>

<head>
        <title>preview - Resume Bakery</title>
</head>

<body>

	<div id="preview_page">
            <div id="preview_header">
			<div id="preview_sideline">Welcome <b><?echo $user;?></b>&nbsp;|&nbsp;<a href="logout.php" title="Log out">Logout</a></div>
			<div id="preview_title">Resume-Bakery</div>
			<div id="preview_tagline">easy resume management</div>
            </div>
            <div id="preview_body" style="background-color: <?=$templates['background_color']?>;padding-top: <?=$templates['margin_width']?>;padding-bottom: <?=$templates['margin_width']?>;">
                <div id="preview_resume_body" style="margin-left: <?=$templates['margin_width']?>;margin-right: <?=$templates['margin_width']?>;min-height: <?=$height?>mm;border: <?=$templates['border_width']?>px solid <?=$templates['margin_color']?>;">
                        <?
                            if($templates['header_image']!="0")
                            {
                                    echo '<img id="preview_header_image" src="files/'.$templates['template_key'].'_header.jpg"';
                                    if($templates['margin_width']<8)
                                            echo ' style="margin-right: '.(8-$templates['margin_width']).'mm;"';
                                    echo '>';
                            }
                        ?>
                        <div id="preview_personal_info" style="margin-top: <?=($templates['header_image']!="0")?60+10:"0"?>px;">
                                <div id="preview_profile_pic" align="center">
                                        <?echo ($data['profile_pic']!="0")?("<img src='files/$user-$area_of_work.jpg'>"):'';?>
                                </div>
                                <div id="preview_info" align="left" style="font-family: <?=$templates['font_family']?>;">
                                        <div class="preview_name">
                                                <span id="preview_first_name"><?echo $data['first_name']?></span>&nbsp;&nbsp;
                                                <span id="preview_last_name"><?echo $data['last_name']?><br></span>
                                                <?
                                                    if($data['gender']!=NULL)
                                                        echo '<span id="preview_gender">'.(($data['gender']=='M')?'Male':'Female').'</span>';
                                                    echo (($data['gender']==NULL)||($data['dob']==NULL&&$data['marital_status']==NULL))?'':'<span id="preview_g">, </span>';
                                                    echo ($data['dob']!=NULL)?('<span id="preview_dob">'.$data['dob'].'</span>'):'';
                                                    echo ($data['dob']==NULL||$data['marital_status']==NULL)?'':'<span id="preview_d">, </span>';
                                                    if($data['marital_status']!=NULL)
                                                        echo '<span id="preview_marital_status">'.(($data['marital_status']=='S')?'Single':'Married').'</span>';
                                                ?>
                                        </div>
                                        <table>
                                        <tr><?echo ($data['mobile']!=NULL)?'<td id="preview_mobile">Mobile: '.$data['mobile'].'</td>':'';
                                            echo ($data['email']!=NULL)?'<td id="preview_email">Email: '.$data['email'].'</td>':'';?></tr>

                                        <tr><?echo ($data['phone']!=NULL)?'<td id="preview_phone">Phone: '.$data['phone'].'</td>':'';
                                            echo ($data['website']!=NULL)?'<td id="preview_website">Website/blog: '.$data['website'].'</td>':'';?></tr>
                                        </table>
                                        <?echo ($data['address']!=NULL)?'<p id="preview_address">'.$data['address'].'</p>':'';?>
                                </div>
                        </div>
                        <table>
                                <tr class="preview_section" id="preview_summary" style="display: <?echo ($sections['summary']!="0")?"block":"none";?>;">
                                        <td class="preview_title"><h3>Summary</h3></td>
                                        <td class="preview_data"><p style="font-size: <?=$templates['font_size']?>px;font-family: <?=$templates['font_family']?>;"><?echo $data['summary'];?></p></td>
                                </tr>
                                <tr class="preview_section" id="preview_skills" style="display: <?echo ($sections['skills']!="0")?"block":"none";?>;">
                                        <td class="preview_title"><h3>Skills</h3></td>
                                        <td class="preview_data"><p style="font-size: <?=$templates['font_size']?>px;font-family: <?=$templates['font_family']?>;"><?echo $data['skills'];?></p></td>
                                </tr>
                                <tr class="preview_section" id="preview_experience" style="display: <?echo ($sections['experience']!="0")?"block":"none";?>;">
                                        <td class="preview_title"><h3>Experience</h3></td>
                                        <td class="preview_data"><p style="font-size: <?=$templates['font_size']?>px;font-family: <?=$templates['font_family']?>;"><?echo $data['experience'];?></p></td>
                                </tr>
                                <tr class="preview_section" id="preview_studies" style="display: <?echo ($sections['studies']!="0")?"block":"none";?>;">
                                        <td class="preview_title"><h3>Studies</h3></td>
                                        <td class="preview_data"><p style="font-size: <?=$templates['font_size']?>px;font-family: <?=$templates['font_family']?>;"><?echo $data['studies'];?></p></td>
                                </tr>
                                <tr class="preview_section" id="preview_interests" style="display: <?echo ($sections['interests']!="0")?"block":"none";?>;">
                                        <td class="preview_title"><h3>Interests</h3></td>
                                        <td class="preview_data"><p style="font-size: <?=$templates['font_size']?>px;font-family: <?=$templates['font_family']?>;"><?echo $data['interests'];?></p></td>
                                </tr>
                                <tr class="preview_section" id="preview_hobbies" style="display: <?echo ($sections['hobbies']!="0")?"block":"none";?>;">
                                        <td class="preview_title"><h3>Hobbies</h3></td>
                                        <td class="preview_data"><p style="font-size: <?=$templates['font_size']?>px;font-family: <?=$templates['font_family']?>;"><?echo $data['hobbies'];?></p></td>
                                </tr>
                                <tr class="preview_section" id="preview_languages" style="display: <?echo ($sections['languages']!="0")?"block":"none";?>;">
                                        <td class="preview_title"><h3>Languages</h3></td>
                                        <td class="preview_data"><p style="font-size: <?=$templates['font_size']?>px;font-family: <?=$templates['font_family']?>;"><?echo $data['languages'];?></p></td>
                                </tr>
                                <tr class="preview_section" id="preview_certificates" style="display: <?echo ($sections['certificates']!="0")?"block":"none";?>;">
                                        <td class="preview_title"><h3>Certificates</h3></td>
                                        <td class="preview_data"><p style="font-size: <?=$templates['font_size']?>px;font-family: <?=$templates['font_family']?>;"><?echo $data['certificates'];?></p></td>
                                </tr>
                                <tr class="preview_section" id="preview_publications" style="display: <?echo ($sections['publications']!="0")?"block":"none";?>;">
                                        <td class="preview_title"><h3>Publications</h3></td>
                                        <td class="preview_data"><p style="font-size: <?=$templates['font_size']?>px;font-family: <?=$templates['font_family']?>;"><?echo $data['publications'];?></p></td>
                                </tr>
                                <tr class="preview_section" id="preview_awards" style="display: <?echo ($sections['awards']!="0")?"block":"none";?>;">
                                        <td class="preview_title"><h3>Awards</h3></td>
                                        <td class="preview_data"><p style="font-size: <?=$templates['font_size']?>px;font-family: <?=$templates['font_family']?>;"><?echo $data['awards'];?></p></td>
                                </tr>
                        </table>
		</div>
            
	</div>
        <div id="preview_rightbar">
            <div id="preview_edit">Edit Resume <img src="images/edit.jpg"/></div><hr>
            <div id="preview_pdf"><img src="images/redball.gif"><span style="color:red; font-size: 14px;"><b> PUBLISH</b> </span><br><br><a href="saveaspdf?resume=<?=$area_of_work?>">Generate PDF</a><img src="images/pdf.jpg" style="vertical-align: bottom;"></div><hr><div style="padding: 10px"><img src="images/redball.gif"/><span style="color:red; font-size: 14px;font-family: Trebuchet MS, Helvetica, sans-serif;"><b>&nbsp;TEMPLATE</b> </span><br><br><div align="center"><img src="images/resume.jpeg"></div></div>
            <div id="preview_new_template" style="text-align: center;"><a>Create new template</a></div>
            <div class="preview_share_temp" id="preview_add_template"><img src="images/green.gif"><span style="vertical-align: top;"> Add shared template</span></div>
            <div class="preview_share_temp" id="preview_add_share" style="display: none;">Enter template key: <input id="preview_shared_key" type="text" size="14" maxlength="16"><button id="preview_addshare_ok">OK</button></div>

            <div id="preview_design_resume" style="display: <?echo ($templates['owner']==$user)?"block":"none";?>;">Design your template</div>
            <div class="preview_templates">Choose your template :
                <select id="preview_user_templates">
                        <option value="default">&lt;default&gt;</option>
                        <?
                            while($user_templates=mysql_fetch_array($result))
                            {
                                    echo '<option'.(($user_templates['template_key']==$id)?' selected ':'').' value="'.$user_templates['template_key'].'">'.$user_templates['template_name'].'</option>';
                            }
                        ?>
                </select>
            </div>
            <?
                if($templates['template_key']!="default")
                    echo   '<div id="preview_share_template">Share this template</div>
                            <div id="preview_remove_template">Remove this template</div>
                            <div id="share_key" style="display: none;color: maroon;font-size: 13px;padding: 10px;">Template Key# : <br><p style="font-weight: bold;text-align: center;">'.$templates['template_key'].'</p>Pass on this key to share this template with your friends.<div align="center"><img id="hide_share" style="cursor: pointer;" src="images/hide_button.png"></div></div>';
            ?>
        </div>
        </div>
</body>

</html>
