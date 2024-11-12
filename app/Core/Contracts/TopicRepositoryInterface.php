<?php

namespace App\Core\Contracts;

use app\Core\DTOs\Topics\TopicDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface TopicRepositoryInterface extends RepositoryInterface
{
    public function create(TopicDto $loginDto);
    public function update($id, TopicDto $updateUserDto);
}
