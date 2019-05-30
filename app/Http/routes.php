<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
//
//Route::group(['namespace' => 'Frontend'  ], function( ) {
//
//    Route::get('about', function() {
//
//        return 'about page in : '  .App::getLocale();;
//    });
//});
//




Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

// frontend /public area routesF
Route::group(['namespace' => 'Frontend', 'middleware' => ['web']], function() {
    // frontend homepage
    Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@index']);
});


Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);
Route::get('about', function() { //test
    return 'about page in : ' . App::getLocale();

});
// api routes

/** TEST **/
// Route::post('save_accounts_to_user', ['as' => 'test.save_accounts_to_user', 'uses' => 'ApiController@saveAccountsToUser']);  //ajax request

Route::get('api/tax-dropdown/',['as' => 'Api.getTaxProductData', 'uses' => 'ApiController@getTaxProductData'] );
Route::get('api/tax-product/', 'ApiController@getTaxProductData');

// protect dashboard :users / customers
Route::group([ 'namespace' => 'Frontend\Dashboard\User', 'prefix' => 'dashboard'], function() {


    Route::group(['middleware' => [ 'App\Http\Middleware\UserRoutingMiddleware', 'status.inactive']], function () {

        // Main dashboard for logged

        Route::get('/', ['as' => 'dashboard.index', 'uses' => 'HomeController@index']);
        Route::get('helps', 'HelpController@index');
        Route::post('helps/store',['as'=>'help.store','uses'=>'HelpController@store']);
        Route::post('feedback/store',['as'=>'feedback.store','uses'=>'HomeController@store_feedback']);

        Route::get('last_login_front','HomeController@updateLastLoginFront');
        Route::get('helps/myquestions',['as'=>'help_myquestions','uses'=>'HelpController@get_myquestion_only']);
        Route::get('helps/faq',['as'=>'help_faq','uses'=>'HelpController@get_faq']);

        // start account area route
        Route::group(['prefix' => 'userManager'], function () {
            Route::get('/', ['as' => 'users.main', 'uses' => 'UserManagerController@index']);
            //Route::get('profile', ['as' => 'profile.index', 'uses' => 'HomeController@index']);
            Route::get('users', ['as' => 'users.index', 'uses' => 'UserManagerController@usersIndex']);
            Route::get('users/create', ['as' => 'users.create', 'uses' => 'UserManagerController@usersCreate']);
            Route::post('users/create', ['as' => 'users.store', 'uses' => 'UserManagerController@usersStore']);

            Route::get('chagnepassword', ['as' => 'users.changepassword', 'uses' => 'UserManagerController@basicIndex']);
            Route::get('profile/basic', ['as' => 'profile.basic.index', 'uses' => 'UserManagerController@basicIndex']);
            Route::get('profile/basic/edit', ['as' => 'profile.basic.edit', 'uses' => 'UserManagerController@basicEdit']);
            Route::patch('profile/basic/update/{id}', ['as' => 'profile.basic.update', 'uses' => 'UserManagerController@basicUpdate']);

            Route::get('profile/address', ['as' => 'profile.address.index', 'uses' => 'UserManagerController@addressIndex']);
            Route::get('profile/address/create', ['as' => 'profile.address.create', 'uses' => 'UserManagerController@addressCreate']);
            Route::post('profile/address/store', ['as' => 'profile.address.store', 'uses' => 'UserManagerController@addressStore']);
            Route::get('profile/address/{id}/edit', ['as' => 'profile.address.edit', 'uses' => 'UserManagerController@addressEdit']);
            Route::patch('profile/address/update/{id}', ['as' => 'profile.address.update', 'uses' => 'UserManagerController@addressUpdate']);
            Route::delete('profile/address/{id}', ['as' => 'profile.address.destroy', 'uses' => 'UserManagerController@destroy']);

            Route::get('profile/bank_account', ['as' => 'profile.bankaccount.index', 'uses' => 'UserManagerController@bankAccountIndex']);
            Route::get('profile/bank_account/create', ['as' => 'profile.bankaccount.create', 'uses' => 'UserManagerController@bankAccountCreate']);
            Route::post('profile/bank_account/store', ['as' => 'profile.bankaccount.store', 'uses' => 'UserManagerController@bankAccountStore']);
            Route::get('profile/bank_account/edit/{id}', ['as' => 'profile.bankaccount.edit', 'uses' => 'UserManagerController@bankAccountEdit']);
            Route::patch('profile/bank_account/update/{id}', ['as' => 'profile.bankaccount.update', 'uses' => 'UserManagerController@bankAccountUpdate']);
            Route::delete('profile/bank_account/{id}', ['as' => 'profile.bankaccount.destroy', 'uses' => 'UserManagerController@bankAccountDestroy']);
			Route::post('editUserMang', ['as' => 'editUserMang', 'uses' => 'UserManagerController@editUserMang']);
		});

        // Start Help Area Route
        Route::resource('helps', 'HelpController', ['names' =>
            [
                'index' => 'helps.index',
                'create' => 'helps.create',
                'edit' => 'helps.edit',
                'update' => 'helps.update',
                'destroy' => 'helps.destroy',

            ],
        ]);
        Route::post('helps/store',['as'=>'help.store','uses'=>'HelpController@store']);
        Route::get('last_login_front','HomeController@updateLastLoginFront');
        Route::get('backend/helps',['as'=>'helps.show','uses'=>'HelpController@show']);
        Route::get('previous/replays/{id?}',['as'=>'helps.replays','uses'=>'HelpController@previous_replays']);
        Route::post('helps/update',['as'=>'helps.updates','uses'=>'HelpController@update']);

        // start account area route
        Route::group(['prefix' => 'accountmanager'], function () {
            Route::get('/', ['as' => 'account.main', 'uses' => 'AccountController@main']);
            Route::get('accounts/list', ['as' => 'account.index', 'uses' => 'AccountController@index']);
            // account/account manager route
            Route::get('accounts/create', ['as' => 'account.create', 'uses' => 'AccountController@create']);
            Route::post('accounts/create', ['as' => 'account.store', 'uses' => 'AccountController@store']);
            Route::get('accounts/{id}/edit', ['as' => 'account.edit', 'uses' => 'AccountController@edit']);
            Route::patch('accounts/{id}', ['as' => 'account.update', 'uses' => 'AccountController@update']);
            Route::delete('accounts/{id}', ['as' => 'account.destroy', 'uses' => 'AccountController@destroy']);

			Route::get('accounts_types', ['as' => 'account.filter', 'uses' => 'AccountController@filter']);
            Route::post('storeDisplay', ['as' => 'account.storeDisplay', 'uses' => 'AccountController@storeDisplay']);

            //ajax request
            Route::get('get_account_json', ['as' => 'account.get_accounts_json', 'uses' => 'AccountController@getAccountsJson']);  //ajax request
            Route::get('get_account_company_type_json', ['as' => 'account.get_account_company_type_json', 'uses' => 'AccountController@getAccountsCompanyTypeJson']);  //ajax request

            Route::post('save_accounts_to_user', ['as' => 'account.save_accounts_to_user', 'uses' => 'AccountController@saveAccountsToUser']);  //ajax request
        });
        // start settings area route
        Route::group(['prefix' => 'settingManager'], function () {
            Route::get('/', ['as' => 'setting.main', 'uses' => 'SettingController@main']);
        });

        // start modules area route
        Route::group(['prefix' => 'moreManager'], function () {
          Route::get('/', ['as' => 'more.main', 'uses' => 'MoreController@main']);

            // Route::get('/', ['as' => 'more.main', 'uses' => 'ProductController@main']);
             //  Route::get('list', ['as' => 'more.main', 'uses' => 'ProductController@index']);
            //ajax request

        });

        // start product area route
        Route::group(['prefix' => 'product'], function () {
            Route::get('/', ['as' => 'product.main', 'uses' => 'ProductController@main']);
            Route::get('list', ['as' => 'product.index', 'uses' => 'ProductController@index']);
            //ajax request
            Route::get('type/{type}', ['as' => 'product.get_product_with_type', 'uses' => 'ProductController@LoadAjaxFilterType']);  //ajax request
            Route::get('filter/{productNumber?}/{name?}/{price?}/{pages?}', ['as' => 'product.filter', 'uses' => 'ProductController@filter']);  //ajax request
			Route::get('get_account_json', ['as' => 'product.get_account_json', 'uses' => 'ProductController@getAccountsJson']);

            //Route::get('get_contact_json', ['as' => 'sales_invoice.get_contact_json', 'uses' => 'SalesInvoiceController@getContactsJson']);  //ajax request
            //Route::get('get_product_json', ['as' => 'sales_invoice.get_product_json', 'uses' => 'SalesInvoiceController@getproductsJson']);  //ajax request

            //*************************************************************************************************************************************************************************************************

            Route::get('create', ['as' => 'product.create', 'uses' => 'ProductController@create']);
            Route::post('create', ['as' => 'product.store', 'uses' => 'ProductController@store']);
            Route::get('{id}/edit', ['as' => 'product.edit', 'uses' => 'ProductController@edit']);
            Route::patch('{id}', ['as' => 'product.update', 'uses' => 'ProductController@update']);
            Route::delete('{id}', ['as' => 'product.destroy', 'uses' => 'ProductController@destroy']);
        });

        Route::group(['prefix' => 'expense'], function () {
            Route::get('/', ['as' => 'expense.main', 'uses' => 'ExpenseController@main']);
            Route::get('list', ['as' => 'expense.index', 'uses' => 'ExpenseController@index']);
            //ajax request
            Route::get('type/{type}', ['as' => 'expense.get_expense_with_type', 'uses' => 'ExpenseController@LoadAjaxFilterType']);  //ajax request
            Route::get('filter/{expenseNumber?}/{name?}/{pages?}', ['as' => 'expense.filter', 'uses' => 'ExpenseController@filter']);  //ajax request

             //*************************************************************************************************************************************************************************************************

            Route::get('create', ['as' => 'expense.create', 'uses' => 'ExpenseController@create']);
            Route::post('create', ['as' => 'expense.store', 'uses' => 'ExpenseController@store']);
            Route::get('{id}/edit', ['as' => 'expense.edit', 'uses' => 'ExpenseController@edit']);
            Route::patch('{id}', ['as' => 'expense.update', 'uses' => 'ExpenseController@update']);
            Route::delete('{id}', ['as' => 'expense.destroy', 'uses' => 'ExpenseController@destroy']);
        });

        // start inovie area route
        Route::group(['prefix' => 'salesInvoice'], function () {
            Route::get('/', ['as' => 'sales_invoice.main', 'uses' => 'SalesInvoiceController@main']);
            Route::get('list', ['as' => 'sales_invoice.index', 'uses' => 'SalesInvoiceController@index']);
            Route::post('exportPdf',['as'=>'sales_invoice.exportPdf','uses'=>'ExportFilesController@export_pdf']);
            Route::get('exportExcel',['as'=>'sales_invoice.exportExcel','uses'=>'ExportFilesController@export_excel']);
            Route::get('exportCsv',['as'=>'sales_invoice.exportCsv','uses'=>'ExportFilesController@export_csv']);
            Route::get('exportHtml',['as'=>'sales_invoice.exportHtml','uses'=>'ExportFilesController@export_html']);



               // Route::get('send_email', ['as' => 'sales_inevoice.send_email', 'uses' => 'SalesInvoiceController@sendEmailmail']);
               Route::get('mail/sendMail/{$id}',['as' => 'sales_invoice.sendMail', 'uses' => 'MailController@basic_email'] );

            //ajax request
          //  Route::get('get_contact_phones','SalesInvoiceController@getContactPhones');
            Route::get('get_contact_phones', ['as' => 'sales_invoice.get_contact_phones', 'uses' => 'SalesInvoiceController@getContactPhones']);  //ajax request

            Route::get('get_contact_email', ['as' => 'sales_invoice.get_contact_email', 'uses' => 'SalesInvoiceController@getContactEmail']);

            Route::get('get_contact_data', ['as' => 'sales_invoice.get_contact_data', 'uses' => 'SalesInvoiceController@getContactData']);  //ajax request
            Route::get('get_contact_address/{id}', ['as' => 'sales_invoice.get_contact_address', 'uses' => 'SalesInvoiceController@getContactAddress']);  //ajax request
            Route::get('get_one_contact_address/{id}', ['as' => 'sales_invoice.get_one_contact_address', 'uses' => 'SalesInvoiceController@getOneContactAddress']);  //ajax request
            Route::get('get_contact_address_by_id/{id}', ['as' => 'sales_invoice.get_contact_address_by_id', 'uses' => 'SalesInvoiceController@getContactAddressByID']);  //ajax request
            Route::get('get_product_data', ['as' => 'sales_invoice.get_product_data', 'uses' => 'SalesInvoiceController@getProductData']);  //ajax request
            Route::get('get__data', ['as' => 'sales_invoice.get_account_data', 'uses' => 'SalesInvoiceController@getAccountData']);  //ajax request
            Route::get('get_finance_json', ['as' => 'sales_invoice.get_finance_json', 'uses' => 'SalesInvoiceController@getFinancesJson']);  //ajax request
            Route::get('status/{status}', ['as' => 'sales_invoice.get_invoices_with_status', 'uses' => 'SalesInvoiceController@LoadAjaxFilterStatus']);  //ajax request
            Route::get('get_contact_json', ['as' => 'sales_invoice.get_contact_json', 'uses' => 'SalesInvoiceController@getContactsJson']);  //ajax request
            Route::get('get_product_json', ['as' => 'sales_invoice.get_product_json', 'uses' => 'SalesInvoiceController@getproductsJson']);  //ajax request
            Route::get('get_account_json', ['as' => 'sales_invoice.get_account_json', 'uses' => 'SalesInvoiceController@getAccountsJson']);  //ajax request
            Route::get('get_tax_fields_view', ['as' => 'sales_invoice.get_tax_fields_view', 'uses' => 'SalesInvoiceController@getTaxFieldsView']);  //ajax request
            Route::get('filter/{invoiceNumber?}/{customer?}/{invoice_date?}/{payment_day?}/{pages?}', ['as' => 'sales_invoice.filter', 'uses' => 'SalesInvoiceController@filter']);  //ajax request

            //*************************************************************************************************************************************************************************************************
        //    Route::get('show', ['as' => 'sales_invoice.show', 'uses' => 'SalesInvoiceController@show']);
            Route::match(['patch', 'post'],'invoice_validation', ['as' => 'sales_invoice.invoice_validation', 'uses' => 'SalesInvoiceController@invoice_validation']);
            Route::get('{id}/show', ['as' => 'sales_invoice.show', 'uses' => 'SalesInvoiceController@show']);
            Route::get('draft/to/invoice/{id?}', ['as' => 'sales_invoice.draft_invoice', 'uses' => 'SalesInvoiceController@draft_to_invoice']);
            Route::get('{id}/downloadPdf',['as'=>'sales_invoice.downloadPdf','uses'=>'SalesInvoiceController@download_pdf']);
            Route::get('{id}/downloadprices',['as'=>'sales_invoice.downloadprices','uses'=>'SalesInvoiceController@downloadprices']);
		      	Route::get('create', ['as' => 'sales_invoice.create', 'uses' => 'SalesInvoiceController@create']);
            Route::post('create', ['as' => 'sales_invoice.store', 'uses' => 'SalesInvoiceController@store']);
            Route::match(['patch', 'post'],'create_draft', ['as' => 'sales_invoice.store_draft', 'uses' => 'SalesInvoiceController@store_draft']);
            Route::post('create_customer', ['as' => 'sales_invoice.store_customer', 'uses' => 'SalesInvoiceController@store_customer']);
            Route::post('create_product', ['as' => 'sales_invoice.store_product', 'uses' => 'SalesInvoiceController@store_product']);
            Route::get('{id}/edit', ['as' => 'sales_invoice.edit', 'uses' => 'SalesInvoiceController@edit']);
            Route::patch('update/{id}', ['as' => 'sales_invoice.update', 'uses' => 'SalesInvoiceController@update']);
            Route::delete('{id}', ['as' => 'sales_invoice.destroy', 'uses' => 'SalesInvoiceController@destroy']);
		    	  Route::post('create_installment'   , ['as' => 'sales_invoice.store_installement'  , 'uses' => 'SalesInvoiceController@store_installement'  ]);
			      Route::post('delete_installment'   , ['as' => 'sales_invoice.sales_invoices_deleteInstallment'  , 'uses' => 'SalesInvoiceController@delete_installement'  ]);
		      	Route::post('sendEmail'   , ['as' => 'sales_invoice.sendEmail'  , 'uses' => 'SalesInvoiceController@sendEmail'  ]);
	});



        // start inovie area route
        Route::group(['prefix' => 'purchase_invoice'], function () {
            Route::get('/', ['as' => 'purchase_invoice.main', 'uses' => 'PurchaseInvoiceController@main']);
            Route::get('list', ['as' => 'purchase_invoice.index', 'uses' => 'PurchaseInvoiceController@index']);

            //ajax request
            Route::get('get_contact_data', ['as' => 'purchase_invoice.get_contact_data', 'uses' => 'PurchaseInvoiceController@getContactData']);  //ajax request
            Route::get('get_contact_address/{id}', ['as' => 'purchase_invoice.get_contact_address', 'uses' => 'PurchaseInvoiceController@getContactAddress']);  //ajax request
            Route::get('get_one_contact_address/{id}', ['as' => 'purchase_invoice.get_one_contact_address', 'uses' => 'PurchaseInvoiceController@getOneContactAddress']);  //ajax request
            Route::get('get_contact_address_by_id/{id}', ['as' => 'purchase_invoice.get_contact_address_by_id', 'uses' => 'PurchaseInvoiceController@getContactAddressByID']);  //ajax request
            Route::get('get_product_data', ['as' => 'purchase_invoice.get_product_data', 'uses' => 'PurchaseInvoiceController@getProductData']);  //ajax request
            Route::get('get_account_data', ['as' => 'purchase_invoice.get_account_data', 'uses' => 'PurchaseInvoiceController@getAccountData']);  //ajax request
            Route::get('status/{status}', ['as' => 'purchase_invoice.get_invoices_with_status', 'uses' => 'PurchaseInvoiceController@LoadAjaxFilterStatus']);  //ajax request
            Route::get('get_contact_json', ['as' => 'purchase_invoice.get_contact_json', 'uses' => 'PurchaseInvoiceController@getContactsJson']);  //ajax request
            Route::get('get_product_json', ['as' => 'purchase_invoice.get_product_json', 'uses' => 'PurchaseInvoiceController@getproductsJson']);  //ajax request
            Route::get('get_account_json', ['as' => 'purchase_invoice.get_account_json', 'uses' => 'PurchaseInvoiceController@getAccountsJson']);  //ajax request
            Route::get('get_tax_fields_view', ['as' => 'purchase_invoice.get_tax_fields_view', 'uses' => 'PurchaseInvoiceController@getTaxFieldsView']);  //ajax request
            Route::get('filter/{invoiceNumber?}/{customer?}/{invoice_date?}/{payment_day?}/{pages?}', ['as' => 'purchase_invoice.filter', 'uses' => 'PurchaseInvoiceController@filter']);  //ajax request

            //*************************************************************************************************************************************************************************************************
            Route::get('create', ['as' => 'purchase_invoice.create', 'uses' => 'PurchaseInvoiceController@create']);
            Route::post('create', ['as' => 'purchase_invoice.store', 'uses' => 'PurchaseInvoiceController@store']);
            Route::get('{id}/edit', ['as' => 'purchase_invoice.edit', 'uses' => 'PurchaseInvoiceController@edit']);
            Route::patch('{id}', ['as' => 'purchase_invoice.update', 'uses' => 'PurchaseInvoiceController@update']);
            Route::delete('{id}', ['as' => 'purchase_invoice.destroy', 'uses' => 'PurchaseInvoiceController@destroy']);
        });


		// start Abstract area route
        Route::group(['prefix' => 'abstract'], function () {

            Route::get('/', ['as' => 'abstract.main', 'uses' => 'AbstractController@main']);
            Route::get('list', ['as' => 'abstract.index', 'uses' => 'AbstractController@index']);

            //ajax request
            Route::get('get_contact_phones','AbstractController@getContactPhones');
            Route::get('get_contact_phones', ['as' => 'abstract.get_contact_phones', 'uses' => 'AbstractController@getContactPhones']);  //ajax request

            Route::get('get_contact_data', ['as' => 'abstract.get_contact_data', 'uses' => 'AbstractController@getContactData']);  //ajax request
            Route::get('get_contact_address/{id}', ['as' => 'abstract.get_contact_address', 'uses' => 'AbstractController@getContactAddress']);  //ajax request
            Route::get('get_one_contact_address/{id}', ['as' => 'abstract.get_one_contact_address', 'uses' => 'AbstractController@getOneContactAddress']);  //ajax request
            Route::get('get_contact_address_by_id/{id}', ['as' => 'abstract.get_contact_address_by_id', 'uses' => 'AbstractController@getContactAddressByID']);  //ajax request
            Route::get('get_product_data', ['as' => 'abstract.get_product_data', 'uses' => 'AbstractController@getProductData']);  //ajax request
            Route::get('get__data', ['as' => 'abstract.get_account_data', 'uses' => 'AbstractController@getAccountData']);  //ajax request
            Route::get('status/{status}', ['as' => 'abstract.get_invoices_with_status', 'uses' => 'AbstractController@LoadAjaxFilterStatus']);  //ajax request
            Route::get('get_contact_json', ['as' => 'abstract.get_contact_json', 'uses' => 'AbstractController@getContactsJson']);  //ajax request
            Route::get('get_product_json', ['as' => 'abstract.get_product_json', 'uses' => 'AbstractController@getproductsJson']);  //ajax request
            Route::get('get_account_json', ['as' => 'abstract.get_account_json', 'uses' => 'AbstractController@getAccountsJson']);  //ajax request
            Route::get('get_tax_fields_view', ['as' => 'abstract.get_tax_fields_view', 'uses' => 'AbstractController@getTaxFieldsView']);  //ajax request
            Route::get('filter/{invoiceNumber?}/{customer?}/{invoice_date?}/{payment_day?}/{pages?}', ['as' => 'abstract.filter', 'uses' => 'AbstractController@filter']);  //ajax request

            //*************************************************************************************************************************************************************************************************
            Route::match(['patch', 'post'],'invoice_validation', ['as' => 'abstract.invoice_validation', 'uses' => 'AbstractController@invoice_validation']);
            Route::get('{id}/show', ['as' => 'abstract.show', 'uses' => 'AbstractController@show']);
            Route::get('create', ['as' => 'abstract.create', 'uses' => 'AbstractController@create']);
            Route::post('create', ['as' => 'abstract.store', 'uses' => 'AbstractController@store']);
            Route::match(['patch', 'post'],'create_draft', ['as' => 'abstract.store_draft', 'uses' => 'AbstractController@store_draft']);
            Route::post('create_customer', ['as' => 'abstract.store_customer', 'uses' => 'AbstractController@store_customer']);
            Route::post('create_product', ['as' => 'abstract.store_product', 'uses' => 'AbstractController@store_product']);
            Route::get('{id}/edit', ['as' => 'abstract.edit', 'uses' => 'AbstractController@edit']);
            Route::post('update/{id}', ['as' => 'abstract.update', 'uses' => 'AbstractController@update']);
            Route::delete('{id}', ['as' => 'abstract.destroy', 'uses' => 'AbstractController@destroy']);
			Route::post('create_installment'   , ['as' => 'abstract.store_installement'  , 'uses' => 'AbstractController@store_installement'  ]);
        });

        // start Other_income area route
        Route::group(['prefix' => 'other_income'], function () {

            Route::get('list', ['as' => 'other_income.index', 'uses' => 'OtherIncomeController@index']);


            //ajax request
            Route::get('get_contact_phones','OtherIncomeController@getContactPhones');
            Route::get('get_contact_phones', ['as' => 'other_income.get_contact_phones', 'uses' => 'OtherIncomeController@getContactPhones']);  //ajax request

            Route::get('get_contact_data', ['as' => 'other_income.get_contact_data', 'uses' => 'OtherIncomeController@getContactData']);  //ajax request
            Route::get('get_contact_address/{id}', ['as' => 'other_income.get_contact_address', 'uses' => 'OtherIncomeController@getContactAddress']);  //ajax request
            Route::get('get_one_contact_address/{id}', ['as' => 'other_income.get_one_contact_address', 'uses' => 'OtherIncomeController@getOneContactAddress']);  //ajax request
            Route::get('get_contact_address_by_id/{id}', ['as' => 'other_income.get_contact_address_by_id', 'uses' => 'OtherIncomeController@getContactAddressByID']);  //ajax request
            Route::get('get_product_data', ['as' => 'other_income.get_product_data', 'uses' => 'OtherIncomeController@getProductData']);  //ajax request
            Route::get('get__data', ['as' => 'other_income.get_account_data', 'uses' => 'OtherIncomeController@getAccountData']);  //ajax request
            Route::get('status/{status}', ['as' => 'other_income.get_invoices_with_status', 'uses' => 'OtherIncomeController@LoadAjaxFilterStatus']);  //ajax request
            Route::get('get_contact_json', ['as' => 'other_income.get_contact_json', 'uses' => 'OtherIncomeController@getContactsJson']);  //ajax request
            Route::get('get_product_json', ['as' => 'other_income.get_product_json', 'uses' => 'OtherIncomeController@getproductsJson']);  //ajax request
            Route::get('get_account_json', ['as' => 'other_income.get_account_json', 'uses' => 'OtherIncomeController@getAccountsJson']);  //ajax request
            Route::get('get_tax_fields_view', ['as' => 'other_income.get_tax_fields_view', 'uses' => 'OtherIncomeController@getTaxFieldsView']);  //ajax request
            Route::get('filter/{invoiceNumber?}/{customer?}/{invoice_date?}/{payment_day?}/{pages?}', ['as' => 'other_income.filter', 'uses' => 'OtherIncomeController@filter']);  //ajax request

            //*************************************************************************************************************************************************************************************************
            Route::match(['patch', 'post'],'invoice_validation', ['as' => 'other_income.invoice_validation', 'uses' => 'OtherIncomeController@invoice_validation']);
            Route::get('{id}/show', ['as' => 'other_income.show', 'uses' => 'OtherIncomeController@show']);
            Route::get('create', ['as' => 'other_income.create', 'uses' => 'OtherIncomeController@create']);
            Route::post('create', ['as' => 'other_income.store', 'uses' => 'OtherIncomeController@store']);
            Route::match(['patch', 'post'],'create_draft', ['as' => 'other_income.store_draft', 'uses' => 'OtherIncomeController@store_draft']);
            Route::post('create_customer', ['as' => 'other_income.store_customer', 'uses' => 'OtherIncomeController@store_customer']);
            Route::post('create_product', ['as' => 'other_income.store_product', 'uses' => 'OtherIncomeController@store_product']);
            Route::get('{id}/edit', ['as' => 'other_income.edit', 'uses' => 'OtherIncomeController@edit']);
            Route::patch('update/{id}', ['as' => 'other_income.update', 'uses' => 'OtherIncomeController@update']);
            Route::delete('{id}', ['as' => 'other_income.destroy', 'uses' => 'OtherIncomeController@destroy']);
			Route::post('create_installment'   , ['as' => 'other_income.store_installement'  , 'uses' => 'OtherIncomeController@store_installement'  ]);
        });

        // start Costs area route
        Route::group(['prefix' => 'cost'], function () {

            Route::get('/', ['as' => 'cost.main', 'uses' => 'CostController@main']);
            Route::get('list', ['as' => 'cost.index', 'uses' => 'CostController@index']);

            //ajax request
            Route::get('get_contact_phones','CostController@getContactPhones');
            Route::get('get_contact_phones', ['as' => 'cost.get_contact_phones', 'uses' => 'CostController@getContactPhones']);  //ajax request
              //Export filesize
            Route::get('exportPdf',['as'=>'cost.exportPdf','uses'=>'ExportFilesController@cost_export_pdf']);
            Route::get('exportExcel',['as'=>'cost.exportExcel','uses'=>'ExportFilesController@cost_export_excel']);
            Route::get('exportCsv',['as'=>'cost.exportCsv','uses'=>'ExportFilesController@cost_export_csv']);
          //  Route::get('exportHtml',['as'=>'cost.exportHtml','uses'=>'ExportFilesController@export_html']);
                      //  Export files
            Route::get('get_contact_data', ['as' => 'cost.get_contact_data', 'uses' => 'CostController@getContactData']);  //ajax request
            Route::get('get_contact_address/{id}', ['as' => 'cost.get_contact_address', 'uses' => 'CostController@getContactAddress']);  //ajax request
            Route::get('get_one_contact_address/{id}', ['as' => 'cost.get_one_contact_address', 'uses' => 'CostController@getOneContactAddress']);  //ajax request
            Route::get('get_contact_address_by_id/{id}', ['as' => 'cost.get_contact_address_by_id', 'uses' => 'CostController@getContactAddressByID']);  //ajax request
            Route::get('get_product_data', ['as' => 'cost.get_product_data', 'uses' => 'CostController@getProductData']);  //ajax request
            Route::get('get__data', ['as' => 'cost.get_account_data', 'uses' => 'CostController@getAccountData']);  //ajax request
            Route::get('status/{status}', ['as' => 'cost.get_invoices_with_status', 'uses' => 'CostController@LoadAjaxFilterStatus']);  //ajax request
            Route::get('get_contact_json', ['as' => 'cost.get_contact_json', 'uses' => 'CostController@getContactsJson']);  //ajax request
            Route::get('get_product_json', ['as' => 'cost.get_product_json', 'uses' => 'CostController@getproductsJson']);  //ajax request
            Route::get('get_account_json', ['as' => 'cost.get_account_json', 'uses' => 'CostController@getAccountsJson']);  //ajax request
            Route::get('get_tax_fields_view', ['as' => 'cost.get_tax_fields_view', 'uses' => 'CostController@getTaxFieldsView']);  //ajax request
            Route::get('filter/{invoiceNumber?}/{customer?}/{invoice_date?}/{payment_day?}/{pages?}', ['as' => 'cost.filter', 'uses' => 'CostController@filter']);  //ajax request

            //*************************************************************************************************************************************************************************************************
            Route::match(['patch', 'post'],'invoice_validation', ['as' => 'cost.invoice_validation', 'uses' => 'CostController@invoice_validation']);
            Route::get('{id}/show', ['as' => 'cost.show', 'uses' => 'CostController@show']);
            Route::get('create', ['as' => 'cost.create', 'uses' => 'CostController@create']);
            Route::post('create', ['as' => 'cost.store', 'uses' => 'CostController@store']);
            Route::match(['patch', 'post'],'create_draft', ['as' => 'cost.store_draft', 'uses' => 'CostController@store_draft']);
            Route::post('create_customer', ['as' => 'cost.store_customer', 'uses' => 'CostController@store_customer']);
            Route::post('create_product', ['as' => 'cost.store_product', 'uses' => 'CostController@store_product']);
            Route::get('{id}/edit', ['as' => 'cost.edit', 'uses' => 'CostController@edit']);
            Route::patch('update/{id}', ['as' => 'cost.update', 'uses' => 'CostController@update']);
            Route::delete('{id}', ['as' => 'cost.destroy', 'uses' => 'CostController@destroy']);
			Route::post('create_installment'   , ['as' => 'cost.store_installement'  , 'uses' => 'CostController@store_installement'  ]);

        });

        // start Sales invoice return area route
        Route::group(['prefix' => 'sales_invoice_return'], function () {
            Route::get('/', ['as' => 'sales_invoice_return.main', 'uses' => 'SalesInvoiceReturnController@main']);
            Route::get('list', ['as' => 'sales_invoice_return.index', 'uses' => 'SalesInvoiceReturnController@index']);

            //ajax request
            Route::get('get_contact_data', ['as' => 'sales_invoice_return.get_contact_data', 'uses' => 'SalesInvoiceReturnController@getContactData']);  //ajax request
            Route::get('get_contact_address/{id}', ['as' => 'sales_invoice_return.get_contact_address', 'uses' => 'SalesInvoiceReturnController@getContactAddress']);  //ajax request
            Route::get('get_one_contact_address/{id}', ['as' => 'sales_invoice_return.get_one_contact_address', 'uses' => 'SalesInvoiceReturnController@getOneContactAddress']);  //ajax request
            Route::get('get_contact_address_by_id/{id}', ['as' => 'sales_invoice_return.get_contact_address_by_id', 'uses' => 'SalesInvoiceReturnController@getContactAddressByID']);  //ajax request
            Route::get('get_product_data', ['as' => 'sales_invoice_return.get_product_data', 'uses' => 'SalesInvoiceReturnController@getProductData']);  //ajax request
            Route::get('get_account_data', ['as' => 'sales_invoice_return.get_account_data', 'uses' => 'SalesInvoiceReturnController@getAccountData']);  //ajax request
            Route::get('status/{status}', ['as' => 'sales_invoice_return.get_invoices_with_status', 'uses' => 'SalesInvoiceReturnController@LoadAjaxFilterStatus']);  //ajax request
            Route::get('get_contact_json', ['as' => 'sales_invoice_return.get_contact_json', 'uses' => 'SalesInvoiceReturnController@getContactsJson']);  //ajax request
            Route::get('get_product_json', ['as' => 'sales_invoice_return.get_product_json', 'uses' => 'SalesInvoiceReturnController@getproductsJson']);  //ajax request
            Route::get('get_account_json', ['as' => 'sales_invoice_return.get_account_json', 'uses' => 'SalesInvoiceReturnController@getAccountsJson']);  //ajax request
            Route::get('get_tax_fields_view', ['as' => 'sales_invoice_return.get_tax_fields_view', 'uses' => 'SalesInvoiceReturnController@getTaxFieldsView']);  //ajax request
            Route::get('filter/{invoiceNumber?}/{customer?}/{invoice_date?}/{payment_day?}/{pages?}', ['as' => 'sales_invoice_return.filter', 'uses' => 'SalesInvoiceReturnController@filter']);  //ajax request

            //*************************************************************************************************************************************************************************************************
            Route::match(['patch', 'post'],'invoice_validation', ['as' => 'sales_invoice_return.invoice_validation', 'uses' => 'SalesInvoiceReturnController@invoice_validation']);
            Route::get('{id}/show', ['as' => 'sales_invoice_return.show', 'uses' => 'SalesInvoiceReturnController@show']);
            Route::get('create', ['as' => 'sales_invoice_return.create', 'uses' => 'SalesInvoiceReturnController@create']);
            Route::post('create', ['as' => 'sales_invoice_return.store', 'uses' => 'SalesInvoiceReturnController@store']);
            Route::match(['patch', 'post'],'create_draft', ['as' => 'sales_invoice_return.store_draft', 'uses' => 'SalesInvoiceReturnController@store_draft']);
            Route::post('create_customer', ['as' => 'sales_invoice_return.store_customer', 'uses' => 'SalesInvoiceReturnController@store_customer']);
            Route::post('create_product', ['as' => 'sales_invoice_return.store_product', 'uses' => 'SalesInvoiceReturnController@store_product']);
            Route::get('{id}/edit', ['as' => 'sales_invoice_return.edit', 'uses' => 'SalesInvoiceReturnController@edit']);
            Route::patch('update/{id}', ['as' => 'sales_invoice_return.update', 'uses' => 'SalesInvoiceReturnController@update']);
            Route::delete('{id}', ['as' => 'sales_invoice_return.destroy', 'uses' => 'SalesInvoiceReturnController@destroy']);
			Route::post('create_installment'   , ['as' => 'sales_invoice_return.store_installement'  , 'uses' => 'SalesInvoiceReturnController@store_installement'  ]);
        });

        // start Cost Other area route
        Route::group(['prefix' => 'cost_other'], function () {
            Route::get('/', ['as' => 'cost_other.main', 'uses' => 'CostOtherController@main']);
            Route::get('list', ['as' => 'cost_other.index', 'uses' => 'CostOtherController@index']);

            //ajax request
            Route::get('get_contact_data', ['as' => 'cost_other.get_contact_data', 'uses' => 'CostOtherController@getContactData']);  //ajax request
            Route::get('get_contact_address/{id}', ['as' => 'cost_other.get_contact_address', 'uses' => 'CostOtherController@getContactAddress']);  //ajax request
            Route::get('get_one_contact_address/{id}', ['as' => 'cost_other.get_one_contact_address', 'uses' => 'CostOtherController@getOneContactAddress']);  //ajax request
            Route::get('get_contact_address_by_id/{id}', ['as' => 'cost_other.get_contact_address_by_id', 'uses' => 'CostOtherController@getContactAddressByID']);  //ajax request
            Route::get('get_product_data', ['as' => 'cost_other.get_product_data', 'uses' => 'CostOtherController@getProductData']);  //ajax request
            Route::get('get_account_data', ['as' => 'cost_other.get_account_data', 'uses' => 'CostOtherController@getAccountData']);  //ajax request
            Route::get('status/{status}', ['as' => 'cost_other.get_invoices_with_status', 'uses' => 'CostOtherController@LoadAjaxFilterStatus']);  //ajax request
            Route::get('get_contact_json', ['as' => 'cost_other.get_contact_json', 'uses' => 'CostOtherController@getContactsJson']);  //ajax request
            Route::get('get_product_json', ['as' => 'cost_other.get_product_json', 'uses' => 'CostOtherController@getproductsJson']);  //ajax request
            Route::get('get_account_json', ['as' => 'cost_other.get_account_json', 'uses' => 'CostOtherController@getAccountsJson']);  //ajax request
            Route::get('get_tax_fields_view', ['as' => 'cost_other.get_tax_fields_view', 'uses' => 'CostOtherController@getTaxFieldsView']);  //ajax request
            Route::get('filter/{invoiceNumber?}/{customer?}/{invoice_date?}/{payment_day?}/{pages?}', ['as' => 'cost_other.filter', 'uses' => 'CostOtherController@filter']);  //ajax request

            //*************************************************************************************************************************************************************************************************
            Route::match(['patch', 'post'],'invoice_validation', ['as' => 'cost_other.invoice_validation', 'uses' => 'CostOtherController@invoice_validation']);
            Route::get('{id}/show', ['as' => 'cost_other.show', 'uses' => 'CostOtherController@show']);
            Route::get('create', ['as' => 'cost_other.create', 'uses' => 'CostOtherController@create']);
            Route::post('create', ['as' => 'cost_other.store', 'uses' => 'CostOtherController@store']);
            Route::match(['patch', 'post'],'create_draft', ['as' => 'cost_other.store_draft', 'uses' => 'CostOtherController@store_draft']);
            Route::post('create_customer', ['as' => 'cost_other.store_customer', 'uses' => 'CostOtherController@store_customer']);
            Route::post('create_product', ['as' => 'cost_other.store_product', 'uses' => 'CostOtherController@store_product']);
            Route::get('{id}/edit', ['as' => 'cost_other.edit', 'uses' => 'CostOtherController@edit']);
            Route::patch('update/{id}', ['as' => 'cost_other.update', 'uses' => 'CostOtherController@update']);
            Route::delete('{id}', ['as' => 'cost_other.destroy', 'uses' => 'CostOtherController@destroy']);
			Route::post('create_installment'   , ['as' => 'cost_other.store_installement'  , 'uses' => 'CostOtherController@store_installement'  ]);

        });

        // start Salary area route
        Route::group(['prefix' => 'salary'], function () {

            Route::get('/', ['as' => 'salary.main', 'uses' => 'SalaryController@main']);
            Route::get('list', ['as' => 'salary.index', 'uses' => 'SalaryController@index']);

            //ajax request
            Route::get('get_contact_phones','SalaryController@getContactPhones');
            Route::get('get_contact_phones', ['as' => 'salary.get_contact_phones', 'uses' => 'SalaryController@getContactPhones']);  //ajax request

            Route::get('get_contact_data', ['as' => 'salary.get_contact_data', 'uses' => 'SalaryController@getContactData']);  //ajax request
            Route::get('get_contact_address/{id}', ['as' => 'salary.get_contact_address', 'uses' => 'SalaryController@getContactAddress']);  //ajax request
            Route::get('get_one_contact_address/{id}', ['as' => 'salary.get_one_contact_address', 'uses' => 'SalaryController@getOneContactAddress']);  //ajax request
            Route::get('get_contact_address_by_id/{id}', ['as' => 'salary.get_contact_address_by_id', 'uses' => 'SalaryController@getContactAddressByID']);  //ajax request
            Route::get('get_product_data', ['as' => 'salary.get_product_data', 'uses' => 'SalaryController@getProductData']);  //ajax request
            Route::get('get__data', ['as' => 'salary.get_account_data', 'uses' => 'SalaryController@getAccountData']);  //ajax request
            Route::get('status/{status}', ['as' => 'salary.get_invoices_with_status', 'uses' => 'SalaryController@LoadAjaxFilterStatus']);  //ajax request
            Route::get('get_contact_json', ['as' => 'salary.get_contact_json', 'uses' => 'SalaryController@getContactsJson']);  //ajax request
            Route::get('get_product_json', ['as' => 'salary.get_product_json', 'uses' => 'SalaryController@getproductsJson']);  //ajax request
            Route::get('get_account_json', ['as' => 'salary.get_account_json', 'uses' => 'SalaryController@getAccountsJson']);  //ajax request
            Route::get('get_tax_fields_view', ['as' => 'salary.get_tax_fields_view', 'uses' => 'SalaryController@getTaxFieldsView']);  //ajax request
            Route::get('filter/{invoiceNumber?}/{customer?}/{invoice_date?}/{payment_day?}/{pages?}', ['as' => 'salary.filter', 'uses' => 'SalaryController@filter']);  //ajax request

            //*************************************************************************************************************************************************************************************************
            Route::match(['patch', 'post'],'invoice_validation', ['as' => 'salary.invoice_validation', 'uses' => 'SalaryController@invoice_validation']);
            Route::get('{id}/show', ['as' => 'salary.show', 'uses' => 'SalaryController@show']);
            Route::get('create', ['as' => 'salary.create', 'uses' => 'SalaryController@create']);
            Route::post('create', ['as' => 'salary.store', 'uses' => 'SalaryController@store']);
            Route::match(['patch', 'post'],'create_draft', ['as' => 'salary.store_draft', 'uses' => 'SalaryController@store_draft']);
            Route::post('create_customer', ['as' => 'salary.store_customer', 'uses' => 'SalaryController@store_customer']);
            Route::post('create_product', ['as' => 'salary.store_product', 'uses' => 'SalaryController@store_product']);
            Route::get('{id}/edit', ['as' => 'salary.edit', 'uses' => 'SalaryController@edit']);
            Route::patch('update/{id}', ['as' => 'salary.update', 'uses' => 'SalaryController@update']);
            Route::delete('{id}', ['as' => 'salary.destroy', 'uses' => 'SalaryController@destroy']);
			Route::post('create_installment'   , ['as' => 'salary.store_installement'  , 'uses' => 'SalaryController@store_installement'  ]);

        });


        // start bank area route
        Route::group(['prefix' => 'bank'], function () {

            Route::get('list', ['as' => 'bank.index', 'uses' => 'BankController@index']);

            //ajax request

            Route::get('create', ['as' => 'bank.create', 'uses' => 'BankController@create']);
            Route::post('create', ['as' => 'bank.store', 'uses' => 'BankController@store']);
            Route::get('{id}/edit', ['as' => 'bank.edit', 'uses' => 'BankController@edit']);
            Route::patch('{id}', ['as' => 'bank.update', 'uses' => 'BankController@update']);
            Route::delete('{id}', ['as' => 'bank.destroy', 'uses' => 'BankController@destroy']);
        });

        // start Finance area route
        Route::group(['prefix' => 'finance'], function () {
            Route::get('/', ['as' => 'finance.main', 'uses' => 'FinanceController@index']);
            Route::get('cash/list', ['as' => 'cash.index', 'uses' => 'CashController@index']);
			      Route::get  ('{id}/{type}/show'   , ['as' => 'finance.show'  , 'uses' => 'FinanceController@show'  ]);
            Route::get   ('create'   , ['as' => 'finance.create' , 'uses' => 'FinanceController@create' ]);
            Route::post  ('create'   , ['as' => 'finance.store'  , 'uses' => 'FinanceController@store'  ]);
            Route::get   ('{id}/{type}/edit', ['as' => 'finance.edit'   , 'uses' => 'FinanceController@edit'   ]);
            Route::patch ('update/{id}' , ['as' => 'finance.update' , 'uses' => 'FinanceController@update' ]);
            Route::delete('{id}'     , ['as' => 'finance.destroy', 'uses' => 'FinanceController@destroy']);

		      	Route::get('filter/{type?}/{filterName?}/{financeNumber?}/{pages?}', ['as' => 'finance.filter', 'uses' => 'FinanceController@filter']); //ajax request
            Route::get('filterAll/{start_date?}/{end_date?}/{pages?}', ['as' => 'finance.filterAll', 'uses' => 'FinanceController@filterAll']);
            Route::post  ('addAmount'   , ['as' => 'finance.addAmount'  , 'uses' => 'FinanceController@addAmount'  ]);
            Route::post  ('transform'   , ['as' => 'finance.transform'  , 'uses' => 'FinanceController@transform'  ]);
            Route::post  ('close'   , ['as' => 'finance.close'  , 'uses' => 'FinanceController@close'  ]);
			      Route::post  ('removeAmount'   , ['as' => 'finance.removeAmount'  , 'uses' => 'FinanceController@removeAmount'  ]);
		       	Route::post  ('removeTrans'   , ['as' => 'finance.removeTrans'  , 'uses' => 'FinanceController@removeTrans'  ]);
           //Export filesize
           Route::get('exportPdf',['as'=>'finance.exportPdf','uses'=>'ExportFilesController@finance_export_pdf']);
           Route::get('exportExcel',['as'=>'finance.exportExcel','uses'=>'ExportFilesController@finance_export_excel']);
           Route::get('exportCsv',['as'=>'finance.exportCsv','uses'=>'ExportFilesController@finance_export_csv']);
           //ajax request
            Route::get('status/{status}', ['as' => 'finance.get_finance_with_status', 'uses' => 'FinanceController@LoadAjaxFilterStatus']);  //ajax request

            Route::get('cash/create', ['as' => 'cash.create', 'uses' => 'CashController@create']);
            Route::post('cash/create', ['as' => 'cash.store', 'uses' => 'CashController@store']);
            Route::get('cash/{id}/edit', ['as' => 'cash.edit', 'uses' => 'CashController@edit']);
            Route::patch('cash/{id}', ['as' => 'cash.update', 'uses' => 'CashController@update']);
            Route::delete('cash/{id}', ['as' => 'cash.destroy', 'uses' => 'CashController@destroy']);
        });

        // start reports area route
        Route::group(['prefix' => 'report'], function () {

            Route::get('main', ['as' => 'report.main', 'uses' => 'ReportController@main']);
			Route::get('clients', ['as' => 'report.invoice', 'uses' => 'ReportController@invoice']);
            Route::get('suppliers', ['as' => 'report.invoice2', 'uses' => 'ReportController@invoice2']);
			Route::get('finance_log', ['as' => 'log.index', 'uses' => 'LogController@index']);
            Route::get('invoices_log', ['as' => 'log.income', 'uses' => 'LogController@income']);
            Route::get('contacts_log', ['as' => 'log.contact', 'uses' => 'LogController@contact']);
            Route::get('taxes_log', ['as' => 'log.tax', 'uses' => 'LogController@tax']);
			Route::get('acc_overview', ['as' => 'report.acc_overview', 'uses' => 'ReportController@acc_overview']);
            Route::get('getAccounts', ['as' => 'report.getAccounts', 'uses' => 'ReportController@getAccounts']);
            //ajax request
			Route::get('filter/{code?}/{from?}/{to?}', ['as' => 'report.filter', 'uses' => 'ReportController@filter']);  //ajax request
            Route::post('downloadPDF', ['as' => 'report.pdf', 'uses' => 'ReportController@export_pdf']);
            Route::get('downloadEXCEL', ['as' => 'report.excel', 'uses' => 'ReportController@export_excel']);
            Route::get('downloadCSV', ['as' => 'report.csv', 'uses' => 'ReportController@export_csv']);
            //ajax request
			Route::get('prof_loss', ['as' => 'report.prof_loss', 'uses' => 'ReportController@prof_loss']);
        });
        // start reports area route
        Route::group(['prefix' => 'operating_analysis'], function () {
            Route::get('main', ['as' => 'operating_analysis.main', 'uses' => 'operating_analysisController@main']);
        });

        // start reports area route
        Route::group(['prefix' => 'General_administrative'], function () {
            Route::get('main', ['as' => 'General_administrative.main', 'uses' => 'General_administrativeController@main']);
        });





           // start mycompany area route
        Route::group(['prefix' => 'mycompany'], function () {

            Route::get('list', ['as' => 'mycompany.index', 'uses' => 'MyCompanyController@index']);


            //ajax request

            Route::get('mycompany/create', ['as' => 'mycompany.create', 'uses' => 'MyCompanyController@create']);
            Route::post('mycompany/create', ['as' => 'mycompany.store', 'uses' => 'MyCompanyController@store']);
            Route::get('mycompany/{id}/edit', ['as' => 'mycompany.edit', 'uses' => 'MyCompanyController@edit']);
            Route::patch('mycompany/{id}', ['as' => 'mycompany.update', 'uses' => 'MyCompanyController@update']);
            Route::patch('mycompany/tax/{id}', ['as' => 'mycompany.update_tax', 'uses' => 'MyCompanyController@updateTax']);
            Route::delete('mycompany/{id}', ['as' => 'mycompany.destroy', 'uses' => 'MyCompanyController@destroy']);

			Route::get('invoices', ['as' => 'mycompany.invoices', 'uses' => 'MyCompanyController@invoices']);

            //ajax request

        });

        // start reports area route
        Route::group(['prefix' => 'tax'], function () {

            Route::get('main', ['as' => 'tax.main', 'uses' => 'TaxController@main']);
            Route::get('create', ['as' => 'tax.create', 'uses' => 'TaxController@create']);
            Route::post('create', ['as' => 'tax.store', 'uses' => 'TaxController@store']);
            Route::get('{id}/edit', ['as' => 'tax.edit', 'uses' => 'TaxController@edit']);
            Route::patch('{id}', ['as' => 'tax.update', 'uses' => 'TaxController@update']);
            Route::delete('{id}', ['as' => 'tax.destroy', 'uses' => 'TaxController@destroy']);

            //ajax request

        });

        // start reports area route
        Route::group(['prefix' => 'setting'], function () {

            Route::get('main', ['as' => 'setting.main', 'uses' => 'SettingController@main']);

            //ajax request

        });

        // start bank_settings area route
        Route::group(['prefix' => 'bank_settings'], function () {

            Route::get('list', ['as' => 'bank_settings.index', 'uses' => 'BankSettingsController@index']);

            //ajax request

            Route::get('create', ['as' => 'bank_settings.create', 'uses' => 'BankSettingsController@create']);
            Route::post('create', ['as' => 'bank_settings.store', 'uses' => 'BankSettingsController@store']);
            Route::get('{id}/edit', ['as' => 'bank_settings.edit', 'uses' => 'BankSettingsController@edit']);
            Route::patch('{id}', ['as' => 'bank_settings.update', 'uses' => 'BankSettingsController@update']);
            Route::delete('{id}', ['as' => 'bank_settings.destroy', 'uses' => 'BankSettingsController@destroy']);
        });

        // start contact area route
        Route::group(['prefix' => 'contacts'], function () {
            Route::get('/', ['as' => 'contact.main', 'uses' => 'ContactController@main']);
            Route::get('list', ['as' => 'contact.index', 'uses' => 'ContactController@index']);
            //Export filesize
            Route::get('exportPdf',['as'=>'contact.exportPdf','uses'=>'ExportFilesController@contact_export_pdf']);
            Route::get('exportExcel',['as'=>'contact.exportExcel','uses'=>'ExportFilesController@contact_export_excel']);
            Route::get('exportCsv',['as'=>'contact.exportCsv','uses'=>'ExportFilesController@contact_export_csv']);
            ///
            Route::get('create', ['as' => 'contact.create', 'uses' => 'ContactController@create']);
            Route::post('create', ['as' => 'contact.store', 'uses' => 'ContactController@store']);
            Route::get('/{id}/edit', ['as' => 'contact.edit', 'uses' => 'ContactController@edit']);
            Route::patch('/{id}', ['as' => 'contact.update', 'uses' => 'ContactController@update']);
            Route::delete('/{id}', ['as' => 'contact.destroy', 'uses' => 'ContactController@destroy']);

            Route::get('/{id}/address', ['as' => 'contact.address.index', 'uses' => 'ContactController@addressIndex']);
            Route::get('/{id}/address/create', ['as' => 'contact.address.create', 'uses' => 'ContactController@addressCreate']);
            Route::post('/{id}/address/create', ['as' => 'contact.address.store', 'uses' => 'ContactController@addressStore']);
            Route::get('address/{contact_id}/edit/{id}', ['as' => 'contact.address.edit', 'uses' => 'ContactController@addressEdit']);
            Route::patch('address/{id}', ['as' => 'contact.address.update', 'uses' => 'ContactController@addressUpdate']);
            Route::delete('address/{id}', ['as' => 'contact.address.destroy', 'uses' => 'ContactController@addressDestroy']);
            Route::get('type/{type}', ['as' => 'contact.get_contact_with_type', 'uses' => 'ContactController@LoadAjaxFilterType']);  //ajax request
            Route::get('filter/{accountingNumber?}/{firstName?}/{companyName?}/{phoneNumber?}/{pages?}', ['as' => 'contacts.filter', 'uses' => 'ContactController@filter']);  //ajax request
        });

        Route::get('/images/{id}', function($id) {
//    header("Content-type: image/jpeg");
//    //"select image from table where id = $image"
//   echo $here_I_get_my_img_from_DB;
            $file = UserFile::find($id);
            $data = $file->file;
            return Response::make($data, 200, array('Content-type' => $file->mime, 'Content-length' => $file->size));
        });
    });
});


