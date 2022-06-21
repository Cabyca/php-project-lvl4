<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    protected string $users;
    protected string $tasks;
    protected string $statuses;

    protected function setUp(): void
    {
        parent::setUp();

        $this->statuses = TaskStatus::factory()->count(4)->create();
        $this->tasks = Task::factory()->count(4)->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
        $response->assertViewIs('tasks.index');
    }

    public function testCreate()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('tasks.create'));
        $response->assertOk();
        $response->assertViewIs('tasks.create');
    }

    public function testStore()
    {
        $user = User::factory()->create();

        $fakeTask = Task::factory()->make();

        $data = [
            'name' => $fakeTask->getAttribute('name'),
            'description' => $fakeTask->getAttribute('description'),
            'status_id' => $fakeTask->getAttribute('status_id'),
            //'created_by_id' => $fakeTask->getAttribute('created_by_id'),
            'assigned_to_id' => $fakeTask->getAttribute('assigned_to_id'),
        ];
        $response = $this->actingAs($user)->post(route('tasks.store'), $data);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('tasks', ['name' => $fakeTask->getAttribute('name')]);
    }

    public function testStoreInvalid()
    {
        $user = User::factory()->create();

        $fakeTask = Task::factory()->make();

        $data = [
            'name' => '',
            'description' => $fakeTask->getAttribute('description'),
            'status_id' => $fakeTask->getAttribute('status_id'),
            'assigned_to_id' => $fakeTask->getAttribute('assigned_to_id'),
        ];
        $response = $this->actingAs($user)->post(route('tasks.store'), $data);
        $response->assertRedirect();
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('tasks', ['name' => '']);
    }

    public function testUpdate()
    {
        $user = User::factory()->create();

        $task = Task::first();

        $fakeTask = Task::factory()->make();

        $data = [
            'name' => $fakeTask->getAttribute('name'),
            'description' => $fakeTask->getAttribute('description'),
            'status_id' => $fakeTask->getAttribute('status_id'),
            'assigned_to_id' => $fakeTask->getAttribute('assigned_to_id'),
        ];

        $response = $this->actingAs($user)->patch(route('tasks.update', $task->id), $data);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('tasks', ['name' => $fakeTask->getAttribute('name')]);
    }

    public function testUpdateWithValidationErrors()
    {
        $user = User::factory()->create();

        $task = Task::first();

        $fakeTask = Task::factory()->make();

        $data = [
            'name' => '',
            'description' => $fakeTask->getAttribute('description'),
            'status_id' => $fakeTask->getAttribute('status_id'),
            'assigned_to_id' => $fakeTask->getAttribute('assigned_to_id'),
        ];

        $response = $this->actingAs($user)->patch(route('tasks.update', $task->id), $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('tasks', ['name' => $fakeTask->getAttribute('name')]);
    }

    public function testEdit()
    {
        $id = Task::first()->id;
        $response = $this->get(route('tasks.edit', $id), [$this->tasks]);
        $response->assertOk();
        $response->assertViewIs('tasks.edit');
    }

    public function testShow()
    {
        $user = User::factory()->create();

        $task = Task::first();

        $response = $this->actingAs($user)->get(route('tasks.show', [$task]));
        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $user = User::factory()->create();
        $task = Task::first();
        $response = $this->actingAs($user)->delete(route('tasks.destroy', $task));
        $response->assertRedirect();
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
