<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class SuratKelahiran extends Migration
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
            'nama_lengkap' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'jenis_kelamin' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'dilahirkan_di' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'kelahiran_ke' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'anak_ke' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'penolong_kelahiran' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat_anak' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nik' => [
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
            'catatan' => [
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
        $this->forge->createTable('s_kelahiran', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('s_kelahiran');
    }
}
