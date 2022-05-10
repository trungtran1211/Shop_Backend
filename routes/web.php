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
use App\Http\Controllers\ExampleController;

Route::get('example', [ExampleController::class, 'dummy'])->middleware('cors');
	Route::group(['prefix' => '/'], function () {
		Route::get('/', 'FrontendController@getHome')->name('home');
	    
	});
	Route::group(['middleware' => ['lang']], function() {
		Route::get('detail/{id}', 'FrontendController@getDetail');
		Route::post('detail/{id}', 'FrontendController@postComment');
		Route::get('category/{id}', 'FrontendController@getCategory');
		Route::get('search','FrontendController@getSearch');

		// Route::group(['prefix'=>'login1'],function(){
		// 	Route::get('/', 'LoginCustomController@getlogincustom');
		// 	Route::post('/', 'LoginCustomController@postlogincustom');
			
		// 	Route::get('logout1', 'LoginCustomController@getLogout1');
		// });
		/*======================================================*/
		/*Tuyển dụng*/
		Route::get('gettuyendung', 'FrontendController@getlisttd');
		/*======================================================*/
		
		/*======================================================*/
		/*Thêm vào yêu thích*/
		Route::get('addcartyt/{id}','CartController@getAddCartYt');
		Route::get('deleteyt/{id}','FrontendController@getdeleteyt');
		Route::get('pageyeuthich/{id}','FrontendController@getPageYT');
		Route::get('yeuthich/{id}','FrontendController@getYeuThich');
		//Route::post('yeuthich/{id}','FrontendController@postYeuThich');
		/*======================================================*/
		Route::get('lichsu/{id}','FrontendController@getLichSu');

		Route::get('deletebill/{id}','FrontendController@getDeleteBill');
		/*======================================================*/
		/*Kiểm tra lịch sử mua hàng*/


		// Route::post('regrister', 'LoginCustomController@postregrister');

		
		Route::get('signup','LoginCustomController@getSignUp');
		Route::get('contact','FrontendController@getContact');
		Route::post('checkbills','FrontendController@getCheckBill')->name('checkbill');
		Route::get('checklistbill','FrontendController@getCheckListBill');
		Route::get('check-bill','FrontendController@getcheck');
		/*======================================================*/

		/*======================================================*/
		/*Giỏ hàng*/
		Route::group(['prefix'=>'cart'],function(){
			Route::get('add/{id}','CartController@getAddCart');
			Route::get('ad/{id}','CartController@getShow');
			Route::get('show','CartController@getShowCart')->name('show-cart');
			Route::get('delete/{id}','CartController@getDeleteCart');
			Route::get('update','CartController@getUpdateCart');
			Route::post('updatesize','CartController@getUpdateSize');
			Route::post('show','CartController@postComplete');
			Route::post('add-cart-ajax','CartController@addCartAjax');
			Route::get('checkout','CartController@getCheckout');
		});
		/*======================================================*/

		Route::get('complete','CartController@getComplete')->name('complete');
		 
	});


/*======================================================*/
/*Admin*/
/*======================================================*/

Route::group(['namespace'=>'Admin'],function(){
	Route::group(['prefix'=>'login','middleware'=>'CheckLogedIn'],function(){
		Route::get('/','LoginController@getLogin');
		Route::post('/','LoginController@postLogin');
	});
	
	Route::get('logout','HomeController@getLogout');
	Route::group(['middleware'=>'leveladmin'],function(){
		Route::group(['prefix'=>'admin'],function(){	
			Route::get('home','HomeController@getHome');
			Route::group(['middleware'=>'duyetadmin'],function(){
				Route::group(['prefix'=>'category'], function(){
					Route::get('/','CategoryController@getCate');
					Route::post('/','CategoryController@postCate');
					Route::get('edit/{id}','CategoryController@getEditCate');
					Route::post('edit/{id}','CategoryController@postEditCate');
					Route::get('delete/{id}','CategoryController@getDeleteCate');
				});



				/*======================================================*/
				/*Add tuyển dụng*/
				Route::get('tuyendung','TuyendungController@getuyendung');
				Route::post('addtuyendung','TuyendungController@postaddtuyendung');
				Route::get('addtuyendungmoi','TuyendungController@addtuyendungmoi');
				/*======================================================*/

				/*======================================================*/
				/*Nhân Viên*/
				Route::post('addstaff','StaffController@postAddStaff');
				Route::get('staff','StaffController@getListstaff');
			    Route::get('admin/xoa/{id}','StaffController@getDeletestaff');
			    /*======================================================*/

				/*======================================================*/
				/*Bình luận khách hàng*/
				Route::get('binhluan','CommentController@getList');
			    Route::get('xoa/{id}','CommentController@getDelete');
			    /*======================================================*/
				
				/*======================================================*/
				/*Slide*/
			    Route::post('addslide','SlideController@postaddslide');
			    Route::get('sua/{id}','SlideController@getUpdateSlide');
			    Route::post('sua/{id}','SlideController@postUpdateSlide');
			    Route::post('updatestatus','SlideController@getUpdateStatus');
			    /*======================================================*/
				
				/*======================================================*/
				/*Khách hàng*/
				Route::get('khachhang','CommentController@getListkh');
			    Route::get('xoa/{id}','CommentController@getDeletekh');
			    /*======================================================*/
				
			});
		    Route::group(['middleware'=>'duyet'],function(){
		    	Route::get('updatestatusbill/{id}','BillController@updateStatusBill');
		    	Route::get('duyet','BillController@getduyet');
		    });	

		    /*======================================================*/
			/*Nhập Hàng*/
		    Route::post('addodernew/{id}','OderController@postAddOder');
		    Route::get('listnhap','OderController@getlistnhap');
		    Route::get('addoder/{id}','OderController@getAddOder');
		    /*======================================================*/

		    /*======================================================*/
			/*Cập nhật hóa đơn*/
		    Route::group(['middleware'=>'levelgiaohang'],function(){
		    	Route::get('bill','BillController@getbill');
		    	Route::get('delbill/{id}','BillController@getdelbill');
		    	Route::get('listbill/{id}','BillController@getlistBill');
		    	Route::get('xoabill/{id}','BillController@getXoaBill');
		    	Route::post('updatebillship', 'BillController@updateBillShip');
		    	Route::get('pdf/{id}','BillController@getPdfBill');
			});
			/*======================================================*/

			Route::group(['middleware'=>'duyetadmin'],function(){
				Route::group(['prefix'=>'product'],function(){
					Route::get('/','ProductController@getProduct');
					Route::get('add','ProductController@getAddProduct');
					Route::post('add','ProductController@postAddProduct');
					Route::get('khachhang','ProductController@khachhang');
					Route::get('binhluan','ProductController@binhluan');
					Route::get('lichsu','ProductController@lichsu');
					Route::get('nhanvien','ProductController@nhanvien');
					Route::get('addnhanvien','ProductController@addnhanvien');
					Route::get('slide','ProductController@slide');
					Route::get('addslide','ProductController@addslide');
					Route::get('updateslide','ProductController@updateslide');
					Route::get('listslide','SlideController@getlistslide');
					Route::get('xoa/{id}','SlideController@getDeleteslide');
					Route::get('edit/{id}','ProductController@getEditProduct');
					Route::post('edit/{id}','ProductController@postEditProduct');
					Route::get('delete/{id}','ProductController@getDeleteProduct');
				});
			});
		});
	});
});
