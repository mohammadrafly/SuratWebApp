<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class SuratKeteranganWaliNikah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_wali' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nik' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'bin_wali' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'ttl_wali' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'pekerjaan_wali' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat_wali' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'calon_perempuan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'binti_perempuan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'ttl_perempuan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'agama_perempuan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'pekerjaan_perempuan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat_perempuan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_laki_laki' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'bin_laki_laki' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'ttl_laki_laki' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'agama_laki_laki' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'pekerjaan_laki_laki' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat_laki_laki' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'status_ttd' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'disposisi_surat' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('s_keterangan_wali_nikah', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('s_keterangan_wali_nikah');
    }
}
