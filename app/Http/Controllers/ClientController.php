<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateClientsRequest;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    function processClient(ValidateClientsRequest $request) {
        // Reading the json uploaded
        $readFile = file_get_contents($request->file('file'));
        // Convert content to Object
        $json_clients = json_decode($readFile);
        return view('index');
    }
}
