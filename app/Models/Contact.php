<?php

namespace App\Models;

use App\Notifications\ContactCreatedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'phone', 'email'];

    /**
     * @return void
     */
    protected static function boot() : void
    {
        parent::boot();
        self::created(function (Contact $record) {
            User::admins()->get()->each(function ($admin) use ($record) {
            });
        });
    }
}
