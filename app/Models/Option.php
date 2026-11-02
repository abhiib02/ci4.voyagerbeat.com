<?php

namespace App\Models;

use CodeIgniter\Model;

class Option extends Model
{

    protected $table            = 'options_table';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    // Allowed fields for insert/update operations
    protected $allowedFields    = [
        'name',
        'value',
    ];

    // Dates
    protected $useTimestamps = false;

    // Validation rules
    protected $validationRules      = [
        'name'  => 'required|max_length[255]',
        'value' => 'permit_empty',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function insertOption(array $data): bool
    {
        return $this->insert($data);
    }
    public function getAllOptions(): array
    {
        return $this->findAll();
    }
    public function getOptionValue(string $name): ?string
    {
        $result = $this->where('name', $name)->first();

        return $result ? $result->value : null;
    }
    public function saveOption(string $name, string $value): bool
    {
        return (bool) $this->where('name', $name)
            ->set('value', $value)
            ->update();
    }
}
