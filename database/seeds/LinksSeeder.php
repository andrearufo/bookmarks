<?php


use Phinx\Seed\AbstractSeed;

class LinksSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'url' => 'https://www.andrearufo.it/',
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $links = $this->table('links');
        $links->insert($data)->saveData();
    }
}
