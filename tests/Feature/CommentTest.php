<?php

namespace Tests\Feature;

use App\Repositories\CommentRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class CommentTest extends TestCase
{
    private $commentRepository;
    protected function setUp(): void
    {
        parent::setUp();
        $this->commentRepository = new CommentRepository();
    }


    public function testCreateComment()
    {
        $this->commentRepository->createComment([
            'news_id' => '2',
            'user_id' => '2',
            'text' => 'Test 2'
        ]);
    }

    public function testRedis()
    {
        $isConnected = Redis::ping();

        if ($isConnected) {
            echo "Laravel terhubung dengan Redis!";
        } else {
            echo "Laravel tidak terhubung dengan Redis.";
        }
    }


}
