<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory;

class Quote extends Model
{
    protected $fillable = [
        'client_name',
        'client_company',
        'client_email',
        'client_phone',
        'client_address',
        'quote_number',
        'line_item',
        'quantity',
        'price',
        'list_price',
        'shipping_price',
        'currency',
        'pdf_path',
        'inventory_id',
        'todays_date',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
