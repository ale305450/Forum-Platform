<?php

namespace App\Http\Controllers;

use App\Core\Contracts\UserRepositoryInterface;
use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Users\RegisterRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of all users.
     */
    public function index()
    {
        $users = $this->userRepository->all();
        return response()->json([
            'data' => UserResource::collection($users->load('media')),
        ]);
    }

    /**
     * Store a newly created user in storage.
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->userRepository->register($request->toDto());

        return response()->json([
            'data' => new UserResource($user),
        ]);
    }

    /**
     * Login the user.
     */
    public function login(LoginRequest $request)
    {
        $token = $this->userRepository->login($request->toDto());

        return response()->json([
            'token' => $token,
        ]);
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        $this->userRepository->logout($request);

        return response()->json([
            'message' => 'the user logout succsfully',
        ]);
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id)->load('media');
        // dd($user);
        return new UserResource($user);
        //  response()->json([
        //     'data' => new UserResource($user),
        // ]);
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userRepository->update($id, $request->toDto());

        return response()->json(['data' => $user]);
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);

        return response()->json(['message' => 'user deleted']);
    }

    /**
     * Filter the users by the name.
     */
    public function filter(Request $request)
    {
        $users = $this->userRepository->filter($request);

        return response()->json([
            'filterd users' => $users
        ]);
    }
}
