<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PalindromController extends Controller
{
    public function index()
    {
        return view('palindrom.index');
    }

    public function checkPalindrom(Request $request)
    {
        $text = $request->get('text');

        $text = trim($text);

        if(preg_match('/\\s/', $text)) {
            return response()->json(['error' => 'There string has more than two words']);
        }

        $tmpText = strrev($text);

        if($tmpText == $text) {
            return response()->json([
                'message' => 'The string is a palindrom',
                'color' => 'text-green-400'
            ]);
        }

        return response()->json([
            'message' => "The string isn't a palindrom",
            'color' => 'text-red-400'
        ]);
    }
}
