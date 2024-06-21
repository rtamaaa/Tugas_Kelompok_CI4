<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVisitorTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ip' => [
                'type'       => 'VARCHAR',
                'constraint' => '45',
            ],
            'date' => [
                'type' => 'DATE',
            ],
            'hits' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'online' => [
                'type' => 'TINYINT',
                'constraint' => 1,
            ],
            'time' => [
                'type'       => 'TIME',
            ],
            'content_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'deleted_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('visitor');
    }

    public function down()
    {
        $this->forge->dropTable('visitor');
    }
}
