<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PartController extends Controller
{
    public function updateDatabase()
    {
        echo "Calling API...\n";
        $response = Http::post(config('app.api_parts'));
        echo "API Called...\n";

        if ($response->status() === 200) {
            echo "Status ok.. \n";
            $datas = json_decode($response->body(), true);

            echo "Calling Truncate \n";
            Part::query()->truncate();
            echo "truncated..\n";

            foreach ($datas as $data) {
                // $slug = $data['make'] . "-" . Str::remove(['(', ')'], Str::replace(' ', '-', $data['category']));
                $slug = $data['make'].' '.$data['category'];
                // $slug = Str::slug($data)
                $inventory = Part::firstOrCreate([
                    'slugName' => Str::slug($slug, '-'),
                    'category' => $data['category'],
                    'make' => $data['make'],
                    'model' => $data['model'],
                    'hours' => $data['hours'],
                    'condition' => $data['condition'],
                    'subject' => $data['subject'],
                    'year' => $data['year'],
                    'capacity' => $data['capacity'],
                    'boom' => $data['boom'],
                    'jib' => $data['jib'],
                    'description' => $data['description'],
                    'images' => json_encode($data['images']),
                    'thumbnail' => $data['thumb'],
                ]);
                $inventory->save();
                echo "Saving..\n";
                echo $slug."\n";
            }
            echo "Inventory updated successfully..\n";
        } else {
            echo "Error calling API..\n";
        }

        echo "Closing API..\n";
    }
}
