<?php

namespace App\Helpers;


class RequestHelper {
    public static function clientIp($request) {
        if( !empty( $request->server('HTTP_CF_CONNECTING_IP') ) ){
            return $request->server('HTTP_CF_CONNECTING_IP');
        }
        return $request->getClientIp();
    }
}
