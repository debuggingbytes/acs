<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\System\SiteConfiguration;

class SiteConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Baisc site configuration
        $configurations = [
            // Key Site information
            [
                'key' => 'site_name',
                'value' => 'First Website',
            ],
            [
                'key' => 'site_description',
                'value' => 'Website description',
            ],
            [
                'key' => 'site_logo',
                'value' => 'logo.png',
            ],
            [
                'key' => 'site_favicon',
                'value' => 'favicon.png',
            ],
            [
                'key' => 'site_email',
                'value' => 'contact@website.com',
            ],
            [
                'key' => 'site_phone',
                'value' => '+1234567890',
            ],
            [
                'key' => 'site_address',
                'value' => '123 Street, City, Country',
            ],
            [
                'key' => 'site_facebook',
                'value' => 'https://facebook.com/website',
            ],
            [
                'key' => 'site_twitter',
                'value' => 'https://twitter.com/website',
            ],
            [
                'key' => 'site_google_analytics',
                'value' => '',
            ],
            // Inventory Based Information
            [
                'key' => 'max_allowed_featured_products',
                'value' => 5,
            ],
            [
                'key' => 'max_allowed_inventory',
                'value' => 25,
            ],
            [
                'key' => '',
                'value' => '',
            ],
            // License Information
            [
                'key' => 'license_key',
                'value' => '',
            ],
            [
                'key' => 'license_type',
                'value' => 'free',

            ],
            [
                'key' => 'license_expires_at',
                'value' => '',
            ],
            [
                'key' => 'license_last_verified_at',
                'value' => '',
            ],
            [
                'key' => 'license_status',
                'value' => 'unverified',
            ],
            [
                'key' => 'license_valid_domains',
                'value' => '',
            ],

        ];

        foreach ($configurations as $config) {
            SiteConfiguration::create([
                'key' => $config['key'],
                'value' => $config['value'],
            ]);
        }
    }
}
