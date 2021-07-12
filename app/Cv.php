<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $table ='cvs';
    public $primaryKey ='id';
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
