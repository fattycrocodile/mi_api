<?php

namespace App\Http\Controllers;

use App\Helpers\RequestHelper;
use App\Http\Resources\TaskResource;
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'key' => 'required'
        ]);
        $keyInfo = new MiKeyInformation();
        $keyInfo->key = $request->key;
        if(isset($request->key_type)) {
            $keyInfo->key_type = $request->key_type;
        }
        $keyInfo->client_ip = RequestHelper::clientIp($request);
        $keyInfo->save();
        $keyInfo = MiKeyInformation::find($keyInfo->id);
        return new TaskResource($keyInfo);
    }

    public function show($id) {
        $keyInfo = new MiKeyInformation($id);
        return new TaskResource($keyInfo);
    }

    public function update(Request $request, $id)
    {
        $mi_key_information = MiKeyInformation::findorfail($id);
        $mi_key_information->token = $request->token;
        $mi_key_information->server_ip = RequestHelper::clientIp($request);
        $mi_key_information->status = $request->status;
        $mi_key_information->save();
        return $mi_key_information;
    }

    public function delete(MiKeyInformation $mi_key_information)
    {
        $mi_key_information->delete();

        return 204;
    }
}
