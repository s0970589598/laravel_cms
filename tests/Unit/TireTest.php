<?php

namespace Tests\Unit;

use Tests\TestCase;

class TireTest extends TestCase
{
    public function testCheckSensitiveWord()
    {
        $sensitiveWords = [
            '激情視频',
            '高清AV',
            '激情床戲',
            '主席'
        ];
        $str = '小明很激動，看了一個不錯的主激情視频，你那有高清AV視频嗎？';

        $tire = new \App\Foundation\Tire();
        foreach ($sensitiveWords as $v) {
            $tire->add($v);
        }
        $result = $tire->seek($str);

        $this->assertEquals(['激情視频', '高清AV'], $result);
    }
}
