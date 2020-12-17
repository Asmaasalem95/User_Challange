<?php


namespace App\Repositories;


use App\Contracts\UserRepositoryInterface;
use App\Entities\ProviderX;
use App\Entities\ProviderY;
use App\Transformers\ProviderXTransformer;
use App\Transformers\ProviderYTransformer;
use App\Utilities\Filters\CurrencyFilter;
use App\Utilities\Filters\ProviderFilter;
use App\Utilities\Filters\RangeFilter;
use App\Utilities\Filters\StatusCodeFilter;
use Illuminate\Http\Response;
use Nahid\JsonQ\Jsonq;
use Nahid\QArray\Exceptions\ConditionNotAllowedException;
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
     * @desc apply filter classes on data
     *
     * @param array $filters
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function filter( array $filters)
    {
        // TODO: Implement filter() method.
        $data = $this->convertDataToCollection($this->mergeDataFromProviders());
        try {
            if (isset($filters['provider'])) {
                $data = ProviderFilter::apply($data, $filters['provider']);
            }
            if (isset($filters['statusCode'])) {
                $data = StatusCodeFilter::apply($data, $filters['statusCode']);
            }
            if (isset($filters['balanceMin']) && isset($filters['balanceMax'])) {

                $data = RangeFilter::apply($data, array('balanceMin' => $filters['balanceMin'], 'balanceMax' => $filters['balanceMax']));
            }
            if (isset($filters['currency'])) {
                $data =  CurrencyFilter::apply($data, $filters['currency']);
            }

            return $data->get()->toArray();

        } catch (ConditionNotAllowedException $exception) {
            return response()->json([
                'status' => 'Error1!',
                'response' => $exception->getMessage(),
            ])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }


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
        try {
            $json = new Jsonq();
            $data = $json->collect($data);
            return $data;
        } catch (FileNotFoundException $exception) {
            return response()->json([
                'status' => 'File not found!',
                'response' => $exception,
            ])->setStatusCode(Response::HTTP_NOT_FOUND);
        }


    }
    }
