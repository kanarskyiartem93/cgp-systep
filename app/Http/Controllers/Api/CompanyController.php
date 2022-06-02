<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\Client\ClientResource;
use App\Http\Resources\Company\CompanyResource;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyController extends Controller
{
    public function index():AnonymousResourceCollection
    {
        return CompanyResource::collection(Company::paginate());
    }

    public function showClientsBelongToCompany(Company $company):AnonymousResourceCollection
    {
        return ClientResource::collection($company->clients()->paginate());
    }

    public function showCompaniesBelongToClient(Client $client):AnonymousResourceCollection
    {
        return CompanyResource::collection($client->companies()->paginate());
    }
}
