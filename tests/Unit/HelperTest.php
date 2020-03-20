<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    public function test_getYoutubeId()
    {
        $result = getYoutubeId('https://www.youtube.com/watch?v=u_Qs0vBT2XQ');
        $this->assertEquals($result, 'u_Qs0vBT2XQ');

        $result = getYoutubeId('https://youtu.be/u_Qs0vBT2XQ');
        $this->assertEquals($result, 'u_Qs0vBT2XQ');

        $result = getYoutubeId('https://www.youtube.com');
        $this->assertNull($result);

        $result = getYoutubeId('https://google.com/u_Qs0vBT2XQ');
        $this->assertNull($result);
    }
}
