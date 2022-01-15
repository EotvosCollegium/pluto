<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'amount',
        'notes',
        'cash',
        'income',
        'user_id'
    ];

    /**
     * Get the user who created the account.
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
     * Get the users the account assigned to.
     * See https://laravel.com/docs/8.x/eloquent-relationships#many-to-many
     */
    public function assigned_users()
    {
        return $this->belongsToMany(User::class);
    }
}
