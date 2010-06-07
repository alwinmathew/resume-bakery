<?php


include 'session.php';
include 'fetchdatabase.php';
$sql="SELECT * FROM sections WHERE username='$user'";
$result=mysql_query($sql);
$sections=mysql_fetch_array($result);

$width=(int)$data['margin_width'];
$height=297-(2*$width);

$html = '<div id="body" style="background-color: '.$data['background_color'].';padding-top: '.$data['margin_width'].';padding-left: '.$data['margin_width'].';padding-right: '.$data['margin_width'].';height: 297mm">
        <div id="resume_body" style="border: '.$data['border_width'].'px solid '.$data['margin_color'].';height: '.$height.'mm">
	<div id="personal_info">
                                <div id="profile_pic">
                                        <img src="'.$data['profile_pic'].'" height="120" width="120">
                                </div>
                                <div id="info">
                                        <div class="name">
                                                <span id="first_name">'.$data['first_name'].'</span>&nbsp;&nbsp;&nbsp;
                                                <span id="last_name">'.$data['last_name'].'</span><br>';
$html.=($data['gender']!=NULL)?('<span id="gender">'.(($data['gender']=='M')?'Male':'Female').'</span>'):'';
if(($data['gender']!=NULL)&&($data['dob']!=NULL||$data['marital_status']!=NULL))
        $html.='<span id="g">, </span>';
$html.=($data[dob]!=NULL)?('<span id="dob">'.$data['dob'].(($data['marital_status']!=NULL)?', ':'').'</span>'):'';
$html.=($data['marital_status']!=NULL)?('<span id="marital_status">'.(($data['marital_status']=='S')?'Single':'Married').'</span>'):'';
$html.='
                                                
                                        </div>
                                        <table>
                                        <tr>';
$html.=($data['mobile']!=NULL)?('<td id="mobile">Mobile: '.$data['mobile'].'</td>'):'';
$html.=($data['email']!=NULL)?('<td id="email">Email: '.$data['email'].'</td>'):'';
$html.='</tr><tr>';
$html.=($data['phone']!=NULL)?('<td id="phone">Phone: '.$data['phone'].'</td>'):'';
$html.=($data['website']!=NULL)?('<td id="website">Website/Blog: '.$data['website'].'</td>'):'';
$html.='</tr></table>';
$html.=($data['address']!=NULL)?('<p id="address">'.$data['address'].'</p>'):'';
$html.='
                                </div>
                        </div>
                        <table>';
$html.=($sections['summary']=='1')?
                            '<tr class="section" id="summary">
                                <td class="title"><h3>Summary</h3></td>
                                <td class="data" align="justify" style="font-family: '.$data['font_family'].';font-size: '.$data['font_size'].';"><p>'.$data['summary'].'</p></td>
                            </tr>':'';
$html.=($sections['skills']=='1')?
                            '<tr class="section" id="skills">
                                <td class="title"><h3>Skills</h3></td>
                                <td class="data" align="justify" style="font-family: '.$data['font_family'].';font-size: '.$data['font_size'].';"><p>'.$data['skills'].'</p></td>
                            </tr>':'';
$html.=($sections['experience']=='1')?
                            '<tr class="section" id="experience">
                                <td class="title"><h3>Experience</h3></td>
                                <td class="data" align="justify" style="font-family: '.$data['font_family'].';font-size: '.$data['font_size'].';"><p>'.$data['experience'].'</p></td>
                            </tr>':'';
$html.=($sections['studies']=='1')?
                            '<tr class="section" id="studies">
                                <td class="title"><h3>Studies</h3></td>
                                <td class="data" align="justify" style="font-family: '.$data['font_family'].';font-size: '.$data['font_size'].';"><p>'.$data['studies'].'</p></td>
                            </tr>':'';
$html.=($sections['interests']=='1')?
                            '<tr class="section" id="interests">
                                <td class="title"><h3>Interests</h3></td>
                                <td class="data" align="justify" style="font-family: '.$data['font_family'].';font-size: '.$data['font_size'].';"><p>'.$data['interests'].'</p></td>
                            </tr>':'';
$html.=($sections['hobbies']=='1')?
                            '<tr class="section" id="hobbies">
                                <td class="title"><h3>Hobbies</h3></td>
                                <td class="data" align="justify" style="font-family: '.$data['font_family'].';font-size: '.$data['font_size'].';"><p>'.$data['hobbies'].'</p></td>
                            </tr>':'';
$html.=($sections['languages']=='1')?
                            '<tr class="section" id="languages">
                                <td class="title"><h3>Languages</h3></td>
                                <td class="data" align="justify" style="font-family: '.$data['font_family'].';font-size: '.$data['font_size'].';"><p>'.$data['languages'].'</p></td>
                            </tr>':'';
$html.=($sections['certificates']=='1')?
                            '<tr class="section" id="certificates">
                                <td class="title"><h3>Certificates</h3></td>
                                <td class="data" align="justify" style="font-family: '.$data['font_family'].';font-size: '.$data['font_size'].';"><p>'.$data['certificates'].'</p></td>
                            </tr>':'';
$html.=($sections['publications']=='1')?
                            '<tr class="section" id="publications">
                                <td class="title"><h3>Publications</h3></td>
                                <td class="data" align="justify" style="font-family: '.$data['font_family'].';font-size: '.$data['font_size'].';"><p>'.$data['publications'].'</p></td>
                            </tr>':'';
$html.=($sections['awards']=='1')?
                            '<tr class="section" id="awards">
                                <td class="title"><h3>Awards</h3></td>
                                <td class="data" align="justify" style="font-family: '.$data['font_family'].';font-size: '.$data['font_size'].';"><p>'.$data['awards'].'</p></td>
                            </tr>':'';
$html.='</table></div></div>';

include("pdf/mpdf.php");

$mpdf=new mPDF('win-1252','A4',0,'',0,0,0,0);

$mpdf->useOnlyCoreFonts = true;

$mpdf->SetDisplayMode('fullpage','single');

// LOAD a stylesheet
$stylesheet = file_get_contents('pdfstyle.css');

$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html,2);

$mpdf->Output();

exit;
?>

