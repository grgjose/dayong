$(document).ready(function () {

    // Members Upload Form On Submit 
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

    // Excel New Sales Upload Form On Submit
    $("#uploadForm_excelNewSales").on("submit", function (e) {

        if($('#sheets').val() == "" || $('#sheets').val() == null || $('#sheets').val() == "undefined"){
            e.preventDefault();

            var formData = new FormData(this);
    
            $.ajax({
                url: "/excel-new-sales/loadSheets",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#response").html("");
                    
                    response.forEach((sheet) => {
                        let newOption = $('<option>', { value: sheet, text: sheet }); 
                        if(sheet.includes("NS")){ $('#sheets').append(newOption).trigger("chosen:updated"); }
                    });

                },
                error: function (xhr) {
                    $("#response").html("<p>No File has been Selected</p>");
                }
            });

            $("#uploadForm_excelNewSales").attr("action", '/excel-new-sales/upload');
            $("#uploadButton_excelNewSales").removeAttr('disabled');
        } else {
            
        }
    });

});