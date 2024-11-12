<?php

namespace app\Infrastructure\Repositories;

use App\Core\Contracts\UserRepositoryInterface;
use app\Core\DTOs\Users\LoginDto;
use app\Core\DTOs\Users\RegisterDto;
use app\Core\DTOs\Users\UpdateUserDto;
use App\Core\Entities\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserRepository implements UserRepositoryInterface
{
    public function all(): Collection
    {
        $users = User::with('media')->get();
        return $users;
    }
    public function find($id)
    {
        return User::findOrFail($id);
    }
    public function delete($id)
    {
        $user = $this->find($id);
        $user->delete();
    }
    public function register(RegisterDto $registerDto)
    {

        $user = User::create([
            'name' => $registerDto->name,
            'email' => $registerDto->email,
            'password' => $registerDto->password,
        ]);

        // Add media if an image is included in the DTO
        if (isset($registerDto->profile_picture) && $registerDto->profile_picture instanceof UploadedFile) {
            $user->addMedia($registerDto->profile_picture)->toMediaCollection('profile_images');
        }
        //$user->assignRole('user');
        return $user;
    }
    public function login(LoginDto $loginDto): string
    {
        if (Auth::attempt([
            'email' => $loginDto->email,
            'password' => $loginDto->password
        ])) {
            $user = $this->findByEmail($loginDto->email);
            $token = $user->createToken('auth_token')->plainTextToken;
            return $token;
        } else {
            return 'There is error in email or password';
        }
    }
    public function logout(Request $request)
    {
        //logout out the current user
        $request->user()->tokens()->delete();
    }
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }
    public function update($id, UpdateUserDto $updateUserDto)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $updateUserDto->name,
            'password' => $updateUserDto->password,
        ]);

        if ($updateUserDto->profile_picture != null) {
            $oldImage = $user->getFirstMedia('profile_images');
            if($oldImage != null)
            {
                $oldImage->delete();
            }
            // Add media if an image is included in the DTO
            if (isset($updateUserDto->profile_picture) && $updateUserDto->profile_picture instanceof UploadedFile) {
                $user->addMedia($updateUserDto->profile_picture)->toMediaCollection('profile_images');
            }
        }
        return $user;
    }
}