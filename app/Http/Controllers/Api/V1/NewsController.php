<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\NewsCommentSaveRequest;
use App\Http\Resources\V1\MessageResource;
use App\Http\Resources\V1\News\NewsItemResource;
use App\Http\Resources\V1\News\NewsItemsResource;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\UserNewsSaved;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $newsType = $request->news_type;

        $news = News::with(['newsType'])
            ->withCount('comments')
            ->when($newsType, function($query) use ($newsType){
                if (!empty($newsType)) $query->orderBy('created_at', 'desc');
                else if ($newsType == 'popular') {
                    $query->orderByDesc('view');
                } else if ($newsType == 'notify') {
                    $announcementNewsTypeName = 'хабарландыру';
                    $query->whereHas('newsType', fn($query) => $query->where('name->kk', 'like', "%$announcementNewsTypeName%"));
                    $query->orderByDesc('created_at');
                } else if($newsType == 'saved') {
                    $query->has('thisUserSaved');
                }
            })
            ->withExists('thisUserSaved as is_saved')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return NewsItemsResource::collection($news)->additional(['status' => true]);
    }

    public function newsAnouncements(Request $request)
    {
        $announcementNewsTypeName = 'хабарландыру';
        $news = News::with('newsType')
            ->withCount('comments')
            ->withExists('thisUserSaved as is_saved')
            ->whereHas('newsType', fn($query) => $query->where('name', 'like', "%$announcementNewsTypeName%"))
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return NewsItemsResource::collection($news)->additional(['status' => true]);
    }

    public function savedNews(Request $request)
    {

        $news = News::with('newsType')
            ->has('thisUserSaved')
            ->withCount('comments')
            ->withExists('thisUserSaved as is_saved')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return NewsItemsResource::collection($news)->additional(['status' => true]);
    }


    public function popularNews(Request $request)
    {
        $news = News::with('newsType')
            ->withCount('comments')
            ->orderByDesc('view')
            ->withExists('thisUserSaved as is_saved')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        return NewsItemsResource::collection($news)->additional(['status' => true]);
    }

    public  function show($id)
    {
        $news = News::with(['newsType'])
            ->with('comments', fn ($query) => $query->withExists('thisUserLiked as is_liked')
            ->with('user:id,full_name,avatar'))
            ->withCount('comments')
            ->withExists('thisUserSaved as is_saved')
            ->findOrFail($id);

        $news->increment('view');
        return new NewsItemResource($news);
    }

    public function saveNews($id)
    {
        $news = News::withExists('thisUserSaved as is_saved')->find($id);
        // $user = !request()->expectsJson() ? auth()->user() : auth()->guard('api')->user();
        $user = auth()->guard('api')->user();
        if ((bool) $news->is_saved) {
            UserNewsSaved::where('user_id', $user->id)
                ->where('news_id', $news->id)
                ->delete();
        } else {
            UserNewsSaved::upsert([
                'user_id' => $user->id,
                'news_id' => $news->id,
            ], [
                'user_id' => $user->id,
                'news_id' => $news->id
            ]);

        }
        $msg = $news->thisUserSaved()->exists() ? __('message.success.saved') : __('message.success.deleted');
        return new MessageResource($msg);
    }

    public function newsCommentSave($id, NewsCommentSaveRequest $request)
    {

        $news = News::findOrFail($id);
        $user = auth()->guard('api')->user();
        $news->comments()->create([
            'user_id' =>  $user->id,
            'text' => $request->text,
            'parent_id' => $request->comment_id
        ]);
        return new MessageResource(__('message.success.saved'));

    }
}
