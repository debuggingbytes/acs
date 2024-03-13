@extends('templates.account')

@section('title')
Add Inventory | ADMIN - ACS.com
@endsection
@section('content')
<section class="container mx-auto p-2">
  <h1 class="uppercase text-cyan-700 font-bold text-3xl py-10">Adding New Inventory</h1>
  
  @livewire('AddInventory')
</section>
@endsection

@section('scripts')

@endsection