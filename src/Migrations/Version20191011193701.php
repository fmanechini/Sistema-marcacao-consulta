<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191011193701 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE planos (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, planome VARCHAR(50) NOT NULL)');
        $this->addSql('CREATE TABLE especialidade (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, esnome VARCHAR(50) NOT NULL)');
        $this->addSql('CREATE TABLE horarios_medico (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, dia VARCHAR(10) NOT NULL, hora TIME NOT NULL)');
        $this->addSql('CREATE TABLE medico (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, menome VARCHAR(100) NOT NULL, dia1 VARCHAR(10) DEFAULT NULL, dia2 VARCHAR(10) DEFAULT NULL, dia3 VARCHAR(10) DEFAULT NULL, dia4 VARCHAR(10) DEFAULT NULL, dia5 VARCHAR(10) DEFAULT NULL)');
        $this->addSql('CREATE TABLE medico_especialidade (medico_id INTEGER NOT NULL, especialidade_id INTEGER NOT NULL, PRIMARY KEY(medico_id, especialidade_id))');
        $this->addSql('CREATE INDEX IDX_6E75B05AA7FB1C0C ON medico_especialidade (medico_id)');
        $this->addSql('CREATE INDEX IDX_6E75B05A3BA9BFA5 ON medico_especialidade (especialidade_id)');
        $this->addSql('CREATE TABLE medico_horarios_medico (medico_id INTEGER NOT NULL, horarios_medico_id INTEGER NOT NULL, PRIMARY KEY(medico_id, horarios_medico_id))');
        $this->addSql('CREATE INDEX IDX_98251216A7FB1C0C ON medico_horarios_medico (medico_id)');
        $this->addSql('CREATE INDEX IDX_9825121637697009 ON medico_horarios_medico (horarios_medico_id)');
        $this->addSql('CREATE TABLE consulta (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, medico_idmedico_id INTEGER NOT NULL, cliente_idcliente_id INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_A6FE3FDE8BB8409 ON consulta (medico_idmedico_id)');
        $this->addSql('CREATE INDEX IDX_A6FE3FDE47D695D9 ON consulta (cliente_idcliente_id)');
        $this->addSql('CREATE TABLE cliente (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, clinome VARCHAR(100) NOT NULL, telefone VARCHAR(50) NOT NULL)');
        $this->addSql('CREATE TABLE cliente_planos (cliente_id INTEGER NOT NULL, planos_id INTEGER NOT NULL, PRIMARY KEY(cliente_id, planos_id))');
        $this->addSql('CREATE INDEX IDX_B39BFBC7DE734E51 ON cliente_planos (cliente_id)');
        $this->addSql('CREATE INDEX IDX_B39BFBC77539B838 ON cliente_planos (planos_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE planos');
        $this->addSql('DROP TABLE especialidade');
        $this->addSql('DROP TABLE horarios_medico');
        $this->addSql('DROP TABLE medico');
        $this->addSql('DROP TABLE medico_especialidade');
        $this->addSql('DROP TABLE medico_horarios_medico');
        $this->addSql('DROP TABLE consulta');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE cliente_planos');
    }
}
