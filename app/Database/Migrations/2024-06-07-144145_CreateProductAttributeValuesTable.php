<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductAttributeValuesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'product_id'        => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'attribute_value_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('attribute_value_id', 'attribute_values', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_attribute_values');
    }

    public function down()
    {
        $this->forge->dropTable('product_attribute_values');
    }
}
