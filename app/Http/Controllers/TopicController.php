<?php

namespace App\Http\Controllers;

use App\Core\Contracts\TopicRepositoryInterface;
use App\Core\Entities\Topic;
use App\Http\Requests\Topics\TopicRequest;
use App\Http\Resources\TopicResource;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    protected $topicRepository;

    public function __construct(TopicRepositoryInterface $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }
    /**
     * Display a listing of the topics.
     */
    public function index()
    {
        $topics = $this->topicRepository->all();

        return response()->json([
            'data' => TopicResource::collection($topics)
        ]);
    }

    /**
     * Store a newly created topic in storage.
     */
    public function store(TopicRequest $request)
    {
        $topic = $this->topicRepository->create($request->toDto());

        return response()->json([
            'data' => new TopicResource($topic)
        ]);
    }

    /**
     * Display the specified topic.
     */
    public function show($id)
    {
        $topic = $this->topicRepository->find($id);

        return response()->json([
            'data' => new TopicResource($topic)
        ]);
    }

    /**
     * Update the specified topic in storage.
     */
    public function update(TopicRequest $request, $id)
    {
        $topic = $this->topicRepository->update($id, $request->toDto());

        return response()->json([
            'data' => new TopicResource($topic)
        ]);
    }

    /**
     * Remove the specified topic from storage.
     */
    public function destroy($id)
    {
        $this->topicRepository->delete($id);

        return response()->json([
            'message' => 'topic deleted succsfully'
        ]);
    }
}
