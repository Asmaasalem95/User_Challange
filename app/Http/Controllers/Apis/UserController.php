<?php

namespace App\Http\Controllers\Apis;

use App\Contracts\UserServiceInterface;
use App\Http\Requests\FilterUsersRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class UserController extends Controller
{

    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index(FilterUsersRequest $request)
    {
        try {
           $users = $this->userService->getFilteredUsers($request->all());
            return response()->json([
                'status' => 'Success',
                'data'=> $users,
            ])->setStatusCode(Response::HTTP_OK);

          //  \response()->
        }
        catch (\Exception $e)
        {
            return response()->json([
                'status' => 'Error2!',
                'response' => $e->getMessage(),
            ])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

    }
}
