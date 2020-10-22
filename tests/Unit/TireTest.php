<?php

namespace Tests\Unit;

use Tests\TestCase;

class TireTest extends TestCase
{
    public function testCheckSensitiveWord()
    {
        $sensitiveWords = [
            '激情视频',
            '高清AV',
            '激情床戲',
            '主席'
        ];
        $str = '小明很激动，看了一個不错的主激情视频，你那有高清AV视频嗎？';

        $tire = new \App\Foundation\Tire();
        foreach ($sensitiveWords as $v) {
            $tire->add($v);
        }
        $result = $tire->seek($str);

        $this->assertEquals(['激情视频', '高清AV'], $result);
    }
}
