<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateVisitorsTableAddContentId extends Migration
{
    public function up()
    {
        $this->forge->addColumn('visitor', [
            'content_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'ip', // Adjust this to place the column in the desired position
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('visitor', 'content_id');
    }
}
