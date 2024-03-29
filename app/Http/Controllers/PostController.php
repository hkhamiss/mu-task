<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewPostRequest;
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
        $this->repository->store($request->all());
    }

    public function update(Request $request,$id){
        $this->repository->update($id,$request->all());
    }

    public function delete($id){
        $this->repository->destroy($id);
    }
}
