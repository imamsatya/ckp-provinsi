<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ratarata extends Model
{
    //
     //
    protected $table = 'rataratas';

    protected $fillable = [
        'ratarata', 'bulan', 'created_at'
    ];

    public function user()
    {
    return $this->belongsTo('App\User');
    }
    
}
