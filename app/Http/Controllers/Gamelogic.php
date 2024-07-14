<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Winner;

class Gamelogic extends Controller
{
    /**
     * Store a newly created winner in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'number' => [
                'required',
                'string',
                'unique:winners,number'
            ]
        ]);

        // Create a new winner record
        $store = Winner::create($validatedData);

        // Return a response, e.g., the created store record
        return response()->json($store, 201);
    }

    public function winner(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            
        ]);

        // Create a new winner record
        $winner = Winner::create($validatedData);

        // Return a response, e.g., the created winner record
        return response()->json($winner, 201);
    }
}
