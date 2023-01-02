<?php

namespace App\Http\Controllers;

use App\Helpers\RequestHelper;
use App\Models\MiServer;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class MiSLALoaderController extends Controller
{


    public function load_mi($type) {

        $server = MiServer::query();

        $server = $server->where(function($query) use ($type) {
            $query->where(function($query) {
                $query->whereNull('count')
                ->orwherecolumn('limit', '>', 'count');
            })
            ->where(function($query) use ($type) {
                $query->where('job_type', '=', $type)
                ->orwhere('job_type', '=', 'all');
            })
            ->where(function($query) {
                $query->WhereNull('execution_time')
                ->orWhere('execution_time', '<=', now()->toDateTimeString());
            })
            ->where([
                ['status', '=', 'online'],
                ['is_active', '=', true]
            ]);
        })->inRandomOrder()->first();

        return $server;
    }

    public function mi_online_time($type) {
        $online = MiServer::query();

        $online = $online->where(function($query) use ($type) {
            $query->where(function($query) {
                $query->whereNull('count')
                ->orwhereColumn('limit', '>', 'count');
            })
            ->where(function($query) use ($type) {
                $query->where('job_type', '=', $type)
                ->orwhere('job_type', '=', 'all');
            })
            ->where(function($query) {
                $query->WhereNull('execution_time')
                ->orWhere('execution_time', '>', now()->toDateTimeString());
            })
            ->where([
                ['status', '=', 'online'],
                ['is_active', '=', true]
            ]);
        })->inRandomOrder()->first('execution_time');

        return empty($online) ? 'Server is offline' :  'Online will available at: ' . Carbon::parse($online->execution_time)->diffForHumans();
    }

    public function update_mi_server($id, $step, $time = null, $type = null) {
        $model = MiServer::findorfail($id);
        $model->count += $step;
        ($time == null && $type == null) ?: $model->execution_time = RequestHelper::convert_period($type, $time);
        $model->save();
        return $model;
    }



    public function xetoken(Request $request) {

        $this->validate($request, [
            'deviceToken' => 'required'
        ]);

        $app_info = $this->load_mi('flash');

        if(empty($app_info)) {
            $resp_array = [
                "data" => $this->mi_online_time('flash'),
                "status" => false
            ];
            return json_encode($resp_array);
        }

        $key_data = [
            'server_id' => $app_info->id,
            'key' => $request->deviceToken,
            'key_type' => 'fastboot'
        ];

        $key_resp = app(MiKeyInformationController::class)->store($request->merge($key_data));

        sleep(3);

        return app(MiKeyInformationController::class)->show($key_resp->work_id);
    }


}
