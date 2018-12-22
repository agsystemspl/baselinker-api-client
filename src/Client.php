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

        $form_params = [
            'token' => $this->accessToken,
            'method' => $name,
        ];

        if ($parameters = array_shift($arguments)) {
            $form_params += [
                'parameters' => json_encode($parameters),
            ];
        }

        $response = $client->request('POST', $this->connector, [
            'form_params' => $form_params,
        ]);

        $result = json_decode($response->getBody()->getContents());

        return $result;
    }
}
