<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MiServer;
use App\Models\MiKeyLog;

class MiKeyInformation extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'mi_key_informations';

    public function server_info()
    {
        return $this->belongsTo(MiServer::class, 'server_id', 'id');
    }

    public function key_logs()
    {
        return $this->hasMany(MiKeyLog::class, 'key_id');
    }
}
