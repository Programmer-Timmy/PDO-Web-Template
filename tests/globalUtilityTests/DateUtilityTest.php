<?php declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Controllers\GlobalUtility\DateUtility;

final class DateUtilityTest extends TestCase
{
    public function testCalculateTimeAgo(): void
    {
        $this->assertEquals(
            'Just now',
            DateUtility::calculateTimeAgo(date('Y-m-d H:i:s'))
        );
    }

    public function testFormatDate(): void
    {
        $this->assertEquals(
            date('d-m-Y H:i:s', strtotime(date('Y-m-d H:i:s'))),
            DateUtility::formatDate(date('Y-m-d H:i:s'))
        );
    }

    public function testGetCurrentDate(): void
    {
        $this->assertEquals(
            date('d-m-Y'),
            DateUtility::getCurrentDate()
        );
    }
}
