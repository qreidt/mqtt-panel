<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthApiTokenController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $data = $this->validate();

        $team = Team::query()
            // Filter and query mqtt client if exists by MQTT ID
            ->withWhereHas('mqttClients',
                fn(Builder|HasMany $q) => $q->where('mqtt_id', $data['client_id']))

            // Filter and query by api token credentials
            ->withWhereHas('apiTokens',
                fn(Builder|HasMany $q) => $q->where([
                    'key' => $data['api_key'],
                    'secret' => $data['api_secret']
                ]))

            ->first();

        // Return http status 401 [unauthorized] if query not successful
        if (! $team) {
            return response()->json([
                'message' => 'Credentials Unauthorized',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'team_id' => $team->id,
            'api_token_id' => $team->apiTokens->first()->id,
            'mqtt_client_id' => $team->mqttClients->first()->id,
        ]);
    }

    /**
     * Validate incoming request
     *
     * @return array{client_id: string, api_key: string, api_secret: string}
     */
    private function validate(): array
    {
        return request()->validate([
            'client_id' => ['required', 'string'],
            'api_key' => ['required', 'string'],
            'api_secret' => ['required', 'string'],
        ]);
    }
}
