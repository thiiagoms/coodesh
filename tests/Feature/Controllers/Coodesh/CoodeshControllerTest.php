<?php

namespace Controllers\Coodesh;

use Illuminate\Http\{Response};
use Tests\TestCase;

class CoodeshControllerTest extends TestCase
{
    /**
     * Default api root path test.
     *
     * @return void
     */
    public function test_coodesh_get_endpoint(): void
    {
        $response = $this->get('/api');

        $response->assertStatus(Response::HTTP_OK);

        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('message', $content);
        $this->assertEquals('REST Back-end Challenge 20201209 Running', $content['message']);
    }
}
