<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Company\StoreRequest;
use App\Http\Requests\Admin\Company\UpdateRequest;
use App\Models\Client;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    protected CompanyService $service;

    public function __construct(CompanyService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((Company::query())->get())
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.company.index');

    }

    public function create(): View
    {
        return view('admin.company.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->service->store($data);
        return redirect()->route('admin.company.index');

    }

    public function edit(Company $company): View
    {
        $clients = Client::all();

        return view('admin.company.edit', compact('company', 'clients'));
    }

    public function update(UpdateRequest $request, Company $company): RedirectResponse
    {
        $data = $request->validated();
        $this->service->update($data, $company);
        return redirect()->route('admin.company.index');
    }

    public function destroy(Company $company): RedirectResponse
    {
        $this->service->destroy($company);
        return redirect()->route('admin.company.index');
    }
}
