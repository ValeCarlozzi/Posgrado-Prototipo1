<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250729162859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alumno (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, apellido VARCHAR(100) NOT NULL, email VARCHAR(150) NOT NULL, dni VARCHAR(20) NOT NULL, cuil VARCHAR(20) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1435D52DE7927C74 ON alumno (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1435D52D7F8F253B ON alumno (dni)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1435D52DAAD6D0D7 ON alumno (cuil)');
        $this->addSql('CREATE TABLE carrera (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, ordenanza_aprobacion VARCHAR(255) DEFAULT NULL, resolucion_implementacion VARCHAR(255) DEFAULT NULL, conea_aprobacion VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE curso (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, horas INTEGER NOT NULL, es_optativo BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE dictado_curso (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, curso_id INTEGER DEFAULT NULL, fecha_inicio DATE NOT NULL, fecha_fin DATE NOT NULL, CONSTRAINT FK_D1D77F7187CB4A1F FOREIGN KEY (curso_id) REFERENCES curso (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D1D77F7187CB4A1F ON dictado_curso (curso_id)');
        $this->addSql('CREATE TABLE legajo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, alumno_id INTEGER DEFAULT NULL, carrera_id INTEGER DEFAULT NULL, numero VARCHAR(30) NOT NULL, CONSTRAINT FK_32DD07F6FC28E5EE FOREIGN KEY (alumno_id) REFERENCES alumno (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_32DD07F6C671B40F FOREIGN KEY (carrera_id) REFERENCES carrera (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_32DD07F6FC28E5EE ON legajo (alumno_id)');
        $this->addSql('CREATE INDEX IDX_32DD07F6C671B40F ON legajo (carrera_id)');
        $this->addSql('CREATE TABLE nota (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, alumno_id INTEGER DEFAULT NULL, dictado_id INTEGER DEFAULT NULL, valor DOUBLE PRECISION NOT NULL, documento VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_C8D03E0DFC28E5EE FOREIGN KEY (alumno_id) REFERENCES alumno (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C8D03E0DD85A5EE6 FOREIGN KEY (dictado_id) REFERENCES dictado_curso (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_C8D03E0DFC28E5EE ON nota (alumno_id)');
        $this->addSql('CREATE INDEX IDX_C8D03E0DD85A5EE6 ON nota (dictado_id)');
        $this->addSql('CREATE TABLE pago (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, alumno_id INTEGER DEFAULT NULL, cuil VARCHAR(20) NOT NULL, fecha_pago DATE NOT NULL, numero_cuota INTEGER NOT NULL, comprobante VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_F4DF5F3EFC28E5EE FOREIGN KEY (alumno_id) REFERENCES alumno (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_F4DF5F3EFC28E5EE ON pago (alumno_id)');
        $this->addSql('CREATE TABLE tarifa (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, curso_id INTEGER DEFAULT NULL, carrera_id INTEGER DEFAULT NULL, monto DOUBLE PRECISION NOT NULL, fecha_inicio DATE NOT NULL, fecha_fin DATE DEFAULT NULL, CONSTRAINT FK_A01B5DE87CB4A1F FOREIGN KEY (curso_id) REFERENCES curso (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A01B5DEC671B40F FOREIGN KEY (carrera_id) REFERENCES carrera (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_A01B5DE87CB4A1F ON tarifa (curso_id)');
        $this->addSql('CREATE INDEX IDX_A01B5DEC671B40F ON tarifa (carrera_id)');
        $this->addSql('CREATE TABLE usuario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, apellido VARCHAR(100) NOT NULL, email VARCHAR(150) NOT NULL, dni VARCHAR(20) NOT NULL, cuil VARCHAR(20) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05DE7927C74 ON usuario (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05D7F8F253B ON usuario (dni)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05DAAD6D0D7 ON usuario (cuil)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE alumno');
        $this->addSql('DROP TABLE carrera');
        $this->addSql('DROP TABLE curso');
        $this->addSql('DROP TABLE dictado_curso');
        $this->addSql('DROP TABLE legajo');
        $this->addSql('DROP TABLE nota');
        $this->addSql('DROP TABLE pago');
        $this->addSql('DROP TABLE tarifa');
        $this->addSql('DROP TABLE usuario');
    }
}
