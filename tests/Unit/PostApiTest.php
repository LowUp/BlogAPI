<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

// use App\Models\Post;

class PostApiTest extends TestCase
{
    protected int $testId = 40;
    /**
     * A basic unit test example.
     */
    // public function test_example(): void
    // {
    //     $this->assertTrue(true);
    // }

    /**
     * Test the POST method for posts api.
     */
    public function test_store_post_api(): void
    {
        $testInput = [
            'title' => 'Test Title',
            'content' => 'Test Content',
            'author' => 'Test Author'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Basic ' . base64_encode('test:test'),
        ])->postJson('api/posts', $testInput);

        $response
            ->assertStatus(201)
            ->assertJson(
                [
                    'message' => 'Post sucefully created'
                ]
            );

    }

    /**
     * Test the GET method for posts api.
     */
    public function test_get_post_api(): void
    {

        $response = $this->getJson('api/posts/' . $this->testId);

        $response
            ->assertStatus(200)
            ->assertJson(
                fn(AssertableJson $json) =>
                $json->where('id', $this->testId)
                    ->where('title', 'Test Title')
                    ->where('content', 'Test Content')
                    ->where('author', 'Test Author')
                    ->etc()
            );
    }

    /**
     * Test the POST method for posts api with invalid format inside the body of the request.
     */
    public function test_store_post_api_with_invalid_format(): void
    {
        $testInput = [
            'title' => 'Test Title',
            'author' => 'Test Author'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Basic ' . base64_encode('test:test'),
        ])->postJson('api/posts', $testInput);

        $response
            ->assertStatus(422);
    }

    /**
     * Test the authentication for posts api.
     */
    public function test_auth_post_api(): void
    {
        $testInput = [
            'title' => 'Test Title',
            'content' => 'Test Content',
            'author' => 'Test Author'
        ];

        $response = $this->postJson('api/posts', $testInput);

        $response
            ->assertStatus(401);
    }
}
