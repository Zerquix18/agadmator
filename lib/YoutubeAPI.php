<?php
/**
 * Class for activities related to Youtube's API
 */

namespace Lib;

class YoutubeAPI
{
    private $api_key;

    private $last_error;

    public function __construct($api_key = null)
    {
        if (! $api_key) {
            if (! env('YOUTUBE_API_KEY')) {
                abort(500, 'YOUTUBE_API_KEY is not defined');
            }
            $api_key = env('YOUTUBE_API_KEY');
        }
        $this->api_key = $api_key;
    }

    public function getVideosFromPlaylist(string $playlist_id): array
    {
        $data = [
            'key'        => $this->api_key,
            'playlistId'  => $playlist_id,
            'part'       => 'snippet, id',
            'order'      => 'date',
            'maxResults' => 50,
        ];
        $page_token = '';
        $result     = [];
        while (true) {
            $query = http_build_query($data + ['pageToken' => $page_token]);
            $url = 'https://www.googleapis.com/youtube/v3/playlistItems?' . $query;
            $response = file_get_contents($url);

            if (! $response) {
                return $result;
            }

            $response = json_decode($response, true);
            $result   = array_merge($result, $response['items']);

            if (key_exists('nextPageToken', $response)) {
                $page_token = $response['nextPageToken'];
            } else {
                break;
            }
        }
        return $result;
    }
}
