<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class SuratPengantarPermohonanKtp extends Migration
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
            'author' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nik' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'kelurahan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'kecamatan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'kabupaten' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'jumlah_berkas' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'keterangan' => [
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
        $this->forge->createTable('s_pengantar_permohonan_ktp', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('s_pengantar_permohonan_ktp');
    }
}
