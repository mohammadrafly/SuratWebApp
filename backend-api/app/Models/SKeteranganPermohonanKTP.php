<?php

namespace App\Models;

use CodeIgniter\Model;

class SKeteranganPermohonanKTP extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 's_keterangan_permohonan_ktp';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'author',
        'nama',
        'nik',
        'jenis_kelamin',
        'ttl',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'kewarganegaraan',
        'status_ttd',
        'catatan',
        'disposisi_surat',
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
