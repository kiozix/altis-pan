$(function(){

    var RconSay = function(deleteUrl, csrf){
        var deleteUrl = deleteUrl;
        var csrf = csrf;

        console.log(deleteUrl, csrf)

        swal({
            title: "Message Global",
            text: "Votre message :",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Message..." },
            function(inputValue){
                if (inputValue === false) return false;
                if (inputValue === "") {
                    swal.showInputError("Veuillez entrer un message.");
                    return false
                }

                $.ajax({
                        method: "POST",
                        url: deleteUrl,
                        cache: false,
                        data: { message: inputValue, _token: csrf }
                    })
                    .done(function(data){
                        swal("Effectuer!", "Votre message à bien été envoyer.", "success");
                    }).fail(function(e){
                });
            });
    }

    $( "#say" ).click(function(event) {
        event.preventDefault();
        var deleteUrl = $(this).data("callback");
        var csrf = $(this).data("csrf");
        RconSay(deleteUrl, csrf);
    });

})