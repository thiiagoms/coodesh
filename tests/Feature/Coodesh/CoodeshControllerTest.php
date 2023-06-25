<?php

namespace Coodesh;

use Tests\TestCase;
use Illuminate\Http\{JsonResponse, Response};

class CoodeshControllerTest extends TestCase
{
    /**
     * Default api root path test.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/api');

        $response->assertStatus(Response::HTTP_OK);

        $content = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('message', $content);
        $this->assertEquals('REST Back-end Challenge 20201209 Running', $content['message']);
    }
}
