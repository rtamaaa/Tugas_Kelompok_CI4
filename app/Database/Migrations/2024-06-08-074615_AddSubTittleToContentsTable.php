<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSubTittleToContentsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('contents', [
            'subtittle' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('contents', 'subtittle');
    }
}
