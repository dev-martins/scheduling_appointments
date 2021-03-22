<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Channel extends Model
{
    use HasFactory;

    public static function getChannels()
    {
        $key = Credential::getCredential();

        $url = 'https://api.feegow.com/v1/api/patient/list-sources';
        $response = Http::withHeaders([
            'x-access-token'   => $key->token,
        ])->get($url);

        return json_decode($response->body());
    }
}
