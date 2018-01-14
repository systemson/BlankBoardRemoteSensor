<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Auth routes
 */
Route::middleware('clear-cache')
->group(function () {
    Auth::routes();
});


/**
 * Public site
 */

/** Group for Public namespace */
/** @todo  rename namespace to "Public" */
Route::namespace('Front')
->group(function () {
    /** Default controller for front site */
    Route::get('/', 'Home@index')->name( 'home' );
    Route::get('/home', 'Home@index');
});


/**
 * Admin site
 */

/** Group for Admin namespace */
Route::namespace('Admin')
->prefix('admin')
->middleware(['auth', 'clear-cache', 'inactive', 'password-expire'])
->group(function () {

    /** Default controller for admin site */
    Route::get('/', 'DashboardController@index')->name('admin');

    /** Dashboard page */
    Route::get( 'dashboard', 'DashboardController@index' )->name( 'dashboard.index' );

    /** Meditions module */
    Route::get('meditions', 'MeditionsController@index')->name( 'meditions.index' );
    Route::get('meditions/graphs', 'MeditionsController@graphs')->name( 'meditions.graphs' );
    Route::get('meditions/monthly', 'MeditionsController@monthly')->name( 'meditions.monthly' );
    Route::get('meditions/daily', 'MeditionsController@daily')->name( 'meditions.daily' );

    /** Invoices module */
    Route::resource('invoices', 'InvoicesController');
    Route::get('invoices/new/{user_id}/{date}', 'InvoicesController@new')->name( 'invoices.create' );

    /** Sensors module */
    Route::resource('sensors', 'SensorsController');

    /** Payments module */
    Route::get('payments', 'PaymentsController@index')->name( 'payments.index' );

    /**
     * Emails module
     */

    /** Resource email routes */
    Route::resource('emails', 'EmailsController');

    /** Emails folders */
    Route::get('sent_emails', 'EmailsController@sentEmails')->name('emails.sent');
    Route::get('draft_emails', 'EmailsController@draftEmails')->name('emails.draft');
    Route::get('trashed_emails', 'EmailsController@trashedEmails')->name('emails.trash');

    /** Restore emails */
    Route::patch('emails/{id}/restore', 'EmailsController@restore')->name('emails.restore');

    /** Users module */
    Route::resource('users', 'UsersController');

    /** Roles module */
    Route::resource('roles', 'RolesController')->except('show');

    /** Permissions module */
    Route::resource('permissions', 'PermissionsController')->only([
        'index',
        'edit',
        'update',
    ]);

});
