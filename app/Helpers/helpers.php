<?php

use App\Models\Company;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

function countCompanies()
{
    return number_format(Company::where('is_active', '1')->count('id'));
}
function countCompanyUser()
{
    $company = auth()->user()->company;
    return number_format(User::where('is_active', '1')->when(!Gate::allows('SA'), function ($q) use ($company) {
        return $q->whereCompany($company);
    })->where('role', 'CA')->count('id'));
}

function countService()
{
    $company = auth()->user()->company;
    return number_format(Service::where('is_active', '1')->when(!Gate::allows('SA'), function ($q) use ($company) {
        return $q->whereCompany($company);
    })->count('id'));
}

function countDoctor()
{
    $company = auth()->user()->company;
    return number_format(User::where('is_active', '1')->when(!Gate::allows('SA'), function ($q) use ($company) {
        return $q->whereCompany($company);
    })->where('role', 'DO')->count('id'));
}
