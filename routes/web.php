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



Route::get('/', 'Dashboard@index');


// Authentication routes...
/*Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout'); */

Auth::routes();

// Registration routes...
// Route::get('auth/register', 'Auth\AuthController@getRegister');
// Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('staff/create', 'StaffController@create');
Route::post('staff/store', 'StaffController@store');
Route::get('staff/show/{id}', 'StaffController@show');
Route::get('staff/list', 'StaffController@index')->name('staff_list');
Route::delete('staff/destroy', 'StaffController@destroy');

Route::get('dashboard', 'Dashboard@index');
Route::get('home', 'Dashboard@index');

// routes for branches
Route::get('branch', 'BranchController@index');
Route::get('branch/create', 'BranchController@create');
Route::post('branch/store', 'BranchController@store');
Route::delete('branch/destroy', 'BranchController@destroy');
Route::get('branch/edit/{id}', 'BranchController@edit');
Route::post('branch/update', 'BranchController@update');

// rotes for supplier
Route::get('supplier', 'SupplierController@index');
Route::get('supplier/create', 'SupplierController@create');
Route::post('supplier/store', 'SupplierController@store');
Route::get('supplier/edit/{id}', 'SupplierController@edit');
Route::post('supplier/update/', 'SupplierController@update');
Route::delete('supplier/destroy', 'SupplierController@destroy');

// routes for products
Route::get('product', 'ProductController@index')->name('product_list');
Route::get('product/create', 'ProductController@create');
Route::post('product/store', 'ProductController@store');
Route::get('product/edit/{id}', 'ProductController@edit');
Route::post('product/update/', 'ProductController@update');
Route::delete('product/destroy', 'ProductController@destroy');
Route::get('product/show/{id}', 'ProductController@show');
Route::get('product/get-product-stock/{id}', 'ProductController@getProductStock');
Route::get('product/get-price-level-by-product/{id}', 'ProductController@getPriceLevelByProduct');
Route::get('product/get-product-description/{id}', 'ProductController@getProductDescription');

// routes for product category
Route::get('product/category', 'CategoryController@index')->name('product_category');
Route::post('category/store', 'CategoryController@store');
Route::get('product/category/edit/{id}', 'CategoryController@edit');
Route::post('category/update', 'CategoryController@update');
Route::delete('category/destroy', 'CategoryController@destroy');

//  routes for brands
Route::get('product/brand', 'BrandController@index')->name('product_brand');
Route::post('brand/store', 'BrandController@store');
Route::get('product/brand/edit/{id}', 'BrandController@edit');
Route::post('brand/update', 'BrandController@update');
Route::delete('brand/destroy', 'BrandController@destroy');

// routes for models
Route::get('product/model', 'ModelController@index')->name('product_model');
Route::post('model/store', 'ModelController@store');
Route::post('model/update', 'ModelController@update');
Route::get('product/model/edit/{id}', 'ModelController@edit');
Route::delete('model/destroy', 'ModelController@destroy');

// routes for purchase orders
Route::get('purchase-orders', 'PurchaseOrderController@index')->name('purchase_order_list');
Route::get('purchase-orders/create', 'PurchaseOrderController@create')->name('create_purchase_order');
Route::get('purchase-orders/getsupplier/{id}', 'PurchaseOrderController@getSupplierDetailsById');
Route::get('purchase-orders/getbranch/{id}', 'PurchaseOrderController@getBranchDetailsById');
Route::get('purchase-orders/getproducts/{id}', 'PurchaseOrderController@getProducts');
Route::get('purchase-orders/get-product-description/{id}', 'PurchaseOrderController@getProductDescription');
Route::get('purchase-orders/get-term-due-date/{id}', 'PurchaseOrderController@getTermDueDate');
Route::get('purchase-orders/get-product-items/{id}', 'PurchaseOrderController@getProductItems');
Route::post('purchase-orders/save-po-product', 'PurchaseOrderController@savePoProduct');
Route::post('purchase-orders/delete-po-product', 'PurchaseOrderController@deletePoProduct');
Route::post('purchase-orders/update', 'PurchaseOrderController@update');
Route::get('purchase-orders/edit/{id}', 'PurchaseOrderController@edit');
Route::get('purchase-orders/print/{id}', 'PurchaseOrderController@printPurchaseOrder');
Route::get('purchase-orders/makeinvoice/{id}', 'PurchaseOrderController@invoicePoView');
Route::get('purchase-orders/doinvoice/{id}', 'PurchaseOrderController@doInvoicePurchaseOrder');
Route::delete('purchase-orders/destroy', 'PurchaseOrderController@destroy');

// routes for purchase invoices
Route::get('purchase-invoices', 'PurchaseInvoiceController@index')->name('purchase_invoice_list');
Route::get('purchase-invoice/edit/{id}', 'PurchaseInvoiceController@edit')->name('purchase_invoice_edit');
Route::get('purchase-invoice/get-product-items/{id}', 'PurchaseInvoiceController@getProductItems');
Route::post('purchase-invoice/save-invoice-product', 'PurchaseInvoiceController@savePiProduct');
Route::post('purchase-invoice/update', 'PurchaseInvoiceController@update');
Route::post('purchase-invoice/delete-pi-product', 'PurchaseInvoiceController@deletePiProduct');
Route::get('purchase-invoice/print/{id}', 'PurchaseInvoiceController@printPurchaseInvoice');
Route::get('purchase-invoice/create', 'PurchaseInvoiceController@create')->name('create_purchase_invoice');
Route::delete('purchase-invoice/destroy', 'PurchaseInvoiceController@destroy');

// routes for quotations
Route::get('quotation', 'QuotationController@index')->name('quotation_list');
Route::get('quotation/create', 'QuotationController@create');
Route::get('quotation/edit/{id}', 'QuotationController@edit')->name('edit_quotation');
Route::post('quotation/save-quotation-product', 'QuotationController@saveQuotationProduct');
Route::get('quotation/get-product-items/{id}', 'QuotationController@getProductItems');
Route::post('quotation/update', 'QuotationController@update');
Route::get('quotation/print/{id}', 'QuotationController@printQuotation');
Route::delete('quotation/destroy', 'QuotationController@destroy');

// routes for customers
Route::post('customer/store', 'CustomerController@store');
Route::post('customer/ajaxStore', 'CustomerController@ajaxStore');
Route::get('customer/getcustomer/{id}', 'CustomerController@getCustomerDetailsById');

// routes for sales invcice
Route::get('sales-invoices/', 'SalesInvoiceController@index')->name('salesinvoice_list');
Route::get('sales-invoice/create', 'SalesInvoiceController@create');
Route::get('sales-invoice/edit/{id}', 'SalesInvoiceController@edit')->name('edit_salesinvoice');
Route::post('sales-invoice/update', 'SalesInvoiceController@update');
Route::get('sales-invoice/get-product-items/{id}', 'SalesInvoiceController@getProductItems');
Route::post('sales-invoice/save-salesinvoice-product', 'SalesInvoiceController@saveSalesInvoiceProduct');
Route::delete('sales-invoice/destroy', 'SalesInvoiceController@destroy');
