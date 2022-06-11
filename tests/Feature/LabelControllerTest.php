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

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();

        $this->labels = Label::factory()->count(4)->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
        $response->assertViewIs('labels.index');
    }

    public function testStore()
    {
        $user = User::factory()->create();

        //dd($user);

        $fakeLabel = Label::factory()->make();

        $data = [
            "name" => $fakeLabel->getAttribute('name'),
        ];
        $response = $this->actingAs($user)->post(route('labels.store'), $data);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('labels', ['name' => $fakeLabel->getAttribute('name')]);
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

        $fakeLabel = Label::factory()->make()->getAttribute('name');

        $response = $this->actingAs($user)->patch(
            route('labels.update', $label->id),
            ['name' => $fakeLabel]
        );

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('labels', ['name' => $fakeLabel]);
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
        $label2 = Label::find($label->id);
        $this->assertDatabaseMissing('labels', ['id' => $label2->id]);
    }
}
