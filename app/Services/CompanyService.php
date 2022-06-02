<?php


namespace App\Services;


use App\Models\Client;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class CompanyService
{
    public function store(mixed $data)
    {
        try {
            DB::beginTransaction();
            if (isset($data['clients'])) {
                $clients = $data['clients'];
                unset($data['clients']);
            }
            $company = Company::firstOrCreate($data);
            if (isset($clients)) {
                $company->clients()->sync($clients);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }

    }

    public function update(mixed $data, Company $company): void
    {
        try {
            DB::beginTransaction();
            if (isset($data['clients'])) {
                $clients = $data['clients'];
                unset($data['clients']);
            }

            $company->update($data);

            if (isset($companies)) {
                $company->clients()->sync($clients);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }

    }

    public function destroy(Company $company)
    {
        $company->clients()->detach();
        $company->delete();
    }

}
