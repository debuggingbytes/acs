<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Inventory extends Model
{
    use HasFactory;


    protected $fillable = ['inventoryable_type', 'inventoryable_id', 'cost', 'serial_number', 'is_available', 'is_featured', 'thumbnail'];
    // public $timestamps = false;

    public function inventoryable()
    {
        return $this->morphTo();
    }

    public function craneInventory()
    {
        return $this->hasOne(CraneInventory::class);
    }

    public function partInventory()
    {
        return $this->hasOne(PartInventory::class);
    }

    public function equipmentInventory()
    {
        return $this->hasOne(EquipmentInventory::class);
    }

    public function customFields()
    {
        return $this->hasMany(CustomField::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function uniqueViews(): HasMany{
        return $this->hasMany(UniqueInventoryView::class);
    }

    public function getCleanDescriptionAttribute()
    {
        return strip_tags($this->description, '<br>');
    }

    public function getThumbnailAttribute($value){
        if(!Str::startsWith($value, '/')){
            return '/'.$value;
        }
        return $value;
    }
}
