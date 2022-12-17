<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MiServer;
use App\Models\MiServerLog;

class MiServerLogController extends Controller
{
    //
    public function index(MiServer $mi_server)
    {
        return $mi_server->server_logs->all();
    }


    public function store(Request $request, $mi_server)
    {
        return MiServerLog::create(array_merge($request->all(), ["server_id" => $mi_server]));
    }

    public function update(Request $request, MiServerLog $mi_server_log)
    {
        $mi_server_log->update($request->all());

        return $mi_server_log;
    }

    public function delete(MiServerLog $mi_server_log)
    {
        $mi_server_log->delete();

        return 204;
    }
}
