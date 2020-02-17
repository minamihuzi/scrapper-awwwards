Dropzone.options.dpzSingleFile = {
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 1,
    acceptedFiles: '.txt',
    init: function () {
      this.on("maxfilesexceeded", function (file) {
        this.removeAllFiles();
        $("#file_name").val("");
        this.addFile(file);
      });
    },
    success: function(file, res) {
        var data = JSON.parse(res);
        if(data.status=="success"){
            $("#file_name").val(data.file_name);
        }else{
            alert("cannot connect to server!");
        }
    }
};

$(document).ready(function () {
    $("#btn_check_submit").click(function(){
        var project_name=$("#project_name").val();
        var check_type=$("input[name='check_type']:checked").val();
        var file_name=$("#file_name").val();
        var domains = $("#domains").val();
        if(project_name==""){
            alert("please enter project name!");
            $("#project_name").focus();
            return;
        }
        if(file_name=="" && domains==""){
            alert("Insert domains.");
            return;
        }
        $.ajax({
            url: site_url+"/checkDomain/check_domain",
            data:{project_name:project_name, check_type:check_type, file_name:file_name, domains:domains},
            type:"post",
            success: function(result){
                location.href=site_url+"/check/list";
            }
        });
    });
});
