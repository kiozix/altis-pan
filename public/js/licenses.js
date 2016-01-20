$(function () {
    var setLicenses = function (userId, csrfToken, type, id) {
        var updateUrl = $(".licenses").data("callback");
        var csrfToken = csrfToken;
        var userId = userId;
        var type = type;
        var id = id;
        console.log('Update URL : '+updateUrl)
        console.log('csrfToken : '+csrfToken)
        console.log('userId : '+userId)
        console.log('type : '+type)
        console.log('id : '+id)

        $.ajax({
            type: "POST",
            url: updateUrl,
            data: {type: type, pid:userId, id:id, _token:csrfToken},
            success: function (msg) {
                // Récupération des données du echo dans un tableau
                var res = msg.split(";");
                if (res[0] == 0) {
                    location.reload();
                    //alert("type "+res[0] + " - msg : "+res[1]);
                }
                if (res[0] == 1) {
                    //alert("type "+res[0] + " - msg : "+res[1]);
                    location.reload();
                }
                if (res[0] == 2) {
                    alert("type " + res[0] + " - msg : " + res[1]);
                }
            }
        });
        console.log('FIN')
        return false;
    }

    $(".licenses").on("click","a.licenses-list",function(event){
        event.preventDefault();
        console.log('INIT')
        var userId = $(this).data("user");
        var csrfToken = $(this).data("csrf");
        var type = $(this).data("type");
        var id = $(this).data("id");
        setLicenses(userId, csrfToken, type, id);
    });
});
