<?php

namespace App\Models;

use CodeIgniter\Model;

class Book extends Model
{
    protected $table      = 'books';
    protected $useTimestamps = true;
    protected $allowedFields = ['title', 'slug', 'author', 'publisher', 'cover'];

    public function getBook($slug = false)
    {
        if ($slug == false) {
            // return $this->findAll();
            return $this->orderBy('id', 'DESC')->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }
}
