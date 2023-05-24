<?php

namespace App\Models;

use CodeIgniter\Model;

class SPengantarNikah extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 's_pengantar_nikah';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'author',
        'nama_wali',
        'nik',
        'bin_wali',
        'ttl_wali',
        'pekerjaan_wali',
        'alamat_wali',
        'calon_perempuan',
        'binti_perempuan',
        'ttl_perempuan',
        'agama_perempuan',
        'pekerjaan_perempuan',
        'alamat_perempuan',
        'nama_laki_laki',
        'bin_laki_laki',
        'ttl_laki_laki',
        'agama_laki_laki',
        'pekerjaan_laki_laki',
        'alamat_laki_laki',
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
