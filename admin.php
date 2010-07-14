<?php
        $host=$_POST['host']; // Host name
        $db_user=$_POST['db_user']; // Mysql username
        $db_pass=$_POST['db_pass']; // Mysql password
        $db_name=$_POST['db_name'];

        $string='<?php  $host="'.$host.'";$username="'.$db_user.'";$password="'.$db_pass.'";$db_name="'.$db_name.'";';
        $string.='mysql_connect("$host", "$username", "$password")or die("Error connecting to MySQL server: ".mysql_error());mysql_select_db("$db_name")or die("Error selecting MySQL database: ".mysql_error());?>';

        $handle=fopen("logininfo.php","w");
        fwrite($handle, $string);
        fclose($handle);

        mysql_connect("$host", "$db_user", "$db_pass")or die("Error connecting to MySQL server: ".mysql_error());
        $sql="DROP DATABASE $db_name";
        mysql_query($sql);
        $sql="CREATE DATABASE $db_name";
        mysql_query($sql);
        mysql_select_db("$db_name")or die("Error selecting MySQL database: ".mysql_error());

        $backupFile='rbakery.sql';    // mysqldump file

        $templine='';
        // Read in entire file
        $lines=file($backupFile);
        // Loop through each line
        foreach ($lines as $line)
        {
                // Skip it if it's a comment
                if (substr($line, 0, 2) == '--' || $line == '')
                        continue;

                // Add this line to the current segment
                $templine .= $line;
                // If it has a semicolon at the end, it's the end of the query
                if (substr(trim($line), -1, 1) == ';')
                {
                        // Perform the query
                        mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
                        // Reset temp variable to empty
                        $templine = '';
                }
        }
        function mover($src,$dst)
        {
                $handle=opendir($src);                      // Opens source dir.
                if(!is_dir($dst))
                        mkdir($dst,0755);       // Make dest dir.
                while($file=readdir($handle))
                {
                        if(($file!=".") and ($file!=".."))
                        {       // Skips . and .. dirs
                                $srcm=$src."/".$file;
                                $dstm=$dst."/".$file;
                                if(is_dir($srcm))
                                {                      // If another dir is found
                                        mover($srcm,$dstm);               // calls itself - recursive WTG
                                }
                                else
                                {
                                      copy($srcm,$dstm);
                                      system("rm -f $srcm");
                                }
                        }
                }
                closedir($handle);
                rmdir($src);
        }
        system("mv install/* .");
        system("rm -rf install");
        rmdir("install");
        unlink("installer.php");
        return ("success");
?>
