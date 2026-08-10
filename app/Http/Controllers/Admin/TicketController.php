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

    public function close($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update(['status' => 'closed']);

        return redirect()->route('support.index')->with('success', 'تیکت بسته شد.');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('support.index')->with('success', 'تیکت با موفقیت حذف شد.');
    }
}
