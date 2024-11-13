<?php

namespace App\Core\Contracts;

use app\Core\DTOs\Users\LoginDto;
use app\Core\DTOs\Users\RegisterDto;
use app\Core\DTOs\Users\UpdateUserDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function login(LoginDto $loginDto): string;
    public function register(RegisterDto $registerDto);
    public function update($id, UpdateUserDto $updateUserDto);
    public function logout(Request $request);
    public function findByEmail($email);
    public function filter(Request $request);
    public function search(Request $request);
}
