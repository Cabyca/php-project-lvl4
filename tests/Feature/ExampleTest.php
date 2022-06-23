<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @phpstan-ignore-next-line */
    public function test(): void
    {
        /** @phpstan-ignore-next-line */
        $response = $this->get('/');
        /** @phpstan-ignore-next-line */
        $response->assertStatus(200);
    }
}
