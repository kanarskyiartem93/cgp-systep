<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ClientCompany;
use App\Models\Company;
use Illuminate\Database\Seeder;

class ClientCompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $companies = Company::all();
        $clients = Client::all();

        Client::all()->random(2500)->each(function ($client) use ($companies) {
            $client->companies()->attach(
                $companies->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        Company::all()->random(2500)->each(function ($company) use ($clients) {
            $company->clients()->attach(
                $clients->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

    }
}
