<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateClientsRequest;
use App\Http\Controllers\Clases\Client;

class ClientController extends Controller
{
    function processClient(ValidateClientsRequest $request) {
        // Reading the json uploaded
        $readFile = file_get_contents($request->file('file'));
        // Convert content to Object
        $json_clients = json_decode($readFile);
        // Create Clients
        $clients = Client::createClients($json_clients);
        // Process data
        $processed_clients = count($clients);
        $approved_clients = 0;
        $rejected_clients = 0;
        $accumulateApprovedAmount = 0;
        foreach ($clients as $index => $client) {
            $client->processClient();
            $approved_clients = $client->getApprovedClientsAmount($approved_clients);
            $rejected_clients = $client->getRejectedClientsAmount($rejected_clients);
            $accumulateApprovedAmount = $client->accumulateApprovedAmount($accumulateApprovedAmount);
        }
        $amount_approved_average = Client::calculateAmountApprovedAverage($accumulateApprovedAmount, $processed_clients);
        return view('index', compact('clients', 'processed_clients', 'approved_clients', 'rejected_clients', 'accumulateApprovedAmount', 'amount_approved_average'));
    }
}
