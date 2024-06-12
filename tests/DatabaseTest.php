<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../private/config/settings.php';
use PHPUnit\Framework\TestCase;
use App\Controllers\Database;

class DatabaseTest extends TestCase
{
    private Database $database;
    public function setUp(): void
    {
        $this->database = new Database(useSQLite: true);
            
            $this->database->query('
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT NOT NULL,
                password_hash TEXT NOT NULL
            )'
        );

        $this->database->insert(table: 'users', columns: ['username', 'password_hash'], values: ['admin', password_hash('admin', PASSWORD_DEFAULT)]);

    }

    public function testGet(): void
    {
        $this->assertIsObject(
            $this->database->get(table: 'users', where: ['id' => 1])
        );
    }

    public function testGetAll(): void
    {
        $this->assertIsArray(
            $this->database->getAll(table: 'users')
        );
    }

    public function testInsert(): void
    {
        $this->database->insert(table: 'users', columns: ['username', 'password_hash'], values: ['admin', password_hash('admin', PASSWORD_DEFAULT)]);
        $this->assertIsObject(
            $this->database->get(table: 'users', where: ['id' => 2])
        );
    }

    public function testUpdate(): void
    {
        $this->database->update(table: 'users', columns: ['username', 'password_hash'], values: ['super admin', password_hash('admin', PASSWORD_DEFAULT)], where: ['id' => 1]);
        $data = $this->database->get(table: 'users', where: ['id' => 1]);
        $this->assertEquals('super admin', $data->username);
        
    }

    public function testDelete(): void
    {
        
        $this->database->delete(table: 'users', where: ['id' => 1]);
        $data = $this->database->get(table: 'users', where: ['id' => 1]);
        $this->assertEmpty($data);
    }

    public function testSucsesfulTransaction(): void
    {
        $this->database->beginTransaction();
        $this->database->insert(table: 'users', columns: ['username', 'password_hash'], values: ['admin', password_hash('admin', PASSWORD_DEFAULT)]);
        $this->database->commit();
        $this->assertIsObject(
            $this->database->get(table: 'users', where: ['id' => 2])
        );
    }
    
    public function testFailedTransaction(): void
    {
        $this->database->beginTransaction();
        $this->database->insert(table: 'users', columns: ['username', 'password_hash'], values: ['admin', password_hash('admin', PASSWORD_DEFAULT)]);
        $this->database->rollback();
        $this->assertFalse(
            $this->database->get(table: 'users', where: ['id' => 2])
        );
    }
}