<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\UnisocRSAKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UnisocRSAKeyController extends Controller
{

    public function itel_keys() {
        $key = UnisocRSAKey::query();
        $key = $key->where([
            'key_type' => 'itel',
            'status' => 'pending'
        ])->firstOrFail();
        return new TaskResource($key);
    }

    public function lenovo_keys() {
        $key = UnisocRSAKey::query();
        $key = $key->where([
            'key_type' => 'lenovo',
            'status' => 'pending'
        ])->firstOrFail();
        return new TaskResource($key);
    }

    public function generate_itel_key(Request $request) {

        $this->validate($request, [
            'deviceToken' => 'required'
        ]);

        $key = new UnisocRSAKey;
        $key->key = $request->deviceToken;
        $key->key_type = 'itel';
        $key->save();

        $key_resp = UnisocRSAKey::findorfail($key->id);


        return response()->json([
            'data' => $key_resp->token,
            'status' => $key_resp->status
        ]);
    }

    public function update_itel_key(Request $request, $id) {

        $this->validate($request, [
            'status' => 'required'
        ]);

        $key = UnisocRSAKey::findorfail($id);
        $key->token = $request->token;
        $key->status = $request->status;
        $key->save();

        return $key;
    }

    public function generate_lenovo_key(Request $request) {

        $this->validate($request, [
            'deviceToken' => 'required'
        ]);


        $key = new UnisocRSAKey;
        $key->key = $request->deviceToken;
        $key->key_type = 'lenovo';
        $key->save();

        $is_done = false;
        while(!$is_done) {
            $key_resp = UnisocRSAKey::findorfail($key->id);
            if($key_resp->status != 'pending') {
                $is_done = true;
            }
        }

        return response()->json([
            'data' => $key_resp->token,
            'status' => $key_resp->status
        ]);
    }

    public function update_lenovo_key(Request $request, $id) {

        $this->validate($request, [
            'status' => 'required'
        ]);

        $key = UnisocRSAKey::findorfail($id);
        $key->token = $request->token;
        $key->status = $request->status;
        $key->save();

        return $key;
    }

}
