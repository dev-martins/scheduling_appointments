<?php

namespace App\Http\Controllers\Scheduling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Models\Professional;
use App\Models\Channel;
use App\Models\Scheduling;

class SchedulingController extends Controller
{
    public function getSpecialties(Specialty $specialty)
    {
        try {
            $specialties = $specialty->list_of_specialties();
            return response()->json($specialties, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage()], 500);
        }
    }

    public function getProfessionals($id_especialty)
    {
        try {
            $professionals =  Professional::getProfessionals($id_especialty);
            return response()->json($professionals, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage()], 500);
        }
    }

    public function getChannels()
    {
        try {
            $channels = Channel::getChannels();
            return response()->json($channels, 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage()], 500);
        }
    }

    public function scheduling(Request $req)
    {
        try {
            Scheduling::create($req->all());
            return response()->json(["msg" => "Consulta agendada"], 201);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage()], 500);
        }
    }
}
