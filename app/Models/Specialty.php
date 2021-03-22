<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Specialty extends Model
{
    use HasFactory;

    public function list_of_specialties(){

        $key = Credential::getCredential();

        $url = 'https://api.feegow.com/v1/api/specialties/list';
        $response = Http::withHeaders([
            'x-access-token'   => $key->token,
        ])->get($url);

        return json_decode($response->body());
    }

    
}
