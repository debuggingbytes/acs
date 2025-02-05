<?php

namespace App\Livewire;

use App\Livewire\Modals\InfoModal;
use App\Models\CraneInventory;
use App\Models\Image;
use App\Models\Inventory;
use App\Models\CraneType;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Livewire\Attributes\Validate;
use App\Models\CustomField;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class AddInventory extends Component
{
    use WithFileUploads;

    public $type;
    #[Validate('required')]
    public $make;
    public bool $is_available = true;
    public bool $is_featured = false;
    public $model;
    public $subject;
    public $year;
    public $capacity;
    public $boom;
    public $jib;
    public $jibInserts;
    public $jibType;
    public $hoursLower;
    public $hoursUpper;
    public $condition;
    public $description;
    public $types;
    public $cost = "Inquire";
    public $serial_number;
    public $mileage;
    public $images = [];
    public $newImages = [];
    public $infoScreen = false;
    public $descriptionLive = false;
    public $addNewCraneType;
    public $addNewCraneTypeShow = false;
    public string $customKey = '';
    public string $customValue = '';
    public mixed $customFields = [];
    public bool $showCustomFields = false;

    protected $rules = [
        'year' => 'required|numeric|min:1900|', // Numeric year between 1900 and current year
        'type' => 'required|string|max:255', // Required string up to 255 characters
        'make' => 'required|string|max:255', // Required string up to 255 characters
        'model' => 'required|string|max:255', // Required string up to 255 characters
        'boom' => 'nullable', // Nullable numeric, minimum value 0
        'condition' => 'nullable', // Nullable string up to 255 characters
        'description' => 'nullable|string', // Nullable string
    ];

    /*

        Methods involving crane types

    */
    public function showType()
    {
        $this->addNewCraneTypeShow = ! $this->addNewCraneTypeShow;
    }

    public function addCraneType()
    {
        CraneType::firstOrCreate([
            'type' => Str::lower(Str::replace(' ', '_', $this->addNewCraneType)),
            'text' => $this->addNewCraneType
        ]);
        $this->dispatch('newCraneType');
        $this->addNewCraneTypeShow = false;
    }

    #[On('newCraneType')]
    public function refreshCraneTypes()
    {
        $this->types = CraneType::all();
    }

    /**
     *
     * Helper Methods
     *
     */

    public function closeInfo()
    {
        $this->infoScreen = ! $this->infoScreen;
    }


    // Toggles live description which parses BBcode
    public function descriptionLiveToggle()
    {
        $this->descriptionLive = ! $this->descriptionLive;
    }
    /**
     * Image methods
     */

    public function updatedNewImages()
    {
        $this->images = array_merge($this->images, $this->newImages);
        $this->newImages = [];
    }

    public function removeImage($id)
    {
        unset($this->images[$id]);
    }

    public function moveImage($from, $to)
    {
        if (isset($this->images[$from]) && isset($this->images[$to])) {
            // Remove image from current position
            $image = array_splice($this->images, $from, 1)[0];

            // Add image at new position
            array_splice($this->images, $to, 0, [$image]); // Note the brackets around $image
        }
    }
    private function watermarkImage($img)
    {
        // dd($img);
        $manager = new ImageManager(new Driver());
        $image = $manager->read($img);
        $watermark = public_path('img/watermark.webp');
        $image->place($watermark, 'bottom-right', 10, 10, 90);
        $image->save($img);
    }
    private function convertToWebp($img)
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($img);
        $img = Str::replace('.jpg', '.webp', $img);
        $image->toWebp(70)->save($img);
        return $img;

    }
    // ** Custom Fields ** /

    public function addCustomField()
    {
        array_push($this->customFields, [$this->customKey => $this->customValue]);
        $this->customKey = '';
        $this->customValue = '';
    }
    public function removeCustom($index)
    {
        unset($this->customFields[$index]);
    }

    /**
     *
     * Finalization Methods
     *
     */

    public function save()
    {

        if ($this->customKey != '' || $this->customValue != '') {
            session()->flash('error', 'You did not save the custom field, please try again.');
            return false;
        }
        $this->validate();

        $slugName = Str::slug($this->year . ' ' . $this->make . ' ' . $this->model);
        if (empty($this->cost)) {
            $this->cost = "Inquire";
        }

        $inventory = Inventory::create([
            'inventoryable_type' => CraneInventory::class,
            'inventoryable_id' => null,
            'is_available' => $this->is_available,
            'is_featured' => $this->is_featured,
            'serial_number' => $this->serial_number,
            'cost' => $this->cost,
        ]);
        $craneInventory = CraneInventory::create([
            'slugName' => $slugName,
            'inventory_id' => $inventory->id,
            'type' => $this->type,
            'make' => $this->make,
            'model' => $this->model,
            'subject' => $this->make . ' ' . $this->model,
            'year' => $this->year,
            'capacity' => $this->capacity,
            'boom' => $this->boom,
            'jib' => $this->jib,
            'jibInserts' => $this->jibInserts,
            'jibType' => $this->jibType,
            'hoursUpper' => $this->hoursUpper,
            'hoursLower' => $this->hoursLower,
            'mileage' => $this->mileage,
            'condition' => $this->condition,
            'description' => $this->description,
        ]);
        if (! empty($this->customFields)) {
            foreach ($this->customFields as $field) {
                foreach ($field as $key => $value) {
                    $customField = new CustomField();
                    $customField->key = $key;
                    $customField->value = $value;
                    $customField->inventory_id = $inventory->id;
                    $customField->save();
                }
            }
        }
        $inventory->inventoryable()->associate($craneInventory);
        $inventory->save();
        $count = 0;
        $image_order = 0;

        if (is_array($this->images) && count($this->images) > 0) {
            foreach ($this->images as $img) {
                if ($img->isValid()) {
                    $image_name = $slugName . '_' . Str::uuid() . '.' . $img->getClientOriginalExtension();
                    // $image_path = "/storage/inventory/{$inventory->id}";
                    $image = new Image();
                    $image->inventory_id = $inventory->id;
                    $image->image_order = $image_order;
                    // Store the image with a custom name and specific disk ('inventory' in this case)
                    $img->storeAs("inventory/{$inventory->id}", $image_name, 'public');
                    $location = "storage/inventory/{$inventory->id}/$image_name";
                    $this->watermarkImage($location);
                    $converted = $this->convertToWebp($location);
                    Storage::disk('public')->delete('inventory/' . $inventory->id . '/' . $image_name);
                    $image->image_path = $converted;
                    $image->save();
                    $image_order++;

                }
                if ($count == 0) {
                    $inventory->thumbnail = $converted;
                    $inventory->save();
                    $count++;
                }
            }
        } else {
            $inventory->thumbnail = 'img/coming-soon.png';
            $inventory->save();
        }

        $modalMessage = [
            'heading' => 'Inventory Added',
            'message' => 'We have successfully added ' . $this->subject . ' to the database, this item is currently live on the website',
        ];
        $this->dispatch('show-modal', 'success', $modalMessage)->to(InfoModal::class);
        $this->resetExcept(['types']);
    }

    public function mount()
    {
        $this->types = CraneType::all();
        $this->rules = [
            'year' => 'required|numeric|min:1900|max:' . date('Y'),
        ];
    }


    #[Layout('dashboard.app')]
    public function render()
    {
        return view('livewire.add-inventory');
    }
}
