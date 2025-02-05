<?php

namespace App\Livewire\Dashboard;

use App\Livewire\Modals\InfoModal;
use App\Models\CraneInventory;
use App\Models\Image;
use App\Models\Inventory;
use App\Models\PartInventory;
use App\Models\EquipmentInventory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ModifyInventory extends Component
{
    use WithFileUploads;

    public $inventory;

    public bool $showImages = true;

    //big long list of ALL variables possible... change this later

    //Shared Properties
    public $uploadImages = [];

    public $images;
    public $imagePaths = [];

    public $serialNumber;

    public $cost;

    public $is_available;

    public $is_featured;
    public $is_public;


    public $thumbnail;

    public $slugName;

    public $year;

    public $make;

    public $subject;

    public $condition;

    public $description;
    public mixed $customFields;
    public array $customFieldsData = [];

    // Crane Specific
    public $type;

    public $model;

    public $jib;
    public $jibInserts;
    public $jibType;

    public $boom;

    public $capacity;

    public $hoursLower;

    public $hoursUpper;

    public $mileage;

    protected $rules = [
        'year' => 'required|numeric|min:1900|', // Numeric year between 1900 and current year
        'make' => 'required|string|max:255', // Required string up to 255 characters
        //'model' => 'required|string|max:255', // Required string up to 255 characters
        'condition' => 'nullable', // Nullable string up to 255 characters
        //'description' => 'n', // Nullable string
        'images.*.image_path' => 'required',
    ];

    public function mount(Inventory $inventory, $id)
    {

        $this->inventory = Inventory::whereId($id)->with('craneinventory', 'partinventory', 'images', 'equipmentinventory', 'customfields')->first();
        // $this->inventory = Inventory::findOrFail($id)->with('craneinventory', 'partinventory', 'images','equipmentinventory','customfields');
        $this->images = $this->inventory->images;
        $this->imagePaths = $this->inventory->images->pluck('image_path', 'id')->toArray();

        $this->cost = $this->inventory->cost;
        $this->is_available = $this->inventory->is_available;
        $this->is_featured = $this->inventory->is_featured;
        $this->is_public = $this->inventory->is_public;
        $this->thumbnail = $this->inventory->thumbnail;
        $this->serialNumber = $this->inventory->serial_number;
        $this->slugName =
            $this->inventory->craneInventory->slugName ??
            $this->inventory?->partInventory->slugName ??
            $this->inventory->equipmentInventory->slugName;

        $this->year =
            $this->inventory->craneInventory->year ??
            $this->inventory->partInventory->year ??
            $this->inventory->equipmentInventory->year ?? NULL;

        $this->make =
            $this->inventory->craneInventory->make ??
            $this->inventory->partInventory->make ??
            $this->inventory->equipmentInventory->make;
        $this->subject =
            $this->inventory->craneInventory->subject ??
            $this->inventory->partInventory->subject ??
            $this->inventory->equipmentInventory->subject;
        $this->condition =
            $this->inventory->craneInventory->condition ??
            $this->inventory->partInventory->condition ??
            $this->inventory->equipmentInventory->condition;
        $this->description =
            $this->inventory->craneInventory->description ??
            $this->inventory->partInventory->description ??
            $this->inventory->equipmentInventory->description;

        // Crane Specific
        $this->type = $this->inventory->craneInventory->type ?? null;
        $this->jib = $this->inventory->craneInventory->jib ?? null;
        $this->jibType = $this->inventory->craneInventory->jibType ?? null;
        $this->jibInserts = $this->inventory->craneInventory->jibInserts ?? null;
        $this->boom = $this->inventory->craneInventory->boom ?? null;
        $this->capacity = $this->inventory->craneInventory->capacity ?? null;
        $this->hoursLower = $this->inventory->craneInventory->hoursLower ?? null;
        $this->hoursUpper = $this->inventory->craneInventory->hoursUpper ?? null;
        $this->mileage = $this->inventory->craneInventory->mileage ?? null;
        $this->model = $this->inventory->craneInventory->model ?? null;
        // Custom Fields
        $this->customFields = $this->inventory->customfields;
        $this->customFieldsData = $this->inventory->customfields->toArray();

    }

    public function updatedCustomFieldsData($value, $key)
    {
        $key = explode('.', $key);
        $index = $key[0];
        $val = $key[1];
        $this->inventory->customfields[$index][$val] = $value;
        $this->inventory->customfields[$index]->save();
    }

    public function moveImagePosition($currentImg, $var)
    {

        if ($var == "lower") {
            $replacementImg = $currentImg--;
        } else {
            $replacementImg = $currentImg++;
        }


        $replacement = $this->inventory->images->where('image_order', '=', $replacementImg)->first();
        $current = $this->inventory->images->where('image_order', '=', $currentImg)->first();

        $currentOrder = $current->image_order;

        $current->image_order = $replacement->image_order;
        $replacement->image_order = $currentOrder;

        $current->save();
        $replacement->save();

        $this->dispatch('refresh-images');
    }


    public function addValue($type)
    {
        $this->$type = 'CHANGE ME';
    }

    public function makeThumbnail($thumbnail)
    {
        $this->inventory->thumbnail = $thumbnail;
        $this->inventory->save();
        $this->dispatch('refresh');
    }

    public function deleteImage($id, $image)
    {
        if ($image == $this->inventory->thumbnail && $this->is_available) {
            $modalMessage = [
                'heading' => 'Thumbnail Error',
                'message' => 'You cannot remove the thumbnail image if the inventory is available',
            ];

            return $this->dispatch('show-modal', 'error', $modalMessage)->to(InfoModal::class);
        }

        Storage::disk('public')->delete(Str::replace('/storage/', '', $image));
        Image::whereId($id)->delete();
        // Inventory::whereInventoryableId($this->inventory->inventoryable_id)->update(['thumbnail' => '']);

        $this->correctImagePosition($this->inventory->id);
        $this->dispatch('refresh-images');
    }

    public function correctImagePosition($inventory_id)
    {
        $images = Image::where('inventory_id', $inventory_id)->orderBy('image_order')->get();
        $expected_pos = 0; // Start at our 0 index
        foreach ($images as $image) {
            if ($image->image_order != $expected_pos) {
                $image->image_order = $expected_pos;
                $image->save();
            }
            $expected_pos++;
        }
        $this->dispatch('refresh-images');
    }

    #[On('refresh')]
    public function refreshThumbnail()
    {
        $this->thumbnail = $this->inventory->thumbnail;
    }

    #[On('refresh-images')]
    public function refreshImages()
    {
        $this->images = $this->inventory->images;
    }

    public function saveChanges()
    {
        $this->validate();
        // Inventory Variables
        $this->inventory->cost = $this->cost;
        $this->inventory->is_available = $this->is_available;
        $this->inventory->is_featured = $this->is_featured;
        $this->inventory->is_public = $this->is_public;
        // $this->inventory->thumbnail = $this->thumbnail;
        $this->inventory->serial_number = $this->serialNumber;
        $craneData = ['slugName', 'year', 'make', 'model', 'subject', 'condition', 'description', 'type', 'jib', 'jibInserts', 'jibType', 'boom', 'capacity', 'hoursLower', 'hoursUpper', 'mileage'];
        $partData = ['slugName', 'year', 'make', 'subject', 'condition', 'description'];


        if ($this->inventory->inventoryable_type == CraneInventory::class) {
            $this->updateRelationship($this->inventory->craneInventory, $craneData);
            $this->inventory->craneInventory->updated_at = now();
            $this->inventory->craneInventory->save();
        } elseif ($this->inventory->inventoryable_type == PartInventory::class) {
            $this->updateRelationship($this->inventory->partInventory, $partData);
            $this->inventory->partInventory->updated_at = now();
            $this->inventory->partInventory->save();
        } elseif ($this->inventory->inventoryable_type == EquipmentInventory::class) {
            $this->updateRelationship($this->inventory->equipmentInventory, $partData);
            $this->inventory->equipmentInventory->updated_at = now();
            $this->inventory->equipmentInventory->save();
        } else {
            dd($this->inventory);
        }


        // dd($this->inventory);
        $this->inventory->save();
        $modalMessage = [
            'heading' => 'Inventory Updated',
            'message' => 'We have updated the listing',
        ];
        $this->dispatch('show-modal', 'success', $modalMessage)->to(InfoModal::class);
    }

    private function updateRelationship($model, $data)
    {
        // dd($model, $data);
        foreach ($data as $val) {
            $model->$val = $this->$val;
        }
    }

    public function toggleView()
    {
        $this->showImages = ! $this->showImages;
    }

    public function uploadImage()
    {

        $lastImageOrder = Image::where('inventory_id', $this->inventory->id)->max('image_order') ?? 0;
        $count = $lastImageOrder;

        if (is_array($this->uploadImages)) {
            foreach ($this->uploadImages as $upload) {
                if ($upload->isValid()) {
                    $image_name = $this->slugName.'_'.Str::uuid().'.'.$upload->getClientOriginalExtension();
                    $image_path = "storage/inventory/{$this->inventory->id}";

                    $image = new Image();
                    $image->image_path = "$image_path/$image_name";
                    $image->inventory_id = $this->inventory->id;
                    $image->image_order = ++$count;
                    $image->save();
                    $image_path = "inventory/{$this->inventory->id}";

                    // Store the image with a custom name and specific disk ('inventory' in this case)
                    $upload->storeAs($image_path, $image_name, 'public');
                    // Storage::disk('public')->storeAs($image_path, $image_name, 'public');

                }
            }
            $this->uploadImages = [];
        }

        $modalMessage = [
            'heading' => 'Images Uploaded',
            'message' => 'You have successfully added more images to the inventory',
        ];
        $this->dispatch('refresh-images');

        return $this->dispatch('show-modal', 'success', $modalMessage)->to(InfoModal::class);
    }


    public function deleteInventory($id)
    {

        $inventory = Inventory::findOrFail($id);
        if ($inventory) {
            $inventory->craneInventory()->delete() ?? $inventory->partInventory()->delete() ?? $inventory->equipmentInventory()->delete();
            Storage::disk('public')->deleteDirectory("/inventory/$id");
            $inventory->images()->delete();
            $inventory->delete();
            return $this->redirect('/dashboard/inventory/show', navigate: true);
        }
    }


    #[Layout('dashboard.app')]
    public function render()
    {
        return view('livewire.dashboard.modify-inventory');

    }
}
