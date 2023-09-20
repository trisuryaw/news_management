<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsResource;
use App\Models\User;
use App\Repositories\NewsRepository;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class NewsController extends Controller
{
    private $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getToken($id = 1)
    {
        $user = User::where(['id' => $id])->first();
        $token = $user->createToken('API Token')->accessToken;
        return response()->json(['token' => $token]);
    }

    public function index()
    {
        $news = $this->newsRepository->getAllNews();
        return NewsResource::collection($news);
    }

    public function store(NewsRequest $request)
    {
        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();

        $this->newsRepository->createNews([
            'user_id' => $request->input('user_id'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $fileName,
        ]);

        $file->storeAs('uploads', $fileName);

        return response()->json([
            'success' => true,
            'message' => 'News is successfully created',
        ], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $news = $this->newsRepository->getNewsById($id);
        return NewsResource::collection($news);
    }

    public function update(NewsRequest $request, $id)
    {
        $oldNews = $this->newsRepository->getNewsById($id)->first();
        Storage::delete('/uploads/' . $oldNews->image);

        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();

        $this->newsRepository->updateNews($id, [
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $fileName,
        ]);

        $file->storeAs('uploads', $fileName);

        return response()->json([
            'success' => true,
            'message' => 'News is successfully updated',
        ]);
    }

    public function destroy($id)
    {
        $oldNews = $this->newsRepository->getNewsById($id)->first();
        Storage::delete('/uploads/' . $oldNews->image);

        $this->newsRepository->deleteNews($id);
        return response()->json([
            'success' => true,
            'message' => 'News is successfully deleted',
        ]);
    }
}
