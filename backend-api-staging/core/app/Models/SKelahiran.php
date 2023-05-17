<?php

namespace App\Models;

use CodeIgniter\Model;

class SKelahiran extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 's_kelahiran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'author',
        'nama_lengkap',
        'jenis_kelamin',
        'dilahirkan_di',
        'kelahiran_ke',
        'anak_ke',
        'penolong_kelahiran',
        'alamat_anak',
        'nik',
        'status_ttd',
        'disposisi_surat'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
