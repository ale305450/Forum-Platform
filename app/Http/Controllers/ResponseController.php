<?php

namespace App\Http\Controllers;

use App\Core\Contracts\ResponseRepositoryInterface;
use App\Http\Requests\Responses\CreateResponseRequest;
use App\Http\Requests\Responses\UpdateResponseRequest;
use App\Http\Resources\ResponseResource;
use App\Core\Entities\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    protected $responseRepository;

    public function __construct(ResponseRepositoryInterface $responseRepository)
    {
        $this->responseRepository = $responseRepository;
    }
    /**
     * Display a listing of the responses.
     */
    public function index()
    {
        $responses = $this->responseRepository->all();

        return response()->json([
            'data' => ResponseResource::collection($responses)
        ]);
    }

    /**
     * Store a newly created response in storage.
     */
    public function store(CreateResponseRequest $request)
    {
        $response = $this->responseRepository->create($request->toDto());

        return response()->json(
            [
                'data' => new ResponseResource($response)
            ]
        );
    }

    /**
     * Display the specified response.
     */
    public function show($id)
    {
        $response = $this->responseRepository->find($id);

        return response()->json(
            [
                'data' => new ResponseResource($response)
            ]
        );
    }

    /**
     * Update the specified response in storage.
     */
    public function update(UpdateResponseRequest $request, $id)
    {
        $response = $this->responseRepository->update($id, $request->toDto());

        return response()->json(
            [
                'data' => new ResponseResource($response)
            ]
        );
    }

    /**
     * Remove the specified response from storage.
     */
    public function destroy($id)
    {
        $this->responseRepository->delete($id);

        return response()->json(
            [
                'message' => 'Response has been deleted'
            ]
        );
    }

    /**
     * Remove the specified response from storage.
     */
    public function topicResponses($topic_id)
    {
        $responses = $this->responseRepository->topicResponses($topic_id);

        return response()->json(
            [
                'data' =>  ResponseResource::collection($responses)
            ]
        );
    }
}
