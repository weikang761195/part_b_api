<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Listing extends Model
{
    public $table = "listing";
    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function addListing($request){
        $new_list = new $this;
        $new_list->list_name = $request['list_name'];
        $new_list->distance = $request['distance'];
        $new_list->user_id = Auth::id();
        $new_list->save();
    }

    public function deleteListing($id){
        $this::find($id)->delete();
    }
}
