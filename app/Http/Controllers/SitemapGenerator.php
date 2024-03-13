<?php

namespace App\Http\Controllers;

use App\Models\CraneInventory;
use App\Models\Inventory;
use App\Models\PartInventory;

class SitemapGenerator extends Controller
{
    // Automatically generate sitemap
    public function index()
    {
        // Main URLS
        $inventories = Inventory::with('craneinventory', 'partinventory')->get();

        $categories = $inventories
            ->where('inventoryable_type', '=', PartInventory::class)
            ->merge($inventories->where('inventoryable_type', '=', CraneInventory::class))
            ->map(function ($inventory) {
                return $inventory->inventoryable_type == PartInventory::class
                    ? $inventory->partinventory->type
                    : $inventory->craneinventory->type;
            })
            ->unique()
            ->values();

        return response()->view('sitemap.index', [
            'parts' => $inventories->where('inventoryable_type', '=', PartInventory::class),
            'cranes' => $inventories->where('inventoryable_type', '=', CraneInventory::class),
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }
}
