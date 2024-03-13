@extends('templates.auth')
@auth
  <script>window.location = "/account";</script>
@endauth
@section('content')
<section id="auth">
  <div class="relative overflow-hidden w-100 min-h-screen">
    <img src="{{asset('siteart/hero-3.webp')}}" alt="Login" class="object-fit w-full h-full"/>
    <div class="absolute w-1/2 top-0 right-0  glass-bg h-screen bg-neutral-100 flex justify-center items-center">
      <div class="bg-slate-200 w-2/3 rounded-md overflow-hidden">
        <div class="bg-gradient-to-b from-cyan-900 to-gray-700 p-2 h-12 align-middle">
          <h2 class="text-white uppercase font-2xl font-bold">Login Required</h2>
        </div>
        <div class="p-2 ">
          <form action="{{ route('login.user') }}" method="post" class="">
            @method('POST')
            @csrf
            <label for="email" class="block uppercase text-lg font-bold text-cyan-600 mb-2">Email:</label>
            <input type="email" id="email" name="email" value="" placeholder="JohnSmith@domain.com" required class="block w-full focus:bg-sky-800 active:bg-sky-800 bg-sky-800 text-white px-2 py-3 rounded-md mb-5 invalid:ring-pink-500" >
            <label for="password" class="block uppercase text-lg font-bold text-cyan-600 mb-2">Password:</label>
            <input type="password" id="password" name="password" required class="block w-full focus:bg-sky-800 active:bg-sky-800 bg-sky-800 text-white px-2 py-3 rounded-md mb-5">
            <div class="flex justify-end gap-2">
              <input type="submit" value="Register" class="inline-block ring-2 font-bold text-cyan-600 uppercase px-3 w-32 py-2">
              <input type="submit" value="Login" class="inline-block bg-cyan-600 font-bold text-white uppercase px-3 w-32 py-2">
            </div>
          </form>
          @if($errors)
          @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
          @endforeach
      @endif
        </div>
      </div>
    </div>
  </div>
</section>
@endsection