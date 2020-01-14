<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Resources\StatusResource;


class StatusesController extends Controller
{
    public function index()
    {
        return StatusResource::collection(
            Status::latest()->paginate()
        );

    }

    public function store()
    {
        $status = Status::create([
            'body' => request('body'),
            'user_id' => auth()->user()->id
        ]);

        return StatusResource::make($status);
    }


}
