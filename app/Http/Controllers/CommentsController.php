<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCommentRequest;
use App\Models\PostComment;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public $repository;
    public function __construct(CommentRepository $repository)
    {
        $this->repository=$repository;
    }

    public function index(){

    }

    public function store(Request $request){
        $data=$request->except('_token');
        $this->repository->store($data);
        return response()->json([],200);
    }

    public function update(Request $request,$id){
        $this->repository->update($request->all(),$id);
    }

    public function destroy($id){
        $this->repository->destroy($id);
        return response()->json([],200);
    }
}
