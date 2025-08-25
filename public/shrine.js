$(document).ready(function () {
    $("#registerForm").on("submit", function (e) {
        e.preventDefault(); // stop form from reloading page
        alert(1);
        $(".error-text").text(""); // clear old errors

        $.ajax({
            url: registerUrl, // from Blade
            type: "POST",
            data: $(this).serialize(),
            success: function(response){
                if(response.status === 200){
                    $("#responseMsg").html('<span class="text-success">'+response.message+'</span>');
                    $("#registerForm")[0].reset();
                }
            },
            error: function(xhr){
                if(xhr.status === 422){ // validation error
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value){
                        $("."+key+"_error").text(value[0]); // place error under input
                    });
                } 
            }
        });
    });

    $.getJSON("/tamilnadu.json", function (data) {
        let tnCities = data["tamil-nadu"];
        $("#city").html('<option value="">Select City/District</option>');
        $.each(tnCities, function (key, value) {
            $("#city").append('<option value="' + value.toLowerCase().replace(/\s+/g, '-') + '">' + value + '</option>');
        });
    });
});