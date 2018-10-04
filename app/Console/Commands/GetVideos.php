<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Lib\YoutubeAPI;
use App\Video;

class GetVideos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get_videos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches the videos :)';

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('Getting videos...');
        $youtube_api = new YoutubeAPI;
        $videos = $youtube_api->getVideosFromChannel('UCL5YbN5WLFD8dLIegT5QAbA');
        $videos = array_column($videos, 'id');
        $videos = array_column($videos, 'videoId');
        
        $details = $youtube_api->getVideoDetails($videos);
        
        $counter = 1;
        foreach ($details as $video_data) {
            $description = $video_data['description'];
            list($white_pieces, $black_pieces) = $this->getPlayers($description);
            if (! $white_pieces) {
                continue;
            }

            $id         = $video_data['id'];
            $title      = $video_data['title'];
            $video_date = new \DateTime($video_data['publishedAt']);
            $opening    = $this->getOpening($description);
            $game_name  = $this->getGameName($description);
            $event      = $this->getEvent($description);
            $moves      = $this->getMoves($description);

            $video = Video::firstOrNew(['id' => $id]);

            $video->title        = $title;
            $video->video_date   = $video_date;
            $video->white_pieces = $white_pieces;
            $video->black_pieces = $black_pieces;
            $video->opening      = $opening;
            $video->game_name    = $game_name;
            $video->event        = $event;
            $video->moves        = $moves;

            $video->save();
        }
    }

    /**
     * Returns the players that were involved in the name
     * @param string $description The video description
     * @return array [white pieces, black pieces]
     */
    private function getPlayers(string $description): array
    {
        $regex = '/(^|\n)(([\w -\(\)]+) vs ([\w -\(\)]+))$/m';
        if (! preg_match($regex, $description, $matches)) {
            return ['', ''];
        }
        $white = trim($matches[3]);
        $black = trim($matches[4]);

        $white = str_replace('#agadmator ', '', $white);
        return [$white, $black];
    }

    /**
     * Returns the name of the game if it has one.
     * @param string $description The video description
     */
    private function getGameName(string $description): string
    {
        $regex = '/"[\w -]+" \(game of the day [\w-]+\)/';
        if (! preg_match($regex, $description, $matches)) {
            return '';
        }
        return $matches[0];
    }

    /**
     * Returns where this game was played
     */
    private function getEvent(string $description): string
    {
        $regex = '/([\w ]+ \(\d+\)),.+, ([A-Za-z]{3})-([\d]{2})\s\n/';
        if (! preg_match($regex, $description, $matches)) {
            return '';
        }
        return trim($matches[0]);
    }

    private function getOpening(string $description): string
    {
        $regex = '/(.+)([A-Z]{1}[0-9]{2})\)\s/';
        if (! preg_match($regex, $description, $matches)) {
            return '';
        }
        return trim($matches[0]);
    }

    private function getMoves(string $description): string
    {
        $regex = '/^(1\.)([\w \.-]+)/im';
        if (! preg_match($regex, $description, $matches)) {
            return '';
        }
        return trim($matches[0]);
    }
}
