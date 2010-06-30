<?php
    include 'session.php';
    include 'logininfo.php';
    

    mysql_connect("$host", "$username", "$password")or die("cannot connect");
    mysql_select_db("$db_name")or die("cannot select DB");

    $type=$_POST['type'];
    $value=$_POST['value'];

//    function mysql_update_array($data, $id_field, $id_value)
//    {
//	foreach($data as $field=>$value)
//        {
//		$fields[] = sprintf("`%s` = '%s'", $field, mysql_real_escape_string($value));
//	}
//	$field_list = join(',', $fields);
//	$query = sprintf("UPDATE templates SET %s WHERE `%s` = %s", $field_list, $id_field, intval($id_value));
//	return $query;
//    }

    if($type=="new")
    {
            if($value=="")
                    $value=$user." template";
            $template_key="$user-$value".rand();
            $template_key=md5($template_key);
            $template_key=substr($template_key,8,16);
            $sql="INSERT INTO templates (template_name,template_key,owner,users) VALUES('$value','$template_key','$user','$user')";
            $result=mysql_query($sql);
            $sql="UPDATE personalinfo SET template_id='$template_key' WHERE username='$user' AND area_of_work='general'";
            $result=mysql_query($sql);
            die;
    }
    if($type=="add_shared")
    {
            $sql="SELECT * FROM templates WHERE template_key='$value'";
            $result=mysql_query($sql);
            if(mysql_num_rows($result)==0)
                    die("error");
            $templates=mysql_fetch_array($result);
            if($templates['read_only']=="1")
            {
                    $sql="INSERT INTO templates (template_key,users) VALUES('$value','$user')";
                    $result=mysql_query($sql);
                    $sql="UPDATE templates SET template_name='";
                    $sql.=$templates['template_name']."',owner='";
                    $sql.=$templates['owner']."',read_only='1',header_image='";
                    $sql.=$templates['header_image']."',font_family='";
                    $sql.=$templates['font_family']."',font_size='";
                    $sql.=$templates['font_size']."',margin_width='";
                    $sql.=$templates['margin_width']."',margin_color='";
                    $sql.=$templates['margin_color']."',border_width='";
                    $sql.=$templates['border_width']."',background_color='";
                    $sql.=$templates['background_color']."' WHERE template_key='$value' AND users='$user'";
                    $result=mysql_query($sql);
                    $sql="UPDATE personalinfo SET template_id='$value' WHERE username='$user' AND area_of_work='general'";
            }
            else
            {
                    $value=$templates['template_name'];
                    $template_key="$user-$value".rand();
                    $template_key=md5($template_key);
                    $template_key=substr($template_key,8,16);
                    $sql="INSERT INTO templates (template_name,template_key,owner,users) VALUES('$value','$template_key','$user','$user')";
                    $result=mysql_query($sql);
                    $sql="UPDATE templates SET read_only='1',header_image='";
                    $sql.=$templates['header_image']."',font_family='";
                    $sql.=$templates['font_family']."',font_size='";
                    $sql.=$templates['font_size']."',margin_width='";
                    $sql.=$templates['margin_width']."',margin_color='";
                    $sql.=$templates['margin_color']."',border_width='";
                    $sql.=$templates['border_width']."',background_color='";
                    $sql.=$templates['background_color']."' WHERE template_key='$template_key' AND users='$user'";
                    $result=mysql_query($sql);
                    copy("files/".$templates['template_key']."_header.jpg","files/$template_key"."_header.jpg");
                    $sql="UPDATE personalinfo SET template_id='$template_key' WHERE username='$user' AND area_of_work='general'";
            }
            $result=mysql_query($sql);
            die("success");
    }
    if($type=="change")
    {
            $sql="UPDATE personalinfo SET template_id='$value' WHERE username='$user' AND area_of_work='general'";
            $result=mysql_query($sql);
            die;
    }
    if($type=="remove")
    {
            $sql="DELETE FROM templates WHERE template_key='$value' AND users='$user'";
            $result=mysql_query($sql);
            $sql="SELECT template_key FROM templates WHERE users='$user'";
            $result=mysql_query($sql);
            if(mysql_num_rows($result)==0)
                    $value="default";
            else
            {
                    $value=mysql_fetch_array($result);
                    $value=$value['template_key'];
            }
            $sql="UPDATE personalinfo SET template_id='$value' WHERE username='$user' AND area_of_work='general'";
            $result=mysql_query($sql);
            die;
    }

    if($value=="status_temp")
            die(file_exists("tmp/$user"."_header.jpg"));
    if($value=="remove_temp")
    {
            unlink("tmp/$user"."_header.jpg");
            die;
    }

    $sql="SELECT template_id FROM personalinfo WHERE username='$user' AND area_of_work='general'";
    $result=mysql_query($sql);
    $data=mysql_fetch_array($result);
    $id=$data['template_id'];

    if($value=="remove_header")
    {
            unlink("files/$id"."_header.jpg");
            $value="0";
    }
    else if($value=="check_header")
    {
            if(file_exists("tmp/$user"."_header.jpg"))
            {
                    rename("tmp/$user"."_header.jpg","files/$id"."_header.jpg");
                    $value="1";
            }
            else
                    die;
    }

    if($value!="")
            $sql="UPDATE templates SET $type='$value' WHERE template_key='$id' AND owner='$user'";
    else
            $sql="UPDATE templates SET $type=DEFAULT WHERE template_key='$id' AND owner='$user'";
    $result=mysql_query($sql);

?>
