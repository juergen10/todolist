<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardTask extends Model
{
  protected $table = 'cardtasks';
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
