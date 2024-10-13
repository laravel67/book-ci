<?php

namespace App\Database\Seeds;

use App\Models\Book;
use Faker\Factory;
use CodeIgniter\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');
        $model = new Book();

        $uniqueTitles = [];
        while (count($uniqueTitles) < 100) {
            $title = $faker->sentence(3);
            if (!in_array($title, $uniqueTitles)) {
                $uniqueTitles[] = $title;
            }
        }

        foreach ($uniqueTitles as $title) {
            $slug = url_title($title, '-', true);

            $data = [
                'title'     => $title,
                'slug'      => $slug,
                'author'    => $faker->name,
                'publisher' => $faker->company,
                'cover' => 'default.jpg'
            ];

            $model->insert($data);
        }
    }
}
