<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    protected string $statuses;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();

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
        $fakeStatus = TaskStatus::factory()->make()->getAttribute('name');

        $data = [
            "name" => $fakeStatus
        ];
        $response = $this->post(route('task_statuses.store'), $data);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', ['name' => $fakeStatus]);
    }

    public function testStoreInvalid()
    {
        $data = [
            "name" => ""
        ];
        $response = $this->post(route('task_statuses.store'), $data);
        $response->assertRedirect();
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('task_statuses', ['name' => '']);
    }

    public function testUpdate()
    {
        $taskStatus = TaskStatus::first();

        //$taskStatusFake = TaskStatus::factory()->make();
        //$nameFakeStatus = $taskStatusFake->first()->getAttribute('name');

        $fakeStatus = TaskStatus::factory()->make()->getAttribute('name');

        $response = $this->patch(
            route('task_statuses.update', $taskStatus->id),
            ['name' => $fakeStatus]
        );

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', ['name' => $fakeStatus]);
    }

    public function testUpdateWithValidationErrors()
    {
        $taskStatus = TaskStatus::first();

        $data = [
            "name" => ""
        ];
        $response = $this->patch(
            route('task_statuses.update', $taskStatus->id),
            $data
        );
        $response->assertSessionHasErrors();
    }

    public function testEdit()
    {
        $id = TaskStatus::first()->id;

        $response = $this->get(route('task_statuses.edit', $id), [$this->statuses]);
        //$response->assertSee('PATCH');
        $response->assertOk();
        $response->assertViewIs('statuses.edit');
    }

    public function testDestroy()
    {
        $taskStatus = TaskStatus::first();
        $response = $this->delete(route('task_statuses.destroy', $taskStatus));
        //$response->assertRedirect();
        $taskStatus = TaskStatus::find($taskStatus->id);
        $this->assertDatabaseMissing('tasks', ['id' => $taskStatus->id]);
    }
}
