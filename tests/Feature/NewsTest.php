<?php

namespace Tests\Feature;

use App\Http\Resources\NewsResource;
use App\Repositories\NewsRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class NewsTest extends TestCase
{
    private $newsRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->newsRepository = new NewsRepository();
    }

    public function testGetToken()
    {
        $token = $this->get('/api/user/1')->decodeResponseJson();
        dd($token);
    }


    public function testCreateSuccess()
    {
        $this->post('/api/news', [
            'user_id' => '1',
            'title' => 'Test22',
            'content' => 'Content',
            'image' => UploadedFile::fake()->image('test.png')
        ], ['Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNWQ2YjY3ZmFkMzdmMjRhZmMyODQ1OWE4YTEzNGEwMDQxMGQ4OTIyZmZiODAyMDlmNmIzMGZiOTRlNmY2YmQ4YWQ2ZTcyMjlhYzc5ZGQ1NzgiLCJpYXQiOjE2OTUyMTg0NDAuMDUwNjMxLCJuYmYiOjE2OTUyMTg0NDAuMDUwNjM1LCJleHAiOjE3MjY4NDA4NDAuMDQzNTY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.bwlvD40Cq5rOBKWSHtV4CxMzViV2SUeZP7G0Q_KkXVOTUlkUFbllspSTGO-ALcITjqTBO_T7y5A02hHvzMyEjgY8cGLXpde2dpYFUSbXjsc2I5ZQFXzNBzjSCfAfx1nQjKqMdqodVmUqR2tue7Gy5iWJGRs6uvbIDNwdVOFy_u6dFsqVHNccaPyN_tAxkx34_d6GKPUUVsrrtMmROfu3FofqjvzzDVzXXihnM4O8ZKYdqpaHpY1p_usaeKuPT4kNxnycK7AwMHpZHUnKo_G5X9mP0DtUiQpNHyko8NZvv1SBtfj8fU5Mhg5Dfl9v8r7WLVzbPSpSMETztf8zLSPNQ9gg_Srzr_RFdNj1lixdpdC4ctznqyyXJoTcwTIjAgskkEDUFd_kKjKgc0TIJgm7NWUHLxTubYi1p8wThg2Lsgf6lUgAf-HK5nkKuQJFkKWpYf_f0kRAbL6MUWbxqYVYzWCr7hqap1BfoGJSFkBU6ZerOVqMcXOelURVe_bsy558ph_TIautHJO39m8oLm_j6JiRSgWpJcJEJOrl2D3upMm6CeJ44YuvNQCrFe2BWqdXuY1G1uQ_L-PwfHHy7sH4nWaKbtN_W7-YjxL9s17AUkzDf3dAPIu3e4LPkXz8ZwZd7KSmn5U4SO5-z-Dll8e4cA7W1xbOI-VGLXmcHpsuIpo'])
            ->assertStatus(201)
            ->json([
                'success' => true,
                'message' => 'News is successfully created'
            ]);
    }


    public function testGetAll()
    {
       $this->get('/api/news',
           ['Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZTE5YjQ1OTRkMDE4MTZiYjQ3NmRiZjRiMTFiNjcwZDk5ODMzNmE2ZmVmNWExYWMwYzI3OGVkNWMxZWFiY2VhYjA0YzU0NTE1ZDcwYjU2MjkiLCJpYXQiOjE2OTUxOTk4OTguMTc5OTc5LCJuYmYiOjE2OTUxOTk4OTguMTc5OTg1LCJleHAiOjE3MjY4MjIyOTguMTczMTcyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.A4FYa04SdkjR7tVRHjMVhZ1EQcCY-h5AIVErOIRbJQauUMUaPCrW--L9Lc5PkXdvrIvlqM2Pr0Bq0wYF00iKiVPP6dS4oLEb4K5U5FR99SIC6U8Z_EpvIxLog8z2di-sO_ZhoKxqgCoANlpBomFiT5x92l9UBig-do_5YQJfrXcks-9Y9uaksxEhJ-phT4qONrKRW_TSS95Dr3vzmQAbNmsvTUR5EOneI-5PsiJ1TNfDItONyODlNBY4C61du0nfVrH-zo0sZXqHfU6stYJKSg-7i-J0SyVeqZ7dcutrW2mfvBMfEcIX6nbOW5gs-skCVtD8C8CUBsrA8LbnudOBJJeO4cxfrqzAG6xUabZoAVNdAP0ggPrx2z-aOzJaj4uAqHipqadyXbaSnI58miYZBDSiDjnkUkpksUAR9gbzI0t_ngZRAcHhDoF6VWG3zjMA99BFg6EYLNtAaTDnVGqKvWn-57mf3M-ePbeITHmxEC_fWBRtx28R9Q1iOb3JlBmE5r0Umt1QR2DyOX4lzsmjuqeLLbroz1CSWFgJieDgbMgZ65VqPdIyU4P19TkRe6S2qAn7yxjoTKzr-v-yDOkJpA5ibR0pOVaGbBKwPf27a_e1sR8mPhnvLlGmohxXiPITUfDvdP_4sf2ByZ_XvMWAo503i_oVOy02zhueUTkEbf0']
       )->assertStatus(200);
    }

    public function testGetNewsById()
    {
        $this->get('/api/news/10',
            ['Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZTE5YjQ1OTRkMDE4MTZiYjQ3NmRiZjRiMTFiNjcwZDk5ODMzNmE2ZmVmNWExYWMwYzI3OGVkNWMxZWFiY2VhYjA0YzU0NTE1ZDcwYjU2MjkiLCJpYXQiOjE2OTUxOTk4OTguMTc5OTc5LCJuYmYiOjE2OTUxOTk4OTguMTc5OTg1LCJleHAiOjE3MjY4MjIyOTguMTczMTcyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.A4FYa04SdkjR7tVRHjMVhZ1EQcCY-h5AIVErOIRbJQauUMUaPCrW--L9Lc5PkXdvrIvlqM2Pr0Bq0wYF00iKiVPP6dS4oLEb4K5U5FR99SIC6U8Z_EpvIxLog8z2di-sO_ZhoKxqgCoANlpBomFiT5x92l9UBig-do_5YQJfrXcks-9Y9uaksxEhJ-phT4qONrKRW_TSS95Dr3vzmQAbNmsvTUR5EOneI-5PsiJ1TNfDItONyODlNBY4C61du0nfVrH-zo0sZXqHfU6stYJKSg-7i-J0SyVeqZ7dcutrW2mfvBMfEcIX6nbOW5gs-skCVtD8C8CUBsrA8LbnudOBJJeO4cxfrqzAG6xUabZoAVNdAP0ggPrx2z-aOzJaj4uAqHipqadyXbaSnI58miYZBDSiDjnkUkpksUAR9gbzI0t_ngZRAcHhDoF6VWG3zjMA99BFg6EYLNtAaTDnVGqKvWn-57mf3M-ePbeITHmxEC_fWBRtx28R9Q1iOb3JlBmE5r0Umt1QR2DyOX4lzsmjuqeLLbroz1CSWFgJieDgbMgZ65VqPdIyU4P19TkRe6S2qAn7yxjoTKzr-v-yDOkJpA5ibR0pOVaGbBKwPf27a_e1sR8mPhnvLlGmohxXiPITUfDvdP_4sf2ByZ_XvMWAo503i_oVOy02zhueUTkEbf0']
        )->assertStatus(200)->json([
            'title' => 'Test',
            'content' => 'Content',
            'image' => '1695199947_test.png'
        ]);
        $filePath = 'uploads/1695199947_test.png';
        $this->assertTrue(Storage::disk('local')->exists($filePath));    }

    public function testNewsUpdate()
    {
        $data = $this->put('/api/news/9', [
            'title' => 'Test 22',
            'content' => 'Test 22',
            'image' => UploadedFile::fake()->image('test2.png'),
        ], ['Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiODA1NzZkZWY3MTM4MjEwNzBmMjY1MWUwZjM1NTFjZDc2ODgwMTY1YjlmM2FkYjliYzg1ODNhZmI3NzJiZmNlZmI1ODBjOWQyMzc3MDQ0MGMiLCJpYXQiOjE2OTUxNjkwODguMTIyODc5LCJuYmYiOjE2OTUxNjkwODguMTIyODg5LCJleHAiOjE3MjY3OTE0ODguMTEyMTczLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.D9LsmMeZpY1S8ygRcXMAIBTndAnQPU61R0rq4YnSwN-2ocfJP4QyhxH8BMxEhB15FHYD0u_lObYQnJdtg7F6mdig7DlkUbzjPSx04HTD0vH-Zoe8Mpdp_BEI7Cylk_pfbLnQUXjZdc4H8_x-Cjlf6LQHnHWrorhyNTVB1EBtlulg-MH-kSU2xlWrf2koNFTQzK862Zepf7hl1Sn-ugs8Xz1yiinZtgYYbjlRcBCgelhvLhrVbyKKgbkG2o1xxNbaH3Y5WGdwlBWA59p3dqW4SSPI5jwMcNKhxUeh6_DeV7k6Ee9Q4G4hVam6eoa44ATFB1m_2kY9x7aAZVy9P-7XaE8T3yoQDVB80M6BfbO1tSXKBgllavHPDviuqlnaH1bOTp3vm9flz0x1dkp-RgweEYHV0A2L4znbnqiKuD04FwUe_cXxeERsun0gbBCwaphD2916wpFmCuPIF5YrQ7un-sVIz-ufVIQp85gu5TyOSdk-vyZfZiqB4GrbIC1mDo1wf5jU5YR-R4_v0BaFkgCafBJvW4ngIivv-w4tg0sqQCQF8S34uwDeDfBkZVIOBD0Nx3uanjlA7j6AP0aUgnc3EVT_6b8Rs5uhEEk2CD7a0EOL3zOFBhlVhT2Yk4W2ILOFC-VgUSuc9hkvGiaNvJupTjbtkaa_WwW8YyuIVAHb16w'])
        ->assertStatus(200)->json([
                'success' => true,
                'message' => 'News is successfully updated']);
    }

    public function testNewsDelete()
    {
        $this->delete('/api/news/9', [], [
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiODA1NzZkZWY3MTM4MjEwNzBmMjY1MWUwZjM1NTFjZDc2ODgwMTY1YjlmM2FkYjliYzg1ODNhZmI3NzJiZmNlZmI1ODBjOWQyMzc3MDQ0MGMiLCJpYXQiOjE2OTUxNjkwODguMTIyODc5LCJuYmYiOjE2OTUxNjkwODguMTIyODg5LCJleHAiOjE3MjY3OTE0ODguMTEyMTczLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.D9LsmMeZpY1S8ygRcXMAIBTndAnQPU61R0rq4YnSwN-2ocfJP4QyhxH8BMxEhB15FHYD0u_lObYQnJdtg7F6mdig7DlkUbzjPSx04HTD0vH-Zoe8Mpdp_BEI7Cylk_pfbLnQUXjZdc4H8_x-Cjlf6LQHnHWrorhyNTVB1EBtlulg-MH-kSU2xlWrf2koNFTQzK862Zepf7hl1Sn-ugs8Xz1yiinZtgYYbjlRcBCgelhvLhrVbyKKgbkG2o1xxNbaH3Y5WGdwlBWA59p3dqW4SSPI5jwMcNKhxUeh6_DeV7k6Ee9Q4G4hVam6eoa44ATFB1m_2kY9x7aAZVy9P-7XaE8T3yoQDVB80M6BfbO1tSXKBgllavHPDviuqlnaH1bOTp3vm9flz0x1dkp-RgweEYHV0A2L4znbnqiKuD04FwUe_cXxeERsun0gbBCwaphD2916wpFmCuPIF5YrQ7un-sVIz-ufVIQp85gu5TyOSdk-vyZfZiqB4GrbIC1mDo1wf5jU5YR-R4_v0BaFkgCafBJvW4ngIivv-w4tg0sqQCQF8S34uwDeDfBkZVIOBD0Nx3uanjlA7j6AP0aUgnc3EVT_6b8Rs5uhEEk2CD7a0EOL3zOFBhlVhT2Yk4W2ILOFC-VgUSuc9hkvGiaNvJupTjbtkaa_WwW8YyuIVAHb16w'
        ])->assertStatus(200)->json([
            'success' => true,
            'message' => 'News is successfully deleted'
        ]);
    }


}
