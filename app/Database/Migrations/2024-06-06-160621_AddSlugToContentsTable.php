<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSlugToContentsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('contents', [
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('contents', 'slug');
    }
}
