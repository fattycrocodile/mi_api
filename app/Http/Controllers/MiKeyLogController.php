<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MiKeyInformation;
use App\Models\MiKeyLog;

class MiKeyLogController extends Controller
{
    //
    public function index(MiKeyInformation $mi_key_information)
    {
        return $mi_key_information->key_logs->all();
    }


    public function store(Request $request, $mi_key_information)
    {
        return MiKeyLog::create(array_merge($request->all(), ["key_id" => $mi_key_information]));
    }

    public function update(Request $request, MiKeyLog $mi_key_log)
    {
        $mi_key_log->update($request->all());

        return $mi_key_log;
    }

    public function delete(MiKeyLog $mi_key_log)
    {
        $mi_key_log->delete();

        return 204;
    }
}
