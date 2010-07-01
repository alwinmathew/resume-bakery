function edit_page_js()
{
        function update_info(type,value,fn)
        {
                $.ajax({
                        type: 'POST',
                        url: "updateinfo.php",
                        data: "infotype=" +type +"&infovalue=" +value,
                        success: function(){
                                $(".section div").css("display","none");
                                $(".info_edit").css("display","none");
                                if(type=="profile_pic")
                                        return;
                                $(fn).show();
                                if(type=="dob")
                                {
                                        if(value=="")
                                            $(fn).html("+ add date of birth");
                                        else
                                            $(fn).html($("#dob_day option:selected").val()+" "+$("#dob_month option:selected").html()+" "+$("#dob_year option:selected").val());
                                        return;
                                }
                                if(value=="")
                                    if(fn.indexOf(" p")>=0)
                                        value="Click to edit description";
                                    else
                                    {
                                        value=(type=="marital_status")?"+ add marital status":"+ add "+type;
                                        value=value+(type=="website"?"/blog URL":"");
                                        if(type=="first_name")
                                            value="firstname";
                                        else if(type=="last_name")
                                            value="lastname";
                                    }
                                $(fn).html(value);
                                height(32);
                        }
                });
        }

        function update_section(type,value)
        {
                $.ajax({
                        type: 'POST',
                        url: "updatesection.php",
                        data: "sectiontype=" +type +"&sectionvalue=" +value,
                        success: function(data){
                                if(type=="sharing")
                                {
                                    if(data=="1")
                                        $("#share span").html("Public");
                                    else
                                        $("#share span").html("Private");
                                    return;
                                }
                                var section="#"+type;
                                var add="#add_"+type;
                                var sec="#sec_"+type;
                                if(value=="1")
                                {
                                        $(section).css("display","block");
                                        $(add).css("display","none");
                                        $(sec).css("display","block");
                                }
                                else
                                {
                                        $(section).css("display","none");
                                        $(add).css("display","block");
                                        $(sec).css("display","none");
                                }
                                height(32);
                        }
                });
        }
        function refresh_info()
        {
                $(".info_edit").css("display","none");
                $("#first_name,#last_name,#info p").show();
                $("#response").html("");
        }
        function refresh_section()
        {
                $(".section div").css("display","none");
                $(".section p").show();
                height(32);
        }
        function edit_info(type)
        {
                var edit="#"+type +"_edit";
                var sec="#edit_"+type;
                var fn="#"+type;
                var selection="#add_"+type;
                var data=$(fn).html();
                refresh_info();
                if(data.substr(0,5)=="+ add"||data=="firstname"||data=="lastname")
                    data="";
                $(fn).hide();
                $(edit).css("display","block");
                $(sec).val(data);
                $(".save").click(function(){
                        if(type=="gender"||type=="marital_status")
                                data=$(selection+" option:selected").val();
                        else
                                data=$(sec).val();
                        if(data=="--")
                                data="";
                        update_info(type,data,fn);
                });
                $(".cancel").click(function(){
                        refresh_info();
                });
        }
        function edit_section(type)
        {
                var edit="."+type +"_edit";
                var sec="#edit_"+type;
                var fn="#"+type +" p";
                var data=$(fn).html();
                refresh_section();
                if(data=="Click to edit description")
                    data="";
                $(edit).css("display","block");
                $(fn).hide();
                $(sec).val(data);
                height(32);
                $(".save").click(function(){
                        data=$(sec).val();
                        update_info(type,data,fn);
                });
                $(".cancel").click(function(){
                        refresh_section();
                });
        }
        function edit_date()
        {
                var day,month,year,value;
                refresh_info();
                $("#dob").hide();
                $("#dob_edit").show();
                $(".save").click(function(){
                        day=$("#dob_day option:selected").val();
                        month=$("#dob_month option:selected").val();
                        year=$("#dob_year option:selected").val();
                        value=year+"-"+month+"-"+day;
                        if(day=="--"||month=="--"||year=="--")
                            value="";
                        update_info("dob",value,"#dob");
                });
                $(".cancel").click(function(){
                        refresh_info();
                });
        }

        $(document).ready(function(){
                $("#user").css("display","block");
                height(32);
                var user=readCookie("user");
                $("#user b").html(user);
                refresh_info();
                refresh_section();
                var i;
                for(i=2010;i>=1900;i--)
                        $("#dob_year").append("<option value='"+i +"'>"+i +"</option>");
                for(i=1;i<=31;i++)
                {
                        var option="<option value='";
                        if(i<10)
                            option+="0";
                        option+=i+"'>"+i +"</option>";
                        $("#dob_day").append(option);
                }
                new AjaxUpload('upload', {
                        action: 'addphoto.php',
                        name: 'myphoto',
                        autoSubmit: true,
                        onSubmit : function(file,ext){
                                //disable upload button
                                this.disable();
                                if (!(ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
                                        // extension is not allowed
                                        $("#response").html("Invalid file extension!");
                                        this.enable();
                                        // cancel upload
                                        return false;
                                }
                        },
                        onComplete: function(){
                                // enable upload button
                                this.enable();
                                window.location.reload();
                        }
                });
                $("#remove").click(function(){
                        update_info("profile_pic","0","");
                        load_edit();
                });
                $("#share span").click(function(){
                        update_section("sharing","");
                });
                $("#first_name,#last_name,#info td,.section p").mouseover(function(){
                        $(this).css("background-color", "#ffffdd");
                });
                $("#first_name,#last_name,#info td,.section p").mouseout(function(){
                        $(this).css("background-color", "white");
                });

                $("#personal_info,#section_view").click(function(){
                        refresh_section();
                });
                $(".section,#section_view").click(function(){
                        refresh_info();
                });

                $(".fields").click(function(){
                        var id=$(this).attr("id");
                        edit_info(id);
                });
                $("#dob").click(function(){
                        edit_date();
                });
                $(".section").mouseover(function(){
                        var id=$(this).attr("id");
                        $("p").click(function(){
                                edit_section(id);
                        });
                });
                $(".add_new").click(function(){
                        var id=$(this).attr("id");
                        var section=id.substr(4);
                        update_section(section,"1");
                });
                $(".sec_views").click(function(){
                        var id=$(this).attr("id");
                        var section=id.substr(4);
                        update_section(section,"0");
                });
                $("#preview").click(function(){
                        load_preview();
                        $("#head_pic").html('<img src="images/preview.png">');
                });
        });
}

function preview_page_js()
{
        function update_template(type)
        {
                var id=$("#preview_user_templates option:selected").val();
                $.ajax({
                        type: 'POST',
                        url: "updatetemplate.php",
                        data: "type=" +type+"&value=" +id,
                        success: function(){
                                load_preview();
                        }
                });
        }
        function add_template()
        {
                var key=$("#preview_shared_key").val();
                if(key!="")
                {
                        $.ajax({
                                type: 'POST',
                                url: "updatetemplate.php",
                                data: "type=add_shared&value=" +key,
                                success: function(data){
                                        if(data=="success")
                                                load_preview();
                                }
                        });
                }
                $("#preview_add_share").css("display","none");
                $("#preview_add_template").show();
        }
        $(document).ready(function(){
                $("#user").css("display","block");
                height(31);
                var user=readCookie("user");
                $("#user b").html(user);
                $("#preview_edit").click(function(){
                        load_edit();
                        $("#head_pic").html('<img src="images/edit2.png">');
                });
                $("#preview_user_templates").change(function(){
                        update_template('change');
                });
                $("#preview_new_template").click(function(){
                        load_design("?type=new");
                        $("#head_pic").html('<img src="images/design.png">');
                });
                $("#preview_design_resume").click(function(){
                        load_design("");
                        $("#head_pic").html('<img src="images/design.png">');
                });
                $("#preview_share_template").click(function(){
                        $(this).hide();
                        $("#preview_remove_template").hide();
                        $("#share_key").css("display","block");
                });
                $("#hide_share").click(function(){
                        $("#share_key").css("display","none");
                        $("#preview_share_template").show();
                        $("#preview_remove_template").show();
                });
                $("#preview_remove_template").click(function(){
                        update_template('remove');
                });
                $("#preview_add_template").click(function(){
                        $(this).hide();
                        $("#preview_add_share").css("display","block");
                });
                $("#preview_addshare_ok").click(function(){
                        add_template();
                });
        });
}

function design_page_js()
{
        function update_template(type,value)
        {
                $.ajax({
                        type: 'POST',
                        url: "updatetemplate.php",
                        data: "type=" +type +"&value=" +value,
                        success: function(data){
                                if(value=="remove_temp"||value=="remove_header")
                                        load_design("");
                                if(value=="status_temp")
                                        return data;
                        }
                });
        }
        function save_template(type){
                var name=$("#template_name").val();
                var font=$("#font option:selected").val();
                var ftsize=$("#font_size").val();
                var mgwidth=$("#margin_width").val();
                var mgcolor=$("#margin_color").val();
                var bdwidth=$("#border_width").val();
                var bgcolor=$("#background_color").val();
                if(type)
                {
                        update_template("new",name);
                        if ($("#read_only").is(':checked'))
                                update_template("read_only","1");
                        else
                                update_template("read_only","0");
                }
                if(font!="default")
                        update_template("font_family",font);
                if(ftsize!="")
                        update_template("font_size",ftsize);
                if(mgwidth!="")
                {
                        mgwidth+="mm";
                        update_template("margin_width",mgwidth);
                }
                if(mgcolor!="")
                {
                        mgcolor="#"+mgcolor;
                        update_template("margin_color",mgcolor);
                }
                if(bdwidth!="")
                {
                        update_template("border_width",bdwidth);
                }
                if(bgcolor!="")
                {
                        bgcolor="#"+bgcolor;
                        update_template("background_color",bgcolor);
                }
                update_template("header_image","check_header");
                load_preview();
        }
        $(document).ready(function(){
                new jscolor.color(document.getElementById('margin_color'), {});
                new jscolor.color(document.getElementById('background_color'), {});
                $("#user").css("display","block");
                height(31);
                var user=readCookie("user");
                $("#user b").html(user);
                var def_font,def_ftsize,def_mgwidth,def_mgcolor,def_bdwidth,def_bgcolor;
                def_font=$(".design_section p").css("font-family");
                def_ftsize=$(".design_section p").css("font-size");
                def_mgwidth=$("#design_body").css("margin");
                def_mgcolor=$("#design_body").css("border-color");
                def_bdwidth=$("#design_body").css("border-width");
                def_bgcolor=$("#preview_popup").css("background-color");
                $(".remove").mouseover(function(){
                        $(this).css('text-decoration','underline');
                });
                $(".remove").mouseout(function(){
                        $(this).css('text-decoration','none');
                });
                $("#preview").click(function(){
                        load_preview();
                        $("#head_pic").html('<img src="images/preview.png">');
                });
                $("#remove_header").click(function(){
                        update_template("header_image","remove_header");
                });
                $("#show").click(function(){
                        var font=$("#font option:selected").val();
                        var ftsize=$("#font_size").val();
                        var mgwidth=$("#margin_width").val();
                        var mgcolor=$("#margin_color").val();
                        var bdwidth=$("#border_width").val();
                        var bgcolor=$("#background_color").val();
                        if(font!="default")
                                $(".design_section p,#design_info").css("font-family",font);
                        else
                                $(".design_section p,#design_info").css("font-family",def_font);
                        if(ftsize!="")
                        {
                                ftsize+="px";
                                $(".design_section p").css("font-size",ftsize);
                        }
                        else
                                $(".design_section p").css("font-size",def_ftsize);
                        if(mgwidth!="")
                        {
                                if(8-mgwidth>0)
                                        $("#header_image").css("margin-right",(8-mgwidth)+"mm");
                                else
                                        $("#header_image").css("margin-right",0);
                                mgwidth+="mm";
                                $("#design_body").css("margin","0mm "+mgwidth);
                                $("#preview_popup").css("padding-top",mgwidth);
                                $("#preview_popup").css("padding-bottom",mgwidth);
                        }
                        else
                        {
                                $("#design_body").css("margin","0mm "+def_mgwidth);
                                $("#preview_popup").css("padding-top",def_mgwidth);
                                $("#preview_popup").css("padding-bottom",def_mgwidth);
                        }
                        if(mgcolor!="")
                        {
                                mgcolor="#"+mgcolor;
                                $("#design_body").css("border-color",mgcolor);
                        }
                        else
                                $("#design_body").css("border-color",def_mgcolor);
                        if(bdwidth!="")
                        {
                                $("#design_body").css("border-width",bdwidth);
                        }
                        else
                                $("#design_body").css("border-width",def_bdwidth);
                        if(bgcolor!="")
                        {
                                bgcolor="#"+bgcolor;
                                $("#preview_popup").css("background-color",bgcolor);
                        }
                        else
                                $("#preview_popup").css("background-color",def_bgcolor);
//                        var user=$("#user b").html();
//                        if(update_template("header_image","status_temp"))
//                                $("#image_header").html('<img id="header_image" src="tmp/'+user +'_header.jpg">');
                });
                $("#save").click(function(){
                        if(page=="design?type=new")
                            save_template(true);
                        else if(page=="design")
                            save_template(false);
                });
                new AjaxUpload('header_upload', {
                        action: 'addheader.php',
                        name: 'myheader',
                        autoSubmit: true,
                        onSubmit : function(file,ext){
                                //disable upload button
                                this.disable();
                                if (!(ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
                                        // extension is not allowed
                                        $("#response").html("Invalid file extension!");
                                        this.enable();
                                        // cancel upload
                                        return false;
                                }
                        },
                        onComplete: function(){
                                // enable upload button
                                this.enable();
                                //load_design(page);
//                                $("#image_header").load("design.php #image_header");
//                                $("#design_personal_info").load("design.php #design_personal_info");
                                window.location.reload();
                        }
                });
        });
}