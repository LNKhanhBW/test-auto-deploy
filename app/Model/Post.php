<?php

namespace App\Model;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title', 'image', 'content', 'created_by', 'updated_by', 'deleted_by',
    ];

    /**
     * Create new record
     * @param $data
     * @return bool
     */
    public function create($data) {
        $this->title = $data['title'];
        $this->content = $data['content'];
        $this->image = $data['image'];
        return $this->save();
    }

    /**
     * Update record
     * @param $data
     * @param $id
     * @return mixed
     */
    public function edit($data, $id) {
        $post = $this->where('id', $id)->first();
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->image = $data['image'];
        return $post->save();
    }

    /**
     * Logic delete record
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function logicDelete($id) {
        $post = $this->where('id', $id)->first();
        $post->deleted_at = new \DateTime();
        $post->deleted_by = 999;
        return $post->save();
    }
}
