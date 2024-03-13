<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EquipmentInventory;
use App\Models\Inventory;
use App\Models\Image;
use App\Models\EquipmentType;
use App\Livewire\Modals\InfoModal;
use App\Models\CustomField;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class AddEquipmentInventory extends Component
{
    use WithFileUploads;

    public bool $is_available = true;
    public bool $is_featured = false;
    public $type;
    public $make;
    public $model;
    public $subject;
    public $year;
    public $images = [];
    public $newImages = [];
    public mixed $cost = 'Inquire';
    public mixed $misc;
    public string $condition;
    public string $description;
    public string $customKey = '';
    public string $customValue = '';
    public mixed $customFields = [];
    public bool $showCustomFields = false;
    public bool $descriptionLive = false;

    public mixed $types;
    public $addNewEquipmentType;
    public $addNewEquipmentTypeShow = false;

    protected $rules = [
        'year' => 'required|numeric|min:1900|', // Numeric year between 1900 and current year
        'make' => 'required|string|max:255', // Required string up to 255 characters
        'condition' => 'nullable|string|max:255', // Nullable string up to 255 characters
        'description' => 'nullable|string', // Nullable string
        'images' => 'required', // Image file
    ];


    /**
     *
     * Image methods
     *
     **/


    public function updatedNewImages(){
        $this->images = array_merge($this->images, $this->newImages);
        $this->newImages = [];
     }

     public function removeImage($id){
        unset($this->images[$id]);
     }

     public function moveImage($from, $to){
        if (isset($this->images[$from]) && isset($this->images[$to])) {
            // Remove image from current position
            $image = array_splice($this->images, $from, 1)[0];

            // Add image at new position
            array_splice($this->images, $to, 0, [$image]); // Note the brackets around $image
        }
     }

    public function addCustomField(){
        array_push($this->customFields, [$this->customKey => $this->customValue]);
        $this->customKey = '';
        $this->customValue = '';
    }
    public function removeCustom($index){
        unset($this->customFields[$index]);
    }


    public function showType(){
        $this->addNewEquipmentTypeShow = !$this->addNewEquipmentTypeShow;
    }

    public function addEquipmentType(){
        EquipmentType::firstOrCreate([
            'type' => Str::lower(Str::replace(' ', '_', $this->addNewEquipmentType)),
            'text' => $this->addNewEquipmentType
        ]);
        $this->dispatch('newEquipmentType');
        $this->addNewEquipmentTypeShow = false;
    }

    #[On('newEquipmentType')]
    public function refreshEquipmentTypes(){
      $this->types = EquipmentType::all();
    }
    private function watermarkImage($img){
        // dd($img);
        $manager = new ImageManager(new Driver());
        $image = $manager->read($img);
        $watermark = public_path('img/watermark.webp');
        $image->place($watermark, 'bottom-right', 10, 10, 90);
        $image->save($img);
    }
    private function convertToWebp($img){
        $manager = new ImageManager(new Driver());
        $image = $manager->read($img);
        $img = Str::replace('.jpg', '.webp', $img);
        $image->toWebp(70)->save($img);
        return $img;

    }


    public function descriptionLiveToggle(){
        $this->descriptionLive = !$this->descriptionLive;
    }

    public function save()
    {
        if($this->customKey != '' || $this->customValue != ''){
            session()->flash('error', 'You did not save the custom field, please try again.');
            return false;
        }

        $this->validate();


        $this->subject = $this->year.' '.$this->make;

        $slugName = Str::slug($this->year.' '.$this->make);

        if(empty($this->cost)){
            $this->cost = "Inquire";
        }

        $inventory = Inventory::create([
            'inventoryable_type' => EquipmentInventory::class,
            'inventoryable_id' => null,
            'is_available' => $this->is_available,
            'is_featured' => $this->is_featured,
            'cost' => $this->cost,
        ]);
        $equipmentInventory = EquipmentInventory::create([
            'slugName' => $slugName,
            'inventory_id' => $inventory->id,
            'type' => $this->type,
            'subject' => $this->subject,
            'year' => $this->year,
            'make' => $this->make,
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
        $inventory->inventoryable()->associate($equipmentInventory);
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
        $this->resetExcept(['types']);
    }

    public function mount(){
        $this->types = EquipmentType::all();
    }

    #[Layout('dashboard.app')]
    public function render()
    {
        return view('livewire.add-equipment-inventory');
    }
}
