<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function index()
    {
        // مرتب‌سازی بر اساس فیلد number
        $questions = Questions::orderBy('number', 'asc')->paginate(10);
        return view('admin.questions.questions', compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'number'   => 'required|integer|min:1',
            'title' => 'required|string|max:255',
            'answer'   => 'required|string',
        ]);

        Questions::create($validated);

        return redirect()->route('questions.index')->with('success', 'سوال جدید با موفقیت اضافه شد.');
    }

    public function edit($id)
    {
        $question = Questions::findOrFail($id);
        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $question = Questions::findOrFail($id);

        $validated = $request->validate([
            'number'   => 'required|integer|min:1',
            'title' => 'required|string|max:255',
            'answer'   => 'required|string',
        ]);

        $question->update($validated);

        return redirect()->route('questions.index')->with('success', 'سوال متداول با موفقیت بروزرسانی شد.');
    }

    public function destroy($id)
    {
        $question = Questions::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'سوال متداول با موفقیت حذف شد.');
    }
}