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
            ['image_url' => 'image_example.jpg', 'ad_id' => 1],
            ['image_url' => 'image_example.jpg', 'ad_id' => 1],
        ];

        foreach ($images as $image){
            // Pas besoin de mettre l'id et timestamp
            Image::create(array(
                'image_url' => $image["image_url"],
                'ad_id' => $image["ad_id"]
            ));
        }
    }
}
