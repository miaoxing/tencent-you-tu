<?php

namespace MiaoxingTest\TencentYouTu\Service;

use Miaoxing\Plugin\Test\BaseTestCase;

/**
 * 腾讯优图服务
 */
class TencentYouTuTest extends BaseTestCase
{
    /**
     * 测试文件不存在的情况
     */
    public function testFuzzyDetectFileNotExists()
    {
        $ret = wei()->tencentYouTu->fuzzydetect('test');
        $this->assertEquals([
            'code' => -1,
            'message' => '请求失败,请稍后再试',
            'result' => [
                'httpcode' => 0,
                'code' => 400,
                'message' => 'file test not exists',
                'data' => [],
            ],
        ], $ret);
    }
}
