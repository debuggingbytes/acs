<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UniqueInventoryView extends Model
{
    use HasFactory;

    protected $fillable = ['user_iWp', 'inventory_id'];

    public function inventory():BelongsTo {
        return $this->belongsTo(Inventory::class);
    }
}
