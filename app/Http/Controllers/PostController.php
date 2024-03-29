<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewPostRequest;
use App\Models\PostComment;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;


class PostController extends Controller
{
    private $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository=$repository;
    }

    public function index(Request $request){
        $data = $this->repository->get(['owner','comments']);
        return response()->json($data,200);
    }

    public function store(NewPostRequest $request){
        $data=$request->except('_token');
        $this->repository->store($data);
        return response()->json([],200);
    }

    public function update(Request $request,$id){
        $data=$request->except('_token');
        $this->repository->update($id,$data);
        return response()->json([],200);
    }

    public function destroy($id){
        $this->repository->destroy($id);
        return response()->json([],200);
    }

    public function show($id){

        $data=$this->repository->find($id);
        return response()->json($data,200);
    }



}
