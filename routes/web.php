<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\OrderController;

use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';


Route::middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');


    //invoices --------------------------------
    Route::group(['prefix' => 'invoice', 'middleware' => 'permission:الفواتير', 'controller' => InvoiceController::class], function () {


        Route::get('/', 'index')->middleware('permission:الفواتير');
        Route::get('creat_invoice', 'create_invoice')->middleware('permission:اضافة فاتورة');
        Route::post('store_invoice', 'store_invoice')->middleware('permission:اضافة فاتورة');
        Route::get('edit_invoice/{id}', 'edit_invoice')->middleware('permission:تعديل الفاتورة');
        Route::get('getproducts/{id}', 'getproducts')->middleware('permission:الفواتير');
        Route::post('update_invoice/{id}', 'update_invoice')->middleware('permission:تعديل الفاتورة');
        Route::get('delete_invoice/{id}', 'delete_invoice')->middleware('permission:حذف الفاتورة');
        Route::post('update_status', 'update_status')->middleware('permission:تغير حالة الدفع');
        //soft delete----------------
        Route::get('soft_delete/{id}', 'soft_delete')->middleware('permission:ارشفة الفاتورة');
        Route::post('force_delete', 'force_delete')->middleware('permission:حذف الفاتورة');
        Route::post('restore_invoice', 'restore_invoice')->middleware('permission:الفواتير');

        //----satus invoices--------------------
        Route::get('archive_invoices', 'archive_invoices')->middleware('permission:ارشيف الفواتير');
        Route::get('paid_invoice', 'paid_invoice')->middleware('permission:الفواتير المدفوعة');
        Route::get('unpaid_invoice', 'unpaid_invoice')->middleware('permission:الفواتير الغير مدفوعة');
        Route::get('invoices_Partial', 'invoices_Partial')->middleware('permission:الفواتير المدفوعة جزئيا');
        // -------------print_invoice------------------
        Route::get('print_invoice/{id}', 'print_invoice')->middleware('permission:طباعةالفاتورة');
    });


    //------products--------------------

    Route::group(['prefix' => 'product', 'middleware' => 'permission:المنتجات', 'controller' => ProductController::class], function () {
        Route::get('/', 'index')->middleware('permission:المنتجات');
        Route::post('store_product', 'store_product')->middleware('permission:اضافة منتج');
        Route::post('update_product', 'update_product')->middleware('permission:تعديل منتج');
        Route::post('product_delete', 'product_delete')->middleware('permission:حذف منتج');
    });
    //---------report invoices--------------------
    Route::group(['prefix' => 'report', 'middleware' => 'permission:تقرير الفواتير', 'controller' => ReportController::class], function () {
        Route::get('/', 'index')->middleware('permission:تقرير الفواتير');
        Route::post('resut_data', 'resut_data')->middleware('permission:تقرير الفواتير');
    });

    //--------------sections--------------

    Route::group(['prefix' => 'section', 'middleware' => 'permission:الاقسام', 'controller' => SectionController::class], function () {
        Route::get('/', 'index')->middleware('permission:الاقسام')->middleware('permission:الاقسام');
        Route::post('store_section', 'store_section')->middleware('permission:اضافة قسم');
        Route::post('update_section', 'update_section')->middleware('permission:تعديل قسم');
        Route::delete('delete_section', 'delete_section')->middleware('permission:حذف قسم');
    });
    //--------------roles--------
    Route::group(['prefix' => 'role', 'middleware' => 'permission:صلاحيات المستخدمين', 'controller' => RolesController::class], function () {

        Route::get('/', 'index')->middleware('permission:صلاحيات المستخدمين');
        Route::get('add-role', 'add_role')->middleware('permission:اضافة صلاحية');
        Route::post('add_permission_role', 'add_permission_role')->middleware('permission:اضافة صلاحية');
        Route::get('show_role/{id}', 'show_role')->middleware('permission:عرض صلاحية');
        Route::get('delete_role/{id}', 'delete_role')->middleware('permission:حذف صلاحية');
        Route::get('edit_role/{id}', 'edit_role')->middleware('permission:تعديل صلاحية');
        Route::post('update_role', 'update_role')->middleware('permission:تعديل صلاحية');
    });
    //---------------user----------------------------
    Route::group(['prefix' => 'user', 'middleware' => 'permission:قائمة المستخدمين', 'controller' => UserController::class], function () {



        Route::get('/', 'index')->middleware('permission:قائمة المستخدمين');
        Route::get('Add_user', 'Add_user')->middleware('permission:اضافة مستخدم');
        Route::post('store_user', 'store_user')->middleware('permission:اضافة مستخدم');
        Route::get('delete_user/{id}', 'delete_user')->middleware('permission:حذف مستخدم');
        Route::get('edit_user/{id}', 'edit_user')->middleware('permission:تعديل مستخدم');
        Route::post('update_user', 'update_user')->middleware('permission:تعديل ');

        //------------------notification------------------
        Route::get('mark_all_read', 'mark_all_read')->middleware('permission:الاشعارات');
    });
    Route::view('cashier', 'cashier.cashier')->name('cashier');
    Route::post('cashier/store_order', [CashierController::class, 'store_order']);
    Route::get('gete_product/{section_id}', [CashierController::class, 'get_products']);
    Route::get('get_price/{product}', [CashierController::class, 'get_price']);
    Route::resource('order',OrderController::class);
});
