<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Archive extends Model
{
    use HasFactory;
    protected $table = 'archives';
    protected $fillable = [
        'my_id',
        'user_id',
        'last_message',
        'status',
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
