<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
  public function create(Request $request)
  {
    $task = new Task();
    $task->task_name = $request->name;
    $task->id_card_task = $request->id_card;
    $task->iscompleted = false;
    $task->save();
    return "berhasil";
  }
}
