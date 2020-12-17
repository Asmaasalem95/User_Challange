<?php


namespace App\Transformers;


use App\Contracts\ProviderTransformerInterface;

class ProviderYTransformer implements ProviderTransformerInterface
{

    public function transform(array $providerData): array
    {
        // TODO: Implement transform() method.
        $data = [];
        foreach ($providerData as $provider) {
            $data[] = [
                'parentAmount' => $provider['balance'],
                'currency' => $provider['currency'],
                'parentEmail' => $provider['email'],
                'statusCode' => $this->checkAndConvertStatusCode($provider['status']),
                'registrationDate' => $provider['created_at'],
                'parentIdentification' => $provider['id'],
                'provider' => 'DataProviderY'
            ];
        }
        return $data;
    }

    /**
     * @param $status
     * @return int
     */
    private function checkAndConvertStatusCode($status)
    {
        switch ($status) {
            case (100):
                $code = 'authorised';
                break;
            case (200):
                $code = 'decline';
                break;
            case (300):
                $code = 'refunded';
                break;
            default :
                $code = 'unknown';
                break;
        }
        return $code;
    }
}
