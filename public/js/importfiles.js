$(document).ready(function () {
    $("#uploadForm").on("submit", function (e) {

        if($('#sheets').val() == "" || $('#sheets').val() == null || $('#sheets').val() == "undefined"){
            e.preventDefault();

            var formData = new FormData(this);
    
            $.ajax({
                url: "/members/loadSheets",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#response").html("");
                    response.forEach((sheet) => {
                        let newOption = $('<option>', { value: sheet, text: sheet }); 
                        if(sheet != "QUOTA"){ $('#sheets').append(newOption).trigger("chosen:updated"); }
                    });
                },
                error: function (xhr) {
                    $("#response").html("<p>No File has been Selected</p>");
                }
            });

            $("#uploadForm").attr("action", '/members/upload');
            $("#uploadButton").removeAttr('disabled');
        } else {
            
        }
    });
});