// frontend gate to login to cpanel dashboard
Route::group(['namespace' => 'Frontend'], function() {
    // Controllers Within The "App\Http\Controllers\Frontend\Auth" Namespace
    Route::group(['namespace' => 'Auth'], function() {
        // Controllers Within The "App\Http\Controllers\User" Namespace
        // Authentication routes...
        Route::get('login', ['as' => 'login', 'uses' => 'AuthWebController@getLogin']);
        Route::post('login', 'AuthWebController@postLogin');
        Route::get('logout', ['as' => 'logout', 'uses' => 'AuthWebController@getLogout']);
        //Route::get('logout' ,['as'=>'logout','uses'=>'AuthController@getLogout'] );
        // Registration routes...
        Route::get('register', ['as' => 'register.index', 'uses' => 'AuthWebController@getRegister']);
        Route::post('register', ['as' => 'register', 'uses' => 'AuthWebController@register']);

		Route::post('getPlans', ['as' => 'register.getPlans', 'uses' => 'AuthWebController@getPlans']);

        Route::get('user/activation/{token}', 'AuthWebController@activateUser')->name('user.activate');

		Route::get('auth/{provider}','AuthWebController@redirectToProvider');
        Route::get('auth/{provider}/callback',  'AuthWebController@handleProviderCallback');

        Route::get('authMic/microsoft','AuthWebController@redirectToProvider2');
        Route::get('oauth',  'AuthWebController@handleProviderCallback2');
    });
});
//=================================================================




