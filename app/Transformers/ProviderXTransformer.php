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
                'statusCode' => $provider['statusCode'],
                'registrationDate' => $provider['registerationDate'],
                'parentIdentification' => $provider['parentIdentification'],
                'provider' => 'DataProviderX'
            ];
        }
        return $data;
    }
}
