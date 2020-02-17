$(document).ready(function () {
    $(".result_down").click(function(){
        var id = $(this).attr('data-val');
        $("#btn_download").attr("href","javascript:;");
        $("#modal_content").html("<img width='100%' src='"+base_url+"/app-assets/images/loading.gif'>");

        $('#backdrop').modal({backdrop: 'static', keyboard: false});

        $.ajax({
            url: site_url+"/checkDomain/download",
            data:{id:id},
            type:"post",
            dataType:"json",
            success: function(data){
                if(data.status=="success"){
                    $("#modal_content").html("Check Domain Success! Please Download...");
                    $("#btn_download").attr("href",base_url+"/app-assets/download_files/"+data.result_file);
                }else{
                    $("#modal_content").html(data.status);
                }
            },
            error: function(){
                $("#modal_content").html("cannot connect to server!");
            }
        });
    });
});
