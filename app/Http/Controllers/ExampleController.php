<?php

namespace App\Http\Controllers;

//untuk menggunakan $request
use \Illuminate\Http\Request;
//untuk menggunakan response
use Illuminate\Http\Response;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Example: use middleware for all method
        //$this->middleware('age');
        //Example: use middleware for spesifict method
        //$this->middleware('age', ['only' => ['sampleMethod']]);
        //Example: use middleware for all method except sampleMethod
        //$this->middleware('age', ['except' => ['sampleMethod']]);
    }

    public function sampleMethod(){
        return 'Hello From ExampleController';
    }

    public function sampleMethodById($id){
        return 'Hello From ExampleController with Id : '.$id;
    }

    public function searchById($id, $search){
        return 'Hello from searchById, id: '.$id.' search: '.$search;
    }

    public function getAlias(){
        return 'Hello from getAlias, Router : ' . route('alias.action');
    }

    public function getAliasAction(){
        return 'Hello from getAliasAction, Router : ' . route('alias');
    }

    public function testRequest(Request $request){
        //Example: return path
        //return 'Hello from testRequest: '.$request->path();
        return 'Hello from testRequest: '.$request->age;
    }

    public function testManyRequest(Request $request){
        //Example: set default value, if param not found
        // $user['name'] = $request->input('name','Default Name');
        $user['name'] = $request->name;
        $user['pass'] = $request->pass;

        //Example: Check if the value is sent from the client
        // if($request->filled('name', 'email')){   ada nilainya

        //Example: Check if the value is sent from the client and not null
        // One Param
        // if($request->has('name')) { }
        // More than one
        // if($request->has('name', 'email')) { }

        //Example 1
        // return $request->only(['name']);
        // result:
        // {
        //     "name": "Ikhwan",
        // }

        //Example 2
        // return $request->except(['name']);
        // result:
        // {
        //     "pass": "12345",
        // }

        //Example 3
        // return response()->json([
        //     'message' => 'success!',
        //     'status' => true
        // ], 201);

        //Example 4
        return $user;
        // result:
        // {
        //     "name": "Ikhwan",
        //     "pass": "12345"
        // }
    }

    public function response(){
        //Example: use namespace
        // $x = (new Response('Data Succesful Created',201))->header('Content-Type', 'application/json');
        //Example: without namespace
        $x = response('Data Succesful Created',201)->header('Content-Type', 'application/json');
        //Example: set many value at header
        // $x = (new Response('Data Succesful Created',201))->header()->header()->header();

        //Example: auto detect header
        //Note: if the content type is not set, then the lumen will adjust to the existing 
        //results, if json then json, if text then text
        // $user['name'] = "Contoh nama";
        // $user['pass'] = "12345";
        // $x = (new Response($user,201));
        // $x = (new Response("123",201));
        return $x;
    }

}
