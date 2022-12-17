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

    public function server()
    {
        return $this->belongsTo(MiServer::class);
    }

    public function key_logs()
    {
        return $this->hasMany(MiKeyLog::class, 'key_id');
    }
}
