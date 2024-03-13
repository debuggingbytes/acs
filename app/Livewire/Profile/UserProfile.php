<?php

namespace App\Livewire\Profile;

use App\Livewire\Modals\InfoModal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UserProfile extends Component
{
    public $user;

    public $name;

    public $email;

    public $newPassword;

    public $currentPassword;

    public function mount()
    {
        $this->user = User::findOrFail(Auth::user()->id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;

    }

    public function save()
    {
        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->save();
    }

    public function changePassword()
    {
        if (Hash::check($this->currentPassword, $this->user->password)) {
            $modalMessage = [
                'heading' => 'Password Changed',
                'message' => 'Your password has been successfully updated',
            ];
            $this->user->password = Hash::make($this->newPassword);
            $this->user->save();

            return $this->dispatch('show-modal', 'success', $modalMessage)->to(InfoModal::class);
        }
        $modalMessage = [
            'heading' => 'Password Error',
            'message' => 'The password you entered did not match the database',
        ];

        return $this->dispatch('show-modal', 'error', $modalMessage)->to(InfoModal::class);
    }

    #[Layout('dashboard.app')]
    public function render()
    {
        return view('livewire.profile.user-profile');
    }
}
