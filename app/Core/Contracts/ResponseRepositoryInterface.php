<?php

namespace App\Core\Contracts;

use app\Core\DTOs\Responses\CreateResponseDto;
use app\Core\DTOs\Responses\UpdateResponseDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface ResponseRepositoryInterface extends RepositoryInterface
{
    public function create(CreateResponseDto $responseDto);
    public function update($id, UpdateResponseDto $responseDto);
    public function topicResponses($topic_id);
}
