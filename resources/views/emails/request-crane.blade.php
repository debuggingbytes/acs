@component('mail::message')
<div>
    <p>A User with the email {{$email}} has requested more information on the following crane</p>
    <p>{{$crane->craneInventory->subject}}</p>
    <x-mail::button :url="route('crane', ['id' => $crane->id, 'slug' => $crane->craneInventory->slugName])">View Inventory</x-mail::button>
</div>
@endcomponent
