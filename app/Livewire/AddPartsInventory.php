<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\PartsType;
use App\Models\PartInventory;
use App\Models\Inventory;
use App\Models\CustomField;
use App\Models\Image;
use App\Livewire\Modals\InfoModal;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class AddPartsInventory extends Component
{
    //   ToDo:  Need to change all variables and methods to work with parts inventory. Copy & Paste for the win
    public $type;

    #[Validate('required')]
    public $make;
    public $model;
    public $subject;
    public $year;
    public $capacity;
    public $boom;
    public $jib;
    public $jibType;
    public $hoursLower;
    public $hoursUpper;
    public $condition;
    public $description;
    public $images = [];
    public $cost;
    public bool $is_available = true;
    public bool $is_featured = false;
    public $infoScreen = false;
    public $descriptionLive = false;
    public mixed $types;
    public $addNewPartsType;
    public $addNewPartsTypeShow = false;
    public string $customKey = '';
    public string $customValue = '';
    public mixed $customFields = [];
    public bool $showCustomFields = false;

    protected $rules = [
        'year' => 'required|numeric|min:1900|', // Numeric year between 1900 and current year
        'make' => 'required|string|max:255', // Required string up to 255 characters
        // 'category' => 'required|string|max:100', // Required string up to 100 characters
        'condition' => 'nullable|string|max:255', // Nullable string up to 255 characters
        'description' => 'nullable|string', // Nullable string
    ];

    public function closeInfo()
    {
        $this->infoScreen = ! $this->infoScreen;
    }

    public function descriptionLiveToggle()
    {
        $this->descriptionLive = ! $this->descriptionLive;
    }

    public function showType(){
        $this->addNewPartsTypeShow = !$this->addNewPartsTypeShow;
    }

    // Creating Custom Parts Types Code

    public function addPartsType(){
        PartsType::firstOrCreate([
            'type' => Str::lower(Str::replace(' ', '_', $this->addNewPartsType)),
            'text' => $this->addNewPartsType
        ]);
        $this->dispatch('newPartsType');
        $this->addNewPartsTypeShow = false;
    }

    #[On('newPartsType')]
    public function refreshPartsTypes(){
      $this->types = PartsType::all();
    }
    // ** Custom Fields ** /

    public function addCustomField(){
        array_push($this->customFields, [$this->customKey => $this->customValue]);
        $this->customKey = '';
        $this->customValue = '';
    }
    public function removeCustom($index){
        unset($this->customFields[$index]);
    }


    public function save()
    {

        $this->validate();

        $slugName = Str::slug($this->year.' '.$this->make.' '.$this->model);

        $inventory = Inventory::create([
            'inventoryable_type' => PartInventory::class,
            'inventoryable_id' => null,
            'cost' => '10000',
        ]);
        $craneInventory = PartInventory::create([
            'slugName' => $slugName,
            'inventory_id' => $inventory->id,
            'type' => $this->type,
            'make' => $this->make,
            'model' => $this->model,
            'subject' => $this->make.' '.$this->model,
            'year' => $this->year,
            'capacity' => $this->capacity,
            'boom' => $this->boom,
            'jib' => $this->jib,
            'jibType' => $this->jibType,
            'hoursUpper' => $this->hoursUpper,
            'hoursLower' => $this->hoursLower,
            'condition' => $this->condition,
            'description' => $this->description,
        ]);
        if (!empty($this->customFields)) {
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
        if (is_array($this->images)) {
            $image_order = 0;
            foreach ($this->images as $img) {
                if ($img->isValid()) {
                    $image_name = $slugName.'_'.Str::uuid().'.'.$img->getClientOriginalExtension();
                    // $image_path = "/storage/inventory/{$inventory->id}";
                    $image = new Image();
                    $image->inventory_id = $inventory->id;
                    $image->image_order = $image_order;
                    // Store the image with a custom name and specific disk ('inventory' in this case)
                    $img->storeAs("inventory/{$inventory->id}", $image_name, 'public');
                    $location = "storage/inventory/{$inventory->id}/$image_name";
                    $this->watermarkImage($location);
                    $converted = $this->convertToWebp($location);
                    Storage::disk('public')->delete('inventory/'.$inventory->id.'/'.$image_name);
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
        }
        $modalMessage = [
            'heading' => 'Inventory Added',
            'message' => 'We have successfully added '.$this->subject.' to the database, this item is currently live on the website',
        ];
        $this->dispatch('show-modal', 'success', $modalMessage)->to(InfoModal::class);
        $this->reset();
    }

    private function watermarkImage($img){
        $manager = new ImageManager(new Driver());
        $image = $manager->read($img);
        $image->place(asset('img/watermark.webp'), 'bottom-right', 10, 10, 90);
        // $image->toWebp(70)->save($img);
    }
    private function convertToWebp($img){
        $manager = new ImageManager(new Driver());
        $image = $manager->read($img);
        $img = Str::replace('.jpg', '.webp', $img);
        $image->toWebp(70)->save($img);
        return $img;

    }
    public function updated()
    {
        session()->flash('message');
    }

    public function mount()
    {
        $this->types = PartsType::all();
        $this->rules = [
            'year' => 'required|numeric|min:1900|max:'.date('Y'),
        ];
    }

    #[Layout('dashboard.app')]
    public function render()
    {
        return view('livewire.add-parts-inventory');
    }
}
