<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EquipmentInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'type',
        'make',
        'subject',
        'slugName',
        'year',
        'cost',
        'misc',
        'condition',
        'description',
        'is_available',
        'is_featured',
    ];

    public function inventory()
    {
        return $this->morphOne(Inventory::class, 'inventoryable');
    }

    // Attribute Changes
    public function getReadableTypeAttribute()
    {
        return Str::replace('_', ' ', $this->type);
    }

    public function getKebabTypeAttribute()
    {
        return Str::replace('_', '-', $this->type);
    }
    public function getCleanSlugAttribute()
    {
        return Str::replace('-', ' ', $this->slugName);
    }
    public function getDescriptionAttribute($value){
        $value = html_entity_decode(htmlspecialchars_decode($value));
        return $value;
    }
}
