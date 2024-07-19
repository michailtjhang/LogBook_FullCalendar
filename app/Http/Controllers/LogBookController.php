<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogBookRequest;
use App\Models\LogBook;
use App\Models\Struktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogBookController extends Controller
{
    public function index()
    {
        return view('logbook');
    }

    public function logbookList(request $request)
    {
        $start = date('Y-m-d', strtotime($request->start));

        $userId = Auth::user()->id;

        $logbook = LogBook::join('users', 'users.id', '=', 'logbook.users_id')
            ->select('logbook.id', 'logbook.title', 'logbook.description', 'logbook.date', 'logbook.status', 'logbook.users_id', 'users.name AS user_name')
            ->where('users_id', $userId)
            ->where('date', '>=', $start)->get()
            ->map(fn ($item) => [
                'id' => $item->id,
                'title' => $item->title,
                'date' => $item->date,
                'description' => $item->description,
                'status' => $item->status
            ]);

        return response()->json($logbook);
    }

    public function checkLogbook(Request $request)
    {
        $date = $request->date;
        $userId = Auth::user()->id;

        $logbookExists = LogBook::where('users_id', $userId)
            ->where('date', $date)
            ->exists();

        return response()->json(['exists' => $logbookExists]);
    }

    public function logbookDashList(request $request)
    {
        $start = date('Y-m-d', strtotime($request->start));

        $userId = Auth::user()->id;

        $subordinates = Struktur::where('user_id_atasan', $userId)->pluck('user_id_bawahan');

        if (auth()->user()->jabatan == "manager") {
            $logbook = Logbook::whereIn('users_id', $subordinates)
                ->join('users', 'users.id', '=', 'logbook.users_id')
                ->select('logbook.id', 'logbook.title', 'logbook.description', 'logbook.date', 'logbook.status', 'logbook.users_id', 'users.name AS user_name')
                ->where('date', '>=', $start)->get()
                ->map(fn ($item) => [
                    'id' => $item->id,
                    'title' => $item->title,
                    'date' => $item->date,
                    'description' => $item->description,
                    'status' => $item->status,
                    'users_id' => $item->users_id
                ]);;
        } elseif (auth()->user()->jabatan == "direktur") {
            $logbook = Logbook::whereIn('users_id', $subordinates)
                ->join('users', 'users.id', '=', 'logbook.users_id')
                ->select('logbook.id', 'logbook.title', 'logbook.description', 'logbook.date', 'logbook.status', 'logbook.users_id', 'users.name AS user_name')
                ->where('date', '>=', $start)->get()
                ->map(fn ($item) => [
                    'id' => $item->id,
                    'title' => $item->title,
                    'date' => $item->date,
                    'description' => $item->description,
                    'status' => $item->status,
                    'users_id' => $item->users_id
                ]);;;
        } else {
            $logbook = Logbook::whereIn('users_id', $subordinates)
                ->join('users', 'users.id', '=', 'logbook.users_id')
                ->select('logbook.id', 'logbook.title', 'logbook.description', 'logbook.date', 'logbook.status', 'logbook.users_id', 'users.name AS user_name')
                ->where('date', '>=', $start)->get()
                ->map(fn ($item) => [
                    'id' => $item->id,
                    'title' => $item->title,
                    'date' => $item->date,
                    'description' => $item->description,
                    'status' => $item->status,
                    'users_id' => $item->users_id
                ]);;;
        }

        return response()->json($logbook);
    }

    public function create(LogBook $logBook)
    {
        return view('logbook-form', ['data' => $logBook, 'action' => route('logbook.store')]);
    }

    public function store(LogBookRequest $request, LogBook $logBook)
    {
        $logBook->date = $request->date;
        $logBook->title = $request->title;
        $logBook->description = $request->description;
        $logBook->users_id = Auth::user()->id;

        $logBook->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Logbook saved successfully',
        ]);
    }

    public function show(LogBook $logBook)
    {
        // 
    }

    public function edit(LogBook $logBook)
    {
        // 
    }

    public function update(Request $request, LogBook $logBook)
    {
        //
    }

    public function destroy(LogBook $logBook)
    {
        //
    }
}
