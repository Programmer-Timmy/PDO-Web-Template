<?php declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Controllers\GlobalUtility\TimeUtility;

final class TimeUtilityTest extends TestCase
{
    public function testGetCurrentDateTime(): void
    {
        $this->assertEquals(
            date('d-m-Y H:i:s'),
            TimeUtility::getCurrentDateTime()
        );
    }

    public function testGetCurrentTime(): void
    {
        $this->assertEquals(
            date('H:i:s', strtotime('2 hour')),
            TimeUtility::getCurrentTime()
        );
    }
}