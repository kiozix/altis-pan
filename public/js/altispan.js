$(function(){

    var deleteUserGroup = function(user, csrfToken){
        var deleteUrl = $(".group-members").data("callback");
        var groupId = $(".group-members").data("group");
        var crsfToken = csrfToken;
        var groupName = $(".group-members").data("groupname");
        var userId = user;
        console.log("SUPPRESSION AVEC LES PARAMETRES SUIVANTS:");
        console.log(deleteUrl,groupId, groupName, userId, crsfToken);
        swal({
            title: "Voulez vous supprimer cet utilisateur du groupe "+groupName,
            text: "Ceci supprime definitivement l utilisateur du groupe",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Oui, supprimer le!",
            cancelButtonTex: "Annuler",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
         if(isConfirm) {
             $.ajax({
                 method: "POST",
                 url: deleteUrl,
                 cache: false,
                 data: { groupId: groupId, userId: userId, _token: crsfToken }
                 })
                 .done(function(data){
                        console.log($(".group-members a.group-userlist").find("[data-user='" + user + "']"));
                         $(".group-members a.group-userlist[data-user='" + user + "']").parent().parent().remove();
                         swal("Utilisateur bien supprimé du groupe ", null, "success");

                 });

         }
        }
        )
    }

    $(".group-members").on("click","a.group-userlist",function(event){
        event.preventDefault();
        console.log("INITIALISATION SUPPRESSION UTILISATEUR DU GROUPE");
        var userId = $(this).data("user");
        var csrfToken = $(this).data("csrf");
        deleteUserGroup(userId, csrfToken);
    });
})