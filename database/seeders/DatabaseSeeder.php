<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LuxeDrive\Core\Models\Vehicle;

class DatabaseSeeder extends Seeder
{
    /**
        * Seed the application's database.
        */
    public function run(): void
    {
        Vehicle::create([
            'name' => 'Porsche 911 Carrera',
            'class' => 'Performance Coupe',
            'price_per_day' => 450,
            'acceleration' => '3.8s 0-60',
            'seats' => 2,
            'luggage' => null,
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCbGktMAix9W6Vopcr9ELdDsRJevgzh3Y6fxT3K0xddZkWpUHNPuBfYLCTYWwcN1bNUtmtnvtG5PtYc7opMN8vwJcM7NDO-ZcG5PdCuWmlBYVHzWnRDgj_aycR2WprxJKgjYsbPgelonR_7LxtJstbHrNtLRXPsL04txcR5jYcuHD8C47ICFMsbbxTAEn3jcidBejKBHsefcvBovdkzumXCYc49v9Dqxdh4TnLZ51edlxYwlN0BY5pQSdt-7myun0Qy0xAJ6X4moQ',
            'image_alt' => 'Sleek white Porsche 911 sports car',
            'electric' => false,
        ]);

        Vehicle::create([
            'name' => 'Mercedes S-Class',
            'class' => 'Executive Sedan',
            'price_per_day' => 320,
            'acceleration' => null,
            'seats' => 4,
            'luggage' => null,
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCiGJbFaVE7vnLuXXYli4plEtzX-6TiAplpruTiSqi6wdL8KBVcRK8cmCAHYtWUwlu-8xIgWApxLyRhXpO4g7rHJFJkctHpsv0CkX6lRnjq23gtAx-3dyGI_ufYZNb7qtQG45Nx6Fim20w3_Lrs8FIuwZ7Fwm8hoiRfTDcf8w2pgZzeDfA4YxDzJsWvendWoSTIlOQUlPWC6LNRYpX-8OiNCDEhToH0O0VS1oci-VtMsxW30KPrvdKYyeOYMO4g4mokmAiCOyZtiA',
            'image_alt' => 'Black Mercedes Benz S-Class',
            'electric' => false,
        ]);

        Vehicle::create([
            'name' => 'Range Rover Vogue',
            'class' => 'Luxury SUV',
            'price_per_day' => 380,
            'acceleration' => null,
            'seats' => null,
            'luggage' => 5,
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC2HykwC7rdUG4Zj_hhS8zRGLV9pFDtUtUd4XzmNYz4pmMH7a0SNqsZ3rCmv210b6EAAkRH_YWX7vGzJO6JWzzCyYLxGUiDwy-Fl2AJuevXTsS7HGRpUNLO_qAiLfePhZFrpKZci8Sb_F_9e7PI0LA0eJMUK7u6JW1_8GNn6d-peXitk4AcV2r5cw4Cuw1vZTS1be-R822ECNYIauh2E18KVvmTrguzpeucj3oDF9FHjuEy2NQkmrPvExch7BBqYQ0TCFCHSXS5NQ',
            'image_alt' => 'Dark green Range Rover',
            'electric' => false,
        ]);

        Vehicle::create([
            'name' => 'BMW i8',
            'class' => 'Hybrid Sports',
            'price_per_day' => 400,
            'acceleration' => null,
            'seats' => null,
            'luggage' => null,
            'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDq_8fvXAT7oDnyW214GxjwMKFnvBnWRlFGAkfesLRFzQ6J2JfgJvwa4x0zujhXR6X0R-Emr-fv-XH_EeabLCZ5jivicMvO1GvV-8O884N-y62cn5QK9jVOKDAHw6JN3PEp2-66iDa88XXwX0VWMfwvr-G0YN6dBzghG6V8G4oPXzh3QfixfgrPAxvvL6ulHZu3madczJLApe0q08gf5dwTIfsQ4Z8IuQKso-O7iPh5r1klEGSL4Z8C1mwX4-OnnJzQyUr7KGw6lQ',
            'image_alt' => 'Futuristic BMW i8',
            'electric' => true,
        ]);
    }
}
