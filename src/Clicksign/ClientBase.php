<?php

namespace Clicksign;

/**
 * Class ClientBase
 */
abstract class ClientBase
{
    /**
     * @var string|null $baseUrl
     * https://app.clicksign.com/api para produção
     * https://sandbox.clicksign.com/api para testes
     */
    protected $baseUrl = null;

    /**
     * @var string|null $accessToken
     */
    protected $accessToken = null;

    /**
     * @var int $timeout
     */
    protected $timeout = 240;

    /**
     * @var string $version
     *  Versão da API
     */
    protected $version = "v1";

    /**
     * @param $method
     * @param $entity
     * @param array $data
     * @return object
     */
    public function doRequestCurl($method, $entity, $data = [])
    {
        // trata o body da requisição
        $body = isset($data['body']) ? json_encode($data['body']) : null;

        // trata a url da requisicao adicionado parâmetros casos exista e incluindo o token de acesso
        $uri = $this->baseUrl . '/' . $this->version . '/' . $entity;
        $uri .= isset($data['params']) ? '/' . $data['params'] : '';
        $uri .= '?access_token=' . $this->accessToken;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Clicksign/PHP");
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "HTTP/1.1",
            "Accept: application/json",
            "Content-type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($method === 'POST' && !empty($body)):
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        endif;

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $content = substr($response, $header_size);
        $error = curl_error($ch);

        curl_close($ch);

        return $this->parseResponse($header, $content);

    }

    /**
     * @param $header
     * @param $content
     * @return object
     */
    private function parseResponse($header, $content)
    {
        $headerInfo = explode("\r\n", $header);
        $line1Parts = explode(' ', $headerInfo[0]);
        $status = $line1Parts[1];
        $description = $line1Parts[2];

        $resp = json_decode($content);

        $response = [
            'header' => [
                'http' => $headerInfo[0],
                'status' => $status,
                'description' => $description
            ],
            'content' => !isset($resp->errors) && count($resp->errors) == 0 ? json_decode($content, true) : null,
            'errors' => isset($resp->errors) && count($resp->errors) > 0 ? $resp->errors : null,
        ];

        return json_decode($content);
    }

    /**
     * @param $environment
     */
    protected function setBaseUrl($environment)
    {
        $this->baseUrl = $environment !== 'production' ? 'https://sandbox.clicksign.com/api' : 'https://app.clicksign.com/api';
    }

    /**
     * @param $accessToken
     */
    protected function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

}
