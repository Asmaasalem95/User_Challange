<?php


namespace App\Transformers;


use App\Contracts\ProviderTransformerInterface;

class ProviderXTransformer implements ProviderTransformerInterface
{

    public function transform(array $providerData): array
    {

        // TODO: Implement transform() method.
        $data = [];
        foreach ($providerData as $provider) {
            $data[] = [
                'parentAmount' => $provider['parentAmount'],
                'currency' => $provider['Currency'],
                'parentEmail' => $provider['parentEmail'],
                'statusCode' => $this->checkAndConvertStatusCode($provider['statusCode']),
                'registrationDate' => $provider['registerationDate'],
                'parentIdentification' => $provider['parentIdentification'],
                'provider' => 'DataProviderX'
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
            case (1):
                $code = 'authorised';
                break;
            case (2):
                $code = 'decline';
                break;
            case (3):
                $code = 'refunded';
                break;
            default :
                $code = 'unknown';
                break;
        }
        return $code;
    }
}
