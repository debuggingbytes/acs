<div class="lg:w-1/2 lg:mx-auto p-2 mb-5">
  <span class="uppercase text-lg text-cyan-600 font-bold break-words">Filter By Category</span>
  <select name="categories">
    @php
    $categories = App\Models\Inventory::showCategories();
    @endphp
    <option value="clear" selected>View All</option>
    @foreach ($categories as $category)
    <option value="{{$category}}">{{ $category }}</option>
    @endforeach
  </select>
</div>
