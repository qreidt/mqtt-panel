<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiToken extends Model
{
    protected $fillable = [
        'team_id',
        'name',
        'key',
        'secret',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
