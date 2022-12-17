<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MiKeyInformation;

class MiKeyLog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function key_information()
    {
        return $this->belongsTo(MiKeyInformation::class, 'key_id');
    }
}
