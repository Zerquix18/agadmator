<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Lib\YoutubeAPI;

class YoutubeAPITest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetVideos()
    {
        $youtube_api = new YoutubeAPI;
        $videos = $youtube_api->getVideosFromChannel('UCL5YbN5WLFD8dLIegT5QAbA');
        $this->assertNotNull($videos);
    }
}
