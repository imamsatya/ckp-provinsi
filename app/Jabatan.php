<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    //
    protected $table = 'jabatans';

    protected $fillable = [
        'jabatan_kantor', 'role', 'created_at'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
