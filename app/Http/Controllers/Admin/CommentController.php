<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->paginate(15);
        $pendingCount = Comment::where('is_approved', false)->count();
        return view('admin.comments.index', compact('comments', 'pendingCount'));
    }

    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update(['is_approved' => true]);

        return redirect()->route('comments.index')->with('success', 'نظر تایید شد.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'نظر با موفقیت حذف شد.');
    }

    public function create()
    {
        return view('admin.comments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'content'   => 'required|string',
        ]);

        Comment::create($validated);

        return redirect()->route('comments.index')->with('success', 'نظر با موفقیت اضافه شد.');
    }
}
