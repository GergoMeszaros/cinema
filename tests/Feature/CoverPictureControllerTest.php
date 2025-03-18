<?php

namespace Tests\Feature;

use App\Models\CoverPicture;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Mockery;
use Tests\TestCase;

class CoverPictureControllerTest extends TestCase
{
    public function testCreateCoverPicture(): void
    {
        $coverPictureMock = Mockery::mock('alias:' . CoverPicture::class);
        $coverPictureMock->shouldReceive('generateImage')
            ->once()
            ->with('imageName', 'Cover text');

        $coverPictureMock->shouldReceive('create')
            ->once()
            ->with([
                'name' => 'imageName',
                'cover_text' => 'Cover text',
                'movie_id' => 1,
                'path' => 'images/imageName',
            ])
            ->andReturn((object)[
                'id' => 1,
                'name' => 'imageName',
                'cover_text' => 'Cover text',
                'movie_id' => 1,
                'path' => 'images/imageName'
            ]);

        $response = $this->json('POST', route('cover_picture.new'), [
            'name' => 'imageName',
            'cover_text' => 'Cover text',
            'movie_id' => 1
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'id' => 1,
            'name' => 'imageName',
            'cover_text' => 'Cover text',
            'movie_id' => 1,
            'path' => 'images/imageName',
        ]);
    }

    public function testRemoveCoverPicture(): void
    {
        $coverPictureMock = Mockery::mock('alias:' . CoverPicture::class);
        $coverPictureMock->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($coverPictureMock);

        $coverPictureMock->shouldReceive('delete')
            ->once()
            ->andReturn(true);

        $response = $this->json('DELETE', route('cover_picture.remove', ['id' => 1]));

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Cover picture successfully deleted!'
        ]);
    }

    public function testNotFoundCoverPicture(): void
    {
        $coverPictureMock = Mockery::mock('alias:' . CoverPicture::class);
        $coverPictureMock->shouldReceive('find')
            ->once()
            ->with(999)
            ->andReturnNull();

        $responseNotFound = $this->json('DELETE', route('cover_picture.remove', ['id' => 999]));

        $responseNotFound->assertStatus(404);
        $responseNotFound->assertJson([
            'message' => 'Cover picture not found!'
        ]);
    }

    public function testEditCoverPicture(): void
    {
        $coverPictureMock = Mockery::mock('alias:' . CoverPicture::class);
        $coverPictureMock->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($coverPictureMock);

        $coverPictureMock->shouldReceive('update')
            ->once()
            ->with([
                'name' => 'Updated Image Name',
            ])
            ->andReturn(true);

        $coverPictureMock->name = 'Updated Image Name';

        $response = $this->json('PATCH', route('cover_picture.edit', ['id' => 1]), [
            'name' => 'Updated Image Name',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'name' => 'Updated Image Name',
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
