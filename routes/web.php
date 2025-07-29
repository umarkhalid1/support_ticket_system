<?php

use App\Livewire\Backend\ContactUser;
use App\Livewire\Dashboard;
use App\Livewire\ImageUpload;
use App\Livewire\UserProfile;
use App\Livewire\Frontend\Home;
use App\Livewire\Backend\EditUser;
use App\Livewire\Backend\UserList;
use App\Livewire\Backend\TicketList;
use App\Livewire\Backend\UserCreate;
use Illuminate\Support\Facades\Route;
use App\Livewire\Backend\TicketDetail;
use App\Livewire\Category\CategoryEdit;
use App\Livewire\Category\CategoryForm;
use App\Livewire\Frontend\TicketCreate;
use App\Livewire\Category\CategoryIndex;

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // ***************************  Category Routes ******************************** //

    Route::get('/categories/create', CategoryForm::class)->name('categories.create')->middleware(['can:category.create']);

    Route::get('/categories', CategoryIndex::class)->name('categories')->middleware(['can:category.view']);

    Route::get('/categories/{category}/edit', CategoryEdit::class)->name('categories.edit')->middleware(['can:category.update']);

    // ***************************  Ticket Routes ******************************** //

    Route::get('tickets', TicketList::class)->name('tickets.index')->middleware(['can:ticket.view']);
    Route::get('tickets/{ticket}', TicketDetail::class)->name('ticket.detail');

    // ***************************  User Routes ******************************** //

    Route::get('users/create', UserCreate::class)->name('users.create')->middleware(['can:user.create']);
    Route::get('users', UserList::class)->name('users')->middleware(['can:user.view']);
    Route::get('users/{user}/edit', EditUser::class)->name('users.edit')->middleware(['can:user.update']);

    Route::get('message/{id}', ContactUser::class)->name('contact.user');

    // ***************************  Auth Routes ******************************** //

    Route::post('/logout', \App\Livewire\Logout::class)->name('logout');
    Route::get('profile', UserProfile::class)->name('profile');

    Route::get('image_upload', ImageUpload::class);


});



Route::get('/', Home::class)->name('home');
Route::get('ticket/create', TicketCreate::class)->name('tickets.create');


Route::fallback(function () {
    return view('404');
});

require __DIR__ . '/auth.php';