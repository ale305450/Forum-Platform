<?php

namespace app\Infrastructure\Repositories;

use App\Core\Contracts\TopicRepositoryInterface;
use app\Core\DTOs\Topics\TopicDto;
use App\Core\Entities\Topic;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

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
        Gate::authorize('creator', $topic);

        $topic->update([
            'title' => $topicDto->title,
            'description' => $topicDto->description,
        ]);

        $topic->categories()->sync($topicDto->category_id);
        return $topic;
    }
    public function delete($id)
    {
        $topic = $this->find($id);
        Gate::authorize('creator', $topic);
        $topic->categories()->detach();
        $topic->delete();
    }
    public function search(Request $request)
    {
        $search = $request->search;
        $topics = Topic::where('title', 'like', "%$search%")->get();

        return $topics;
    }
    public function filter(Request $request)
    {
        $query = QueryBuilder::for(Topic::class)
            ->with('categories')
            ->allowedFilters([
                AllowedFilter::partial('categories.name') // Filter by the category name
            ])->get();

        if ($request->filled('name')) {
            $query->where('name', $request->name)->paginate(2);
        }
        dd($query);
    }
}
