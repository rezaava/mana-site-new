<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::latest()->paginate(15);
        $openCount = Ticket::where('status', 'open')->count();

        return view('admin.support.index', compact('tickets', 'openCount'));
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);

        return view('admin.support.show', compact('ticket'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ], [
            'user_name.required' => 'لطفاً نام خود را وارد کنید.',
            'user_name.max' => 'نام وارد شده بیش از حد طولانی است.',

            'email.required' => 'لطفاً ایمیل خود را وارد کنید.',
            'email.email' => 'فرمت ایمیل صحیح نیست.',
            'email.max' => 'ایمیل وارد شده بیش از حد طولانی است.',

            'subject.required' => 'لطفاً موضوع پیام را وارد کنید.',
            'subject.max' => 'موضوع بیش از حد طولانی است.',

            'message.required' => 'لطفاً متن پیام را وارد کنید.',
            'message.max' => 'متن پیام بیش از حد طولانی است.',
        ]);

        $ticket = Ticket::create([
            'user_name' => $validated['user_name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'open',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'پیام شما با موفقیت ارسال شد. در اولین فرصت با شما تماس می‌گیریم.',
            'ticket_id' => $ticket->id,
        ]);
    }

    public function close($id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->update([
            'status' => 'closed'
        ]);

        return redirect()
            ->route('support.index')
            ->with('success', 'تیکت بسته شد.');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()
            ->route('support.index')
            ->with('success', 'تیکت با موفقیت حذف شد.');
    }
}