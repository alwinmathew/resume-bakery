          function update_info(type,value,fn)
                {
                        $.ajax({
                                type: 'POST',
                                url: "updateinfo.php",
                                data: "infotype=" +type +"&infovalue=" +value,
                                success: function(){
                                        if(type=="profile_pic")
                                                return;
                                        $(".section div").hide();
                                        $(".info_edit").hide();
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
                                                $(section).show();
                                                $(add).hide();
                                                $(sec).show();
                                        }
                                        else
                                        {
                                                $(section).hide();
                                                $(add).show();
                                                $(sec).hide();
                                        }
                                }
                        });
                }
                function refresh_info()
                {
                        $(".info_edit").hide();
                        $("#first_name,#last_name,#info p").show();
                        $("#file_upload").hide();
                        $("#profile_pic p").show();
                }
                function refresh_section()
                {
                        $(".section div").css("display","none");
                        $(".section p").show();
			$(".section_edit").hide();
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
                        $(edit).show();
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
                        $(edit).show();
                        $(fn).hide();
                        $(sec).val(data);
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



function edit_page_js()
{
	$(document).ready(function(){
                        $(".file_upload").hide();
			$(".section_edit").hide();
                        refresh_info();
                        refresh_section();
                        document.getElementById("add_title").defaultSelected = true;
                        document.getElementById("male").defaultSelected = true;
                        document.getElementById("single").defaultSelected = true;
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
                                onComplete: function(data){
                                        // enable upload button
                                        this.enable();
                                        window.location.reload();
                                }
                        });
                        $("#remove").click(function(){
                                update_info("profile_pic","0","");
                                window.location.reload();
                        });
                        $("#preview").click(function(){
                                window.location="preview";
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
                        
           });
}
