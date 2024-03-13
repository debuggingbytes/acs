@extends('templates.account')

@section('title')
@endsection
@section('content')
<section class="container mx-auto p-2">
  <h1 class="uppercase text-cyan-700 font-bold text-3xl py-10">Welcome {{Auth::user()->name}}!</h1>
  {{-- 
    Display information based on user level
    Begin with Admins,
    then Moderators  
  --}}
  @if(Auth::user()->user_level >=2)
  <div class="flex p-10 gap-5 ">
    <div class="box p-5 border 
      bg-gradient-to-t from-blue-900 via-cyan-600 to-blue-500 
      hover:bg-gradient-to-t hover:from-blue-900 hover:via-cyan-900 hover:to-blue-500
      h-20 w-1/3 rounded-lg text-center ring ring-white cursor-pointer"
      >
    <h4 class="uppercase text-white font-bold text-2xl">Crane Inventory</h4></div>
    <div class="box p-5 border 
      bg-gradient-to-t from-blue-900 via-cyan-600 to-blue-500 
      hover:bg-gradient-to-t hover:from-blue-900 hover:via-cyan-900 hover:to-blue-500
      h-20 w-1/3 rounded-lg text-center ring ring-white cursor-pointer"
      >
    <h4 class="uppercase text-white font-bold text-2xl">Store Inventory</h4></div>
    <div class="box p-5 border 
      bg-gradient-to-t from-blue-900 via-cyan-600 to-blue-500 
      hover:bg-gradient-to-t hover:from-blue-900 hover:via-cyan-900 hover:to-blue-500
      h-20 w-1/3 rounded-lg text-center ring ring-white cursor-pointer"
      >
    <h4 class="uppercase text-white font-bold text-2xl">User Management</h4></div>
  </div>
  @endif
  
</section>
@endsection