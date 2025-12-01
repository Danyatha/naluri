<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class StoryController extends Controller
{
    public function index()
    {
        $storyModel = new Story();
        $stories = $storyModel->all();
        $story = [
            'title' => $stories[0]->title,
            'author' => $stories[0]->author,
            'date' => $stories[0]->date->format('F j, Y'),
            'content' => $stories[0]->content,
            'closing' => $stories[0]->closing,
        ];

        return view('story', compact('story'));
    }
}
