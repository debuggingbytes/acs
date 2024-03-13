<div class="p-2 w-full">
    <livewire:modals.InfoModal />
    <div class="block">
        <form wire:submit='save'>
            <x-forms.label-input name="name" label="Name" livewire="name" />
            <x-forms.label-input name="email" label="email" livewire="email" />
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2.5 bg-cyan-600 uppercase text-white font-bold rounded-xl">Save</button>
            </div>
        </form>
    </div>
    <div class="flex flex-col ">
        <div class="border border-yellow-400 p-2 rounded-md bg-yellow-200 my-2 w-2/3 mx-auto">
            <p class="font-bold">Security Notice</p>
            <p class="text-sm">
              To ensure the security of your account, we require your current password when updating your password. This extra layer of verification helps us confirm that it's indeed you making the change.
            </p>
          </div>
        <form wire:submit='changePassword'>
        <x-forms.label-input name="currentPassword" label="current" livewire="currentPassword" type="password" />
        <x-forms.label-input name="newPassword" label="new password" livewire="newPassword" type="password" />
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2.5 bg-cyan-600 uppercase text-white font-bold rounded-xl">Change Password</button>
        </div>
        </form>
    </div>
</div>
