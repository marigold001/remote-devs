<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAttributeValuesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'attribute_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'value'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('attribute_id', 'attributes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('attribute_values');
    }

    public function down()
    {
        $this->forge->dropTable('attribute_values');
    }
}
