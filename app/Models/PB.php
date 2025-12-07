<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PB extends Authenticatable
{
    protected $table = 'pbs';
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'password',
        'born_place',
        'bod',
        'religion',
        'graduate',
        'ktp_address',
        'bank_account_number',
        'bank_account_name',
        'bank_name',
        'join_date',
        'partner_status',
        'ktp_number',
        'kk_number',
        'skck_number',
        'ktp_path_doc',
        'kk_path_doc',
        'skck_path_doc',
        'selfie_path',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
        'deleted_reason',
];
}
