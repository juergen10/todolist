<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CardTask;
use Auth;

class CardTaskController extends Controller
{
  public function create(Request $request)
  {
    $cardTask = new CardTask();
    $cardTask->title = $request->name;
    $cardTask->user_id = Auth::id();
    $cardTask->save();
    return "berhasil";
  }
}
