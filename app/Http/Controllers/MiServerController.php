<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MiServer;

class MiServerController extends Controller
{
    //
    public function index()
    {
        return MiServer::all();
    }

    public function show(MiServer $mi_server)
    {
        return $mi_server;
    }

    public function store(Request $request)
    {
        return MiServer::create($request->all());
    }

    public function update(Request $request, MiServer $mi_server)
    {
        $mi_server->update($request->all());

        return $mi_server;
    }

    public function delete(MiServer $mi_server)
    {
        $mi_server->delete();

        return 204;
    }
}
