<?php

namespace App\Livewire\Contact;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Mail;
use App\Mail\CraneRequestInfo;


class RequestCraneInfo extends Component
{
    #[Validate('required', message: "please put a valid email")]
    public $email;
    public $phone ='';
    public $fullName ='';
    public $crane;
    public $emailSent = false;


    public function requestInformation(){
        if($this->phone != '' || $this->fullName){

        }else{
            $this->validate();
            $this->sendEmail($this->email);
            $this->emailSent = !$this->emailSent;
        }

    }
    protected function sendEmail($email){

        Mail::to('contact@albertacraneservice.com')->send(new CraneRequestInfo($this->email, $this->crane));
        // ADD QUEUE FUNCTION

    }
    public function render()
    {
        return view('livewire.contact.request-crane-info');
    }
}
