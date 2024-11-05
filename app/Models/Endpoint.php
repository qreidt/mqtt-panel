<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endpoint extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'team_id',
        'name',
        'path'
    ];

    public function scopeTeam(Builder $query): Builder
    {
        $team_id = Filament::getTenant()->id;
        return $query->where('team_id', $team_id);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
