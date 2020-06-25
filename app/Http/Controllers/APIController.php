<?php

namespace App\Http\Controllers;

use App\User;
use App\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class APIController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (auth()->attempt($credentials)) {
            $token = (Str::random(32));
            Auth::user()->api_token = $token;
            Auth::user()->save();
            return response()->json([
                'id' => Auth::id(),
                'token' => $token,
                'status' => ['code' => 200 ,'message' => 'Access Granted',],
            ], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }

    public function getListing(Request $request)
    {
        $user_id = $request->id;
        $user = User::find($user_id);

        if ($user){
            $user_listing = $user->listings;
            return response()->json([
                'listing' => $user_listing,
                'status' => ['code' => 200 ,'message' => 'Listing successfully retrieved',],
            ], 200);
        }else{
            return response()->json(['error' => 'User Not found']);
        }
    }

    public function updateListing(Request $request){
        $listing_id = $request->id;
        $new_listing_name = $request->list_name;
        $new_listing_id = $request->listing_id;

        //check if new id existed in db
        $new_listing = Listing::find($new_listing_id);
        //what the new id is different from old id and new id not existed in db
        if($new_listing && $listing_id!=$new_listing_id){
            return response()->json(['error' => 'New Listing ID already existed']);
        }

        //update listing data
        $listing = Listing::find($listing_id);
        if($listing){
            $listing->id = $new_listing_id;
            $listing->list_name = $new_listing_name;
            $listing->save();
            return response()->json([
                'status' => ['code' => 200 ,'message' => 'Listing successfully updated',],
            ], 200);
        }else{
            return response()->json(['error' => 'Listing Not found']);
        }


    }
}
