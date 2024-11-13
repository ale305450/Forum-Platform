<?php

namespace app\Infrastructure\Repositories;

use App\Core\Contracts\TopicRepositoryInterface;
use app\Core\DTOs\Topics\TopicDto;
use App\Core\Entities\Topic;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TopicRepository implements TopicRepositoryInterface
{
    public function all(): Collection
    {
        return Topic::with('user')->get();
    }
    public function find($id)
    {
        return Topic::with('user')->findOrFail($id);
    }
    public function create(TopicDto $topicDto)
    {
        //dd($topicDto->category_id);
        $user_id = Auth::user()->id;
        $topic = Topic::create([
            'title' => $topicDto->title,
            'description' => $topicDto->description,
            'user_id' => $user_id
        ]);
        
        $topic->categories()->attach($topicDto->category_id);
        return $topic;
    }
    public function update($id, TopicDto $topicDto)
    {
        $topic = $this->find($id);

        $topic->update([
            'title' => $topicDto->title,
            'description' => $topicDto->description,
        ]);

        return $topic;
    }
    public function delete($id)
    {
        $topic = $this->find($id);
        $topic->delete();
    }
}
