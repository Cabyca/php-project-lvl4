<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    protected string $statuses;

    protected function setUp(): void
    {
        parent::setUp();

        $this->statuses = TaskStatus::factory()->count(4)->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
        $response->assertViewIs('statuses.index');
    }

    public function testStore()
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->make();
        $data = $taskStatus->only(['name']);
        $response = $this
            ->actingAs($user)
            ->post(route('task_statuses.store'), $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testStoreInvalid()
    {
        $user = User::factory()->create();

        $data = [
            "name" => ""
        ];
        $response = $this->actingAs($user)->post(route('task_statuses.store'), $data);
        $response->assertRedirect();
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('task_statuses', ['name' => '']);
    }

    public function testUpdate()
    {
        $user = User::factory()->create();

        $taskStatus = TaskStatus::first();

        $fakeStatus = TaskStatus::factory()->make()->getAttribute('name');

        $response = $this->actingAs($user)->patch(
            route('task_statuses.update', $taskStatus->id),
            ['name' => $fakeStatus]
        );

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', ['name' => $fakeStatus]);
    }

    public function testUpdateWithValidationErrors()
    {
        $user = User::factory()->create();

        $taskStatus = TaskStatus::first();

        $data = [
            "name" => ""
        ];
        $response = $this->actingAs($user)->patch(
            route('task_statuses.update', $taskStatus->id),
            $data
        );
        $response->assertSessionHasErrors();
    }

    public function testEdit()
    {
        $id = TaskStatus::first()->id;

        $response = $this->get(route('task_statuses.edit', $id), [$this->statuses]);
        $response->assertOk();
        $response->assertViewIs('statuses.edit');
    }

    public function testDestroy()
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::first();
        $response = $this->actingAs($user)->delete(route('task_statuses.destroy', $taskStatus));
        $response->assertRedirect();
        $this->assertDatabaseMissing('task_statuses', ['id' => $taskStatus->id]);
    }
}
