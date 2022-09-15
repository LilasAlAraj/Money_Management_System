<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outgoing extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'details',
        'id'
    ];

    public function date()
    {
        return str_replace(substr($this->created_at, 10), '', $this->created_at);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
