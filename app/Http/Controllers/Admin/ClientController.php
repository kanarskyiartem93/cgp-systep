<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\StoreRequest;
use App\Http\Requests\Admin\Client\UpdateRequest;
use App\Models\Client;
use App\Models\Company;
use App\Services\ClientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    protected ClientService $service;

    public function __construct(ClientService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((Client::query())->get())
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.client.index');

    }

    public function create(): View
    {
        return view('admin.client.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->service->store($data);

        return redirect()->route('admin.client.index');

    }

    public function edit(Client $client): View
    {
        $companies = Company::all();

        return view('admin.client.edit', compact('client', 'companies'));
    }

    public function update(UpdateRequest $request, Client $client): RedirectResponse
    {
        $data = $request->validated();
        $this->service->update($data, $client);

        return redirect()->route('admin.client.index');
    }

    public function destroy(Client $client): RedirectResponse
    {
        $this->service->destroy($client);

        return redirect()->route('admin.client.index');
    }
}
