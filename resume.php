<?php
        $user=$_GET['id'];
        if($user=='')
            header("location: login");
        include 'fetchdatabase.php';
        $sql="SELECT * FROM sections WHERE username='$user' AND area_of_work='general'";
        $result=mysql_query($sql);
        $sections=mysql_fetch_array($result);
        $id=$user;
        if($sections['sharing']=='0')
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
?>

<html>

<head>
        <title>Resume Bakery - <?echo $data['first_name'].' '.$data['last_name'];?></title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
        <link rel="stylesheet" type="text/css" media="screen" href="mystyle.php?id=<?echo $user;?>"/>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript">
                $(document).ready(function(){
                        $("#edit").click(function(){
                                window.location.replace("edit");
                        });
                });

        </script>
</head>

<body>

	<div id="page">
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
	</div>
        </div>
</body>

</html>
