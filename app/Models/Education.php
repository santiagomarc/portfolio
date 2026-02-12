<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'user_id',
        'degree',
        'school_details',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
