<?php

namespace App\Http\Controllers;
use App\Models\Companies;
use App\Models\Company;
use Inertia\Inertia;
use App\Http\Requests\CompaniesRequest;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Http\Request;

class CompaniesController extends Controller
{
        public function index()
    {
        $companies = Company::all();

        return Inertia::render('Companies/Index',[
            'companies' => $companies,
        ]);
    }

    public function store(CompaniesRequest $request)
    {
        Company::create($request->validated());

        return to_route('companies.index')
        ->with([
            'message' => '作成しました。',
            'status' => 'success'
        ]);
    }
}
