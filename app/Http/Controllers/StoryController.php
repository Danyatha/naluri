<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class StoryController extends Controller
{
    public function index()
    {
        // Featured = story terbaru
        $featured = Story::orderBy('created_at', 'desc')->first();

        if (!$featured) {
            abort(404, 'No stories found');
        }

        // Categories unik
        $categories = Story::pluck('category')->unique();

        // Latest stories (kecuali featured)
        $latest = Story::orderBy('created_at', 'desc')
            ->skip(1)
            ->take(6)
            ->get();

        return view('story', [
            'featured' => [
                'slug'         => $featured->slug,
                'image'        => $featured->image,
                'category'     => $featured->category,
                'title'        => $featured->title,
                'excerpt'      => $featured->excerpt,
                'author'       => $featured->author,
                'date'         => $featured->date->format('F j, Y'),
                'views'        => $featured->views ?? 0,
                'reading_time' => $featured->reading_time ?? '3 min read',
            ],
            'categories' => $categories,
            'latest' => $latest->map(function ($s) {
                return [
                    'slug'         => $s->slug,
                    'image'        => $s->image,
                    'category'     => $s->category,
                    'title'        => $s->title,
                    'excerpt'      => $s->excerpt,
                    'author'       => $s->author,
                    'reading_time' => $s->reading_time ?? '3 min read',
                ];
            }),
        ]);
    }



    public function show($slug)
    {
        $stories = Story::all();
        $story = collect($stories)->firstWhere('slug', $slug);

        if (!$story) {
            abort(404);
        }

        // Related stories (same category, exclude current)
        $related = collect($stories)
            ->where('category', $story['category'])
            ->where('slug', '!=', $slug)
            ->take(3)
            ->toArray();

        return view('story-detail', compact('story', 'related'));
    }

    public function category($category)
    {
        $stories = Story::all();
        $filtered = collect($stories)->where('category', $category)->toArray();

        return view('category', compact('filtered', 'category'));
    }
}
