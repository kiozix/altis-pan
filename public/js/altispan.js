$(function(){

    var deleteUserGroup = function(user, csrfToken){
        var deleteUrl = $(".group-members").data("callback");
        var groupId = $(".group-members").data("group");
        var crsfToken = csrfToken;
        var groupName = $(".group-members").data("groupname");
        var userId = user;
        swal({
            title: "Voulez supprimer l'utilisateur du groupe "+groupName + " ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Valider la suppression !",
            cancelButtonText: "Annuler",
            closeOnConfirm: false,
            closeOnCancel: false
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
                         $(".group-members a.group-userlist[data-user='" + user + "']").parent().parent().remove();
                         swal("Utilisateur bien supprimé du groupe ", null, "success");

                 });

         }else {
             swal("Annuler", "Le joueur n'a pas été suprimmer", "error");
         }
        }
        )
    }

    $(".group-members").on("click","a.group-userlist",function(event){
        event.preventDefault();
        var userId = $(this).data("user");
        var csrfToken = $(this).data("csrf");
        deleteUserGroup(userId, csrfToken);
    });

    $(".player-gang").select2({
        placeholder: "Chercher un utilisateur",
        allowClear: true,
        minimumResultsForSearch: 2
    });
})