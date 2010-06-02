<?php
        $user=$_GET['id'];
        if($user=='')
            header("location: login");
        include 'fetchdatabase.php';
        $sql="SELECT * FROM sections WHERE username='$user'";
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
?>

<html>

<head>
        <title>Resume Bakery - <?echo $data['first_name'].' '.$data['last_name'];?></title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css" />
        <link rel="stylesheet" type="text/css" href="mystyle.css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript">
                $(document).ready(function(){
                        $("#file_upload").hide();
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
                        $("#profile_pic p").click(function(){
                                $("#profile_pic p").hide();
                                $("#file_upload").show();
                        });
                        $("#edit").click(function(){
                                window.location.replace("edit");
                        });
                });

        </script>
</head>

<body>

	<div id="page">
            <div id="body">
                        <div id="personal_info">
                                <div id="profile_pic">
                                        <img src="<?echo $data['profile_pic']?>" height="120" width="120">
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
