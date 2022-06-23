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
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('labels.create'));
        $response->assertOk();
        $response->assertViewIs('labels.create');
    }

    public function testStore()
    {
        $user = User::factory()->create();

        $fakeLabel = Label::factory()->make();
        $data = $fakeLabel->only(['name', 'description']);

        $response = $this->actingAs($user)->post(route('labels.store'), $data);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
//        $this->assertDatabaseHas('labels', [
//            'name' => $fakeLabel->only(['name']),
//            'description' => $fakeLabel->only(['description'])
//        ]);
        $this->assertDatabaseHas('labels', $data);
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
        $data = $fakeLabel->only(['name', 'description']);
        $response = $this->actingAs($user)->patch(
            route('labels.update', $label),
            $data
        );

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
//        $this->assertDatabaseHas('labels', [
//            'name' => $fakeLabel->only(['name']),
//            'description' => $fakeLabel->only(['description'])
//        ]);
        $this->assertDatabaseHas('labels', $data);
    }

    public function testUpdateWithValidationErrors()
    {
        $user = User::factory()->create();

        $label = Label::first();

        $data = [
            "name" => ""
        ];

        $response = $this->actingAs($user)->patch(
            route('labels.update', $label),
            $data
        );
        $response->assertSessionHasErrors();
    }

    public function testEdit()
    {
        /** @phpstan-ignore-next-line */
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
        /** @phpstan-ignore-next-line */
        $this->assertDatabaseMissing('labels', ['id' => $label->id]);
    }
}
