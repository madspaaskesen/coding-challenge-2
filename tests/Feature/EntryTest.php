<?php

namespace Tests\Feature;

use App\Entry;
use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class EntryTest extends TestCase
{
    use RefreshDatabase;

    public function testCanStartAnEntry() {
        $project = factory(Project::class)->create();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->postJson(
            '/entries/start',
            [
                'projectId' => $project->id
            ]
        );

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([ 'status' => 'success' ]);
    }

    public function testCanStopAStartedEntry() {
        $project = factory(Project::class)->create();
        $user = factory(User::class)->create();
        $entry = factory(Entry::class)->create([
            'project_id' => $project->id
        ]);
        $project->entries()->save($entry);

        $response = $this->actingAs($user)->postJson(
            '/entries/stop',
            [
                'projectId' => $project->id
            ]
        );

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([ 'status' => 'success' ]);
    }

    public function testCannotStartTwoEntriesOnSameProject()
    {
        $project = factory(Project::class)->create();
        $user = factory(User::class)->create();
        $entry = factory(Entry::class)->create([
            'project_id' => $project->id
        ]);
        $project->entries()->save($entry);

        $response = $this->actingAs($user)->postJson(
            '/entries/start',
            [
                'projectId' => $project->id
            ]
        );

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'status' => 'error',
                'message' => 'There is already an open entry on this project.'
            ]);
    }

    public function testCannotStopAndNoneStartedEntry()
    {
        $project = factory(Project::class)->create();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->postJson(
            '/entries/stop',
            [
                'projectId' => $project->id
            ]
        );

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'status' => 'error',
                'message' => 'There is no open entry on this project.'
            ]);;
    }
}
