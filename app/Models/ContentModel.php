<?php

namespace App\Models;

use CodeIgniter\Model;

class ContentModel extends Model
{
    protected $table            = 'contents';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['judul', 'deskripsi', 'tanggal','subtittle','foto', 'slug'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['generateSlug'];
    protected $beforeUpdate   = ['generateSlug'];

    protected function generateSlug(array $data)
    {
        if (isset($data['data']['judul'])) {
            $data['data']['slug'] = $this->createSlug($data['data']['judul']);
        }
        return $data;
    }

    private function createSlug(string $string): string
    {
        // Convert the string to lowercase
        $string = strtolower($string);

        // Replace spaces and special characters with hyphens
        $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
        $string = preg_replace('/[\s-]+/', ' ', $string);
        $string = preg_replace('/\s/', '-', $string);

        // Trim any leading or trailing hyphens
        $string = trim($string, '-');

        // Check for uniqueness and append a unique identifier if necessary
        $slug = $string;
        $count = 0;
        while ($this->where('slug', $slug)->countAllResults() > 0) {
            $count++;
            $slug = $string . '-' . $count;
        }

        return $slug;
    }

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Hooks
    protected $afterInsert    = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Function to search data by title and description
    public function searchData($keyword)
    {
        return $this->like('judul', $keyword)
                    ->orLike('deskripsi', $keyword)
                    ->findAll();
    }
}
