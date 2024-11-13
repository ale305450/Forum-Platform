<?php

namespace app\Infrastructure\Repositories;

use App\Core\Contracts\ResponseRepositoryInterface;
use app\Core\DTOs\Responses\CreateResponseDto;
use app\Core\DTOs\Responses\UpdateResponseDto;
use App\Core\Entities\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ResponseRepository implements ResponseRepositoryInterface
{
    public function all(): Collection
    {
        return Response::with(['user', 'topic', 'parent', 'replies'])->get();
    }

    public function create(CreateResponseDto $responseDto)
    {
        dd( $responseDto);
        $user_id = Auth::user()->id;
        $response = Response::create([
            'user_id' => $user_id,
            'topic_id' => $responseDto->topic_id,
            'content' => $responseDto->content,
            'parent_id' => $responseDto->parent_id
        ]);

        return $response;
    }

    public function find($id)
    {
        return Response::findOrFail($id);
    }

    public function update($id, UpdateResponseDto $responseDto)
    {
        $response = $this->find($id);
        Gate::authorize('writer', $response);
        $response->update(
            [
                'content' => $responseDto->content,
            ]
        );

        return $response;
    }

    public function delete($id)
    {
        $response = $this->find($id);
        Gate::authorize('writer', $response);
        $response->delete();
    }
}
