<?php
namespace App\Repositories;

use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;

class CommentRepository {

    public function model()
    {
        return new PostComment();
    }


    public function get($relations=[],$columns=['*'])
    {
        return $this->model()->query()->with($relations)->select($columns)->orderBy('created_at', 'desc')->get();
    }


    public function store($data){
        return $this->model()->create($data);
    }

    public function find($id)
    {
        return $this->model()->findorfail($id);
    }


    public function update($id,$data)
    {
        $row=$this->find($id);
        $row->update($data);
        return $row;

    }

    public function destroy($id)
    {
        $this->model()->findorfail($id)->delete();
    }



}
