<?php

namespace AGSystems\Baselinker\API;

class Client
{
    protected $connector = 'https://api.baselinker.com/connector.php';
    protected $accessToken;

    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function __call($name, $arguments)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $this->connector, [
            'form_params' => [
                'token' => $this->accessToken,
                'method' => $name,
                'parameters' => array_shift($arguments),
            ],
        ]);

        $result = json_decode($response);

        return $result;
    }
}
