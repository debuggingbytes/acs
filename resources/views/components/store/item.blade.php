<div class="w-[350px] ring-2 rounded-xl overflow-hidden relative">
  <img src="{{ $product->image_url }}">
  <div class="absolute bottom-0 left-0 right-0 bg-sky-700/80 px-2 py-1">
    <h3 class="text-white text-xl font-bold uppercase">{{$product->product_name}}</h3>
    <p>{{$product->product_description}}</p>
    <p>{{$product->product_cost}}</p>
  </div>
</div>