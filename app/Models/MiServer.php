<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MiServerLog;
use App\Models\MiKeyInformation;
use App\Models\MiKeyLog;

class MiServer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function server_logs()
    {
        return $this->hasMany(MiServerLog::class, 'server_id');
    }

    public function key_informations()
    {
        return $this->hasMany(MiKeyInformation::class, 'server_id');
    }

    public function key_logs()
    {
        return $this->hasManyThrough(
            MiKeyLog::class,
            MiKeyInformation::class,
            'server_id',
            'key_id',
            'id',
            'id'
        );
    }
}
