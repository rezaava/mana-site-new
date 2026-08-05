<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questions;

class QuestionController extends Controller
{
    public function createQuestion(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:200',
            'answer' => 'required|string',
            'number' => 'required|integer',
        ]);

        $question = Questions::create($validatedData);

        return response()->json(['message' => 'Question created successfully', 'success' => true, 'question' => $question], 201);
    }

    public function deleteQuestion($id)
    {
        $question = Questions::findOrFail($id);

        if (!$question) {
            return response()->json(['message' => 'Question not found', 'success' => false], 404);
        }

        $question->delete();

        return response()->json(['message' => 'Question deleted successfully', 'success' => true], 200);
    }

    public function updateQuestion(Request $request, $id)
    {
        $question = Questions::findOrFail($id);

        if (!$question) {
            return response()->json(['message' => 'Question not found', 'success' => false], 404);
        }

        $validatedData = $request->validate([
            'title' => 'string|max:200',
            'answer' => 'string',
            'number' => 'integer',
        ]);

        $question->update($validatedData);

        return response()->json(['message' => 'Question updated successfully', 'success' => true, 'question' => $question], 200);
    }

    public function getAllQuestions()
    {
        $questions = Questions::all();

        return response()->json(['questions' => $questions, 'success' => true], 200);
    }

    public function changeNumber(Request $request, $id)
    {
        $question = Questions::findOrFail($id);

        if (!$question) {
            return response()->json(['message' => 'Question not found', 'success' => false], 404);
        }

        $validatedData = $request->validate([
            'number' => 'required|integer',
        ]);

        $question->number = $validatedData['number'];
        $question->save();

        return response()->json(['message' => 'Question number updated successfully', 'success' => true, 'question' => $question], 200);
    }

}
