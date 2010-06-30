<?
        include 'session.php';
        include 'fetchdatabase.php';
        $sql="SELECT * FROM sections WHERE username='$user'";
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
</head>

<body>

	<div id="page">
		<div id="header">
			<div id="sideline">Welcome <b><?echo $user;?></b>&nbsp;|&nbsp;<a href="logout.php" title="Log out">Logout</a></div>
                        <div id="title">Resume-Bakery</div>
                        <div id="tagline">easy resume management</div>
		</div>
		<div id="body_design">
                        <div id="control">
                                <div id="preview" onclick="load_preview();">Preview</div>
                                <h3 align="left"><?echo ($param)?"New Template":"Edit template : ".$templates['template_name'];?></h3>

                                <table>
                                    <?echo ($param)?' <tr><td class="head">Template Name</td>
                                        <td class="field"> : <input id="template_name" type="text" size="7" maxlength="32"></td>
                                    </tr>':'';?>
                                    <tr>            <td class="head" id="head_image">Header image</td>
                                    <td class="field"> : <span id="header_upload" style="cursor: pointer;text-decoration: underline;color: maroon;">Upload</span></td>
                                                        <tr><td><p id="response" style="color: red;"></p>
                                                        <span id="remove_header" class="remove" style="color: red;font-size: 11px;cursor: pointer;">- remove saved header</span>
                                                    </td>
                                    </tr>
                                    
                                    <tr><td class="head">Margin width</td>
                                        <td class="field"> : <input  id="margin_width" type="text" size="1" maxlength="2" value="<?echo ($param)?'8':(int)$templates['margin_width']?>"> mm</td>
                                    </tr>
                                    <tr>
                                        <td class="head">Margin color</td>
                                        <td class="field"> : <input id="margin_color" class="color {required:false}" size="4" maxlength="6" value="<?echo ($param)?'FFFFFF':$templates['margin_color']?>"></td>
                                    </tr>
                                    <tr><td class="head">Border width</td>
                                        <td class="field"> : <input id="border_width" type="text" size="1" maxlength="1" value="<?echo ($param)?'0':$templates['border_width']?>"> px</td>
                                    </tr>
                                    <tr>
                                        <td class="head">Background color</td>
                                        <td class="field"> : <input id="background_color" class="color {required:false}" size="4" maxlength="6" value="<?echo ($param)?'FFFFFF':$templates['background_color']?>"></td>
                                    </tr>
                                    <tr>
                                        <td class="head" id="section_font">Section font</td>
                                        <td class="field"> : <input id="font_size" type="text" size="1" maxlength="2" value="<?echo ($param)?'12':$templates['font_size']?>"> px</td></tr>
                                        <tr><td><select id="font">
                                            <option selected id="new_font" value="default">&lt;Change Font&gt;</option>
                                            <option value='Arial Black, Gadget, sans-serif' style='font-family: Arial Black, Gadget, sans-serif;'>Arial Black</option>
                                            <option value='Courier New, Courier, monospace' style='font-family: Courier New, Courier, monospace;'>Courier New</option>
                                            <option value='Lucida Console, Monaco, monospace' style='font-family: Lucida Console, Monaco, monospace;'>Lucida Console</option>
                                            <option value='Palatino Linotype, Book Antiqua, Palatino, serif' style='font-family: Palatino Linotype, Book Antiqua, Palatino, serif;'>Palatino Linotype</option>
                                            <option value='Times New Roman, Times, serif' style='font-family: Times New Roman, Times, serif;'>Times New Roman</option>
                                            <option value='Trebuchet MS, Helvetica, sans-serif' style='font-family: Trebuchet MS, Helvetica, sans-serif;'>Trebuchet MS</option>
                                        </select>
                                        </td>
                                    </tr>
                                    <?
                                    echo ($param)?
                                    '<tr><td class="head">Set template as Read-only</td>
                                         <td class="field">: <input id="read_only" checked type="checkbox" value="read"></td>
                                     </tr>':'';
                                    ?>
                                </table>
                                <div id="change" align="center"><br><br>
                                    <span id="show" style="float: left;width: 80px" title="Click to see Preview">Show <?echo ($param)?"Design":"Changes";?></span><span id="save" style="float: right;width: 80px;" title="Save Template">Save <?echo ($param)?"Design":"Changes";?></span>
                                </div>
                        </div>
                        
		</div>
	</div>
        <div id="preview_popup" style="background-color: <?=($param)?"#FFFFFF":$templates['background_color']?>;padding-top: <?=($param)?"8mm":$templates['margin_width']?>;padding-bottom: <?=($param)?"8mm":$templates['margin_width']?>;">
                <div id="design_body" style="border: <?=($param)?"0":$templates['border_width']?>px solid <?=($param)?"#FFFFFF":$templates['margin_color']?>;margin-left: <?=($param)?"8mm":$templates['margin_width']?>;margin-right: <?=($param)?"8mm":$templates['margin_width']?>;min-height: <?$width=($param)?8:(int)$templates['margin_width'];$height=297-(2*$width);echo $height;?>mm">
                        <div id="image_header">
                        <?  if(file_exists("tmp/$user"."_header.jpg"))
                            {
                                    echo '<img id="header_image" align="right" src="tmp/'.$user.'_header.jpg"';
                                    if($templates['margin_width']<8)
                                            echo ' style="margin-right: '.(8-$templates['margin_width']).'mm;"';
                                    echo '>';
                            }
                            else if(!$param)
                                    if($templates['header_image']!="0")
                                    {
                                            echo '<img id="header_image" align="right" src="files/'.$templates['template_key'].'_header.jpg"';
                                            if($templates['margin_width']<8)
                                                    echo ' style="margin-right: '.(8-$templates['margin_width']).'mm;"';
                                            echo '>';
                                    }
                        ?>
                        </div>
                        <div id="design_personal_info" style="margin-top: <?  if(file_exists("tmp/$user"."_header.jpg"))
                                    echo 60+10;
                                else if(!$param)
                                    if($templates['header_image']!="0")
                                        echo 60+10;
                                    else
                                        echo 0;
                                else
                                    echo 0;?>px;">
                                <div id="design_profile_pic" align="center">
                                        <?echo ($data['profile_pic']!="0")?('<img src="files/'.$user.'.jpg">'):'';?>
                                </div>
                                <div id="design_info" align="left" style="font-family: <?=($param)?"Trebuchet MS, Helvetica, sans-serif":$templates['font_family']?>;">
                                        <div class="design_name">
                                                <span id="first_name"><?echo $data['first_name']?></span>&nbsp;&nbsp;
                                                <span id="last_name"><?echo $data['last_name']?><br></span>
                                                <?
                                                    if($data['gender']!=NULL)
                                                        echo '<span id="design_gender">'.(($data['gender']=='M')?'Male':'Female').'</span>';
                                                    echo (($data['gender']==NULL)||($data['dob']==NULL&&$data['marital_status']==NULL))?'':'<span id="design_g">, </span>';
                                                    echo ($data['dob']!=NULL)?('<span id="design_dob">'.$data['dob'].'</span>'):'';
                                                    echo ($data['dob']==NULL||$data['marital_status']==NULL)?'':'<span id="design_d">, </span>';
                                                    if($data['marital_status']!=NULL)
                                                        echo '<span id="design_marital_status">'.(($data['marital_status']=='S')?'Single':'Married').'</span>';
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
                                <tr class="design_section" id="summary" style="display: <?echo ($sections['summary']!="0")?"block":"none";?>;">
                                        <td class="design_title"><h3>Summary</h3></td>
                                        <td class="design_data"><p style="font-size: <?=($param)?"12":$templates['font_size']?>px;font-family: <?=($param)?"Trebuchet MS, Helvetica, sans-serif":$templates['font_family']?>;"><?echo $data['summary'];?></p></td>
                                </tr>
                                <tr class="design_section" id="skills" style="display: <?echo ($sections['skills']!="0")?"block":"none";?>;">
                                        <td class="design_title"><h3>Skills</h3></td>
                                        <td class="design_data"><p style="font-size: <?=($param)?"12":$templates['font_size']?>px;font-family: <?=($param)?"Trebuchet MS, Helvetica, sans-serif":$templates['font_family']?>;"><?echo $data['skills'];?></p></td>
                                </tr>
                                <tr class="design_section" id="experience" style="display: <?echo ($sections['experience']!="0")?"block":"none";?>;">
                                        <td class="design_title"><h3>Experience</h3></td>
                                        <td class="design_data"><p style="font-size: <?=($param)?"12":$templates['font_size']?>px;font-family: <?=($param)?"Trebuchet MS, Helvetica, sans-serif":$templates['font_family']?>;"><?echo $data['experience'];?></p></td>
                                </tr>
                                <tr class="design_section" id="studies" style="display: <?echo ($sections['studies']!="0")?"block":"none";?>;">
                                        <td class="design_title"><h3>Studies</h3></td>
                                        <td class="design_data"><p style="font-size: <?=($param)?"12":$templates['font_size']?>px;font-family: <?=($param)?"Trebuchet MS, Helvetica, sans-serif":$templates['font_family']?>;"><?echo $data['studies'];?></p></td>
                                </tr>
                                <tr class="design_section" id="interests" style="display: <?echo ($sections['interests']!="0")?"block":"none";?>;">
                                        <td class="design_title"><h3>Interests</h3></td>
                                        <td class="design_data"><p style="font-size: <?=($param)?"12":$templates['font_size']?>px;font-family: <?=($param)?"Trebuchet MS, Helvetica, sans-serif":$templates['font_family']?>;"><?echo $data['interests'];?></p></td>
                                </tr>
                                <tr class="design_section" id="hobbies" style="display: <?echo ($sections['hobbies']!="0")?"block":"none";?>;">
                                        <td class="design_title"><h3>Hobbies</h3></td>
                                        <td class="design_data"><p style="font-size: <?=($param)?"12":$templates['font_size']?>px;font-family: <?=($param)?"Trebuchet MS, Helvetica, sans-serif":$templates['font_family']?>;"><?echo $data['hobbies'];?></p></td>
                                </tr>
                                <tr class="design_section" id="languages" style="display: <?echo ($sections['languages']!="0")?"block":"none";?>;">
                                        <td class="design_title"><h3>Languages</h3></td>
                                        <td class="design_data"><p style="font-size: <?=($param)?"12":$templates['font_size']?>px;font-family: <?=($param)?"Trebuchet MS, Helvetica, sans-serif":$templates['font_family']?>;"><?echo $data['languages'];?></p></td>
                                </tr>
                                <tr class="design_section" id="certificates" style="display: <?echo ($sections['certificates']!="0")?"block":"none";?>;">
                                        <td class="design_title"><h3>Certificates</h3></td>
                                        <td class="design_data"><p style="font-size: <?=($param)?"12":$templates['font_size']?>px;font-family: <?=($param)?"Trebuchet MS, Helvetica, sans-serif":$templates['font_family']?>;"><?echo $data['certificates'];?></p></td>
                                </tr>
                                <tr class="design_section" id="publications" style="display: <?echo ($sections['publications']!="0")?"block":"none";?>;">
                                        <td class="design_title"><h3>Publications</h3></td>
                                        <td class="design_data"><p style="font-size: <?=($param)?"12":$templates['font_size']?>px;font-family: <?=($param)?"Trebuchet MS, Helvetica, sans-serif":$templates['font_family']?>;"><?echo $data['publications'];?></p></td>
                                </tr>
                                <tr class="design_section" id="awards" style="display: <?echo ($sections['awards']!="0")?"block":"none";?>;">
                                        <td class="design_title"><h3>Awards</h3></td>
                                        <td class="design_data"><p style="font-size: <?=($param)?"12":$templates['font_size']?>px;font-family: <?=($param)?"Trebuchet MS, Helvetica, sans-serif":$templates['font_family']?>;"><?echo $data['awards'];?></p></td>
                                </tr>
                        </table>
                 </div>
        </div>
        <div id="design_rightbar">
                <div id="preview" onclick="load_preview();">Preview</div>
        </div>
	

</body>

</html>
