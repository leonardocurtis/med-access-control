<?php

namespace App\Http\Controllers;

class ModuleController extends Controller
{
    public function hospitalSectors()
    {
        return view('modules.hospital-sectors');
    }

    public function medicalSpecialties()
    {
        return view('modules.medical-specialties');
    }

    public function equipment()
    {
        return view('modules.equipment');
    }

    public function careUnits()
    {
        return view('modules.care-units');
    }
}
