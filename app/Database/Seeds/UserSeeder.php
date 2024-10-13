<?php

namespace App\Database\Seeds;

use Faker\Factory;
use App\Models\User;
use CodeIgniter\Database\Seeder;


class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            $data = [
                'name' => $faker->name,
                'address' => $faker->address
            ];
            $model = new User();
            $model->insert($data);
        }

        // $this->db->query(
        //     "INSERT INTO users ('name', 'address') VALUES(:name:, :address:)",
        //     $data
        // );

        // $this->db->table('users')->insert($data);

    }
}
