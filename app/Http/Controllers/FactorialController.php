<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FactorialController extends Controller
{
    public function index()
    {
        return view('factorial.index');
    }

    public function calculateFactorial(Request $request) 
    {
        // $request->validate([
        //     'number' => 'numeric|gte:1'
        // ]);

        $number = $request->get('number');
        if(!$this->validatePositiveNumber($number)) {
            return response()->json(['error' => 'Not valid Number'], 422);
        }

        $response = [
            'factorial' => number_format($this->factorial($number), 0, '.', ',')
        ];
        
        return response()->json($response);
    }

    private function factorial($number)
    {
        $result = 1;
        for($i = 1; $i <= $number; $i++) {
            $result *= $i;
        }

        return $result;
    }

    private function validatePositiveNumber($number)
    {
        $number = (int)$number;
        if($number < 1) {
            return false;
        }

        return true;
    }
}
