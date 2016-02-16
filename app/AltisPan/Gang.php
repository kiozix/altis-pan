<?php
namespace app\AltisPan;
use Illuminate\Support\Facades\DB;
class Gang {

    public function DelMember($playerId, $groupId){

        $gang = DB::table('gangs')->where('id', $groupId)->first();

        $suppr = array("\"", "`", "[", "]");
        $lineGang = str_replace($suppr, "", $gang->members);
        $ArrayGang = preg_split("/,/", $lineGang);
        $gangMembers = array();

        foreach ($ArrayGang as $member) {
        $gangMembers[] = $member;
        }
        unset($gangMembers[$playerId]);
        if(env('DB_EXTDB') == 1) {
            $gangMembersString = '[';
        }elseif(env('DB_EXTDB') == 2){
            $gangMembersString = '"[';
        }
        $gangList = "";
        foreach ($gangMembers as $gangMember) {
            if ($gangMember != $playerId) {
                $gangList .= "`" . $gangMember . "`,";
            }
        }
        $gangList = rtrim($gangList, ",");
        $gangMembersString .= $gangList;
        if(env('DB_EXTDB') == 1) {
            $gangMembersString .= ']';
        }elseif(env('DB_EXTDB') == 2){
            $gangMembersString .= ']"';
        }

        DB::table('gangs')
            ->where('id', $groupId)
            ->update(array(
                'members' => $gangMembersString,
            ));
    }
}