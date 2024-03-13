@extends('templates.store')

@section('content')
<section class="container mx-auto p-2">
  <h1 class="uppercase text-cyan-700 font-bold text-3xl py-10">Alberta Crane Service Store</h1>
  @isset($products)
  <div class="grid grid-flow-col auto-cols-max gap-4 w-5/6 mx-auto">
    @foreach ($products as $product)
      <x-store.item :product="$product" />
    @endforeach
  </div>
  @endisset
</section>
@endsection