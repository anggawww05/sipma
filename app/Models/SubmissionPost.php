<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubmissionPost extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
