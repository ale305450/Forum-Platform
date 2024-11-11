<?php

namespace App\Core\Contracts;

use app\Core\DTOs\Topics\CreateTopicDto;
use app\Core\DTOs\Topics\UpdateTopicDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface TopicRepositoryInterface extends RepositoryInterface
{
    public function create(CreateTopicDto $loginDto);
    public function update($id, UpdateTopicDto $updateUserDto);
}
