<?php

namespace App\Http\Controllers;

use App\Models\LogBook;
use Illuminate\Http\Request;

class LogBookController extends Controller
{
    public function index()
    {
        return view('dashboard.logbook');
    }

    public function logbookList(request $request)
    {
        $start = date('Y-m-d', strtotime($request->start));

        $logbook = LogBook::where('date', '>=', $start)->get()
            ->map(fn($item) => [
                'id' => $item->id,
                'title' => $item->title,
                'date' => $item->date,
                'description' => $item->description,
                'status' => $item->status
            ]);

        return response()->json($logbook);
    }

    public function create(LogBook $logBook)
    {
        return view('dashboard.logbook-create', ['data' => $logBook, 'action' => route('logbook.store')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LogBook $logBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogBook $logBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LogBook $logBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogBook $logBook)
    {
        //
    }
}
