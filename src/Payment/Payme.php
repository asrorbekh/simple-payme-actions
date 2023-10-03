<?php

namespace App\Payment;

use App\Request\CurlRequest;

class Payme
{
    private string $url;
    private array $headers;
    private CurlRequest $curlRequest;

    public function __construct()
    {
        $this->curlRequest = new CurlRequest();
        $this->url = PAYME_ENDPOINT;

        $this->headers = [
            'Host: checkout.test.paycom.uz', // Example: checkout.test.paycom.uz
            'X-Auth: YOUR_AUTH_KEY', // Example: 5e730e8e0b852a417aa49ceb
            'Cache-Control: no-cache',
            'Content-Type: application/json',
        ];

    }

    public function create(): bool|string
    {
        $requestBody = '{
        "id": 123,
        "method": "cards.create",
        "params": {
                "card": { "number": "8600069195406311  ", "expire": "0399"},
            "save": true
           }
         }';

        return $this->curlRequest->send($this->url, $this->headers, $requestBody);
    }

    public function verifyCard(): string|bool
    {
        $requestBody = '{
        "id": 123,
        "method": "cards.verify",
        "params": {
            "token": "651bdd447d00859911351800_DaWN5J8FNdj28anxMJ4nyZYwCKJS5A0yhI3wQXDfmnFHy3Jxx9ibyWy98Q7EjcUCW9kP6MuA7qNFu13rAqZsfcfvDwFM5DqX0TrFu1a3NCFH4ZkZciPq3rV0wP6SGm98srf8JvSeiAWSP20Uyqc27fxJzmNT70iHr5pusf1b88VpV77zWsq5Wk5OGzHBk70Eq96nmw7wSSIZ6K3EdTES2NKMUmCXPFa41COPzOfs868O5HuErBOTsB1TU7Ayw2MgwXUiQ79XNqYkeQme9f1AAPgMUiWbyYSDFfpr9ZjwC2uWJsIOfhTewzIuXaksx9r6zQ4XzsznwAo58yNJBifXKj3C6G4tQxrmWZTCOvnOF0jiguquC04Rta2yrY3V95TzmXeNvw",
            "code":"666666"
           }
        }';

        return $this->curlRequest->send($this->url, $this->headers, $requestBody);

    }

    public function getVerifyCode(): bool|string
    {
        $request_body = '{
            "id": 123,
            "method": "cards.get_verify_code",
            "params": {
            "token": "651bdd447d00859911351800_DaWN5J8FNdj28anxMJ4nyZYwCKJS5A0yhI3wQXDfmnFHy3Jxx9ibyWy98Q7EjcUCW9kP6MuA7qNFu13rAqZsfcfvDwFM5DqX0TrFu1a3NCFH4ZkZciPq3rV0wP6SGm98srf8JvSeiAWSP20Uyqc27fxJzmNT70iHr5pusf1b88VpV77zWsq5Wk5OGzHBk70Eq96nmw7wSSIZ6K3EdTES2NKMUmCXPFa41COPzOfs868O5HuErBOTsB1TU7Ayw2MgwXUiQ79XNqYkeQme9f1AAPgMUiWbyYSDFfpr9ZjwC2uWJsIOfhTewzIuXaksx9r6zQ4XzsznwAo58yNJBifXKj3C6G4tQxrmWZTCOvnOF0jiguquC04Rta2yrY3V95TzmXeNvw"
                   } 
             }';

        return $this->curlRequest->send($this->url, $this->headers, $request_body);
    }

    public function createReceipts(): bool|string
    {
        $requestBody = '{
        "id": 4,
        "method": "receipts.create",
        "params": {
            "amount": 500000,
            "account": {
                "order_id": "test"
            },
            "detail": {
                "receipt_type": 0,
                "shipping": {
                    "title": "Доставка до ттз-4 28/23",
                    "price": 500000
                },
                "items": [
                    {
                        "discount":10000,
                        "title": "Помидоры",
                        "price": 505000,
                        "count": 2,
                        "code": "00702001001000001",
                        "units": 241092,
                        "vat_percent": 15,
                        "package_code": "123456"
                    }
                ]
            }
        }
    }';

        return $this->curlRequest->send($this->url, $this->headers, $requestBody);
    }

    public function payReceipts(): bool|string
    {
        $requestBody = '{
            "id": 123,
            "method": "receipts.pay",
            "params": {
                "id": "651bdd647bb0813f1167f591",
                "token": "651bdd447d00859911351800_DaWN5J8FNdj28anxMJ4nyZYwCKJS5A0yhI3wQXDfmnFHy3Jxx9ibyWy98Q7EjcUCW9kP6MuA7qNFu13rAqZsfcfvDwFM5DqX0TrFu1a3NCFH4ZkZciPq3rV0wP6SGm98srf8JvSeiAWSP20Uyqc27fxJzmNT70iHr5pusf1b88VpV77zWsq5Wk5OGzHBk70Eq96nmw7wSSIZ6K3EdTES2NKMUmCXPFa41COPzOfs868O5HuErBOTsB1TU7Ayw2MgwXUiQ79XNqYkeQme9f1AAPgMUiWbyYSDFfpr9ZjwC2uWJsIOfhTewzIuXaksx9r6zQ4XzsznwAo58yNJBifXKj3C6G4tQxrmWZTCOvnOF0jiguquC04Rta2yrY3V95TzmXeNvw",
                "payer": {
                    "phone": "998901304527"
                }
            }
        }';

        return $this->curlRequest->send($this->url, $this->headers, $requestBody);
    }
}