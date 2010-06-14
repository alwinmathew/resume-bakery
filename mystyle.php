<?php   header("Content-type: text/css");
        if(!isset ($_COOKIE['user']))
                $user=$_GET['id'];
        else
        {
                $user=$_COOKIE['user'];
                setcookie("user",$user,time()+3600);
        }
        include 'fetchdatabase.php';
        $width=(int)$data['margin_width'];
        $height=297-(2*$width);
?>

        #body
        {
                background-color: <?=$data['background_color']?>;
                margin-top: 10px;
                margin-bottom: 10px;
                margin-left: auto;
                margin-right: auto;
                width: 210mm;
                padding-top: <?=$data['margin_width']?>;
                padding-bottom: <?=$data['margin_width']?>;
        }
        #resume_body
	{
		margin-left: <?=$data['margin_width']?>;
                margin-right: <?=$data['margin_width']?>;
                min-height: <?=$height?>mm;
		padding: 30px;
                width: auto;
                border: <?=$data['border_width']?>px solid <?=$data['margin_color']?>;
	}
        #header_image
        {
                float: right;
                height: <?=$data['margin_width']-1?>mm;
                margin-top: 0.5px;
                margin-bottom: 0.5px;
        }
        #personal_info
        {
                margin-top: <?=$data['margin_width']-1?>mm;
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
		font-family: <?=$data['font_family']?>;
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
                font-size: <?=$data['font_size']?>px;
                font-family: <?=$data['font_family']?>;
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

