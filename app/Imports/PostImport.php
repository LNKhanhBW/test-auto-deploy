<?php

namespace App\Imports;

use App\Model\Post;
use Maatwebsite\Excel\Concerns\ToModel;

class PostImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return Post|\Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Post([
            'title' => $row[0],
            'image' => $row[1],
            'content' => $row[2],
        ]);
    }
}
