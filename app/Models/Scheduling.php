<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduling extends Model
{
    use HasFactory;

    protected $fillable = [
        "specialty_id",
        "professional_id",
        "name",
        "cpf",
        "source_id",
        "birthdate"
    ];
}
