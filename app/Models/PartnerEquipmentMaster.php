<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerEquipmentMaster extends Model
{
    protected $table = 'partner_equipment_master';
    protected $fillable = [
        'category',
        'package',
        'equipment',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'deleted_reason_area',
    ];
}
