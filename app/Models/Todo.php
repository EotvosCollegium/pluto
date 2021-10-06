<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'expiration_date',
        'completed'
    ];

    /**
     * Get the user who created the todo.
     * See https://laravel.com/docs/8.x/eloquent-relationships#one-to-many-inverse
     */
    public function user()
    {
        return $this->belongsTo(User::class);

        //eg.
        //$todo->user() //query builder
        //$todo->user   //lekerdezte a user-t
        //$todo->user->name
    }

    /**
     * Get the users the todo assigned to.
     * See https://laravel.com/docs/8.x/eloquent-relationships#many-to-many
     */
    public function assigned_users()
    {
        return $this->belongsToMany(User::class);
    }
}
