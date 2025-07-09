<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function timelines()
    {
        return $this->hasMany(Timeline::class);
    }

    public function submission_post()
    {
        return $this->hasOne(SubmissionPost::class);
    }
}
