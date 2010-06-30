<?php
        $user=$_GET['id'];
        if($user=='')
            header("location: .");
        include 'fetchdatabase.php';
        $sql="SELECT * FROM sections WHERE username='$user' AND area_of_work='general'";
        $result=mysql_query($sql);
        $sections=mysql_fetch_array($result);
        $id=$user;
        if($sections['sharing']!='1')
        {
                include 'session.php';
                if($id!=$user)
                {
                        header("location: resume?id=$user");
                }
        }
        $id=$data['template_id'];
        $sql="SELECT * FROM templates WHERE template_key='$id'";
        $result=mysql_query($sql);
        $templates=mysql_fetch_array($result);
        $width=(int)$templates['margin_width'];
        $height=297-(2*$width);
?>

<html>

<head>
        <title>Resume Bakery - <?echo $data['first_name'].' '.$data['last_name'];?></title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
        <link rel="stylesheet" type="text/css" media="screen" href="mystyle.php"/>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript">
                function height()
                {
                        var ht=$("#container").css("height");
                        ht=ht.substring(0,ht.length-2);
                        ht=parseInt(ht);
                        ht-=31;
                        ht+="px";
                        $("#rightsidebar").css("height",ht);
                }
                $(document).ready(function(){
                        height();
                        $("#edit").click(function(){
                                window.location.replace("edit");
                        });
                });

        </script>
</head>

<body>
    <div id="page_body">
        <div id="tp">
                <div align="center">
                        <a href="#">TIPS FOR A GOOD RESUME</a>
                        <a href="#">SAMPLE RESUME</a>
                        <a href="#">ABOUT US</a>
                        <a href="#">HELP</a>
                        <br><br>
                </div>
                <img src="images/abc.png"/>&nbsp;&nbsp;&nbsp;
                <img style="vertical-align: super;" src="images/arrow.gif"/>&nbsp;&nbsp;&nbsp;&nbsp;
                <img src="images/a.png" onmouseover="this.src='images/amouse.png';" onmouseout="this.src='images/a.png';" />
                <br><br>
                <marquee style="color: brown;">Easy and Smart Resume generator. &nbsp;&nbsp;Experience it.</marquee>
        </div>


        <div id="rightsidebar" style="color: maroon;text-align: justify;">
                <?
                    if($sections['sharing']=='1')
                            echo "You are currently viewing <b>$user</b>'s public resume.";
                    else
                            echo "This is how your resume would look like if it is made public.";
                ?>
        </div>
        <div id="container" align="center">
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
                                                <?echo ($data['profile_pic']!="0")?('<img src="files/'.$user.'.jpg">'):'';?>
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
        </div>

        <div id="footer">
                Copright Reserved
	</div>
    </div>
</body>

</html>
