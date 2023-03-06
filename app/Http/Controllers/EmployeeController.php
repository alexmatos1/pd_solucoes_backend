<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function addEmployee(Request $request){       

        $name = $request['name'];
        $estimatedHours = $request['estimatedHours'];
        $squadId = $request['squadId'];

        $squad = DB::select('SELECT id FROM squad WHERE id = :squadId', [
            'squadId' => $squadId
        ]);

        $verifica = sizeof($squad);        

        if($verifica == 1){
            DB::insert('INSERT INTO employee (name, estimatedHours, squadId)
            VALUES (:name, :estimatedHours, :squadId)', [                
                'name' => $name,          
                'estimatedHours' => $estimatedHours,          
                'squadId' => $squadId,          
            ]);
        }
    }

    public function squadTime(Request $request){

        $squadId = $request['squadId']; 

        $totalSquad = DB::select("SELECT SUM(rp.spentHours) as squadHours FROM report rp
            inner join employee em on em.id = rp.employeeId
            where em.squadId =:squadId", ['squadId' => $squadId]);

        return $totalSquad;

    }

    public function employeeTime(Request $request){

        $squadId = $request['squadId']; 

        $totalSquad = DB::select("SELECT SUM(rp.spentHours) as employeeHours FROM report rp
            inner join employee em on em.id = rp.employeeId
            where em.squadId =:squadId GROUP BY rp.employeeId", ['squadId' => $squadId]);

        return $totalSquad;

    }

}
