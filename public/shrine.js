$(document).ready(function () {
    // For text, email, password, tel, date fields
    $("#registerForm input").on("input", function () {
        let fieldName = $(this).attr("name");
        $("." + fieldName + "_error").text("");
    });

    // For dropdowns (select) and checkbox
    $("#registerForm select, #registerForm input[type='checkbox']").on("change", function () {
        let fieldName = $(this).attr("name");
        $("." + fieldName + "_error").text("");
    });
    
    $("#registerForm").on("submit", function (e) {
        e.preventDefault(); // stop form from reloading page
        $(".error-text").text(""); // clear old errors

        let $btn = $("#registerBtn"); // ✅ target submit button
        let originalBtnHtml = $btn.html();

        // Show loader inside button
        $btn.html('<span class="spinner-border spinner-border-sm me-2"></span> Processing...')
            .prop("disabled", true);

        $.ajax({
            url: registerUrl, // from Blade
            type: "POST",
            data: $(this).serialize(),
            success: function(response){
                if(response.status === 200){
                    // ✅ Show success popup
                    $("body").append(`
                        <div id="successPopup" style="
                            position: fixed;
                            top: 0; left: 0; right: 0; bottom: 0;
                            background: rgba(0,0,0,0.3);
                            z-index: 9999;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        ">
                            <div style="
                                background: #fff;
                                padding: 30px 40px;
                                border-radius: 10px;
                                box-shadow: 0 2px 16px rgba(0,0,0,0.2);
                                text-align: center;
                                min-width: 300px;
                            ">
                                <span class="text-success" style="font-size:1.2rem;">${response.message}</span>
                            </div>
                        </div>
                    `);
                    setTimeout(function(){
                        $("#successPopup").fadeOut(800, function() { $(this).remove(); });
                    }, 2200);
                    
                    $("#registerForm")[0].reset();
                    
                    setTimeout(function(){
                        $('#registerModal').modal('hide'); 
                    }, 3000); 
                }

                // ✅ Reset button back
                $btn.html(originalBtnHtml).prop("disabled", false);
            },
            error: function(xhr){
                if(xhr.status === 422){ // validation error
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value){
                        $("."+key+"_error").text(value[0]); // place error under input
                    });
                }

                // ❌ On error also reset button
                $btn.html(originalBtnHtml).prop("disabled", false);
            }
        });
    });

    // Load cities JSON
    $.getJSON("/tamilnadu.json", function (data) {
        let tnCities = data["tamil-nadu"];
        $("#city").html('<option value="">Select City/District</option>');
        $.each(tnCities, function (key, value) {
            $("#city").append('<option value="' + value.toLowerCase().replace(/\s+/g, '-') + '">' + value + '</option>');
        });
    });
});
