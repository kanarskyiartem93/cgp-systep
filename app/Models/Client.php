<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'client_company', 'client_id', 'company_id');
    }
}
