<?php


use Phinx\Seed\AbstractSeed;

class TaskSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run(): void
    {
        $this->table('tasks')->truncate();

        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 50; $i++) {
            $date = $faker->date('Y-m-d H:i:s');
            $data[] = [
                'username' => $faker->userName,
                'email' => $faker->email,
                'content' => $faker->text(500),
                'checked' => $faker->boolean,
                'created_at' => $date,
                'updated_at' => $date,
            ];
        }

        $this->insert('tasks', $data);
    }
}
