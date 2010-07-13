<?php


    include 'session.php';
    include 'logininfo.php';
    $area_of_work=$_GET['resume'];  //gets correct resume as area_of_work
    $sql="SELECT * FROM personalinfo WHERE username='$user' AND area_of_work='$area_of_work'";  //fetches user info from DB
    $result=mysql_query($sql);
    $data=mysql_fetch_array($result);

    $sql="SELECT * FROM sections WHERE username='$user' AND area_of_work='$area_of_work'"; //fetches user's sections' status from DB
    $result=mysql_query($sql);
    $sections=mysql_fetch_array($result);
    $id=$data['template_id'];
    $sql="SELECT * FROM templates WHERE template_key='$id'";    //fetches template info from DB
    $result=mysql_query($sql);
    $templates=mysql_fetch_array($result);

    $width=(int)$templates['margin_width'];
    $height=297-(2*$width);
    $pic="files/$user-$area_of_work.jpg";       //path to profile pic

    $header_pos=($templates['margin_width']<8)?'style="margin-right: '.(8-$templates['margin_width']).'mm;"':'';

    $html=' <div id="body" style="background-color: '.$templates['background_color'].';padding-top: '.$templates['margin_width'].';padding-left: '.$templates['margin_width'].';padding-right: '.$templates['margin_width'].';height: 297mm">
            <div id="resume_body" style="border: '.$templates['border_width'].'px solid '.$templates['margin_color'].';height: '.$height.'mm">';
    $html.=($templates['header_image']!="0")?('<div id="image_header"><img id="header_image" src="files/'.$templates['template_key'].'_header.jpg" '.$header_pos.'></div>'):'';
    $html.=	'<div id="personal_info">
                                    <div id="profile_pic" align="center">';
    $html.=($data['profile_pic']!="0")?('<img src="'.$pic.'">'):'';
    $html.=                         '</div>
                                    <div id="info">
                                            <div class="name">
                                                    <span id="first_name">'.$data['first_name'].'</span>&nbsp;&nbsp;&nbsp;
                                                    <span id="last_name">'.$data['last_name'].'</span><br>';
    $html.=($data['gender']!=NULL)?('<span id="gender">'.(($data['gender']=='M')?'Male':'Female').'</span>'):'';
    if(($data['gender']!=NULL)&&($data['dob']!=NULL||$data['marital_status']!=NULL))
            $html.='<span id="g">, </span>';
    $html.=($data['dob']!=NULL)?('<span id="dob">'.$data['dob'].(($data['marital_status']!=NULL)?', ':'').'</span>'):'';
    $html.=($data['marital_status']!=NULL)?('<span id="marital_status">'.(($data['marital_status']=='S')?'Single':'Married').'</span>'):'';
    $html.='

                                            </div>
                                            <table>
                                            <tr>';
    $html.=($data['mobile']!=NULL)?('<td id="mobile" style="font-family: '.$templates['font_family'].';">Mobile: '.$data['mobile'].'</td>'):'';
    $html.=($data['email']!=NULL)?('<td id="email" style="font-family: '.$templates['font_family'].';">Email: '.$data['email'].'</td>'):'';
    $html.='</tr><tr>';
    $html.=($data['phone']!=NULL)?('<td id="phone" style="font-family: '.$templates['font_family'].';">Phone: '.$data['phone'].'</td>'):'';
    $html.=($data['website']!=NULL)?('<td id="website" style="font-family: '.$templates['font_family'].';">Website/Blog: '.$data['website'].'</td>'):'';
    $html.='</tr></table>';
    $html.=($data['address']!=NULL)?('<p id="address" style="font-family: '.$templates['font_family'].';">'.$data['address'].'</p>'):'';
    $html.='
                                    </div>
                            </div>
                            <table>';
    $html.=($sections['summary']=='1')?
                                '<tr class="section" id="summary">
                                    <td class="title"><h3>Summary</h3></td>
                                    <td class="data" align="justify" style="font-size: '.$templates['font_size'].';"><p><pre style="font-family: '.$templates['font_family'].';">'.$data['summary'].'</pre></p></td>
                                </tr>':'';
    $html.=($sections['skills']=='1')?
                                '<tr class="section" id="skills">
                                    <td class="title"><h3>Skills</h3></td>
                                    <td class="data" align="justify" style="font-size: '.$templates['font_size'].';"><p><pre style="font-family: '.$templates['font_family'].';">'.$data['skills'].'</pre></p></td>
                                </tr>':'';
    $html.=($sections['experience']=='1')?
                                '<tr class="section" id="experience">
                                    <td class="title"><h3>Experience</h3></td>
                                    <td class="data" align="justify" style="font-size: '.$templates['font_size'].';"><p><pre style="font-family: '.$templates['font_family'].';">'.$data['experience'].'</pre></p></td>
                                </tr>':'';
    $html.=($sections['studies']=='1')?
                                '<tr class="section" id="studies">
                                    <td class="title"><h3>Studies</h3></td>
                                    <td class="data" align="justify" style="font-size: '.$templates['font_size'].';"><p><pre style="font-family: '.$templates['font_family'].';">'.$data['studies'].'</pre></p></td>
                                </tr>':'';
    $html.=($sections['interests']=='1')?
                                '<tr class="section" id="interests">
                                    <td class="title"><h3>Interests</h3></td>
                                    <td class="data" align="justify" style="font-size: '.$templates['font_size'].';"><p><pre style="font-family: '.$templates['font_family'].';">'.$data['interests'].'</pre></p></td>
                                </tr>':'';
    $html.=($sections['hobbies']=='1')?
                                '<tr class="section" id="hobbies">
                                    <td class="title"><h3>Hobbies</h3></td>
                                    <td class="data" align="justify" style="font-size: '.$templates['font_size'].';"><p><pre style="font-family: '.$templates['font_family'].';">'.$data['hobbies'].'</pre></p></td>
                                </tr>':'';
    $html.=($sections['languages']=='1')?
                                '<tr class="section" id="languages">
                                    <td class="title"><h3>Languages</h3></td>
                                    <td class="data" align="justify" style="font-size: '.$templates['font_size'].';"><p><pre style="font-family: '.$templates['font_family'].';">'.$data['languages'].'</pre></p></td>
                                </tr>':'';
    $html.=($sections['certificates']=='1')?
                                '<tr class="section" id="certificates">
                                    <td class="title"><h3>Certificates</h3></td>
                                    <td class="data" align="justify" style="font-size: '.$templates['font_size'].';"><p><pre style="font-family: '.$templates['font_family'].';">'.$data['certificates'].'</pre></p></td>
                                </tr>':'';
    $html.=($sections['publications']=='1')?
                                '<tr class="section" id="publications">
                                    <td class="title"><h3>Publications</h3></td>
                                    <td class="data" align="justify" style="font-size: '.$templates['font_size'].';"><p><pre style="font-family: '.$templates['font_family'].';">'.$data['publications'].'</pre></p></td>
                                </tr>':'';
    $html.=($sections['awards']=='1')?
                                '<tr class="section" id="awards">
                                    <td class="title"><h3>Awards</h3></td>
                                    <td class="data" align="justify" style="font-size: '.$templates['font_size'].';"><p><pre style="font-family: '.$templates['font_family'].';">'.$data['awards'].'</pre></p></td>
                                </tr>':'';
    $html.='</table></div></div>';
    //function pre_entities($matches) {
    //	return str_replace($matches[1],htmlentities($matches[1]),$matches[0]);
    //}
    ////to html entities;  assume content is in the "content" variable
    //$html = preg_replace_callback('/<pre.*   (.*?)<\/pre>/imsu',pre_entities, $html);


    include("pdf/mpdf.php");            //mpdf library is used to generate the corresponding pdf file

    $mpdf=new mPDF('win-1252','A4',0,'',0,0,0,0,0,0);

    $mpdf->useOnlyCoreFonts = true;

    $mpdf->SetDisplayMode('fullpage','single');

    // LOAD a stylesheet
    $stylesheet = file_get_contents('pdfstyle.css');    //stylesheet of the html to be converted to pdf

    $mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

    $mpdf->WriteHTML($html,2);

    $mpdf->Output();

    exit;
?>

