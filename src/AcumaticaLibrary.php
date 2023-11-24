<?php

namespace acumaticalibrary;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Cookie\CookieJar;

class AcumaticaLibrary {

    private Guzzle $guzzle;

    public function __construct (){

        $this->guzzle = new Guzzle();
        $this->cookies = new CookieJar();
    }

    public function acumatica_Api($requestData){


        $login_acumatica = $this->acumatica_login($requestData['Login_Acumatica']);


        $response = [];
        if($login_acumatica['status'] === 200){

            $action = $requestData['Body_Acumatica']['Action'];
            $url = $requestData['Body_Acumatica']['URL'];
            $data = $requestData['Body_Acumatica']['data'];

            $request_acumatica = $this->acumatica_request($action,$url,$data);

            if($request_acumatica['status'] === 200){

                $response = [
                    'status' => 200,
                    'message' => 'SuccessFully Inserted',
                    'data' => $request_acumatica['data']
                ];

                $this->acumatica_logout();
            }else{

                $response = [
                    'status' => $request_acumatica['status'],
                    'message' => $request_acumatica['message']
                ];

                $this->acumatica_logout();
            }

        }else{

            $response = [
                'status' => $login_acumatica['status'],
                'message' => $login_acumatica['message']
            ];

            $this->acumatica_logout();
        }

        return $response;


    }

    private function acumatica_login($logininfo){

        $resource = 'https://ropali3-adamco.acumatica.com/entity/Auth/login';


        $response = $this->guzzle->request('POST', $resource, [
            'json' => $logininfo,
            'cookies' => $this->cookies,
            'content-type' => 'application/json',
            'http_errors' => false
        ]);

        $json =  json_decode($response->getBody()->getContents());

        $code = $response->getStatusCode();

        $res = [];
        if ($code == 200 || $code == 204) {

            $res = [
                'status' => 200,
                'message' => 'Successfully Login'
            ];

        } else {

            $res = [
                'status' => $code,
                'message' => $json
            ];
        }
        return $res;
    }


    private function acumatica_request($action,$url,$data){

        $response = $this->guzzle->request($action, $url, [
            'json' => $data,
            'cookies' => $this->cookies,
            'content-type' => 'application/json',
            'http_errors' => false,
        ]);

        $responseBody = json_decode($response->getBody()->getContents());
        $code = $response->getStatusCode();

        $res = [];
        if ($code == 200 || $code == 204) {

            $res = [
                'status' => 200,
                'message' => 'Successfully Saved!',
                'data' => $responseBody
            ];
        } else {

            $res = [
                'status' => 404,
                'message' => $responseBody
            ];
        }
        return $res;
    }


    private function acumatica_logout(){


        $resource = 'https://ropali3-adamco.acumatica.com/entity/Auth/logout';


        $response = $this->guzzle->request('POST', $resource, [
            'cookies' => $this->cookies,
            'http_errors' => false
        ]);

        $code = $response->getStatusCode();
        $json = json_encode($response);
        $res = [];
        if ($code == 200 || $code == 204) {

            $res = [
                'status' => 200,
                'message' => 'Successfully Login'
            ];

        } else {

            $res = [
                'status' => 404,
                'message' => $response
            ];
        }

        return $res;
    }


    public function odataParse($odataServices){

        $guzzle = new Guzzle();

        $response = $guzzle->request('GET', $odataServices['URL'], [
            'auth' => [$odataServices['name'], $odataServices['password']],
            'http_errors' => false
        ]);

        $responseBody = json_decode($response->getBody()->getContents(),true);
        return $responseBody['value'];
    }

    public  function requestData($action,$url,$data,$token){

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];

        $response = $this->guzzle->request($action, $url, [
            'json' => $data,
            'content-type' => 'application/json',
            'headers'=> $headers,
            'http_errors' => false,
        ]);

        $responseBody = json_decode($response->getBody()->getContents());
        $code = $response->getStatusCode();

        return $responseBody;
    }


}
