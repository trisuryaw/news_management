<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    private $commentRepository;
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index(CommentRequest $request)
    {
        $this->commentRepository->createComment([
            'news_id' => $request->input('news_id'),
            'user_id' => $request->input('user_id'),
            'text' => $request->input('text')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment is successfully created',
        ], Response::HTTP_CREATED);
    }
}
