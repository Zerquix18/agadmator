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

    public function getVideosFromChannel(string $channel_id, int $max_videos = 0): array
    {
        $data = [
            'key'        => $this->api_key,
            'channelId'  => $channel_id,
            'part'       => 'snippet, id',
            'order'      => 'date',
            'maxResults' => 50,
        ];
        $page_token = '';
        $result     = [];
        while (true) {
            $query = http_build_query($data + ['pageToken' => $page_token]);
            $url = 'https://www.googleapis.com/youtube/v3/search?' . $query;
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

    // returns [{video_id => details}]
    public function getVideoDetails(array $all_ids): ?array
    {
        // youtube returns details of up to 50 vids
        $all_ids = array_chunk($all_ids, 50);
        $result  = [];
        foreach ($all_ids as $ids) {
            $data = [
                'key' => $this->api_key,
                'id'  => implode(',', $ids),
                'part' => 'snippet'
            ];
            $query = http_build_query($data);
            $url = 'https://www.googleapis.com/youtube/v3/videos?' . $query;
            $response = file_get_contents($url);
            if (! $response) {
                return null;
            }
            $response = json_decode($response, true);
            $ids_details = array_map(function ($video) {
                $video['snippet']['id'] = $video['id'];
                ksort($video['snippet']);
                return $video['snippet'];
            }, $response['items']);

            $result = array_merge($result, $ids_details);
        }
        
        return $result;
    }
}
