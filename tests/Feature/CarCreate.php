<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarCreate extends TestCase
{
    /**
     * A basic feature test example.
     */

    private string $endPoint = '/api/cars';
    public function test_example(): void
    {
        $body = [
            'name' => fake()->name(),
            'dayRate' => fake()->numberBetween(200, 300),
            'monthRate' => fake()->numberBetween(1000, 10000),
            'imageUrl' => fake()->imageUrl(),
        ];
        $response = $this->withHeaders([])->post($this->endPoint, $body);

        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['errors' => null]);

        $response->assertStatus(200);
    }
}
