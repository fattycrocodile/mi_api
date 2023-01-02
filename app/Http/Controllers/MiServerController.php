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
        $servers = MiServer::query();
        return datatables()->eloquent($servers)->toJson();
    }

    public function show($id)
    {
        $mi_server = MiServer::findorfail($id);
        return $mi_server;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|unique:mi_servers,auth_uid'
        ]);

        $server = new MiServer();
        $server->name = $request->name;
        $server->ip = RequestHelper::clientIp($request);
        $server->region = $request->region;
        $server->pcid = $request->pcid;
        $server->auth_uid = !$request->has('user_id') ?: $request->user_id;
        $server->passToken = $request->token;
        $server->limit = $request->limit;
        $server->status = !$request->has('status') ?: $request->status;
        $server->job_type = !$request->has('job_type') ?: $request->job_type;
        $server->interval = $request->interval;
        $server->interval_type = $request->interval_type;
        $server->is_active = !$request->has('is_active') ?: $request->is_active;
        $server->save();

        return response()->json([
            'message' => 'Server added successfully',
            'status' => 'success'
        ]);
    }

    public function update(Request $request,$id)
    {
        $server = MiServer::findorfail($id);
        !$request->has('name') ?: $server->name = $request->name;
        !$request->has('region') ?: $server->region = $request->region;
        !$request->has('pcid') ?: $server->pcid = $request->pcid;
        !$request->has('auth_uid') ?: $server->auth_uid = $request->auth_uid;
        !$request->has('token') ?: $server->passToken = $request->token;
        !$request->has('limit') ?: $server->limit = $request->limit;
        !$request->has('status') ?: $server->status = $request->status;
        !$request->has('job_type') ?: $server->job_type = $request->job_type;
        !$request->has('interval') ?: $server->interval = $request->interval;
        !$request->has('interval_type') ?: $server->interval_type = $request->interval_type;
        !$request->has('is_active') ?: $server->is_active = $request->is_active;
        $server->save();

        return response()->json([
            'message' => "{$server->pcid} Server updated successfully",
            'status' => true
        ]);
    }

    public function destroy($id)
    {
        $server = MiServer::findorfail($id);

        if(!$server->keys_list->isEmpty()) {
            return response()->json([
                'message' => 'Server already has keys list',
                'status' => true
            ], 500);
        }

        $server->delete();

        return response()->json([
            'message' => "{$server->pcid} Server is deleted successfully",
            'status' => true
        ]);
    }
}
