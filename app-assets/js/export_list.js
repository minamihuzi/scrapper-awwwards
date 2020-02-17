$(document).ready(function () {
    var tmp = page_code.split('_');
    
    $(".result_down").click(function(){
        var id = $(this).attr('data-val');
        var type = $(this).attr('data-type');
        type=1;
        $("#btn_download").attr("href","javascript:;");
        //$("#modal_content").html("<img width='100%' src='"+base_url+"/app-assets/images/loading.gif'>");

        $('#backdrop').modal({backdrop: 'static', keyboard: false});

        $.ajax({
            url: site_url+"/checkDomain/download",
            data:{id:id},
            type:"post",
            dataType:"json",
            success: function(data){
                if(data.status=="success"){
                    $("#modal_content").html("Check Domain Success! Please Download...");                   
                }else{
                    $("#modal_content").html(data.status);
                }
            },
            error: function(){
                $("#modal_content").html("cannot connect to server!");
            }
        });
    });

    $(".multi_down").click(function(){
        var id = $(this).attr('data-val');
        var tr = $(this).parents('tr');
        var domain_count=$('.text-muted', tr).text();
        if(domain_count>100)domain_count=100;
        var domain_names=$('.domain_info', tr).attr("domains");
        var email=$('.domain_info', tr).attr("email");
        var password=$('.domain_info', tr).attr("password");
        doamin_names=domain_names.split("\n");
        var url=base_url+"/check/export.php";
		$.post(url,{id:id, action:"delete"}, function(data){

        });        
        $("#btn_download").attr("href","javascript:;");
        var progress_html='<div class="progress progress-bar-primary mb-2 ">' +
                '<div id="check_progress" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="'+domain_count+'" style="width:0"></div>'+
            '</div>';
        $("#modal_content").html(progress_html);
        $('#backdrop').modal({backdrop: 'static', keyboard: false});
		
		
        for(var i=0;i<domain_count;i++){
            $.ajax({
                url: url,
                data:{id:id, action:i, file_name:doamin_names[i], email:email, password:password},
                type:"post",
                dataType:"json",
                success: function(data){
					if(data.status=="success"){
                        var valuenow=eval($("#check_progress").attr("aria-valuenow"));
                        var valuemax=eval($("#check_progress").attr("aria-valuemax"));
                        valuenow+=data.total;
                        var percent=valuenow/valuemax*100;
                        $("#check_progress").attr("aria-valuenow",valuenow);
                        $("#check_progress").css("width",percent+"%");                        
                    }else{
                        $("#modal_content").html("cannot connect to server!");
                        // $('#backdrop').modal("hide");
                    }
                },
                error: function(){
                    $("#modal_content").html("cannot connect to server!");
                    // $('#backdrop').modal("hide");
                }
            });
        }
        
    });
});
