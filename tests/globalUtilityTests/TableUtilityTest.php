<?php declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\GlobalUtility\TableSettings;
use App\Controllers\GlobalUtility\TableUtility;
use App\Controllers\GlobalUtility\CustomButton;

use PHPUnit\Framework\TestCase;

final class TableUtilityTest extends TestCase
{
    private TableUtility $tableUtility;
    public function setUp(): void
    {
        // Arrange
        $array = [
            (object) ['name' => 'John', 'age' => 25, 'city' => 'New York'],
            (object) ['name' => 'Doe', 'age' => 30, 'city' => 'Los Angeles'],
            (object) ['name' => 'Jane', 'age' => 35, 'city' => 'Chicago'],
        ];

        $this->tableUtility = new TableUtility($array);
    }

    public function testGenerateTable(): void
    {
        $this->assertIsString(
            $this->tableUtility->generateTable()
        );
    }

    public function testGenerateTableWithCustomShownTables(): void
    {
        // Act
        $this->tableUtility->setTableSettings(new TableSettings(shownTables: ['name', 'city']));
        $string = $this->tableUtility->generateTable();

        // Asert
        $this->assertStringContainsString('Name', $string);
        $this->assertStringContainsString('City', $string);
        $this->assertStringNotContainsString('Age', $string);
    }

    public function testGenerateTableWithCustomButtons(): void
    {
        // Act
        $this->tableUtility->setTableSettings(new TableSettings(customButtons: [new CustomButton('https://www.google.com', 'Google', 'btn btn-primary'), new CustomButton('https://www.bing.com', 'Bing', 'btn btn-secondary')]));
        $string = $this->tableUtility->generateTable();

        // Asert
        $this->assertStringContainsString('Google', $string);
        $this->assertStringContainsString('Bing', $string);
    }

    public function testGenerateTableWithBootstrap(): void
    {
        // Act
        $this->tableUtility->setTableSettings(new TableSettings(bootstrap: true));
        $string = $this->tableUtility->generateTable();

        // Asert
        $this->assertStringContainsString('table-dark', $string);
        $this->assertStringContainsString('table table-striped', $string);
    }


    
}