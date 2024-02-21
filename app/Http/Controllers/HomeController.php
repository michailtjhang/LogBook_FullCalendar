<?php

namespace App\Http\Controllers;

use App\Models\LogBook;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $logbook = LogBook::get();

        return view("home", compact("logbook"));
    }

    public function store(Request $request, string $id)
    {
        $logbook = LogBook::find($id);
        $logbook->status = $request->status;
        $logbook->save();

        return back();
    }
}
