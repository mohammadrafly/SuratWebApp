<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class SuratPernyataan extends Migration
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
            'binti' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'ttl' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'kewarganegaraan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'agama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'pekerjaan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'pernyataan' => [
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
        $this->forge->createTable('s_pernyataan', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('s_pernyataan');
    }
}
