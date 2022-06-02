<?php


namespace App\Services;


use App\Models\Client;
use Illuminate\Support\Facades\DB;

class ClientService
{
    public function store(mixed $data)
    {
        try {
            DB::beginTransaction();
            if (isset($data['companies'])) {
                $companies = $data['companies'];
                unset($data['companies']);
            }

            $client = Client::firstOrCreate($data);
            if (isset($companies)) {
                $client->companies()->sync($companies);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }

    }

    public function update(mixed $data, Client $client): void
    {
        try {
            DB::beginTransaction();
            if (isset($data['companies'])) {
                $companies = $data['companies'];
                unset($data['companies']);
            }

            $client->update($data);

            if (isset($companies)) {
                $client->companies()->sync($companies);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }

    }

    public function destroy(Client $client)
    {
        $client->companies()->detach();
        $client->delete();
    }

}
