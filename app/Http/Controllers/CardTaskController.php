<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CardTask;
use App\Task;
use Auth;

class CardTaskController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $data = CardTask::all();
    $task = $this->task($data);
    return view('home', compact('data', 'task'));
  }
  private function task($data)
  {
    $task = Task::all();
    $cardTask =[];
    foreach ($task as $key => $value) {
      foreach ($data as $val) {
        if ($value->id_card_task === $val->id) {
          if (!isset($cardTask[$value->id_card_task])) {
              $cardTask[$value->id_card_task] = array();
          }
          $cardTask[$value->id_card_task][] = array('id' => $value->id, 'task_name' => $value->task_name, 'iscompleted' => $value->iscompleted);
        }
      }
    }
    return $cardTask;
  }

  public function create(Request $request)
  {
    $cardTask = new CardTask();
    $cardTask->title = $request->name;
    $cardTask->user_id = Auth::id();
    $cardTask->save();
    return "berhasil";
  }
  public function edit(Request $request)
  {
    $data = CardTask::find($request->id);
    $data->title = $request->name;
    $data->save();
    return response ()->json ( $data );
  }
  public function delete(Request $request)
  {
    $data = CardTask::find($request->id);
    $data->delete();
    return response ()->json ();
  }
}
