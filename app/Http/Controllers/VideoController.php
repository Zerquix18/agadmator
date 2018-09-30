<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;

class VideoController extends Controller
{
    public function complete(Request $request)
    {
        $to_complete = [
            'white_pieces',
            'black_pieces',
            'opening',
            'event',
            'game_name',
        ];

        $field = '';
        $field_data = '';

        foreach ($to_complete as $field_to_complete) {
            $field_data = $request->input($field_to_complete);
            if ($field_data && strlen($field_data) >= 3) {
                $field = $field_to_complete;
                break;
            }
        }

        if (! $field) {
            return ['error' => 'No fields to look for'];
        }
        $field_data = $request->input($field_to_complete);
        $field_data = preg_replace('/[^A-Za-z -]/', '', $field_data);
        $videos = Video::select($field)
                        ->distinct()
                        ->where($field, 'LIKE', '%' . $field_data . '%')
                        ->get()
                        ->pluck($field);
        return [$field => $videos];
    }

    public function search(Request $request)
    {
        $to_complete = [
            'white_pieces',
            'black_pieces',
            'opening',
            'event',
            'game_name',
        ];

        $videos = Video::query();

        foreach ($to_complete as $field) {
            $field_data = $request->input($field);
            $field_data = preg_replace('/[^A-Za-z -]/', '', $field_data);
            if ($field_data && strlen($field_data) >= 3) {
                $videos->where($field, 'LIKE', '%' . $field_data . '%');
            }
        }

        $videos = $videos->get();

        return ['videos' => $videos];
    }
}
