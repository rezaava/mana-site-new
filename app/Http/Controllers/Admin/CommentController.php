<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comments::latest()->paginate(15);
        $pendingCount = Comments::where('is_approved', false)->count();
        return view('admin.comments.index', compact('comments', 'pendingCount'));
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

        Comments::create($validated);

        return redirect()->route('comments.index')->with('success', 'نظر با موفقیت اضافه شد.');
    }

    public function approve($id)
    {
        $comment = Comments::findOrFail($id);
        $comment->update(['is_approved' => true]);

        return redirect()->route('comments.index')->with('success', 'نظر تایید شد.');
    }


    public function unapprove($id)
    {
        $comment = Comments::findOrFail($id);
        $comment->update(['is_approved' => false]);

        return redirect()->route('comments.index')->with('success', 'نظر به حالت در انتظار تغییر یافت.');
    }


    public function edit($id)
    {
        $comment = Comments::findOrFail($id);
        return view('admin.comments.edit', compact('comment'));
    }


    public function update(Request $request, $id)
    {
        $comment = Comments::findOrFail($id);

        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'content'   => 'required|string',
            'is_approved' => 'nullable|boolean',
        ]);


        $validated['is_approved'] = $request->has('is_approved');

        $comment->update($validated);

        return redirect()->route('comments.index')->with('success', 'نظر با موفقیت به‌روزرسانی شد.');
    }

    public function destroy($id)
    {
        $comment = Comments::findOrFail($id);
        $comment->delete();

        return redirect()->route('comments.index')->with('success', 'نظر با موفقیت حذف شد.');
    }
}