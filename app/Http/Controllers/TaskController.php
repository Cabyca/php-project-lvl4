<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    #TODO Сделать проверку на разрешение удаления если это тот пользователь
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
//        $taskStatuses = TaskStatus::all();
//
//        foreach ($taskStatuses as $taskStatus) {
//            echo 'Статус: ' . $taskStatus['name'] . '<br>';
//            foreach ($taskStatus->tasks as $task) {
//                echo 'Задача: ' . $task['name'] . '<br>';
//            }
//            echo "__________________<br>";
//        }
//
//        $tasks = Task::all();
//
//        foreach ($tasks as $task) {
//            echo 'Задача: ' . $task['name'] . ' Статус этой задачи: '. $task->status->name .'<br>';
//            echo "__________________<br>";
//        }
//        dd();

        $tasks = Task::all()->sort();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $taskStatuses = TaskStatus::all();
        return view('tasks.create', compact('taskStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $task = new Task();

//        $table->string('name');
//        $table->text('description')->nullable();

        $data = $this->validate($request, [
            'name' => 'required|string',
            'description' => 'nullable'
        ], ['name.unique' => __('validation.tasks.name')]);

        $task->fill($data);
        $task->save();

        flash('Задача успешно создана')->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
