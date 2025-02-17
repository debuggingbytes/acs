<?php

namespace App\Livewire\Contact;

use App\Models\Email;
use Livewire\Component;

class Emailer extends Component
{
    public $name;
    public $email;
    public $message;
    public $phone;
    public $isSent = false;


    public function sendEmail(){
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'phone' => 'prohibited'
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message
        ];

        $this->emailData($data);

        $this->isSent = true;
        $this->reset(['name', 'email', 'message']);

        return session()->flash('success', 'Email sent successfully');
    }

    private function emailData($data){
        // Insert data into database
        Email::create($data);
    }
    public function render()
    {
        return view('livewire.contact.emailer');
    }
}
