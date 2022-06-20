<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelControllerTest extends TestCase
{
    protected string $labels;
    protected string $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->labels = Label::factory()->count(4)->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
        $response->assertViewIs('labels.index');
    }

    public function testCreate()
    {
        $response = $this->get(route('labels.create'));
        $response->assertOk();
        $response->assertViewIs('labels.create');
    }

    public function testStore()
    {
        $user = User::factory()->create();

        $fakeLabel = Label::factory()->make();

        $data = [
            "name" => collect($fakeLabel)->get('name')
        ];

        $response = $this->actingAs($user)->post(route('labels.store'), $data);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('labels', ['name' => collect($fakeLabel)->get('name')]);
    }

    public function testStoreInvalid()
    {
        $user = User::factory()->create();

        $data = [
            "name" => ""
        ];
        $response = $this->actingAs($user)->post(route('labels.store'), $data);
        $response->assertRedirect();
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('labels', ['name' => '']);
    }

    public function testUpdate()
    {
        $user = User::factory()->create();

        $label = Label::first();

        $fakeLabel = Label::factory()->make();

        $data = [
            "name" => collect($fakeLabel)->get('name')
        ];

        $response = $this->actingAs($user)->patch(
            route('labels.update', $label->id),
            $data
        );

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        //$this->assertDatabaseHas('labels', ['name' => $data]);
        $this->assertDatabaseHas('labels', ['name' => collect($fakeLabel)->get('name')]);
    }

    public function testUpdateWithValidationErrors()
    {
        $user = User::factory()->create();

        $label = Label::first();

        $data = [
            "name" => ""
        ];
        $response = $this->actingAs($user)->patch(
            route('labels.update', $label->id),
            $data
        );
        $response->assertSessionHasErrors();
    }

    public function testEdit()
    {
        $id = Label::first()->id;

        $response = $this->get(route('labels.edit', $id), [$this->labels]);
        $response->assertOk();
        $response->assertViewIs('labels.edit');
    }

    public function testDestroy()
    {
        $user = User::factory()->create();
        $label = Label::first();
        $response = $this->actingAs($user)->delete(route('labels.destroy', $label));
        $response->assertRedirect();
        $this->assertDatabaseMissing('labels', ['id' => $label->id]);
    }
}
