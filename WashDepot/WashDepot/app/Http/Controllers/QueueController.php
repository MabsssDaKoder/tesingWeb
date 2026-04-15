<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queue;

class QueueController extends Controller
{
    public function index() {
        $queued     = Queue::where('status', 'queued')->orderBy('queue_number')->get();
        $processing = Queue::where('status', 'processing')->orderBy('queue_number')->get();
        $complete   = Queue::where('status', 'complete')->orderBy('queue_number')->get();

        return view('staff.queue', compact('queued', 'processing', 'complete'));
    }

    public function updateStatus(Request $request, $id) {
        $customer = Queue::findOrFail($id);
        $customer->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }
}