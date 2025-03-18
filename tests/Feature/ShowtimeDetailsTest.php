<?php

namespace Tests\Feature;

use App\Models\ShowtimeDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Mockery;
use Tests\TestCase;

class ShowtimeDetailsTest extends TestCase
{

    public function testCreateShowtimeDetails(): void
    {
        $showtimeDetailsMock = Mockery::mock('alias:' . ShowtimeDetails::class);
        $showtimeDetailsMock->shouldReceive('create')
            ->once()
            ->with([
                'showtime' => '2025-03-20 18:00',
                'available_seats' => 100,
                'movie_id' => 1,
            ])
            ->andReturn((object)[
                'id' => 1,
                'showtime' => '2025-03-20 18:00',
                'available_seats' => 100,
                'movie_id' => 1,
            ]);

        $response = $this->json('POST', route('showtime_details.new'), [
            'showtime' => '2025-03-20 18:00',
            'available_seats' => 100,
            'movie_id' => 1,
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'id' => 1,
            'showtime' => '2025-03-20 18:00',
            'available_seats' => 100,
            'movie_id' => 1,
        ]);
    }

    public function testRemoveShowtimeDetails(): void
    {
        $showtimeDetailsMock = Mockery::mock('alias:' . ShowtimeDetails::class);
        $showtimeDetailsMock->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($showtimeDetailsMock);

        $showtimeDetailsMock->shouldReceive('delete')
            ->once()
            ->andReturn(true);

        $response = $this->json('DELETE', route('showtime_details.remove', ['id' => 1]));

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Showtime details successfully deleted!'
        ]);
    }

    public function testNotFoundShowtimeDetails(): void
    {
        $showtimeDetailsMock = Mockery::mock('alias:' . ShowtimeDetails::class);
        $showtimeDetailsMock->shouldReceive('find')
            ->once()
            ->with(999)
            ->andReturnNull();

        $responseNotFound = $this->json('DELETE', route('showtime_details.remove', ['id' => 999]));

        $responseNotFound->assertStatus(404);
        $responseNotFound->assertJson([
            'message' => 'Showtime details not found!'
        ]);
    }

    public function testEditShowtimeDetails(): void
    {
        $showtimeDetailsMock = Mockery::mock('alias:' . ShowtimeDetails::class);
        $showtimeDetailsMock->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($showtimeDetailsMock);

        $showtimeDetailsMock->shouldReceive('update')
            ->once()
            ->with([
                'showtime' => '2025-03-21 18:00',
                'available_seats' => 90,
            ])
            ->andReturn(true);

        $showtimeDetailsMock->showtime = '2025-03-21 18:00';
        $showtimeDetailsMock->available_seats = 90;

        $response = $this->json('PATCH', route('showtime_details.edit', ['id' => 1]), [
            'showtime' => '2025-03-21 18:00',
            'available_seats' => 90,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'showtime' => '2025-03-21 18:00',
            'available_seats' => 90,
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
