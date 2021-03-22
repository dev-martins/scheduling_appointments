<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Professional extends Model
{
    use HasFactory;

    public static function getProfessionals($id_especialty){

        $key = Credential::getCredential();

        $url = 'https://api.feegow.com/v1/api/professional/list?especialidade_id='.$id_especialty;
        $response = Http::withHeaders([
            'x-access-token'   => $key->token,
        ])->get($url);

        return json_decode($response->body());
    }
}
