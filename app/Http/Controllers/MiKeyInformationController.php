<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MiKeyInformation;
use App\Models\MiServer;

class MiKeyInformationController extends Controller
{
    //
    public function index(MiServer $mi_server)
    {
        return $mi_server->key_informations->all();
    }


    public function store(Request $request, $mi_server)
    {
        return MiKeyInformation::create(array_merge($request->all(), ["server_id" => $mi_server]));
    }

    public function update(Request $request, MiKeyInformation $mi_key_information)
    {
        $mi_key_information->update($request->all());

        return $mi_key_information;
    }

    public function delete(MiKeyInformation $mi_key_information)
    {
        $mi_key_information->delete();

        return 204;
    }
}
