<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function () {
    // Inventory setup crud start
    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'InventorySetup'], function () {
        //category crud operation start
        Route::get('/inventory-setup-category-list', 'CategoryController@index')->name('inventorySetup.category.index');
        Route::get('/dataProcessingCategory', 'CategoryController@dataProcessingCategory')->name('inventorySetup.category.dataProcessingCategory');
        Route::get('/inventory-setup-category-create', 'CategoryController@create')->name('inventorySetup.category.create');
        Route::post('/inventory-setup-category-store', 'CategoryController@store')->name('inventorySetup.category.store');
        Route::get('/inventory-setup-category-edit/{id}', 'CategoryController@edit')->name('inventorySetup.category.edit');
        Route::get('/inventory-setup-category-show/{id}', 'CategoryController@show')->name('inventorySetup.category.show');
        Route::post('/inventory-setup-category-update/{id}', 'CategoryController@update')->name('inventorySetup.category.update');
        Route::get('/inventory-setup-category-delete/{id}', 'CategoryController@destroy')->name('inventorySetup.category.destroy');
        Route::get('/inventory-setup-category-status/{id}/{status}', 'CategoryController@statusUpdate')->name('inventorySetup.category.status');
        //category crud operation end

        //product crud operation start
        Route::get('/inventory-setup-product-list', 'ProductController@index')->name('inventorySetup.product.index');
        Route::get('/dataProcessingProduct', 'ProductController@dataProcessingProduct')->name('inventorySetup.product.dataProcessingProduct');
        Route::get('/inventory-setup-product-create', 'ProductController@create')->name('inventorySetup.product.create');
        Route::post('/inventory-setup-product-store', 'ProductController@store')->name('inventorySetup.product.store');
        Route::get('/inventory-setup-product-edit/{id}', 'ProductController@edit')->name('inventorySetup.product.edit');
        Route::get('/inventory-setup-product-show/{id}', 'ProductController@show')->name('inventorySetup.product.show');
        Route::post('/inventory-setup-product-update/{id}', 'ProductController@update')->name('inventorySetup.product.update');
        Route::get('/inventory-setup-product-delete/{id}', 'ProductController@destroy')->name('inventorySetup.product.destroy');
        Route::get('/inventory-setup-product-status/{id}/{status}', 'ProductController@statusUpdate')->name('inventorySetup.product.status');
        //product crud operation end

        //product Unit crud operation start
        Route::get('/inventory-setup-unit-list', 'UnitController@index')->name('inventorySetup.unit.index');
        Route::get('/dataProcessingUnit', 'UnitController@dataProcessingUnit')->name('inventorySetup.unit.dataProcessingUnit');
        Route::get('/inventory-setup-unit-create', 'UnitController@create')->name('inventorySetup.unit.create');
        Route::post('/inventory-setup-unit-store', 'UnitController@store')->name('inventorySetup.unit.store');
        Route::get('/inventory-setup-unit-edit/{id}', 'UnitController@edit')->name('inventorySetup.unit.edit');
        Route::get('/inventory-setup-unit-show/{id}', 'UnitController@show')->name('inventorySetup.unit.show');
        Route::post('/inventory-setup-unit-update/{id}', 'UnitController@update')->name('inventorySetup.unit.update');
        Route::get('/inventory-setup-unit-delete/{id}', 'UnitController@destroy')->name('inventorySetup.unit.destroy');
        Route::get('/inventory-setup-unit-status/{id}/{status}', 'UnitController@statusUpdate')->name('inventorySetup.unit.status');
        //product Unit crud operation end

        //brand Unit crud operation start
        Route::get('/inventory-setup-brand-list', 'BrandController@index')->name('inventorySetup.brand.index');
        Route::get('/dataProcessingBrand', 'BrandController@dataProcessingBrand')->name('inventorySetup.brand.dataProcessingBrand');
        Route::get('/inventory-setup-brand-create', 'BrandController@create')->name('inventorySetup.brand.create');
        Route::post('/inventory-setup-brand-store', 'BrandController@store')->name('inventorySetup.brand.store');
        Route::get('/inventory-setup-brand-edit/{id}', 'BrandController@edit')->name('inventorySetup.brand.edit');
        Route::get('/inventory-setup-brand-show/{id}', 'BrandController@show')->name('inventorySetup.brand.show');
        Route::post('/inventory-setup-brand-update/{id}', 'BrandController@update')->name('inventorySetup.brand.update');
        Route::get('/inventory-setup-brand-delete/{id}', 'BrandController@destroy')->name('inventorySetup.brand.destroy');
        Route::get('/inventory-setup-brand-status/{id}/{status}', 'BrandController@statusUpdate')->name('inventorySetup.brand.status');
        //brand  crud operation end

        //conversion crud operation start
        Route::get('/inventory-setup-conversion-list', 'ConversionController@index')->name('inventorySetup.conversion.index');
        Route::get('/dataProcessingConversions', 'ConversionController@dataProcessingConversions')->name('inventorySetup.conversion.dataProcessingConversions');
        Route::get('/inventory-setup-conversion-create', 'ConversionController@create')->name('inventorySetup.conversion.create');
        Route::post('/inventory-setup-conversion-store', 'ConversionController@store')->name('inventorySetup.conversion.store');
        Route::get('/inventory-setup-conversion-edit/{id}', 'ConversionController@edit')->name('inventorySetup.conversion.edit');
        Route::get('/inventory-setup-conversion-show/{id}', 'ConversionController@show')->name('inventorySetup.conversion.show');
        Route::post('/inventory-setup-conversion-update/{id}', 'ConversionController@update')->name('inventorySetup.conversion.update');
        Route::get('/inventory-setup-conversion-delete/{id}', 'ConversionController@destroy')->name('inventorySetup.conversion.destroy');
        Route::get('/inventory-setup-conversion-status/{id}/{status}', 'ConversionController@statusUpdate')->name('inventorySetup.conversion.status');
        //conversion operation end

        //Supplier  crud operation start
        Route::get('/inventory-setup-supplier-list', 'SupplierController@index')->name('inventorySetup.supplier.index');
        Route::get('/dataProcessingSupplier', 'SupplierController@dataProcessingSupplier')->name('inventorySetup.supplier.dataProcessingSupplier');
        Route::get('/inventory-setup-supplier-create', 'SupplierController@create')->name('inventorySetup.supplier.create');
        Route::post('/inventory-setup-supplier-store', 'SupplierController@store')->name('inventorySetup.supplier.store');
        Route::get('/inventory-setup-supplier-edit/{id}', 'SupplierController@edit')->name('inventorySetup.supplier.edit');
        Route::get('/inventory-setup-supplier-show/{id}', 'SupplierController@show')->name('inventorySetup.supplier.show');
        Route::post('/inventory-setup-supplier-update/{id}', 'SupplierController@update')->name('inventorySetup.supplier.update');
        Route::get('/inventory-setup-supplier-delete/{id}', 'SupplierController@destroy')->name('inventorySetup.supplier.destroy');
        Route::get('/inventory-setup-supplier-status/{id}/{status}', 'SupplierController@statusUpdate')->name('inventorySetup.supplier.status');
        // Inventory setup crud start

        //purchaserequisition  crud operation start
        Route::get('/inventory-purchaserequisition-list', 'PurchaseRequisitionController@index')->name('inventorySetup.purchaserequisition.index');
        Route::get('/dataProcessingPurchaseRequisition', 'PurchaseRequisitionController@dataProcessingAdjust')->name('inventorySetup.purchaserequisition.dataProcessingPurchaseRequisition');
        Route::get('/inventory-purchaserequisition-create', 'PurchaseRequisitionController@create')->name('inventorySetup.purchaserequisition.create');
        Route::post('/inventory-purchaserequisition-store', 'PurchaseRequisitionController@store')->name('inventorySetup.purchaserequisition.store');
        Route::get('/inventory-purchaserequisition-edit/{id}', 'PurchaseRequisitionController@edit')->name('inventorySetup.purchaserequisition.edit');
        // Route::get('/inventory-purchaserequisition-show/{id}', 'PurchaseRequisitionController@show')->name('inventorySetup.purchaserequisition.show');
        Route::post('/inventory-purchaserequisition-update/{id}', 'PurchaseRequisitionController@update')->name('inventorySetup.purchaserequisition.update');
        Route::get('/inventory-purchaserequisition-delete/{id}', 'PurchaseRequisitionController@destroy')->name('inventorySetup.purchaserequisition.destroy');
        Route::get('/inventory-purchaserequisition-filterproduct', 'PurchaseRequisitionController@filterproduct')->name('inventorySetup.purchaserequisition.filterproduct');
        // Route::get('/inventorySetup.purchaserequisition.approve/{id}', 'PurchaseRequisitionController@approve')->name('inventorySetup.purchaserequisition.approve');
        // Route::post('/inventorySetup.purchaserequisition.approveUpdate/{id}', 'PurchaseRequisitionController@approveUpdate')->name('inventorySetup.purchaserequisition.approveUpdate');
        Route::get('/inventorySetup.purchaserequisition.invoice/{id}', 'PurchaseRequisitionController@invoice')->name('inventorySetup.purchaserequisition.invoice');
        //purchaserequisition  crud operation end

        //purchaseorder  crud operation start
        Route::get('/inventory-purchaseorder-list', 'PurchaseOrderController@index')->name('inventorySetup.purchaseorder.index');
        Route::get('/dataProcessingpurchaseorder', 'PurchaseOrderController@datapurchaseorder')->name('inventorySetup.purchaseorder.datapurchaseorder');
        Route::post('/inventory-purchaseorder-store', 'PurchaseOrderController@store')->name('inventorySetup.purchaseorder.store');
        Route::get('/inventory-purchaseorder-searchpr', 'PurchaseOrderController@searchpr')->name('inventorySetup.purchaseorder.searchpr');
        Route::get('/inventory-purchaseorder-create', 'PurchaseOrderController@create')->name('inventorySetup.purchaseorder.create');
        Route::get('/inventory-purchaseorder-edit/{id}', 'PurchaseOrderController@edit')->name('inventorySetup.purchaseorder.edit');
        Route::post('/inventory-purchaseorder-update/{id}', 'PurchaseOrderController@update')->name('inventorySetup.purchaseorder.update');
        Route::get('/inventory-purchaseorder-delete/{id}', 'PurchaseOrderController@destroy')->name('inventorySetup.purchaseorder.destroy');
        Route::get('/inventory-purchaseorder-filterproduct', 'PurchaseOrderController@filterproduct')->name('inventorySetup.purchaseorder.filterproduct');
        Route::get('/inventorySetup.purchaseorder.invoice/{id}', 'PurchaseOrderController@invoice')->name('inventorySetup.purchaseorder.invoice');
        //purchaseorder  crud operation end

        //purchase  crud operation start
        Route::get('/inventory-purchase-pvlist', 'PurchaseController@pvindex')->name('inventorySetup.purchase.pvindex');
        Route::post('/inventory-purchase-pvcloseopen', 'PurchaseController@pvcloseopen')->name('inventorySetup.purchase.pvcloseopen');
        Route::get('/dataProcessinpv', 'PurchaseController@dataProcessinpv')->name('inventorySetup.purchase.dataProcessinpv');
        Route::get('/inventory-purchase-searchpr', 'PurchaseController@searchpo')->name('inventorySetup.purchase.searchpo');
        Route::post('/inventory-purchase-pvstore', 'PurchaseController@pvstore')->name('inventorySetup.purchase.pvstore');
        Route::get('/inventory-purchase-pvcreate', 'PurchaseController@pvcreate')->name('inventorySetup.purchase.pvcreate');
        Route::get('/inventory-purchase-pvedit/{id}', 'PurchaseController@pvedit')->name('inventorySetup.purchase.pvedit');
        Route::post('/inventory-purchase-pvupdate/{id}', 'PurchaseController@pvupdate')->name('inventorySetup.purchase.pvupdate');
        Route::get('/inventory-purchase-pvdelete/{id}', 'PurchaseController@destroy')->name('inventorySetup.purchase.pvdestroy');
        Route::get('/inventorySetup.purchase.pvinvoice/{id}', 'PurchaseController@pvinvoice')->name('inventorySetup.purchase.pvinvoice');
        //purchase  crud operation end

        //Good received note  crud operation start
        Route::get('/inventory-goodrcvnote-list', 'GrnController@index')->name('inventorySetup.goodrcvnote.index');
        Route::get('/dataProcessinggoodrcvnote', 'GrnController@datagoodrcvnote')->name('inventorySetup.goodrcvnote.datagoodrcvnote');
        Route::post('/inventory-goodrcvnote-store', 'GrnController@store')->name('inventorySetup.goodrcvnote.store');
        Route::get('/inventory-goodrcvnote-searchgrn', 'GrnController@searchgrn')->name('inventorySetup.goodrcvnote.searchgrn');
        Route::get('/inventory-goodrcvnote-create', 'GrnController@create')->name('inventorySetup.goodrcvnote.create');
        Route::get('/inventory-goodrcvnote-edit/{id}', 'GrnController@edit')->name('inventorySetup.goodrcvnote.edit');
        Route::get('/inventory-goodrcvnote-show/{id}', 'GrnController@show')->name('inventorySetup.goodrcvnote.show');
        Route::post('/inventory-goodrcvnote-update/{id}', 'GrnController@update')->name('inventorySetup.goodrcvnote.update');
        Route::get('/inventory-goodrcvnote-delete/{id}', 'GrnController@destroy')->name('inventorySetup.goodrcvnote.destroy');
        Route::get('/inventory-goodrcvnote-filterproduct', 'GrnController@filterproduct')->name('inventorySetup.goodrcvnote.filterproduct');
        Route::get('/inventorySetup.goodrcvnote.invoice/{id}', 'GrnController@invoice')->name('inventorySetup.goodrcvnote.invoice');
        //Good received note  crud operation end

        //Customer  crud operation start
        Route::get('/inventory-setup-customer-list', 'CustomerController@index')->name('inventorySetup.customer.index');
        Route::get('/dataProcessingCustomer', 'CustomerController@dataProcessingCustomer')->name('inventorySetup.customer.dataProcessingCustomer');
        Route::get('/inventory-setup-customer-create', 'CustomerController@create')->name('inventorySetup.customer.create');
        Route::post('/inventory-setup-customer-store', 'CustomerController@store')->name('inventorySetup.customer.store');
        Route::get('/inventory-setup-customer-edit/{id}', 'CustomerController@edit')->name('inventorySetup.customer.edit');
        Route::get('/inventory-setup-customer-show/{id}', 'CustomerController@show')->name('inventorySetup.customer.show');
        Route::post('/inventory-setup-customer-update/{id}', 'CustomerController@update')->name('inventorySetup.customer.update');
        Route::get('/inventory-setup-customer-delete/{id}', 'CustomerController@destroy')->name('inventorySetup.customer.destroy');
        Route::get('/inventory-setup-customer-status/{id}/{status}', 'CustomerController@statusUpdate')->name('inventorySetup.customer.status');
        //Customer  crud operation end
        //Customer  crud operation start
        Route::get('/inventory-adjust-list', 'AdjustController@index')->name('inventorySetup.adjust.index');
        Route::get('/dataProcessingAdjust', 'AdjustController@dataProcessingAdjust')->name('inventorySetup.adjust.dataProcessingAdjust');
        Route::get('/inventory-adjust-create', 'AdjustController@create')->name('inventorySetup.adjust.create');
        Route::post('/inventory-adjust-store', 'AdjustController@store')->name('inventorySetup.adjust.store');
        Route::get('/inventory-adjust-edit/{id}', 'AdjustController@edit')->name('inventorySetup.adjust.edit');
        Route::get('/inventory-adjust-show/{id}', 'AdjustController@show')->name('inventorySetup.adjust.show');
        Route::post('/inventory-adjust-update/{id}', 'AdjustController@update')->name('inventorySetup.adjust.update');
        Route::get('/inventory-adjust-delete/{id}', 'AdjustController@destroy')->name('inventorySetup.adjust.destroy');
        Route::get('/inventory-adjust-status/{id}/{status}', 'AdjustController@statusUpdate')->name('inventorySetup.adjust.status');
        //Customer  crud operation end

        //customer adjustment credit
        Route::get('/inventory-adjustCredit-list', 'AdjustCreditController@index')->name('inventorySetup.adjustCredit.index');
        Route::get('/dataProcessingAdjustCredit', 'AdjustCreditController@dataProcessingAdjustCredit')->name('inventorySetup.adjustCredit.dataProcessingAdjustCredit');
        Route::get('/inventory-adjustCredit-create', 'AdjustCreditController@create')->name('inventorySetup.adjustCredit.create');
        Route::post('/inventory-adjustCredit-store', 'AdjustCreditController@store')->name('inventorySetup.adjustCredit.store');
        Route::get('/inventory-adjustCredit-edit/{id}', 'AdjustCreditController@edit')->name('inventorySetup.adjustCredit.edit');
        Route::get('/inventory-adjustCredit-show/{id}', 'AdjustCreditController@show')->name('inventorySetup.adjustCredit.show');
        Route::post('/inventory-adjustCredit-update/{id}', 'AdjustCreditController@update')->name('inventorySetup.adjustCredit.update');
        Route::get('/inventory-adjustCredit-delete/{id}', 'AdjustCreditController@destroy')->name('inventorySetup.adjustCredit.destroy');
        Route::get('/inventory-adjustCredit-status/{id}/{status}', 'AdjustCreditController@statusUpdate')->name('inventorySetup.adjustCredit.status');

        //customer adjustment deposit
        Route::get('/inventory-adjustDeposit-list', 'AdjustmentDepostiController@index')->name('inventorySetup.adjustDeposit.index');
        Route::get('/dataProcessingadjustDeposit', 'AdjustmentDepostiController@dataProcessingadjustDeposit')->name('inventorySetup.adjustDeposit.dataProcessingadjustDeposit');
        Route::get('/inventory-adjustDeposit-create', 'AdjustmentDepostiController@create')->name('inventorySetup.adjustDeposit.create');
        Route::post('/inventory-adjustDeposit-store', 'AdjustmentDepostiController@store')->name('inventorySetup.adjustDeposit.store');
        Route::get('/inventory-adjustDeposit-edit/{id}', 'AdjustmentDepostiController@edit')->name('inventorySetup.adjustDeposit.edit');
        Route::get('/inventory-adjustDeposit-show/{id}', 'AdjustmentDepostiController@show')->name('inventorySetup.adjustDeposit.show');
        Route::post('/inventory-adjustDeposit-update/{id}', 'AdjustmentDepostiController@update')->name('inventorySetup.adjustDeposit.update');
        Route::get('/inventory-adjustDeposit-delete/{id}', 'AdjustmentDepostiController@destroy')->name('inventorySetup.adjustDeposit.destroy');
        Route::get('/inventory-adjustDeposit-status/{id}/{status}', 'AdjustmentDepostiController@statusUpdate')->name('inventorySetup.adjustDeposit.status');

        //purchase crud operation start
        Route::get('/inventory-purchase-list', 'PurchaseController@index')->name('inventorySetup.purchase.index');
        Route::get('/dataProcessingPurchase', 'PurchaseController@dataProcessingPurchase')->name('inventorySetup.purchase.dataProcessingPurchase');
        Route::get('/inventory-purchase-create', 'PurchaseController@create')->name('inventorySetup.purchase.create');
        Route::post('/inventory-purchase-store', 'PurchaseController@store')->name('inventorySetup.purchase.store');
        Route::get('/inventory-purchase-edit/{id}', 'PurchaseController@edit')->name('inventorySetup.purchase.edit');
        Route::get('/inventory-purchase-show/{id}', 'PurchaseController@show')->name('inventorySetup.purchase.show');
        Route::post('/inventory-purchase-update/{id}', 'PurchaseController@update')->name('inventorySetup.purchase.update');
        Route::get('/inventory-purchase-delete/{id}', 'PurchaseController@destroy')->name('inventorySetup.purchase.destroy');
        Route::get('/inventory-purchase-status/{id}/{status}', 'PurchaseController@statusUpdate')->name('inventorySetup.purchase.status');
        Route::get('/getProductList', 'PurchaseController@getProductList')->name('inventorySetup.purchase.getProductList');
        Route::get('/unitPrice', 'PurchaseController@unitPrice')->name('inventorySetup.purchase.unitPice');
        Route::get('/accounts', 'PurchaseController@getAccounts')->name('inventorySetup.purchase.accounts');
        //purchase crud operation end

        //stock adjustment crud operation start
        Route::get('/inventory-stockAdjustment-list', 'StockAjdustmentController@index')->name('inventorySetup.stockAdjustment.index');
        Route::get('/dataProcessingStockAdjustment', 'StockAjdustmentController@dataProcessingStockAdjustment')->name('inventorySetup.stockAdjustment.dataProcessingStockAdjustment');
        Route::get('/inventory-stockAdjustment-create', 'StockAjdustmentController@create')->name('inventorySetup.stockAdjustment.create');
        Route::post('/inventory-stockAdjustment-store', 'StockAjdustmentController@store')->name('inventorySetup.stockAdjustment.store');
        Route::get('/inventory-stockAdjustment-edit/{id}', 'StockAjdustmentController@edit')->name('inventorySetup.stockAdjustment.edit');
        Route::get('/inventory-stockAdjustment-show/{id}', 'StockAjdustmentController@show')->name('inventorySetup.stockAdjustment.show');
        Route::post('/inventory-stockAdjustment-update/{id}', 'StockAjdustmentController@update')->name('inventorySetup.stockAdjustment.update');
        Route::get('/inventory-stockAdjustment-delete/{id}', 'StockAjdustmentController@destroy')->name('inventorySetup.stockAdjustment.destroy');
        Route::get('/inventory-stockAdjustment-status/{id}/{status}', 'StockAjdustmentController@statusUpdate')->name('inventorySetup.stockAdjustment.status');
        Route::get('/inventory-stockAdjustment-approval/{id}/', 'StockAjdustmentController@approval')->name('inventorySetup.stockAdjustment.approval');
        Route::post('/inventory-stockAdjustment-storeapproval/{id}/', 'StockAjdustmentController@storeapproval')->name('inventorySetup.stockAdjustment.storeapproval');

        Route::get('/getProductListforadjust', 'StockAjdustmentController@getProductListforadjust')->name('inventorySetup.stockAdjustment.getProductListforadjust');
        Route::get('/unitPriceforadjust', 'StockAjdustmentController@unitPriceforadjust')->name('inventorySetup.stockAdjustment.unitPriceforadjust');
        Route::get('/accountsforadjust', 'StockAjdustmentController@accountsforadjust')->name('inventorySetup.stockAdjustment.accountsforadjust');
        //stock adjustment crud operation end


        //stock transfer curd operation start
        Route::get('/inventory-transfer-list', 'StockTransferController@index')->name('inventorySetup.transfer.index');
        Route::get('/dataProcessingTransfer', 'StockTransferController@dataProcessingTransfer')->name('inventorySetup.transfer.dataProcessingTransfer');
        Route::get('/inventory-transfer-create', 'StockTransferController@create')->name('inventorySetup.transfer.create');
        Route::post('/inventory-transfer-store', 'StockTransferController@store')->name('inventorySetup.transfer.store');
        Route::post('/inventory-transfer-approval-store', 'StockTransferController@approval_store')->name('inventorySetup.transfer.approval_store');
        Route::get('/inventory-transfer-edit/{id}', 'StockTransferController@edit')->name('inventorySetup.transfer.edit');
        Route::get('/inventory-transfer-show/{id}', 'StockTransferController@show')->name('inventorySetup.transfer.show');
        Route::get('/inventory-transfer-approval/{id}', 'StockTransferController@approval')->name('inventorySetup.transfer.approval');
        Route::get('/inventory-transfer-getProductListTransfer', 'StockTransferController@getProductListTransfer')->name('inventorySetup.transfer.getProductListTransfer');
        Route::post('/inventory-transfer-update/{id}', 'StockTransferController@update')->name('inventorySetup.transfer.update');
        Route::get('/inventory-transfer-delete/{id}', 'StockTransferController@destroy')->name('inventorySetup.transfer.destroy');
        Route::get('/inventory-transfer-status/{id}/{status}', 'StockTransferController@statusUpdate')->name('inventorySetup.transfer.status');
        Route::get('/inventory-transfer-editapproval/{id}', 'StockTransferController@editapproval')->name('inventorySetup.transfer.editapproval');
        Route::post('/inventorySetup.transfer.approveedit/{id}', 'StockTransferController@updateapprove')->name('inventorySetup.transfer.approveedit');

        //stock transfer curd operation end
        Route::get('/inventory-currentStock-list', 'StockReportController@index')->name('inventorySetup.currentStock.index');
    });
    // Inventory setup crud end
});
