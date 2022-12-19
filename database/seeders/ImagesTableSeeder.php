<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Image;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::truncate(); // Supprimer toutes les données se trouvant dans la table Book

        $images = [
            ['image_url' => 'vincent1.jpg', 'ad_id' => 1],
            ['image_url' => 'vincent2.jpg', 'ad_id' => 1],
            ['image_url' => 'jeanne1.jpg', 'ad_id' => 5],
            ['image_url' => 'jeanne2.jpeg', 'ad_id' => 6],
            ['image_url' => 'jeanne3.jpeg', 'ad_id' => 6],
            ['image_url' => 'jeanne4.jpeg', 'ad_id' => 6],
            ['image_url' => 'jeanne5.jpeg', 'ad_id' => 6],
            ['image_url' => 'jeanne6.jpeg', 'ad_id' => 6],
            ['image_url' => 'jeanne7.jpeg', 'ad_id' => 6],
            ['image_url' => 'titus1.jpg', 'ad_id' => 2],
            ['image_url' => 'jonas1.jpg', 'ad_id' => 4],
            ['image_url' => 'moto_base.png', 'ad_id' => 3],
        ];

        foreach ($images as $image) {
            // Pas besoin de mettre l'id et timestamp
            Image::create(array(
                'image_url' => $image["image_url"],
                'ad_id' => $image["ad_id"]
            ));
        }
    }
}
