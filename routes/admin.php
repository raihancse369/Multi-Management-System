<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');


Route::group(['namespace'=>'App\Http\Controllers\Admin', 'middleware' =>'is_admin','prefix'=>'admin'], function() {

    //Admin Profile Routes
    Route::get('home','AdminController@admin')->name('admin.home');
    Route::get('logout','AdminController@logout')->name('admin.logout');

    Route::get('/password-change','AdminController@PasswordChange')->name('admin.password.change');
    Route::post('/password-update','AdminController@PasswordUpdate')->name('admin.password.update');

    Route::get('/edit-profile', 'AdminController@EditProfile')->name('admin.profile.edit');
Route::post('/update-profile', 'AdminController@UpdateProfile')->name('admin.profile.update');


    // User Role Routes
    Route::group(['prefix'=>'role'], function() {
        Route::get('/','RoleController@index')->name('role');
        Route::post('/store','RoleController@store')->name('store.role');
        Route::get('/edit/{id}','RoleController@edit');
        Route::put('/update/{id}', 'RoleController@update')->name('update.role');
        Route::delete('/delete/{id}','RoleController@destroy')->name('role.delete');
    });

    // Site Routes
    Route::group(['prefix'=>'site'], function() {
        Route::get('/','SiteController@index')->name('site');
        Route::get('/edit/{id}','SiteController@edit');
        Route::post('/update','SiteController@update')->name('update.site');
    });

    //seo setting
    Route::group(['prefix'=>'seo'], function() {
        Route::get('/','SettingController@index')->name('seo');
        Route::get('/edit/{id}','SettingController@edit');
        Route::post('/update','SettingController@update')->name('update.seo');
    });

    //smtp setting
    Route::group(['prefix'=>'smtp'], function() {
        Route::get('/','SettingController@smtp')->name('smtp');
        Route::get('/edit/{id}','SettingController@smtpedit');
        Route::post('/update','SettingController@smtpupdate')->name('update.smtp');
    });

    Route::group(['prefix'=>'slider'], function() {
        Route::get('/', 'SliderController@index')->name('slider');
        Route::post('/store', 'SliderController@store')->name('store.slider');
        Route::get('/edit/{id}', 'SliderController@edit');
        Route::post('/update/{id}', 'SliderController@update')->name('update.slider');
        Route::delete('/delete/{id}', 'SliderController@destroy')->name('slider.delete');
    });

    // About Page Routes

    Route::group(['prefix'=>'about-page'], function() {
        Route::get('/', 'AboutpageController@index')->name('about-page');
        Route::get('/edit/{id}', 'AboutpageController@edit');
        Route::post('/update/{id}', 'AboutpageController@update')->name('update.about-page');
    });

    // Industry Serve Page Routes
    Route::group(['prefix'=>'serve'], function() {
        Route::get('/','ServeController@index')->name('serve');
        Route::post('/store','ServeController@store')->name('store.serve');
        Route::get('/edit/{id}','ServeController@edit');
        Route::post('/update/{id}', 'ServeController@update')->name('update.serve');
        Route::delete('/delete/{id}','ServeController@destroy')->name('serve.delete');
    });

    // Service Page Routes
    Route::group(['prefix'=>'service-page'], function() {
        Route::get('/','ServicepageController@index')->name('service-page');
        Route::post('/store','ServicepageController@store')->name('store.service');
        Route::get('/edit/{id}','ServicepageController@edit');
        Route::post('/update/{id}', 'ServicepageController@update')->name('update.service');
        Route::delete('/delete/{id}','ServicepageController@destroy')->name('service.delete');
    });

    // Project Page Routes
    Route::group(['prefix'=>'project-page'], function() {
        Route::get('/','ProjectController@index')->name('project-page');
        Route::post('/store','ProjectController@store')->name('store.project');
        Route::get('/edit/{id}','ProjectController@edit');
        Route::post('/update/{id}', 'ProjectController@update')->name('update.project');
        Route::delete('/delete/{id}','ProjectController@destroy')->name('project.delete');
    });

    // Footer Page Routes
    Route::group(['prefix'=>'footer-page'], function() {
        Route::get('/','FooterController@index')->name('footer-page');
        Route::post('/store','FooterController@store')->name('store.footer');
        Route::get('/edit/{id}','FooterController@edit');
        Route::post('/update/{id}', 'FooterController@update')->name('update.footer');
        Route::delete('/delete/{id}','FooterController@destroy')->name('footer.delete');
    });

    // Page Routes
    Route::group(['prefix'=>'page'], function() {
        Route::get('/','PageController@index')->name('page');
        Route::post('/store','PageController@store')->name('store.page');
        Route::get('/edit/{id}','PageController@edit');
        Route::post('/update','PageController@update')->name('update.page');
        Route::get('/delete/{id}','PageController@destroy')->name('page.delete');
    });

    // Category Routes
    Route::group(['prefix'=>'category'], function() {
        Route::get('/','CategoryController@index')->name('category');
        Route::post('/store','CategoryController@store')->name('store.category');
        Route::get('/edit/{id}','CategoryController@edit');
        Route::put('/update/{id}', 'CategoryController@update')->name('update.category');
        Route::delete('/delete/{id}','CategoryController@destroy')->name('category.delete');
    });

    // Sub Category Routes
    Route::group(['prefix'=>'subcategory'], function() {
        Route::get('/','SubcategoryController@index')->name('subcategory');
        Route::post('/store','SubcategoryController@store')->name('store.subcategory');
        Route::get('/edit/{id}','SubcategoryController@edit');
        Route::put('/update/{id}', 'SubcategoryController@update')->name('update.subcategory');
        Route::delete('/delete/{id}','SubcategoryController@destroy')->name('subcategory.delete');
    });

    // Brand Category Routes
    Route::group(['prefix'=>'brand'], function() {
        Route::get('/','BrandController@index')->name('brand');
        Route::post('/store','BrandController@store')->name('store.brand');
        Route::get('/edit/{id}','BrandController@edit');
        Route::put('/update/{id}', 'BrandController@update')->name('update.brand');
        Route::delete('/delete/{id}','BrandController@destroy')->name('brand.delete');
    });

    // Product Routes
    Route::group(['prefix'=>'product'], function() {
        Route::get('/','ProductController@index')->name('product');
        Route::post('/store','ProductController@store')->name('store.product');
        Route::get('/edit/{id}','ProductController@edit');
        Route::put('/update','ProductController@update')->name('update.product');
        Route::delete('/delete/{id}','ProductController@destroy')->name('product.delete');
    });


    //Coupon Routes
    Route::group(['prefix'=>'coupon'], function() {
        Route::get('/','CouponController@index')->name('coupon.index');
        Route::post('/store','CouponController@store')->name('store.coupon');
        Route::get('/edit/{id}','CouponController@edit');
        Route::put('/update/{id}', 'CouponController@update')->name('update.coupon');
        Route::delete('/delete/{id}','CouponController@destroy')->name('coupon.delete');
    });

    //Campaign Routes
    Route::group(['prefix'=>'campaign'], function() {
        Route::get('/', 'CampaignController@index')->name('campaign.index');
        Route::post('/store', 'CampaignController@store')->name('campaign.store');
        Route::get('/edit/{id}', 'CampaignController@edit');
        Route::put('/update/{id}', 'CampaignController@update')->name('update.campaign');
        Route::delete('/delete/{id}', 'CampaignController@destroy')->name('campaign.delete');
    });

    //__campaign product routes__//
    Route::group(['prefix'=>'campaign-product'], function(){
        Route::get('/{campaign_id}','CampaignController@campaignProduct')->name('campaign.product');
        Route::get('/add/{id}/{campaign_id}','CampaignController@ProductAddToCampaign')->name('add.product.to.campaign');
        Route::get('/list/{campaign_id}','CampaignController@ProductListCampaign')->name('campaign.product.list');
        Route::get('/remove/{id}','CampaignController@RemoveProduct')->name('campaign.product.remove');
        // Route::post('/update','CampaignController@update')->name('campaign.update');
    });

    //Ticket 
    Route::group(['prefix'=>'ticket'], function(){
        Route::get('/','TicketController@index')->name('ticket.index');
        Route::get('/ticket/show/{id}','TicketController@show')->name('admin.ticket.show');
        Route::post('/ticket/reply','TicketController@ReplyTicket')->name('admin.store.reply');
        Route::get('/ticket/close/{id}','TicketController@CloseTicket')->name('admin.close.ticket');
        Route::get('/ticket/delete/{id}','TicketController@destroy')->name('admin.ticket.delete');

        Route::get('/edit/{id}','TicketController@edit');
        
    });

    // Order Routes
    Route::group(['prefix'=>'order'], function(){
        Route::get('/','OrderController@index')->name('order.index');
        Route::get('/edit/{id}','OrderController@edit');
        Route::post('/update','OrderController@update')->name('update.order');
        Route::get('/delete/{id}','OrderController@destroy')->name('order.delete');

    });

    // Show All Contact Message Routes
    Route::group(['prefix'=>'contact'], function() {
        Route::get('/', 'AdminController@index')->name('contact');
        Route::get('/edit/{id}', 'AdminController@edit');

        Route::delete('/delete/{id}', 'AdminController@destroy')->name('contact.delete');
    });

    // Show All Review Message Routes
    Route::group(['prefix'=>'review'], function() {
        Route::get('/', 'AdminController@rindex')->name('review');
        Route::get('/edit/{id}', 'AdminController@redit');
        Route::delete('/delete/{id}', 'AdminController@rdestroy')->name('review.delete');
    });

    // Show Website Review Message Routes
    Route::group(['prefix'=>'website-review'], function() {
        Route::get('/', 'AdminController@wbindex')->name('website-review');
        Route::get('/edit/{id}', 'AdminController@wbedit');
        Route::delete('/delete/{id}', 'AdminController@wbdestroy')->name('website-review.delete');
    });

    // Blog Category Routes
    Route::group(['prefix'=>'blog-category'], function() {
        Route::get('/','BlogcategoryController@index')->name('blog-category');
        Route::post('/store','BlogcategoryController@store')->name('store.blog-category');
        Route::get('/edit/{id}','BlogcategoryController@edit');
        Route::put('/update/{id}', 'BlogcategoryController@update')->name('update.blog-category');
        Route::delete('/delete/{id}','BlogcategoryController@destroy')->name('blog-category.delete');
    });

    // Blog Post Routes
    Route::group(['prefix'=>'blog'], function() {
        Route::get('/', 'PostController@index')->name('blog');
        Route::post('/store', 'PostController@store')->name('store.blog');
        Route::get('/edit/{id}', 'PostController@edit');
        Route::put('/update/{id}', 'PostController@update')->name('update.blog');
        Route::delete('/delete/{id}', 'PostController@destroy')->name('blog.delete');
    });

    // HRM 

    // Department Routes
    Route::group(['prefix'=>'department'], function() {
        Route::get('/','DepartmentController@index')->name('department');
        Route::post('/store','DepartmentController@store')->name('store.department');
        Route::get('/edit/{id}','DepartmentController@edit');
        Route::put('/update/{id}', 'DepartmentController@update')->name('update.department');
        Route::delete('/delete/{id}','DepartmentController@destroy')->name('department.delete');
    });

    // Designation Routes
    Route::group(['prefix'=>'designation'], function() {
        Route::get('/','DesignationController@index')->name('designation');
        Route::post('/store','DesignationController@store')->name('store.designation');
        Route::get('/edit/{id}','DesignationController@edit');
        Route::put('/update/{id}', 'DesignationController@update')->name('update.designation');
        Route::delete('/delete/{id}','DesignationController@destroy')->name('designation.delete');
    });

    // Employee Routes
    Route::group(['prefix'=>'employee'], function() {
        Route::get('/','EmployeeController@index')->name('employee');
        Route::post('/store','EmployeeController@store')->name('store.employee');
        Route::get('/edit/{id}','EmployeeController@edit');
        Route::put('/update/{id}', 'EmployeeController@update')->name('update.employee');
        Route::delete('/delete/{id}','EmployeeController@destroy')->name('employee.delete');
    });

    // Holiday Routes
    Route::group(['prefix'=>'holiday'], function() {
        Route::get('/','HolidayController@index')->name('holiday');
        Route::post('/store','HolidayController@store')->name('store.holiday');
        Route::get('/edit/{id}','HolidayController@edit');
        Route::put('/update/{id}', 'HolidayController@update')->name('update.holiday');
        Route::delete('/delete/{id}','HolidayController@destroy')->name('holiday.delete');
    });

    // Leave Type Routes
    Route::group(['prefix'=>'leave-type'], function() {
        Route::get('/','LeavetypeController@index')->name('leave-type');
        Route::post('/store','LeavetypeController@store')->name('store.leave-type');
        Route::get('/edit/{id}','LeavetypeController@edit');
        Route::put('/update/{id}', 'LeavetypeController@update')->name('update.leave-type');
        Route::delete('/delete/{id}','LeavetypeController@destroy')->name('leave-type.delete');
    });

    // Leave Application Routes
    Route::group(['prefix'=>'leave'], function() {
        Route::get('/', 'LeaveController@index')->name('leave');
        Route::post('/store', 'LeaveController@store')->name('store.leave');
        Route::get('/edit/{id}', 'LeaveController@edit');
        Route::put('/update/{id}', 'LeaveController@update')->name('update.leave');
        Route::delete('/delete/{id}', 'LeaveController@destroy')->name('leave.delete');
    });

    // Award Routes
    Route::group(['prefix'=>'award'], function() {
        Route::get('/','AwardController@index')->name('award');
        Route::post('/store','AwardController@store')->name('store.award');
        Route::get('/edit/{id}','AwardController@edit');
        Route::put('/update/{id}', 'AwardController@update')->name('update.award');
        Route::delete('/delete/{id}','AwardController@destroy')->name('award.delete');
    });

    // ✅ Attendance Routes
    Route::group(['prefix' => 'attendance', ], function() {
        Route::get('/', 'AttendanceController@index')->name('attendance.index');
        Route::post('/store', 'AttendanceController@store')->name('store.attendance');
        Route::get('/all-attendance', 'AttendanceController@AllAttendance')->name('all.attendance');
        
        // ✅ FIXED — no extra "attendance" here
        Route::get('/edit/{date}', 'AttendanceController@edit')->name('attendance.edit');
        Route::post('/update', 'AttendanceController@update')->name('update.attendance');
        Route::delete('/delete/{att_date}', 'AttendanceController@destroy')->name('attendance.delete');
    });

    // Payroll Routes
    Route::group(['prefix'=>'payroll'], function() {
        Route::get('/','PayrollController@index')->name('payroll');
        Route::post('/store','PayrollController@store')->name('payroll.store');
        Route::get('/edit/{id}','PayrollController@edit');
        Route::put('/update/{id}', 'PayrollController@update')->name('payroll.update');
        Route::delete('/delete/{id}','PayrollController@destroy')->name('payroll.delete');
    });
    // Expense Type Routes
    Route::group(['prefix'=>'expense-type'], function() {
        Route::get('/','ExpensetypeController@index')->name('expense-type');
        Route::post('/store','ExpensetypeController@store')->name('store.expense-type');
        Route::get('/edit/{id}','ExpensetypeController@edit');
        Route::put('/update/{id}', 'ExpensetypeController@update')->name('update.expense-type');
        Route::delete('/delete/{id}','ExpensetypeController@destroy')->name('expense-type.delete');
    });
    // Expense Routes
    Route::group(['prefix'=>'expense'], function() {
        Route::get('/','ExpenseController@index')->name('expense');
        Route::post('/store','ExpenseController@store')->name('store.expense');
        Route::get('/edit/{id}','ExpenseController@edit');
        Route::put('/update/{id}', 'ExpenseController@update')->name('update.expense');
        Route::delete('/delete/{id}','ExpenseController@destroy')->name('expense.delete');
    });

});