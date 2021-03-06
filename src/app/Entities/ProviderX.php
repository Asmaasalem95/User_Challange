<?php


namespace App\Entities;


use App\Contracts\EntityInterface;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\JsonResponse;
class ProviderX implements EntityInterface
{

    private $path = 'providers/DataProviderX.json';

    /**
     * @desc get data from json file
     * @return array
     */
    public function getData(): array
    {
        // TODO: Implement getData() method.

        try
        {
            $json = file_get_contents(storage_path($this->path));
            return json_decode($json,true);
        } catch (FileNotFoundException $exception) {
            response()->json([
                'status' => 'File not found!',
                'response' => $exception,
            ])->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
        }
    }
}
