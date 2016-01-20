$(function () {
    var setLicenses = function (userId, csrfToken, type, id, group) {
        var updateUrl = $(".licenses").data("callback");
        var csrfToken = csrfToken;
        var userId = userId;
        var type = type;
        var id = id;
        var group = group

        $.ajax({
            type: "POST",
            url: updateUrl,
            data: {type: type, pid:userId, id:id, _token:csrfToken, group:group},
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
        return false;
    }

    $(".licenses").on("click","a.licenses-list",function(event){
        event.preventDefault();
        var userId = $(this).data("user");
        var csrfToken = $(this).data("csrf");
        var type = $(this).data("type");
        var id = $(this).data("id");
        var group = $(this).data("group");
        setLicenses(userId, csrfToken, type, id, group);
    });
});
