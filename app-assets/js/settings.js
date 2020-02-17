Dropzone.options.dpzSingleFile = {
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 1,
    acceptedFiles: '.txt',
    init: function () {
      this.on("maxfilesexceeded", function (file) {
        this.removeAllFiles();
        $("#proxy_file_name").val("");
        this.addFile(file);
      });
    },
    success: function(file, res) {
        var data = JSON.parse(res);
        if(data.status=="success"){
            $("#proxy_file_name").val(data.file_name);
        }else{
            alert("cannot connect to server!");
        }
    }
};
$(document).ready(function () {
    $("#btn_proxy_submit").click(function(){       
        var file_name=$("#proxy_file_name").val();        
        if(file_name==""){
            alert("select file to upload");
            return;
        }
		location.href=site_url+"/check/list";
        /*
		$.ajax({
            url: site_url+"/checkDomain/check_domain",
            data:{file_name:file_name},
            type:"post",
            success: function(result){
                location.href=site_url+"/check/list";
            }
        });
		*/
    });
});
