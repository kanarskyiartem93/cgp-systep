<?php

namespace App\Http\Controllers\Api\FieldsForForms;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\ClientFormResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientIndexController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $clients = Client::where('first_name', 'like', '%' . $search . '%')
            ->orWhere('last_name', 'like', '%' . $search . '%')
            ->orderBy('last_name', 'asc')
            ->select('id', 'first_name', 'last_name')
            ->limit(7)
            ->get();

        return ClientFormResource::collection($clients);
    }
}
