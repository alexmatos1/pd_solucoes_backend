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

        $employee = DB::select('SELECT id FROM employee WHERE id = :employeeId', [
            'employeeId' => $employeeId
        ]);

        $verifica = sizeof($employee); 

        if($verifica == 1){
            DB::insert('INSERT INTO report (description, employeeId, spentHours)
            VALUES (:description, :employeeId, :spentHours)', [                
                'description' => $description,          
                'employeeId' => $employeeId,          
                'spentHours' => $spentHours,          
            ]);
        }
    }   
 
}
