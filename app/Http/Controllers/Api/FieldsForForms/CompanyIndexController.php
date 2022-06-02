<?php

namespace App\Http\Controllers\Api\FieldsForForms;

use App\Http\Controllers\Controller;
use App\Http\Resources\Company\CompanyFormResource;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyIndexController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $companies = Company::where('name', 'like', '%' . $search . '%')
            ->orderBy('name', 'asc')
            ->select('id', 'name')
            ->limit(7)
            ->get();

        return CompanyFormResource::collection($companies);
    }
}
