<?php
namespace app\AltisPan;
use Illuminate\Support\Facades\DB;

class Vehicule
{
    public function transfert($id, $owner){
        DB::table('vehicles')
            ->where('id', $id)
            ->update(array(
                'pid' => $owner,
            ));
    }

    public function delete($id){
        DB::table('vehicles')->where('id', $id)->delete();
    }
}