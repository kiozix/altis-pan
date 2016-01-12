/**
 * Created by Emile on 12/01/2016.
 */

function SAVElicenses(type, id){
    $(document).ready( function () {
        $.ajax({
            type: "POST",
            url: "/ajax/update_licences.php",
            data: "type="+type+"&pid=<?=$players->playerid;?>"+"&id="+id,
            success: function(msg){
                // Récupération des données du echo dans un tableau
                var res = msg.split(";");
                if(res[0]==0){
                    location.reload();
                    //alert("type "+res[0] + " - msg : "+res[1]);
                }
                if(res[0]==1){
                    //alert("type "+res[0] + " - msg : "+res[1]);
                    location.reload();
                }
                if(res[0]==2){
                    alert("type "+res[0] + " - msg : "+res[1]);
                }
            }
        });
        return false;
    });
}