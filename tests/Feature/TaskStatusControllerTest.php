<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    protected string $status;

    protected function setUp(): void
    {
        parent::setUp();

        $this->status = TaskStatus::factory()->count(4)->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
        $response->assertViewIs('statuses.index');
    }

    public function testStore()
    {
        $data = [
            "name" => "новый статус"
        ];
        $response = $this->post(route('task_statuses.store'), $data);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('task_statuses', ['name' => 'новый статус']);
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

        $taskStatusFake = TaskStatus::factory()->make();

        dd($taskStatusFake);

        $response = $this->patch(route('task_statuses.update', $taskStatus->id), $taskStatusFake);

//        $data = $this->validate($request, [
//            'name' => 'required|string|unique:task_statuses'
//        ]);
//
//        $taskStatus->fill($data);
//        $taskStatus->save();

    }
}
