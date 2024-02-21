<?php

namespace App\Http\Controllers;

use App\Models\LogBook;
use App\Models\Struktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;

        $subordinates = Struktur::where('user_id_atasan', $userId)->pluck('user_id_bawahan');

        if (auth()->user()->jabatan == "manager") {
            $logbook = Logbook::whereIn('users_id', $subordinates)
                ->join('users', 'users.id', '=', 'logbook.users_id')
                ->select('logbook.id', 'logbook.title', 'logbook.description', 'logbook.date', 'logbook.status', 'logbook.users_id', 'users.name AS user_name')
                ->get();
        } elseif (auth()->user()->jabatan == "direktur") {
            $logbook = Logbook::whereIn('users_id', $subordinates)
                ->join('users', 'users.id', '=', 'logbook.users_id')
                ->select('logbook.id', 'logbook.title', 'logbook.description', 'logbook.date', 'logbook.status', 'logbook.users_id', 'users.name AS user_name')
                ->get();
        } else {
            $logbook = Logbook::whereIn('users_id', $subordinates)
                ->join('users', 'users.id', '=', 'logbook.users_id')
                ->select('logbook.id', 'logbook.title', 'logbook.description', 'logbook.date', 'logbook.status', 'logbook.users_id', 'users.name AS user_name')
                ->get();
        }

        return view("dashboard", compact("logbook"));
    }

    public function store(Request $request, string $id)
    {
        $logbook = LogBook::find($id);
        $logbook->status = $request->status;
        $logbook->save();

        return back();
    }
}
