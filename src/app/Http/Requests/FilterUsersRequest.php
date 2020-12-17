<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class FilterUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'provider' =>   ['string',Rule::in(['DataProviderX','DataProviderY'])],
            'statusCode' => ['string',Rule::in(['authorised','decline','refunded'])],
            'balanceMin' => ['integer','required_with:balanceMax','lt:balanceMax'],
            'balanceMax' => ['integer','required_with:balanceMin','gt:balanceMin'],
            'currency' => ['string']
        ];
    }

    /** override failedValidation function to customize the validation api response
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'status' => 'Invalid inputs!',
            'response' => $validator->errors()->first(),
        ])->setStatusCode(JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
