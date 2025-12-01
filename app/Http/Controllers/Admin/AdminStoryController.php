<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Story;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class AdminStoryController extends Controller
{
    protected $id = 'id_story';
    /**
     * Display a listing of the stories.
     */
    public function index()
    {
        $stories = Story::latest()->paginate(10);
        return view('admin.stories.index', compact('stories'));
    }

    /**
     * Show the form for creating a new story.
     */
    public function create()
    {
        $categories = Story::pluck('category')->unique()->values();
        return view('admin.stories.create', compact('categories'));
    }

    /**
     * Store a newly created story in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'category'      => 'required|string|max:100',
            'excerpt'       => 'required|string|max:500',
            'content'       => 'required|string',
            'author'        => 'required|string|max:100',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'reading_time'  => 'nullable|string|max:50',
        ]);

        // generate unique slug
        $slug = $this->generateUniqueSlug($validated['title']);

        // handle image upload (safe)
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $slug . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/stories'), $imageName);
            $imagePath = 'images/stories/' . $imageName;
        }

        // calculate reading time if not provided
        $readingTime = $validated['reading_time'] ?? $this->calculateReadingTime($validated['content']);

        $story = Story::create([
            'slug'          => $slug,
            'title'         => $validated['title'],
            'category'      => $validated['category'],
            'excerpt'       => $validated['excerpt'],
            'content'       => $validated['content'],
            'author'        => $validated['author'],
            'image'         => $imagePath,
            'reading_time'  => $readingTime,
            'views'         => 0,
            'date'          => now(),
        ]);
        ActivityLog::create(['id_admin' => Auth::guard('admin')->user()->id_admin, 'action' => 'create', 'entity' => 'story', 'entity_id' => $story->id, 'description' => 'Created story']);
        return redirect()->route('admin.stories.index')
            ->with('success', 'Story berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified story.
     */
    public function edit($id)
    {
        $story = Story::findOrFail($id);
        $categories = Story::pluck('category')->unique()->values();
        return view('admin.stories.edit', compact('story', 'categories'));
    }

    /**
     * Update the specified story in storage.
     */
    public function update(Request $request, $id)
    {
        $story = Story::findOrFail($id);

        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'category'      => 'required|string|max:100',
            'excerpt'       => 'required|string|max:500',
            'content'       => 'required|string',
            'author'        => 'required|string|max:100',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'reading_time'  => 'nullable|string|max:50',
        ]);

        // update slug only if title changed
        if ($story->title !== $validated['title']) {
            $story->slug = $this->generateUniqueSlug($validated['title'], $story->id);
        }

        // handle new image upload and safe delete old image
        if ($request->hasFile('image')) {
            if (!empty($story->image) && file_exists(public_path($story->image))) {
                @unlink(public_path($story->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . ($story->slug ?? Str::slug($validated['title'])) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/stories'), $imageName);
            $story->image = 'images/stories/' . $imageName;
        }

        // update other fields
        $story->title = $validated['title'];
        $story->category = $validated['category'];
        $story->excerpt = $validated['excerpt'];
        $story->content = $validated['content'];
        $story->author = $validated['author'];
        $story->reading_time = $validated['reading_time'] ?? $this->calculateReadingTime($validated['content']);
        $story->save();

        ActivityLog::create(['id_admin' => Auth::guard('admin')->user()->id_admin, 'action' => 'update', 'entity' => 'story', 'entity_id' => $story->id, 'description' => 'Updated story']);

        return redirect()->route('admin.stories.index')
            ->with('success', 'Story berhasil diupdate!');
    }

    /**
     * Remove the specified story from storage.
     */
    public function destroy($id)
    {
        $story = Story::findOrFail($id);

        // delete image safely
        if (!empty($story->image) && file_exists(public_path($story->image))) {
            @unlink(public_path($story->image));
        }

        $story->delete();
        ActivityLog::create(['id_admin' => Auth::guard('admin')->user()->id_admin, 'action' => 'delete', 'entity' => 'story', 'entity_id' => $story->id, 'description' => 'Deleted story']);

        return redirect()->route('admin.stories.index')
            ->with('success', 'Story berhasil dihapus!');
    }

    /**
     * Generate a unique slug from title.
     */
    private function generateUniqueSlug(string $title, $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;

        while (
            Story::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    /**
     * Estimate reading time (minutes).
     */
    private function calculateReadingTime(string $content): string
    {
        $wordCount = str_word_count(strip_tags($content));
        $minutes = max(1, (int) ceil($wordCount / 200)); // minimal 1 menit
        return $minutes . ' min read';
    }
}
