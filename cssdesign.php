<?php   header("Content-type: text/css");
        include 'session.php';
        include 'fetchdatabase.php';
?>
        #preview_popup
        {
                background-color: <?=$data['background_color']?>;
                top: 20px;
                left: 340px;
                width: 210mm;
                min-height: 297mm;
                border: 2px solid teal;
                position: absolute;
        }
        #resume_body
	{
		margin: <?=$data['margin_width']?>;
                min-height: 271mm;
		padding: 30px;
                width: auto;
                border: <?=$data['border_width']?>px solid <?=$data['margin_color']?>;
	}

        #personal_info
        {
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




        body
	{
                background: url('images/header_repeat.jpg') repeat-x left top;
	}

        #page
	{
		background-color: #e6e6e6;
                width: 900px;
		margin-top: 20px;
		margin-bottom: 20px;
		margin-left: auto;
		margin-right: auto;
		padding: 10px;
		position: relative;
	}
        #header
	{
		background: url('images/dot.gif') repeat-x left bottom;
	}

	#sideline
	{
		text-align: right;
		font-size: 12px;
		font-family: Arial, Helvetica, sans-serif;
	}

	#sideline a
	{
		text-decoration: none;
		color: #1272c1;
	}
	#sideline a:visited
	{
		text-decoration: none;
		color: #1272c1;
	}
	#sideline a:hover
	{
		text-decoration:none;
		font-size: 14px;
		font-weight: bold;
		color: #12b2e7;
	}

	#title
	{
		font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
		font-size: 50px;
		padding-left: 20px;
		padding-top: 10px;
	}
	#title a
	{
		text-decoration: none;
		color: black;
	}

	#tagline
	{
		padding-left: 22px;
		font-family: Trebuchet MS, Helvetica, sans-serif;
		font-size: 13px;
		padding-bottom: 5px;
                font-style: italic;
	}
        #body
	{
		margin-top:10px;
                margin-bottom: 10px;
		background-color: white;
		min-height:677px;
		padding: 30px;
                width: 690px;
                margin-left: auto;
                margin-right: auto;
	}
        #popup_close
        {
                width: 16px;
                height: 16px;
                position: inherit;
                cursor: pointer;
                background: url('images/cancel.png');
                right: 2px;
                text-align: center;
                top: 2px;
        }
        #control
        {
                font-family: Trebuchet MS, Helvetica, sans-serif;
                font-size: 12px;
                margin-top: 20px;
                margin-bottom: 20px;
        }
        #control table
        {
                font-family: Trebuchet MS, Helvetica, sans-serif;
                font-size: 12px;
                width: 800px;
        }
        #change
        {
                font-size: 14px;
                font-weight: bold;
                text-align: center;
                cursor: pointer;
        }
        .head
        {
                min-width: 100px;
                /*border: 1px solid teal;*/
                padding-top: 5px;
                padding-bottom: 5px;
        }
        .field
        {
                /*border: 1px solid red;*/
                width: 300px;
                padding-top: 5px;
                padding-bottom: 5px;
        }

