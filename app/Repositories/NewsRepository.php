<?php

namespace App\Repositories;

use App\Events\NewsEvent;
use App\Models\NewsModel;
use App\Repositories\Interfaces\NewsRepositoryInterface;

class NewsRepository implements NewsRepositoryInterface
{

    public function getAllNews()
    {
        return NewsModel::paginate(5);
    }

    public function getNewsById(string $id)
    {
        return NewsModel::find(['id' => $id]);
    }

    public function createNews(array $data)
    {
        event(new NewsEvent('Created a news'));
        return NewsModel::create($data);
    }

    public function updateNews($id, $data)
    {
        event(new NewsEvent('Updated a news'));
        return NewsModel::where(['id' => $id])->update($data);
    }

    public function deleteNews($id)
    {
        event(new NewsEvent('Deleted a news'));
        return NewsModel::where(['id' => $id])->delete();
    }
}
