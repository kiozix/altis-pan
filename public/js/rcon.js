$(function(){

    var uid2guid = function(uid) {
        if (!uid) {
            return;
        }

        var steamId = bigInt(uid);

        var parts = [0x42, 0x45, 0, 0, 0, 0, 0, 0, 0, 0];

        for (var i = 2; i < 10; i++) {
            var res = steamId.divmod(256);
            steamId = res.quotient;
            parts[i] = res.remainder.toJSNumber();
        }

        var wordArray = CryptoJS.lib.WordArray.create(new Uint8Array(parts));
        var hash = CryptoJS.MD5(wordArray);
        return hash.toString();
    };

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

    var RconKick = function(callback, csrf, id){
        var callback = callback;
        var csrf = csrf;
        var id = id;

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
                        data: { raison: inputValue, id: id, _token: csrf }
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

    var RconBan = function(callback, csrf, id){
        var callback = callback;
        var csrf = csrf;
        var uid = id;
        var guid = uid2guid(uid);

        console.log(guid)

        swal({
                title: "Ban",
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

                var raison = inputValue;

                swal({
                        title: "Ban",
                        text: "Durée (min):",
                        type: "input",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        animation: "slide-from-top",
                        inputPlaceholder: "Durée en minutes..." },

                    function(inputValue){
                        if (inputValue === false) return false;
                        if (inputValue === "") {
                            swal.showInputError("Veuillez entrer une durée.");
                            return false
                        }

                        $.ajax({
                                method: "POST",
                                url: callback,
                                cache: false,
                                data: { raison: raison, guid: guid, time: inputValue,_token: csrf }
                            })
                            .done(function(data){
                                swal("Effectuer !", "Le joueur à bien été ban", "success");
                            }).fail(function(e) {
                                swal("Erreur !", "Une erreur c'est produite", "error");
                            }
                        );

                    }
                );

            }
        );
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
        RconKick(callback, csrf, id);
    });

    $( "#mp" ).click(function(event) {
        event.preventDefault();
        var callback = $(this).data("callback");
        var csrf = $(this).data("csrf");
        var id = $(this).data("id");
        RconMp(callback, csrf, id);
    });

    $( "#ban" ).click(function(event) {
        event.preventDefault();
        var callback = $(this).data("callback");
        var csrf = $(this).data("csrf");
        var id = $(this).data("id");
        RconBan(callback, csrf, id);
    });

})