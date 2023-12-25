<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phones';
    protected $guarded = [];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
