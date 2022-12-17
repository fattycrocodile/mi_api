<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MiServer;

class MiServerLog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function server()
    {
        return $this->belongsTo(MiServer::class);
    }
}
