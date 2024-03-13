<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PartInventory extends Model
{
    use HasFactory;

    protected $fillable = ['inventory_id', 'slugName', 'subject', 'type', 'make', 'year', 'condition', 'description'];

    public function inventory()
    {
        return $this->morphOne(inventory::class, 'inventoryable');
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

    public function getReadableDescriptionAttribute()
    {
        return Str::title(Str::lower($this->description));
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
