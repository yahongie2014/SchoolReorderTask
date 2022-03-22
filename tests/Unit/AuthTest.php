<?php

namespace Tests\Unit;

use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testValidationAuth()
    {
        $this->json('POST', 'api/login', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "email" => ["The email field is required."],
                    "password" => ["The password field is required."],
                ]
            ]);
    }

    public function testSuccessAuth()
    {
        $userData = [
            "email" => "admin@admin.com",
            "password" => "123456",
        ];

        $this->json('POST', 'api/login', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'token_type' => 'Bearer',
                'message' => 'New Success Login',
                "userInfo" => [],
                "success" => true
            ]);
        $this->assertAuthenticated();

    }
}
