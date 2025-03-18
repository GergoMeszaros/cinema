<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Mockery;
use Tests\TestCase;

class MovieControllerTest extends TestCase
{
    public function testShowAllMovies(): void
    {
        $movieMock = Mockery::mock('alias:' . Movie::class);

        $movieMock->shouldReceive('with')
            ->once()
            ->with(['coverPicture', 'showtimeDetails'])
            ->andReturnSelf();

        $movieMock->shouldReceive('get')
            ->once()
            ->andReturn(collect([
                (object)[
                    'id' => 1,
                    'title' => 'Movie Title',
                    'description' => 'A great movie',
                    'language' => 'English',
                    'age_restriction' => 18,
                    'available_seats' => 50
                ]
            ]));

        $response = $this->json('GET', route('movies.showAll'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'title',
                'description',
                'language',
                'age_restriction',
                'available_seats',
            ]
        ]);
    }

    public function testShowMovie(): void
    {
        $movieMock = Mockery::mock('alias:' . Movie::class);

        $movieMock->shouldReceive('with')
            ->once()
            ->with(['coverPicture', 'showtimeDetails'])
            ->andReturnSelf();

        $movieMock->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn((object)[
                'id' => 1,
                'title' => 'Movie Title',
                'description' => 'A great movie',
                'language' => 'English',
                'age_restriction' => 18,
                'available_seats' => 50
            ]);

        $response = $this->json('GET', route('movies.show', ['id' => 1]));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'title',
            'description',
            'language',
            'age_restriction',
            'available_seats',
        ]);
    }

    public function testNotFoundMovie()
    {
        $movieMock = Mockery::mock('alias:' . Movie::class);
        $movieMock->shouldReceive('with')
            ->once()
            ->with(['coverPicture', 'showtimeDetails'])
            ->andReturnSelf();

        $movieMock->shouldReceive('find')
            ->once()
            ->with(999)
            ->andReturnNull();

        $responseNotFound = $this->json('GET', route('movies.show', ['id' => 999]));

        $responseNotFound->assertStatus(404);
        $responseNotFound->assertJson([
            'message' => 'Movie not found!'
        ]);
    }

    public function testCreateMovie(): void
    {
        $movieMock = Mockery::mock('alias:' . Movie::class);
        $movieMock->shouldReceive('create')
            ->once()
            ->with([
                'title' => 'Movie Title',
                'description' => 'A great movie',
                'language' => 'English',
                'age_restriction' => 18,
                'available_seats' => 50
            ])
            ->andReturn((object)[
                'id' => 1,
                'title' => 'Movie Title',
                'description' => 'A great movie',
                'language' => 'English',
                'age_restriction' => 18,
                'available_seats' => 50
            ]);

        $response = $this->json('POST', route('movies.create'), [
            'title' => 'Movie Title',
            'description' => 'A great movie',
            'language' => 'English',
            'age_restriction' => 18,
            'available_seats' => 50
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'id' => 1,
            'title' => 'Movie Title',
            'description' => 'A great movie',
            'language' => 'English',
            'age_restriction' => 18,
            'available_seats' => 50
        ]);
    }

    public function testRemoveMovie(): void
    {
        $movieMock = Mockery::mock('alias:' . Movie::class);
        $movieMock->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($movieMock);

        $movieMock
            ->shouldReceive('delete')
            ->once()
            ->andReturn(true);

        $response = $this->json('DELETE', route('movies.remove', ['id' => 1]));

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Movie successfully deleted!'
        ]);
    }

    public function testEditMovie(): void
    {
        $movieMock = Mockery::mock('alias:' . Movie::class);
        $movieMock->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($movieMock);

        $movieMock->shouldReceive('update')
            ->once()
            ->with([
                'title' => 'Updated Movie Title',
                'description' => 'An updated great movie',
                'language' => 'English',
                'age_restriction' => 18
            ])
            ->andReturn(true);

        $movieMock->id = 1;
        $movieMock->title = 'Updated Movie Title';
        $movieMock->description = 'An updated great movie';
        $movieMock->language = 'English';
        $movieMock->age_restriction = 18;

        $response = $this->json('PATCH', route('movies.edit', ['id' => 1]), [
            'title' => 'Updated Movie Title',
            'description' => 'An updated great movie',
            'language' => 'English',
            'age_restriction' => 18
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => 1,
            'title' => 'Updated Movie Title',
            'description' => 'An updated great movie',
            'language' => 'English',
            'age_restriction' => 18,
        ]);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function setUp(): void
    {
        parent::setUp();
        Event::fake();
        DB::shouldReceive('connection')->andReturnSelf();
        DB::shouldReceive('getPdo')->andReturnNull();
    }
}
