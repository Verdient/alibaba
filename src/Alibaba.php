<?php

namespace Verdient\Alibaba;

use Verdient\HttpAPI\AbstractClient;

/**
 * 阿里巴巴
 * @author Verdient。
 */
class Alibaba extends AbstractClient
{
    /**
     * @inheritdoc
     * @author Verdient。
     */
    public $protocol = 'https';

    /**
     * @inheritdoc
     * @author Verdient。
     */
    public $host = 'gw.open.1688.com';

    /**
     * @inheritdoc
     * @author Verdient。
     */
    public $routePrefix = 'openapi/param2/1';

    /**
     * @var string App 编号
     * @author Verdient。
     */
    public $appId;

    /**
     * @var string App 秘钥
     * @author Verdient。
     */
    public $appSecret;

    /**
     * @var string 访问令牌
     * @author Verdient。
     */
    public $accessToken;

    /**
     * @inheritdoc
     * @author Verdient。
     */
    public $request = Request::class;

    /**
     * @inheritdoc
     * @author Verdient。
     */
    public function request($path): Request
    {
        $request = new Request();
        $request->setUrl($this->getRequestPath() . '/' . $path);
        $request->appId  = $this->appId;
        $request->appSecret  = $this->appSecret;
        $request->accessToken = $this->accessToken;
        return $request;
    }
}
