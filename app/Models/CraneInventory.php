<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CraneInventory extends Model
{
    use HasFactory;

    protected $fillable = ['inventory_id', 'slugName', 'type', 'make', 'model', 'subject', 'year', 'capacity', 'boom', 'jib', 'jibInserts', 'jibType', 'hoursLower', 'hoursUpper', 'condition', 'description'];

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

    public function getCleanSlugAttribute()
    {
        return Str::replace('-', ' ', $this->slugName);
    }

    // Change Attributes and strip potentially added symbols

    public function getJibAttribute($value)
    {
        if (Str::endsWith($value, "'")) {
            return $value = Str::replace('\'', '', $value);
        }
        return $value;
    }

    public function getMakeAttribute($value){
        return Str::ucfirst(Str::lower($value));
    }


    // public function getTotalJibLengthAttribute()
    // {
    //     if (!empty($this->jibInserts)) {
    //         $jibInserts = explode(",", $this->jibInserts);
    //         $jib = $this->jib;

    //         if (strpos($jib, '-') !== false) {
    //             $jib = explode('-', $jib);
    //         } elseif (strpos($jib, '/') !== false) {
    //             $jib = explode('/', $jib);
    //         }

    //         if (is_array($jib)) {
    //             $jibInserts = array_merge($jibInserts, $jib);
    //         } else {
    //             $jibInserts[] = $jib;
    //         }

    //         return collect($jibInserts)->sum();
    //     }

    //     return collect($this->jib)->sum() . "'";
    // }


}

