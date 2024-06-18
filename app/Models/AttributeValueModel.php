<?php

namespace App\Models;

use CodeIgniter\Model;

class AttributeValueModel extends Model
{
    protected $table = 'attribute_values';
    protected $primaryKey = 'id';
    protected $allowedFields = ['attribute_id', 'value'];
    protected $useTimestamps = true;

    public function getAttributeValues()
    {
        return $this->select('attribute_values.*, attributes.name as attribute_name')
            ->join('attributes', 'attributes.id = attribute_values.attribute_id')
            ->findAll();
    }
}
