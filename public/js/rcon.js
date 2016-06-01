$(function(){

    var RconSay = function(callback, csrf){
        var callback = callback;
        var csrf = csrf;

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
                        url: callback,
                        cache: false,
                        data: { message: inputValue, _token: csrf }
                    })
                    .done(function(data){
                        swal("Effectuer !", "Votre message à bien été envoyer.", "success");
                    }).fail(function(e){
                        swal("Erreur !", "Une erreur c'est produite", "error");
                    }
                );
            });
    }

    var RconKick = function(callback, csrf, id, playerid){
        var callback = callback;
        var csrf = csrf;
        var id = id;
        var playerid = playerid;

        swal({
            title: "Kick",
            text: "Raison :",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Raison..." },

            function(inputValue){
                if (inputValue === false) return false;
                if (inputValue === "") {
                    swal.showInputError("Veuillez entrer une raison.");
                    return false
                }

                $.ajax({
                        method: "POST",
                        url: callback,
                        cache: false,
                        data: { raison: inputValue, id: id, playerid: playerid, _token: csrf }
                    })
                    .done(function(data){
                        swal("Effectuer !", "Le joueur à bien été kicker", "success");
                    }).fail(function(e) {
                        swal("Erreur !", "Une erreur c'est produite", "error");
                    }
                );
            });
    }

    var RconMp = function(callback, csrf, id){
        var callback = callback;
        var csrf = csrf;
        var id = id;

        swal({
                title: "Message privé",
                text: "Message :",
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
                        url: callback,
                        cache: false,
                        data: { message: inputValue, id: id, _token: csrf }
                    })
                    .done(function(data){
                        swal("Effectuer !", "Le message à bien été envoyer", "success");
                    }).fail(function(e) {
                        swal("Erreur !", "Une erreur c'est produite", "error");
                    }
                );
            });
    }

    $( "#say" ).click(function(event) {
        event.preventDefault();
        var callback = $(this).data("callback");
        var csrf = $(this).data("csrf");
        RconSay(callback, csrf);
    });

    $( "#kick" ).click(function(event) {
        event.preventDefault();
        var callback = $(this).data("callback");
        var csrf = $(this).data("csrf");
        var id = $(this).data("id");
        var playerid = $(this).data("playerid");
        RconKick(callback, csrf, id, playerid);
    });

    $( "#mp" ).click(function(event) {
        event.preventDefault();
        var callback = $(this).data("callback");
        var csrf = $(this).data("csrf");
        var id = $(this).data("id");
        RconMp(callback, csrf, id);
    });

})
