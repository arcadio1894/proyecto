<?php

namespace App\Observers;

use App\Category;
use App\Mail\SendEmailCategory;
use App\Mail\SendEmailCategoryUpdate;
use App\User;
use Illuminate\Support\Facades\Mail;

class CategoryObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        $email = "joryes1894@gmail.com";
        $user = User::where('email', $email)->first();
        Mail::to($email)->send(new SendEmailCategory($user, $category));
    }

    /**
     * Handle the category "updated" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        $email = "joryes1894@gmail.com";
        $user = User::where('email', $email)->first();
        Mail::to($email)->send(new SendEmailCategoryUpdate($user, $category));
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        //
    }

    /**
     * Handle the category "restored" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the category "force deleted" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
