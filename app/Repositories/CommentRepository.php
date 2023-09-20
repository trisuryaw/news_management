<?php

namespace App\Repositories;

use App\Models\CommentModel;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{

    public function createComment($data)
    {
        return CommentModel::create($data);
    }

    public function getCommentById($id)
    {
        return CommentModel::find(['id' => $id])->first();
    }

}
