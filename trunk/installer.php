<html>
<head>
<title>Resume-Bakery Database Admin</title>
<style type="text/css">
    body
    {
        background-color: #ddf2da;
        width: 900px;
        margin-left: auto;
        margin-right: auto;
        font-family: Trebuchet MS, Helvetica, sans-serif;
    }
    #page
    {
        background-color: white;
        padding: 30px;
        width: 800px;
        height: 250px;
        font-size: 12px;
        position: absolute;
        top: 0px;
        right: 0px;
        bottom: 0px;
        left: 0px;
        margin: auto;
    }
    td
    {
        font-size: 12px;
        padding: 5px;
    }
    #error_submit
    {
        color: red;
        font-size: 10px;
        font-weight: bold;
    }
    fieldset
    {
        color: green;
        padding: 20px;
        margin: auto;
    }
</style>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
                $("#submit").click(function(){
                        var host=$("#host_name").val();
                        var db_user=$("#db_user").val();
                        var db_pass=$("#db_pass").val();
                        var db_name=$("#db_name").val();
                        if(host==""||db_user==""||db_pass==""||db_name=="")
                        {
                                $("#error_submit").html("fields cannot be left empty !");
                                return;
                        }
                        $.ajax({
                                type: "POST",
                                url: "admin.php",
                                data: "host=" +host +"&db_user=" +db_user +"&db_pass=" +db_pass +"&db_name=" +db_name,
                                success: function(data){
                                        $("#error_submit").html("Database info saved successfully");
                                }
                        });
                });
        });
</script>
</head>

<body>
    <div id="page">
        <fieldset>
                <legend>Server Info</legend>
                <table align="center">
                                <tr>
                                    <td>Host Name</td>
                                    <td>: <input type='text' id='host_name'></td>
                                </tr>
                                <tr>
                                    <td>MySQL User</td>
                                    <td>: <input type='text' id='db_user'></td>
                                </tr>
                                <tr>
                                    <td>MySQL Password</td>
                                    <td>: <input type='password' id='db_pass'></td>
                                </tr>
                                <tr>
                                    <td>MySQL Database Name</td>
                                    <td>: <input type='text' id='db_name'></td>
                                </tr>
                </table>
                <br>
                <div id="error_submit" align="center"></div>
                <br>
                <div align="center"><button id="submit"><?echo (file_exists('logininfo.php'))?'Update':'Submit';?></button></div>
        </fieldset>
    </div>
</body>

</html>
