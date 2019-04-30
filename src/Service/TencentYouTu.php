<?php

namespace Miaoxing\TencentYouTu\Service;

use Miaoxing\Plugin\BaseService;
use Wei\RetTrait;
use TencentYoutuyun\Conf;

/**
 * @method array fuzzydetect($image_path)
 * @method array fuzzydetecturl($url)
 */
class TencentYouTu extends BaseService
{
    use RetTrait;

    /**
     * @var string
     */
    protected $appId;

    /**
     * @var string
     */
    protected $secretId;

    /**
     * @var string
     */
    protected $secretKey;

    /**
     * @var string
     */
    protected $userId;

    /**
     * {@inheritdoc}
     */
    public function __construct(array $options)
    {
        parent::__construct($options);

        // 优图开放平台初始化
        Conf::setAppInfo($this->appId, $this->secretId, $this->secretKey, $this->userId, Conf::API_YOUTU_END_POINT);
    }

    /**
     * 调用优图相关接口
     *
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function __call($name, $args)
    {
        $result = call_user_func_array(['TencentYoutuyun\Youtu', $name], $args);
        if (isset($result['errorcode'])) {
            if ($result['errorcode'] === 0) {
                return $this->suc($result);
            } else {
                return $this->warning($result + ['code' => $result['errorcode']]);
            }
        } else {
            return $this->warning([
                'message' => '请求失败,请稍后再试',
                'result' => $result,
            ]);
        }
    }
}
