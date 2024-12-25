<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyPageController extends Controller
{
    public function page($id, $slug)
    {
        $data =  Company::findOrFail($id);
        $services = Service::whereIsActive(1)->get();
        $doctors = User::whereRole('DO')->whereIsActive(1)->get();
        return view('appointment.create', compact('data', 'services', 'doctors'));
    }
}
