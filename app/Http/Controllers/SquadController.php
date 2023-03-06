<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SquadController extends Controller
{
    public function listSquad(){
        
        $squad = DB::select('SELECT * FROM squad');

        return $squad;
    }

    public function addSquad(Request $request){

        $name = $request['name'];

        DB::insert('INSERT INTO squad (name)
        VALUES (:name)', [                
            'name' => $name,          
        ]);

    }
}
