<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function addReport(Request $request){       

        $description = $request['description'];
        $employeeId = $request['employeeId'];
        $spentHours = $request['spentHours'];
        $createdAt = date('Y/m/d');

        $employee = DB::select('SELECT id FROM employee WHERE id = :employeeId', [
            'employeeId' => $employeeId
        ]);

        $verifica = sizeof($employee); 

        if($verifica == 1){
            DB::insert('INSERT INTO report (description, employeeId, spentHours, createdAt)
            VALUES (:description, :employeeId, :spentHours, :createdAt)', [                
                'description' => $description,          
                'employeeId' => $employeeId,          
                'spentHours' => $spentHours,  
                'createdAt' => $createdAt        
            ]);
        }
    }   

    public function listReport($id, $dataInicio, $dataFim){

        $squadId = $id;
        $dtaInicio = $dataInicio;
        $dtaFim = $dataFim;
         
        
        $totalSquad = DB::select("SELECT em.name, rp.description, rp.spentHours, rp.createdAt FROM report rp
            inner join employee em on em.id = rp.employeeId
            where em.squadId =:id And rp.createdAt BETWEEN '".$dtaInicio."' AND  '".$dtaFim."'", ['id' => $squadId]);     

        return $totalSquad;

    }
 
}
