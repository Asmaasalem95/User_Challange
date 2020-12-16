<?php


namespace App\Repositories;


use App\Contracts\UserRepositoryInterface;
use App\Entities\ProviderX;
use App\Entities\ProviderY;
use App\Transformers\ProviderXTransformer;
use App\Transformers\ProviderYTransformer;
use Illuminate\Http\Response;
use Nahid\JsonQ\Jsonq;
use Nahid\QArray\Exceptions\FileNotFoundException;

class UserRepository implements UserRepositoryInterface
{
    private $providerX;
    private $providerY;
    private $providerXTransformer;
    private $providerYTransformer;

    public function __construct(ProviderX $providerX,
                                ProviderY $providerY,
                                ProviderXTransformer $providerXTransformer,
                                ProviderYTransformer $providerYTransformer
    )
    {
        $this->providerX = $providerX;
        $this->providerY = $providerY;
        $this->providerXTransformer = $providerXTransformer;
        $this->providerYTransformer = $providerYTransformer;
    }
    /**
     * @desc merge data from the providers
     *
     * @return array
     */
    public function mergeDataFromProviders(): array
    {
        // TODO: Implement mergeDataFromProviders() method.

        $providerXData = $this->providerXTransformer->transform($this->providerX->getData()['users']);
        $providerYData = $this->providerYTransformer->transform($this->providerY->getData()['users']);
        return array_merge($providerXData, $providerYData);

    }

    /**
     * @desc convert data into collection so we can apply queries on it
     * @param array $data
     * @return
     * @throws
     */
    public function convertDataToCollection( array $data)
    {
        /*try {*/
            $json = new Jsonq();
            $data = $json->collect($data);
            return $data;
       /* } catch (FileNotFoundException $exception) {
            return response()->json([
                'status' => 'File not found!',
                'response' => $exception,
            ])->setStatusCode(Response::HTTP_NOT_FOUND);
        }*/


    }
    }
