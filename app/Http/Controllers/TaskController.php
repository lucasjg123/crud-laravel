<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // traemos paginacion de 3 tareas por orden mas recientes
        $tasks = Task::latest()->paginate(3);
        return view('index', ['tasks' => $tasks]); // las retornamos a la vista
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validamos
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Nueva tarea creada exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        return view('edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, task $task): RedirectResponse
    {
        // validamos
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Nueva tarea actualizada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Nueva tarea eliminada exitosamente!');
    }
}