/**
 * start routing backend
 */
// backend gate to login to cpanel dashboard
Route::group(['prefix' => Config::get('settings.backend_route'), 'namespace' => 'Backend'], function() {
    // Controllers Within The "App\Http\Controllers\Backend" Namespace
    Route::group(['namespace' => 'Auth'], function() {
        // Controllers Within The "App\Http\Controllers\Backend\User" Namespace
        // Authentication routes...
        Route::get('login', ['as' => 'admin::login', 'uses' => 'AuthController@getLogin']);
        Route::post('login', 'AuthController@postLogin');
        Route::get('logout', ['as' => 'admin::logout', 'uses' => 'AuthController@getLogout']);
    });
});

// protect backend
Route::group([ 'namespace' => 'Backend',
    'prefix' => Config::get('settings.backend_route'),
    'as' => 'admin::',
    'middleware' => [ 'backend.access']], function() {

    Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
	Route::get('dashboard/change', ['as' => 'dashboard.change', 'uses' => 'DashboardController@change']);

	// Invoices Route

    Route::get('invoices', ['as' => 'invoices.index' , 'uses' => 'InvoicesController@index']);
    Route::get('invoices/create', ['as' => 'invoices.create' , 'uses' => 'InvoicesController@create']);
    Route::post('invoices/store', ['as' => 'invoices.store' , 'uses' => 'InvoicesController@store']);
    Route::get('get_user_json', ['as' => 'get_user_json', 'uses' => 'InvoicesController@getUsersJson']);  //ajax request
    Route::get('get_one_user_address/{id}', ['as' => 'get_one_user_address', 'uses' => 'InvoicesController@getOneUserAddress']);  //ajax request
    Route::get('invoices/{id}/show', ['as' => 'invoices.show' , 'uses' => 'InvoicesController@show']);
    Route::post('invoices/{id}/destroy', ['as' => 'invoices.destroy' , 'uses' => 'InvoicesController@destroy']);
    Route::get('invoices/todate/{invoice_date}/{pakageid}', ['as' => 'invoices.get_to_date' , 'uses' => 'InvoicesController@getToDate']);
    Route::get('{id}/downloadPdf',['as'=>'invoice.downloadPdf','uses'=>'InvoicesController@download_pdf']);
  	Route::post('invoices/sendEmail'   , ['as' => 'invoice.sendEmail'  , 'uses' => 'InvoicesController@sendEmail'  ]);

    //feedback routes in backend
    Route::get('feedbacks',['as'=>'feedback.index','uses'=>'FeedbackController@index']);
    Route::post('feedbacks/edit',['as'=>'feedback.update','uses'=>'FeedbackController@update']);
    Route::get('feedbacks/delete/{id}',['as'=>'feedback.destroy','uses'=>'FeedbackController@destroy']);
    Route::get('feedbacks/appearance/{type}',['as'=>'feedback.appearancs','uses'=>'FeedbackController@appear_front']);



	// settings route
    Route::get('settings', ['as' => 'settings.index', 'uses' => 'SettingController@index', 'middleware' => ['permission:setting-list']]);
    Route::get('settings/{id}', ['as' => 'settings.show', 'uses' => 'SettingController@show']);
    Route::get('settings/{id}/edit', ['as' => 'settings.edit', 'uses' => 'SettingController@edit', 'middleware' => ['permission:setting-edit']]);
    Route::patch('settings/{id}', ['as' => 'settings.update', 'uses' => 'SettingController@update', 'middleware' => ['permission:setting-edit']]);

// languages route
    Route::get('languages/add',['as' => 'languages.add', 'uses' => 'LanguageController@create', 'middleware' => ['permission:language-create']]);
    Route::post('languages/add',['as' => 'languages.save', 'uses' => 'LanguageController@store', 'middleware' => ['permission:language-create']]);
    Route::delete('languages/delete/{id}',['as' => 'languages.delete', 'uses' => 'LanguageController@destory', 'middleware' => ['permission:language-delete']]);
    Route::get('languages', ['as' => 'languages.index', 'uses' => 'LanguageController@index', 'middleware' => ['permission:language-list']]);
    Route::get('languages/{id}', ['as' => 'languages.show', 'uses' => 'LanguageController@show', 'middleware' => ['permission:language-list']]);
    Route::get('languages/{id}/edit', ['as' => 'languages.edit', 'uses' => 'LanguageController@edit', 'middleware' => ['permission:language-edit']]);
    Route::patch('languages/{id}', ['as' => 'languages.update', 'uses' => 'LanguageController@update', 'middleware' => ['permission:language-edit']]);
    Route::get('languages/files/{id}',['as' => 'language.files', 'uses' => 'LanguageController@languageFiles', 'middleware' => ['permission:language-edit']]);
    Route::get('languages/files/frontend/{id}',['as' => 'language.files_frontend', 'uses' => 'LanguageController@filesFrontend', 'middleware' => ['permission:language-edit']]);
    Route::get('languages/files/backend/{id}',['as' => 'language.files_backend', 'uses' => 'LanguageController@filesBackend', 'middleware' => ['permission:language-edit']]);
    Route::post('languages/files/{language_id}/{folder_name}/{file_name}',['as'=>'language.save_file','uses'=>'LanguageController@saveFile','middleware' => ['permission:language-edit']]);
    Route::get('languages/files/frontend/{id}',['as' => 'language.files_front', 'uses' => 'LanguageController@languageFilesFront', 'middleware' => ['permission:language-edit']]);
    Route::get('languages/files/backend/{id}',['as' => 'language.files_back', 'uses' => 'LanguageController@languageFilesBack', 'middleware' => ['permission:language-edit']]);
   Route::post('language/change',['as'=>'language.change','uses'=>'LanguageController@changeLanguage','middleware'=>['permission:language-edit']]);

// payment/payment manager route
    Route::get('payments', ['as' => 'payments.index', 'uses' => 'PaymentController@index', 'middleware' => ['permission:payment-list|payment-create|payment-edit|payment-delete']]);

	Route::get('price_plans', ['as' => 'payments.plans', 'uses' => 'PaymentController@plans', 'middleware' => ['permission:payment-list|payment-create|payment-edit|payment-delete']]);

    Route::post('addPlan', ['as' => 'payments.addPlan', 'uses' => 'PaymentController@addPlan', 'middleware' => ['permission:payment-list|payment-create|payment-edit|payment-delete']]);

    Route::post('editPlan', ['as' => 'payments.editPlan', 'uses' => 'PaymentController@editPlan', 'middleware' => ['permission:payment-list|payment-create|payment-edit|payment-delete']]);

    Route::post('removePlan', ['as' => 'payments.removePlan', 'uses' => 'PaymentController@removePlan', 'middleware' => ['permission:payment-list|payment-create|payment-edit|payment-delete']]);

	Route::get('payments/overview', ['as' => 'payments.overview', 'uses' => 'PaymentController@overview', 'middleware' => ['permission:payment-list|payment-create|payment-edit|payment-delete']]);
    Route::get('payments/create', ['as' => 'payments.create', 'uses' => 'PaymentController@create', 'middleware' => ['permission:payment-create']]);
    Route::post('payments/create', ['as' => 'payments.store', 'uses' => 'PaymentController@store', 'middleware' => ['permission:payment-create']]);
    Route::delete('payments/{id}', ['as' => 'payments.destroy', 'uses' => 'PaymentController@destroy', 'middleware' => ['permission:rpayment-delete']]);


//New Routes

Route::get('tax_view', ['as' => 'account_setting.tax', 'uses' => 'AccountController@setting_tax', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::post('removeTax', ['as' => 'tax.removeTax', 'uses' => 'TaxController@removeTax', 'middleware' => ['permission:account-delete']]);
Route::post('editTax', ['as' => 'tax.editTax', 'uses' => 'TaxController@editTax', 'middleware' => ['permission:account-delete']]);
Route::post('addTax', ['as' => 'tax.addTax', 'uses' => 'TaxController@addTax', 'middleware' => ['permission:account-delete']]);

Route::get('taxtype_view', ['as' => 'account_setting.tax_type', 'uses' => 'AccountController@setting_taxtype', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::post('editTaxType', ['as' => 'tax_type.editTaxType', 'uses' => 'TaxTypeController@editTaxType', 'middleware' => ['permission:account-edit']]);
Route::post('removeTaxType', ['as' => 'tax_type.removeTaxType', 'uses' => 'TaxTypeController@removeTaxType', 'middleware' => ['permission:account-delete']]);
Route::post('addTaxType', ['as' => 'tax_type.addTaxType', 'uses' => 'TaxTypeController@addTaxType', 'middleware' => ['permission:account-delete']]);

Route::get('account_view', ['as' => 'account_setting.account', 'uses' => 'AccountController@setting_index', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::post('searchAccount', ['as' => 'account.account', 'uses' => 'AccountController@searchAccount', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);
Route::post('addAccount', ['as' => 'account.addAccount', 'uses' => 'AccountController@addAccount', 'middleware' => ['permission:account-create']]);
Route::post('editAccount', ['as' => 'account.editAccount', 'uses' => 'AccountController@editAccount', 'middleware' => ['permission:account-edit']]);
Route::post('removeAccount', ['as' => 'account.removeAccount', 'uses' => 'AccountController@removeAccount', 'middleware' => ['permission:account-delete']]);

Route::get('category_view', ['as' => 'account_setting.category', 'uses' => 'CategoryController@setting_category', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::post('addCat', ['as' => 'category.addCat', 'uses' => 'CategoryController@addCat', 'middleware' => ['permission:account-create']]);
Route::post('editCat', ['as' => 'category.editCat', 'uses' => 'CategoryController@editCat', 'middleware' => ['permission:account-edit']]);
Route::post('removeCat', ['as' => 'category.removeCat', 'uses' => 'CategoryController@removeCat', 'middleware' => ['permission:account-delete']]);

Route::get('AccountCategory_view', ['as' => 'account_setting.Acc_category', 'uses' => 'AccountCategoryController@setting_acc_category', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);


Route::post('addAccCat', ['as' => 'account_category.addAccCat', 'uses' => 'AccountCategoryController@addAccCat', 'middleware' => ['permission:account-create']]);
Route::post('editAccCat', ['as' => 'account_category.editAccCat', 'uses' => 'AccountCategoryController@editAccCat', 'middleware' => ['permission:account-edit']]);
Route::post('removeAccCat', ['as' => 'account_category.removeAccCat', 'uses' => 'AccountCategoryController@removeAccCat', 'middleware' => ['permission:account-delete']]);

Route::get('relation/taxes', ['as' => 'account_setting.relation', 'uses' => 'AccountController@setting_relation', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::get('relation/company', ['as' => 'account_setting.setting_relation2', 'uses' => 'AccountController@setting_relation2', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::get('relation/screen', ['as' => 'account_setting.setting_relation3', 'uses' => 'AccountController@setting_relation3', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);


Route::post('editAccTax', ['as' => 'account_to_tax.editAccTax', 'uses' => 'AccountToTaxController@editAccTax', 'middleware' => ['permission:account-edit']]);
//Route::get('email_temp', ['as' => 'email.index', 'uses' => 'EmailController@index', 'middleware' => ['permission:user-list|user-create|user-edit|user-delete']]);
Route::get('email_temp', ['as' => 'email.index', 'uses' => 'EmailController@index', 'middleware' => ['permission:user-list|user-create|user-edit|user-delete']]);

Route::post('email_temp/new', ['as' => 'email.new', 'uses' => 'EmailController@store', 'middleware' => ['permission:user-list|user-create|user-edit|user-delete']]);

Route::get('email_temp/{id}/show', ['as' => 'email.show', 'uses' => 'EmailController@show', 'middleware' => ['permission:user-list|user-create|user-edit|user-delete']]);

Route::post('email_temp/edit', ['as' => 'email.edit', 'uses' => 'EmailController@edit', 'middleware' => ['permission:user-list|user-create|user-edit|user-delete']]);


Route::post('email_temp/{id}/destroy', ['as' => 'email.destroy', 'uses' => 'EmailController@destroy', 'middleware' => ['permission:user-list|user-create|user-edit|user-delete']]);
Route::post('editAccCompany', ['as' => 'account_to_companytype.editAccCompany', 'uses' => 'AccountToCompanytypeController@editAccCompany', 'middleware' => ['permission:account-edit']]);
Route::post('addCompany', ['as' => 'account_to_tax.addCompany', 'uses' => 'AccountController@addCompany', 'middleware' => ['permission:account-edit']]);

Route::post('editAccScreen', ['as' => 'account_to_screen.editAccScreen', 'uses' => 'AccountToScreenController@editAccScreen', 'middleware' => ['permission:account-edit']]);



Route::get('users_view', ['as' => 'users.users_view', 'uses' => 'UserController@user_index', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::get('inactivated', ['as' => 'users.inactivated', 'uses' => 'UserController@inactivate_users_index', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::get('users_plan', ['as' => 'users.users_plan', 'uses' => 'UserController@users_plan_index', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::get('epxire_plan', ['as' => 'users.epxire_plan', 'uses' => 'UserController@expire_plan_index', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::get('new', ['as' => 'users.new', 'uses' => 'UserController@new', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::get('susp', ['as' => 'users.susp', 'uses' => 'UserController@susp', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::get('pend', ['as' => 'users.pend', 'uses' => 'UserController@pend', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::get('rolesUser', ['as' => 'users.rolesUser', 'uses' => 'UserController@rolesUser', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::post('searchEmail', ['as' => 'users.searchEmail', 'uses' => 'UserController@searchEmail', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::post('addUser', ['as' => 'users.addUser', 'uses' => 'UserController@addUser', 'middleware' => ['permission:account-edit']]);

Route::post('removeUser', ['as' => 'users.removeUser', 'uses' => 'UserController@removeUser', 'middleware' => ['permission:account-edit']]);

Route::get('editUser', ['as' => 'users.editUser', 'uses' => 'UserController@editUser', 'middleware' => ['permission:account-edit|account-delete']]);

Route::post('editUserAcc', ['as' => 'users.editUserAcc', 'uses' => 'UserController@editUserAcc', 'middleware' => ['permission:account-edit']]);

Route::post('editUserProfile', ['as' => 'users.editUserProfile', 'uses' => 'UserController@editUserProfile', 'middleware' => ['permission:account-edit']]);

Route::post('addUserAddress', ['as' => 'users.addUserAddress', 'uses' => 'UserController@addUserAddress', 'middleware' => ['permission:account-edit']]);

Route::post('removeUserAddress', ['as' => 'users.removeUserAddress', 'uses' => 'UserController@removeUserAddress', 'middleware' => ['permission:account-edit']]);

Route::post('editUserAddress', ['as' => 'users.editUserAddress', 'uses' => 'UserController@editUserAddress', 'middleware' => ['permission:account-edit']]);

Route::post('addUserBankAccount', ['as' => 'users.addUserBankAccount', 'uses' => 'UserController@addUserBankAccount', 'middleware' => ['permission:account-edit']]);

Route::post('removeUserBankAccount', ['as' => 'users.removeUserBankAccount', 'uses' => 'UserController@removeUserBankAccount', 'middleware' => ['permission:account-edit']]);

Route::post('editUserBankAccount', ['as' => 'users.editUserBankAccount', 'uses' => 'UserController@editUserBankAccount', 'middleware' => ['permission:account-edit']]);


Route::get('roles_view', ['as' => 'users.users_roles', 'uses' => 'UserController@roles_index', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::post('addRole', ['as' => 'users.addRole', 'uses' => 'RoleController@addRole', 'middleware' => ['permission:account-edit']]);

Route::post('removeRole', ['as' => 'users.removeRole', 'uses' => 'RoleController@removeRole', 'middleware' => ['permission:account-edit']]);

Route::post('editRole', ['as' => 'users.editRole', 'uses' => 'RoleController@editRole', 'middleware' => ['permission:account-edit']]);



Route::get('user_setting_view', ['as' => 'users.users_settings', 'uses' => 'UserController@user_setting_index', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::post('addSetting', ['as' => 'users.addSetting', 'uses' => 'UserSettingController@addSetting', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::post('removeSetting', ['as' => 'users.removeSetting', 'uses' => 'UserSettingController@removeSetting', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);

Route::post('editSetting', ['as' => 'users.editSetting', 'uses' => 'UserSettingController@editSetting', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);


//  tax_type route
    Route::get('tax_type', ['as' => 'tax_type.index', 'uses' => 'TaxTypeController@index', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);
    Route::get('tax_type/create', ['as' => 'tax_type.create', 'uses' => 'TaxTypeController@create', 'middleware' => ['permission:account-create']]);
    Route::post('tax_type/create', ['as' => 'tax_type.store', 'uses' => 'TaxTypeController@store', 'middleware' => ['permission:account-create']]);
    Route::get('tax_type/{id}/edit', ['as' => 'tax_type.edit', 'uses' => 'TaxTypeController@edit', 'middleware' => ['permission:account-edit']]);
    Route::post('editTaxType', ['as' => 'tax_type.editTaxType', 'uses' => 'TaxTypeController@editTaxType', 'middleware' => ['permission:account-edit']]);
    Route::delete('tax_type/{id}', ['as' => 'tax_type.destroy', 'uses' => 'TaxTypeController@destroy', 'middleware' => ['permission:account-delete']]);

// tax/tax route
    Route::get('tax', ['as' => 'tax.index', 'uses' => 'TaxController@index', 'middleware' => ['permission:account-list|account-create|account-edit|tax-delete']]);
    Route::get('tax/create', ['as' => 'tax.create', 'uses' => 'TaxController@create', 'middleware' => ['permission:account-create']]);
    Route::post('tax/create', ['as' => 'tax.store', 'uses' => 'TaxController@store', 'middleware' => ['permission:account-create']]);
    Route::get('tax/{id}/edit', ['as' => 'tax.edit', 'uses' => 'TaxController@edit', 'middleware' => ['permission:account-edit']]);
    Route::patch('tax/{id}', ['as' => 'tax.update', 'uses' => 'TaxController@update', 'middleware' => ['permission:account-edit']]);
    Route::delete('tax/{id}', ['as' => 'tax.destroy', 'uses' => 'TaxController@destroy', 'middleware' => ['permission:account-delete']]);

// account/ category  route
    Route::get('category', ['as' => 'category.index', 'uses' => 'CategoryController@index', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);
    Route::get('category/create', ['as' => 'category.create', 'uses' => 'CategoryController@create', 'middleware' => ['permission:account-create']]);
    Route::post('category/create', ['as' => 'category.store', 'uses' => 'CategoryController@store', 'middleware' => ['permission:account-create']]);
    Route::get('category/{id}/edit', ['as' => 'category.edit', 'uses' => 'CategoryController@edit', 'middleware' => ['permission:account-edit']]);
    Route::patch('category/{id}', ['as' => 'category.update', 'uses' => 'CategoryController@update', 'middleware' => ['permission:account-edit']]);
    Route::delete('category/{id}', ['as' => 'category.destroy', 'uses' => 'CategoryController@destroy', 'middleware' => ['permission:account-delete']]);

// account/ account_category  route
    Route::get('account_category', ['as' => 'account_category.index', 'uses' => 'AccountCategoryController@index', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);
    Route::get('account_category/create', ['as' => 'account_category.create', 'uses' => 'AccountCategoryController@create', 'middleware' => ['permission:account-create']]);
    Route::post('account_category/create', ['as' => 'account_category.store', 'uses' => 'AccountCategoryController@store', 'middleware' => ['permission:account-create']]);
    Route::get('account_category/{id}/edit', ['as' => 'account_category.edit', 'uses' => 'AccountCategoryController@edit', 'middleware' => ['permission:account-edit']]);
    Route::patch('account_category/{id}', ['as' => 'account_category.update', 'uses' => 'AccountCategoryController@update', 'middleware' => ['permission:account-edit']]);
    Route::delete('account_category/{id}', ['as' => 'account_category.destroy', 'uses' => 'AccountCategoryController@destroy', 'middleware' => ['permission:account-delete']]);

// account/account manager route
    Route::get('account', ['as' => 'account.index', 'uses' => 'AccountController@index', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);
    Route::get('account/create', ['as' => 'account.create', 'uses' => 'AccountController@create', 'middleware' => ['permission:account-create']]);
    Route::post('account/create', ['as' => 'account.store', 'uses' => 'AccountController@store', 'middleware' => ['permission:account-create']]);
    Route::get('account/{id}/edit', ['as' => 'account.edit', 'uses' => 'AccountController@edit', 'middleware' => ['permission:account-edit']]);
    Route::patch('account/{id}', ['as' => 'account.update', 'uses' => 'AccountController@update', 'middleware' => ['permission:account-edit']]);
    Route::delete('account/{id}', ['as' => 'account.destroy', 'uses' => 'AccountController@destroy', 'middleware' => ['permission:account-delete']]);

// account/account to tax route
    Route::get('account_to_tax', ['as' => 'account_to_tax.index', 'uses' => 'AccountToTaxController@index', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);
    Route::get('account_to_tax/create', ['as' => 'account_to_tax.create', 'uses' => 'AccountToTaxController@create', 'middleware' => ['permission:account-create']]);
    Route::post('account_to_tax/create', ['as' => 'account_to_tax.store', 'uses' => 'AccountToTaxController@store', 'middleware' => ['permission:account-create']]);
    Route::get('account_to_tax/{id}/edit', ['as' => 'account_to_tax.edit', 'uses' => 'AccountToTaxController@edit', 'middleware' => ['permission:account-edit']]);
    Route::patch('account_to_tax/{id}', ['as' => 'account_to_tax.update', 'uses' => 'AccountToTaxController@update', 'middleware' => ['permission:account-edit']]);
    Route::delete('account_to_tax/{id}', ['as' => 'account_to_tax.destroy', 'uses' => 'AccountToTaxController@destroy', 'middleware' => ['permission:account-delete']]);

// account/account to companytypes route
    Route::get('account_to_companytype', ['as' => 'account_to_companytype.index', 'uses' => 'AccountToCompanytypeController@index', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);
    Route::get('account_to_companytype/create', ['as' => 'account_to_companytype.create', 'uses' => 'AccountToCompanytypeController@create', 'middleware' => ['permission:account-create']]);
    Route::post('account_to_companytype/create', ['as' => 'account_to_companytype.store', 'uses' => 'AccountToCompanytypeController@store', 'middleware' => ['permission:account-create']]);
    Route::get('account_to_companytype/{id}/edit', ['as' => 'account_to_companytype.edit', 'uses' => 'AccountToCompanytypeController@edit', 'middleware' => ['permission:account-edit']]);
    Route::patch('account_to_companytype/{id}', ['as' => 'account_to_companytype.update', 'uses' => 'AccountToCompanytypeController@update', 'middleware' => ['permission:account-edit']]);
    Route::delete('account_to_companytype/{id}', ['as' => 'account_to_companytype.destroy', 'uses' => 'AccountToCompanytypeController@destroy', 'middleware' => ['permission:account-delete']]);

// account/account to screen route
    Route::get('account_to_screen', ['as' => 'account_to_screen.index', 'uses' => 'AccountToScreenController@index', 'middleware' => ['permission:account-list|account-create|account-edit|account-delete']]);
    Route::get('account_to_screen/create', ['as' => 'account_to_screen.create', 'uses' => 'AccountToScreenController@create', 'middleware' => ['permission:account-create']]);
    Route::post('account_to_screen/create', ['as' => 'account_to_screen.store', 'uses' => 'AccountToScreenController@store', 'middleware' => ['permission:account-create']]);
    Route::get('account_to_screen/{id}/edit', ['as' => 'account_to_screen.edit', 'uses' => 'AccountToScreenController@edit', 'middleware' => ['permission:account-edit']]);
    Route::patch('account_to_screen/{id}', ['as' => 'account_to_screen.update', 'uses' => 'AccountToScreenController@update', 'middleware' => ['permission:account-edit']]);
    Route::delete('account_to_screen/{id}', ['as' => 'account_to_screen.destroy', 'uses' => 'AccountToScreenController@destroy', 'middleware' => ['permission:account-delete']]);


    //user settings

    Route::get('user_settings', ['as' => 'user_settings.index', 'uses' => 'UserSettingController@index', 'middleware' => ['permission:user-settings-list|user-settings-create|user-settings-edit|user-settings-delete']]);
    Route::get('user_settings/create', ['as' => 'user_settings.create', 'uses' => 'UserSettingController@create', 'middleware' => ['permission:user-settings-create']]);
    Route::post('user_settings/create', ['as' => 'user_settings.store', 'uses' => 'UserSettingController@store', 'middleware' => ['permission:user-settings-create']]);
    Route::get('user_settings/{id}/edit', ['as' => 'user_settings.edit', 'uses' => 'UserSettingController@edit', 'middleware' => ['permission:user-settings-edit']]);
    Route::patch('user_settings/{id}', ['as' => 'user_settings.update', 'uses' => 'UserSettingController@update', 'middleware' => ['permission:user-settings-edit']]);
    Route::get('user_settings/{id}', ['as' => 'user_settings.show', 'uses' => 'UserSettingController@show', 'middleware' => ['permission:user-settings-edit']]);
    Route::delete('user_settings/{id}', ['as' => 'user_settings.destroy', 'uses' => 'UserSettingController@destroy', 'middleware' => ['permission:user-settings-delete']]);


    Route::resource('users', 'UserController', ['names' =>
        [
            'index' => 'users.index',
            'create' => 'users.create',
            'store' => 'users.store',
            'show' => 'users.show',
            'edit' => 'users.edit',
            'update' => 'users.update',
            'destroy' => 'users.destroy',
            'destroyTables' => 'users.destroyTables',
        ],
    ]);

    Route::patch('users/profile/user_status/update/{id}', ['as' => 'users.profile.user_status.update', 'uses' => 'UserController@userStatusUpdate', 'middleware' => ['permission:user-edit']]);
    Route::get('users/profile/basic/edit/{id}', ['as' => 'users.profile.basic.edit', 'uses' => 'UserController@basicEdit', 'middleware' => ['permission:user-edit']]);
    Route::patch('users/profile/basic/update/{id}', ['as' => 'users.profile.basic.update', 'uses' => 'UserController@basicUpdate', 'middleware' => ['permission:user-edit']]);
    Route::get('users/profile/address/create/{id}', ['as' => 'users.profile.address.create', 'uses' => 'UserController@addressCreate', 'middleware' => ['permission:user-create']]);
    Route::post('users/profile/address/store/{id}', ['as' => 'users.profile.address.store', 'uses' => 'UserController@addressStore', 'middleware' => ['permission:user-create']]);
    Route::get('users/profile/address/edit/{id}', ['as' => 'users.profile.address.edit', 'uses' => 'UserController@addressEdit', 'middleware' => ['permission:user-edit']]);
    Route::patch('users/profile/address/update/{id}', ['as' => 'users.profile.address.update', 'uses' => 'UserController@addressUpdate', 'middleware' => ['permission:user-edit']]);
    Route::delete('users/profile/address/{id}', ['as' => 'users.profile.address.destroy', 'uses' => 'UserController@addresDestroy', 'middleware' => ['permission:user-delete']]);

    Route::get('users/bank_account/create/{id}', ['as' => 'users.bankaccount.create', 'uses' => 'UserController@bankAccountCreate', 'middleware' => ['permission:user-create']]);
    Route::post('users/bank_account/store/{id}', ['as' => 'users.bankaccount.store', 'uses' => 'UserController@bankAccountStore', 'middleware' => ['permission:user-create']]);
    Route::get('users/bank_account/edit/{id}', ['as' => 'users.bankaccount.edit', 'uses' => 'UserController@bankAccountEdit', 'middleware' => ['permission:user-edit']]);
    Route::patch('users/bank_account/update/{id}', ['as' => 'users.bankaccount.update', 'uses' => 'UserController@bankAccountUpdate', 'middleware' => ['permission:user-edit']]);
    Route::delete('users/bank_account/{id}', ['as' => 'users.bankaccount.destroy', 'uses' => 'UserController@bankAccountDestroy', 'middleware' => ['permission:user-delete']]);
    Route::post('accountdetails', ['as' => 'users.accountdetails', 'uses' => 'ClearDataController@accountDestroyTables', 'middleware' => ['permission:user-delete']]);

    Route::get('roles', ['as' => 'roles.index', 'uses' => 'RoleController@index', 'middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
    Route::get('roles/create', ['as' => 'roles.create', 'uses' => 'RoleController@create', 'middleware' => ['permission:role-create']]);
    Route::post('roles/create', ['as' => 'roles.store', 'uses' => 'RoleController@store', 'middleware' => ['permission:role-create']]);

    // Route::get('roles/{id}', ['as' => 'roles.show', 'uses' => 'RoleController@show']);
    Route::get('roles/{id}/edit', ['as' => 'roles.edit', 'uses' => 'RoleController@edit', 'middleware' => ['permission:role-edit']]);
    Route::patch('roles/{id}', ['as' => 'roles.update', 'uses' => 'RoleController@update', 'middleware' => ['permission:role-edit']]);
    Route::delete('roles/{id}', ['as' => 'roles.destroy', 'uses' => 'RoleController@destroy', 'middleware' => ['permission:role-delete']]);

    //help and support
    Route::get('dashboard/helps',['as'=>'helps.show','uses'=>'HelpController@show']);
    Route::get('previous/replays/{id?}',['as'=>'helps.replays','uses'=>'HelpController@previous_replays']);
    Route::post('dashboard/helps/update',['as'=>'helps_updates','uses'=>'HelpController@update']);
    Route::post('dashboard/helps/faq',['as'=>'helps_faq','uses'=>'HelpController@store_faq']);

    Route::get('helps/delete/replay/{id?}',['as'=>'helps.delete_replay','uses'=>'HelpController@delete_replay', 'middleware' => ['permission:account-delete']]);



});
//=================================================================
