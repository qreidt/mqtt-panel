<?php

namespace App\Mqtt\Models;

use App\Models\Team;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MqttClient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'team_id',
        'name',
        'mqtt_id'
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
