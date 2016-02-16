<?php

namespace app\AltisPan;
use Illuminate\Support\Facades\DB;

class Money
{
    public function AddMoney($id, $amount){

        $player = DB::table('players')->where('playerid', $id)->first();
        $amount = $player->bankacc + $amount;

        DB::table('players')
            ->where('playerid', $id)
            ->update(array(
                'bankacc' => $amount
            ));
    }

    public function RemoveMoney($id, $amount){

        $player = DB::table('players')->where('playerid', $id)->first();

        $amount = $player->bankacc - $amount;

        if($amount <= 0){
            $amount = 0;
        }

        DB::table('players')
            ->where('playerid', $id)
            ->update(array(
                'bankacc' => $amount
            ));
    }
}