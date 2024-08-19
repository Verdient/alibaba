<?php

declare(strict_types=1);

namespace Verdient\Alibaba;

use Verdient\http\Request as HttpRequest;

/**
 * 请求
 * @author Verdient。
 */
class Request extends HttpRequest
{
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
    public function send(): Response
    {
        $this->addQuery('access_token', $this->accessToken);

        $url = $this->getUrl();

        $parsedUrl = parse_url($url);

        $signStr = substr($parsedUrl['path'], 9);

        if (isset($parsedUrl['query'])) {
            $params = [];
            parse_str($parsedUrl['query'], $queries);
            foreach ($queries as $name => $value) {
                $params[] = $name . $value;
            }
            sort($params);
            $signStr .= implode('', $params);
        }

        $sign = strtoupper(hash_hmac('sha1', $signStr, $this->appSecret));

        $this->addQuery('_aop_signature', $sign);

        return new Response(parent::send());
    }
}
