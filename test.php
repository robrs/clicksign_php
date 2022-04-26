<?php


include('AppClient.php');



class Teste
{


    public function criarSignatario()
    {
        $clicksign = new AppClient('d50b8439-4fa1-458f-908b-bb9b0276b021');

        $json = '{
                      "signer": {
                        "email": "fulano@example.com",
                        "phone_number": "11999999999",
                        "auths": [
                          "email"
                        ],
                        "name": "Marcos Zumba",
                        "documentation": "123.321.123-40",
                        "birthday": "1983-03-31",
                        "has_documentation": true,
                        "selfie_enabled": true,
                        "handwritten_enabled": true,
                        "official_document_enabled": true,
                        "liveness_enabled": true
                      }
                     }';


        $signer = json_decode($json, true);

        $resp = $clicksign->signer->create($signer);

        echo '<pre>';
        print_r($resp);
        echo '</pre>';

    }

    public function getAccount()
    {
        $clicksign = new AppClient('d50b8439-4fa1-458f-908b-bb9b0276b021', 'test');
        $response = $clicksign->getAccount();

        echo '<pre>';
        print_r($response);
        echo '</pre>';
    }
}

$teste = new Teste();
$teste->getAccount();

