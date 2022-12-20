<?php

namespace App\Http\Controllers;

use App\Helpers\RequestHelper;
use Illuminate\Http\Request;
use App\Models\MiServer;

class MiServerController extends Controller
{
    //
    public function index()
    {
        return MiServer::all();
    }

    public function show($id)
    {
        $mi_server = MiServer::where('name', '=', $id)->firstorFail();
        return response()->json([
            'server_ip' => $mi_server->ip,
            'server_id' => $mi_server->id,
            'status' => $mi_server->status,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|unique:mi_servers,name'
        ]);

        $server = new MiServer();
        $server->ip = RequestHelper::clientIp($request);
        $server->name = $request->user_id;
        $server->save();

        return response()->json([
            'message' => 'Server added successfully',
            'status' => 'success'
        ]);
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
