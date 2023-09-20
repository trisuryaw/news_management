<?php

namespace App\Repositories\Interfaces;

interface NewsRepositoryInterface
{
    public function getAllNews();
    public function getNewsById(string $id);
    public function createNews(array $data);
    public function updateNews($id, array $data);
    public function deleteNews($id);
}
