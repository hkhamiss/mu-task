<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCommentRequest;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    private $repository;
    public function index(CommentRepository $repository){
        $this->repository=$repository;
    }

    public function store(NewCommentRequest $request){
        $this->repository->store($request->all());
    }

    public function update(Request $request,$id){
        $this->repository->update($request->all(),$id);
    }

    public function delete($id){
        $this->repository->destroy($id);
    }
}
