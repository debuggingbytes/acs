<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Support\Str;

class InventoryController extends Controller
{
    public function showInventory()
    {

        return view('inventory');

    }

    public function showCategory($category)
    {
        $categoryForDb = Str::replace('-', '_', $category);
        $categoryForHumans = Str::replace('-', ' ', $category);
        $inventories = Inventory::with('craneinventory', 'partInventory','equipmentInventory', 'images')
            ->whereHas('craneinventory', function ($query) use ($categoryForDb) {
                $query->where('type', 'like', "%$categoryForDb%");
            })
            ->orWhereHas('equipmentInventory', function ($query) use ($categoryForDb) {
                $query->where('type', 'like', "%$categoryForDb%");
            })
            ->orWhereHas('partInventory', function ($query) use ($categoryForDb) {
                $query->where('type', 'like', "%$categoryForDb%");
            })->get();
        if ($inventories->isEmpty()) {
            $randomInventory = $inventories = Inventory::with('craneinventory','partInventory','equipmentInventory', 'images')->inRandomOrder()->limit(1)->get();

            return view('no-category', ['category' => $categoryForHumans, 'randomInventory' => $randomInventory]);
        }

        return view('category', ['inventories' => $inventories]);

    }

    public function showCrane($id)
    {
        $crane = Inventory::whereId($id)->with('craneinventory', 'images')->first();

        return view('crane', ['inventory' => $crane]);
    }

    public function showCranes()
    {
        $inventories = Inventory::where('inventoryable_type', '=', 'App\Models\CraneInventory')->with('craneInventory','images')->get();

        return $inventories;
    }

    // Parts
    public function showPart($id)
    {
        $part = Inventory::whereId($id)->with('partinventory', 'images')->first();

        return view('parts', ['inventory' => $part]);
    }

    public function showParts()
    {

        return redirect()->route('inventory');
    }

    // Equipment Inventory
    public function showEquipment($id){
        $equipment = Inventory::whereId($id)->with('equipmentInventory', 'customfields', 'images')->first();

        return view('equipment', ['inventory' => $equipment]);
    }
    public function showEquipments(){
        $inventories = Inventory::where('inventoryable_type', '=', 'App\Models\EquipmentInventory')->get();

        return $inventories;
    }

    // next & previous inventory logic

    protected function inventoryNextPrev($id)
    {

    }

    // Method to add inventory via dashboard
    //   public function addInventory()
    //   {
    //     return view('livewire.add-inventory');
    //   }
}
