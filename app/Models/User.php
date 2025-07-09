<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function reports()
    {
        return $this->hasMany(Submission::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function hasRole(): ?string
    {
        if (!is_null($this->admin_id)) return 'admin';
        if (!is_null($this->operator_id)) return 'operator';
        if (!is_null($this->student_id)) return 'student';
        return null;
    }
}
