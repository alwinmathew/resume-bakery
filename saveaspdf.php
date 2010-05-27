<?php


include("fetchdatabase.php");

$html=$_SERVER['QUERY_STRING'];
//$html=$_GET['myhtml'];
$html=str_replace("myhtml=","",$html);

$html=urldecode($html);

//echo $html;
//$html = file_get_contents($_POST['myhtml']);
//print_r($html);*/
/*$html = '
	<div id="personal_info">
                                <div id="profile_pic">
                                        <img src="images/clematis.jpg" height="120" width="120">
                                </div>
                                <div id="info">
                                        <div class="name">
                                                <span id="first_name">$data["first_name"]</span>&nbsp;
                                                <span id="last_name"><?echo $data[\'last_name\']?><br></span>
                                                <span id="gender"><?echo $data[\'gender\']==\'M\'?\'Male\':\'Female\';?></span><span id="g">, </span>
                                                <span id="dob"><?echo $data[\'dob\'];?></span><span id="d">, </span>
                                                <span id="marital_status"><?echo $data[\'marital_status\']==\'S\'?\'Single\':\'Married\';?></span>
                                        </div>
                                        <table>
                                        <tr><td id="phone"><?echo "Phone: ".$data[\'phone\'];?></td>
                                            <td id="email"><?echo "Email: ".$data[\'email\'];?></td></tr>

                                        <tr><td id="mobile"><?echo "Mobile: ".$data[\'mobile\'];?></td>
                                            <td id="website"><?echo "Website/Blog: ".$data[\'website\'];?></td></tr>
                                        </table>
                                        <p id="address"><?echo $data[\'address\'];?></p>

                                </div>
                        </div>
                        <table class="section" id="skills">
                            <tr><td class="title"><h3>Skills</h3></td>
                                <td><p><?echo $data[\'skills\'];?></p></td>
                            </tr>
                            <br
                        </table>
                        <table class="section" id="experience">
                            <tr><td class="title"><h3>Experience</h3></td>
                                <td><p><?echo $data[\'experience\'];?></p></td>
                            </tr>
                        </table>
                        <table class="section" id="studies">
                            <tr><td class="title"><h3>Studies</h3></td>
                                <td><p><?echo $data[\'studies\'];?></p></td>
                            </tr>
                        </table>
                        <table class="section" id="interests">
                            <tr><td class="title"><h3>Interests</h3></td>
                                <td><p><?echo $data[\'interests\'];?></p></td>
                            </tr>
                        </table>
';*/


//==============================================================
//==============================================================
//==============================================================

include("mpdf.php");

/*ob_start();
include 'preview.php';
$html=ob_get_clean();*/
$mpdf=new mPDF();

$mpdf->useOnlyCoreFonts = true;

$mpdf->SetDisplayMode('fullpage');

// LOAD a stylesheet
$stylesheet = file_get_contents('mystyle.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html,2);

$mpdf->Output();

exit;
//==============================================================
//==============================================================
//==============================================================

?>
