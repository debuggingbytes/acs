<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  {{-- Create our static urls --}}
  <url>
    <loc>{{ route('home') }}</loc>
    <lastmod>{{ \Carbon\Carbon::now()->toAtomString() }}</lastmod>
    <changefreq>yearly</changefreq>
    <priority>1</priority>
</url>
<url>
  <loc>{{ route('inventory') }}</loc>
  <lastmod>{{ \Carbon\Carbon::now()->toAtomString() }}</lastmod>
  <changefreq>yearly</changefreq>
  <priority>1</priority>
</url>
<url>
  <loc>{{ route('finance') }}</loc>
  <lastmod>{{ \Carbon\Carbon::now()->toAtomString() }}</lastmod>
  <changefreq>yearly</changefreq>
  <priority>1</priority>
</url>
<url>
  <loc>{{ route('contact') }}</loc>
  <lastmod>{{ \Carbon\Carbon::now()->toAtomString() }}</lastmod>
  <changefreq>yearly</changefreq>
  <priority>1</priority>
</url>
@foreach ($cranes as $crane)
<url>
    <loc>{{ route('crane', ['id' => $crane->id, 'slug' => $crane->craneInventory->slugName])  }}</loc>
    <lastmod>{{ $crane->created_at->tz('UTC')->toAtomString() }}</lastmod>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
</url>
@endforeach
@foreach ($parts as $part)
<url>
    <loc>{{ route('part', ['id' => $part->id, 'slug' => $part->partInventory->slugName])  }}</loc>
    <lastmod>{{ $part->created_at->tz('UTC')->toAtomString() }}</lastmod>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
</url>
@endforeach
{{-- Inventory Category URLS --}}
@foreach ($categories as $category)
<url>
  <loc>{{ route('category', ['slug' => Str::lower($category)])  }}</loc>
  <lastmod>{{ \Carbon\Carbon::now()->toAtomString() }}</lastmod>
  <changefreq>daily</changefreq>
  <priority>0.8</priority>
</url>
@endforeach
</urlset>
