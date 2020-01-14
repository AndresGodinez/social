<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusesController extends Controller
{
    public function index()
    {
        $statuses = Status::latest()->paginate();

        return response()->json($statuses);
    }

    public function store()
    {
        $status = Status::create([
            'body' => request('body'),
            'user_id' => auth()->user()->id
        ]);

        return response()->json($status);
    }


}
