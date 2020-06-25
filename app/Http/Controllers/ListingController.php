<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;

class ListingController extends Controller
{
    //

    public function createListing(){
        return view('create_listing');
    }

    public function addListing(Request $request){
        $request->validate([
            'list_name' => 'required|max:45',
            'distance' => 'required|numeric',
        ]);
        //insert data
        $new_list = new Listing();
        $new_list->addListing($request);

        return redirect('home')->with('create_status', 'Listing created');

    }

    public function deleteListing($id){
        $list = new Listing();
        $list->deleteListing($id);

        return redirect('home')->with('delete_status', 'Listing deleted');
    }
}
