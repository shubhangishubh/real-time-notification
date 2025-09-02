<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RealTask;
use Illuminate\Validation\Rule;
use App\Events\TaskEventCreated;

class RealTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json(
            RealTask::where('user_id', $request->user()->id)->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => ['nullable', Rule::in(['pending','completed'])],
        ]);
        
        $task = $request->user()->realTasks()->create($data);

        broadcast(new TaskEventCreated($task))->toOthers();

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
