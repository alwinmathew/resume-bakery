<?php   header("Content-type: text/css");
        if(!isset ($_COOKIE['user']))
                $user=$_GET['id'];
        else
        {
                $user=$_COOKIE['user'];
                setcookie("user",$user,time()+3600);
        }
        include 'fetchdatabase.php';
        $id=$data['template_id'];
        $sql="SELECT * FROM templates WHERE template_key='$id'";
        $result=mysql_query($sql);
        $templates=mysql_fetch_array($result);
        $width=(int)$templates['margin_width'];
        $height=297-(2*$width);
?>

        #body
        {
                background-color: <?=$templates['background_color']?>;
                margin-top: 10px;
                margin-bottom: 10px;
                margin-left: auto;
                margin-right: auto;
                width: 210mm;
                padding-top: <?=$templates['margin_width']?>;
                padding-bottom: <?=$templates['margin_width']?>;
        }
        #resume_body
	{
		margin-left: <?=$templates['margin_width']?>;
                margin-right: <?=$templates['margin_width']?>;
                min-height: <?=$height?>mm;
		padding: 30px;
                width: auto;
                border: <?=$templates['border_width']?>px solid <?=$templates['margin_color']?>;
	}
        #header_image
        {
                float: right;
                margin-top: 0.5px;
                margin-bottom: 0.5px;
                <?if($templates['margin_width']<8)
                        echo 'margin-right: '.(8-$templates['margin_width']).'mm;';
                ?>
        }
        #personal_info
        {
                margin-top: <?=($data['header_image']!="0")?60+10:"0"?>px;
                height: 200px;
        }

        #profile_pic
	{
                margin-left: 15px;
                margin-top: 15px;
		width: 120px;
		height: 120px;
                font-size: 10px;
	}
        #first_name,#last_name
        {
                font-size: 34px;
                font-weight: bold;
                font-family: Trebuchet MS, Helvetica, sans-serif;
        }
        #status
        {
                font-size: 10px;
                font-weight: bold;
        }
	#info
	{
                margin-left: 200px;
                margin-top: -130px;
		font-family: <?=$templates['font_family']?>;
                font-size: 12px;
	}
        #info table
        {
                padding-top: 10px;
                font-size: 12px;
                width: 400px;
        }
        #info td
        {
                min-width: 150px;
                height: 30px;
        }
        
        h3
        {
                font-family: Trebuchet MS, Helvetica, sans-serif;
                font-size: x-large;
        }
        .title
        {
                width: 192px;
                vertical-align: top;
        }
        .data
        {
                width: 480px;
                vertical-align: top;
        }

        .section p
        {
                margin-top: 5px;
                margin-bottom: 5px;
                font-size: <?=$templates['font_size']?>px;
                font-family: <?=$templates['font_family']?>;
                min-height: 100px;
                text-align: justify;
        }
        .section td
        {
                height: 100px;
                border-top: 1px dotted gray;
        }
        #gender,#g,#dob,#d,#marital_status
        {
                font-family: Trebuchet MS, Helvetica, sans-serif;
                font-size: 12px;
                font-weight: bold;
        }

