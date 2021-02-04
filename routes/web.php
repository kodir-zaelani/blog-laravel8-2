<?php

use App\Models\Tag;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Models\Social;
use App\Models\Setting;
use App\Models\Setarticle;
use App\Models\Categorypost;
use App\Models\Advertisement;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Frontend\Main\Home;
use App\Http\Livewire\Frontend\Post\Show;
use App\Http\Livewire\Frontend\Post\Search;
use App\Http\Livewire\Frontend\Post\Writer;
use App\Http\Livewire\Frontend\Post\Archive;
use App\Http\Livewire\Frontend\Post\Postsall;
use App\Http\Livewire\Frontend\Post\Posttags;
use App\Http\Livewire\Frontend\Download\Index;
use App\Http\Livewire\Frontend\Download\Detail;
use App\Http\Livewire\Frontend\Post\Postauthor;
use App\Http\Livewire\Frontend\Post\Postcategory;
use App\Http\Livewire\Frontend\Page\Show as PageShow;
use App\Models\Widget;

// Route::get('/', function () {
    //     return view('layouts.frontend');
    // });
    
    Route::middleware(['auth:sanctum', 'verified'])->group(function() {
        Route::group(['prefix' => 'backend'], function () {
            Route::name('admin.')->group(function() {
                
                // Route Livewire
                
                // Route Controller
                // Controllers Within The "App\Http\Controllers\Admin" Namespace
                Route::namespace('App\Http\Controllers\Admin')->group(function () {
                    
                    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
                    
                    // menu frontend
                    Route::get('/menus', 'DashboardController@menu')->name('menus.index');
                    
                    //roles
                    Route::resource('/roles', 'RoleController', ['except' => ['show','store', 'destroy']]);
                    
                    // Permission
                    Route::get('/permissions', 'PermissionController@index')->name('permissions.index');
                    
                    //users profile
                    Route::get('/users/profile', 'UserController@profile')->name('users.profile');
                    
                    //users
                    Route::resource('/users', 'UserController', ['except' => ['show', 'store', 'destroy']]);
                    
                    //settings
                    Route::resource('/settings', 'SettingController', ['except' => ['show','create', 'store', 'destroy']]);
                    
                    // socialmedia
                    Route::get('/socialmedia', 'SocialmediaController@index')->name('socialmedia.index');
                    
                    // categoryposts import
                    Route::post('/categoryposts/importSave', 'CategorypostController@importSave')->name('categoryposts.importSave');
                    
                    // categoryposts export
                    Route::get('/categoryposts/export', 'CategorypostController@export')->name('categoryposts.export');
                    // categoryposts printPDF
                    Route::get('/categoryposts/printPDF', 'CategorypostController@printPDF')->name('categoryposts.printPDF');
                    
                    //categoryposts
                    Route::resource('/categoryposts', 'CategorypostController', ['except' => ['show']]);
                    
                    // Json Data for Category and District
                    Route::get('/get/subcategorypost/{categrorypost_id}', 'PostController@getSubcategorypost')->name('posts.subcategorypost');
                    
                    // subcategoryposts import
                    Route::post('/subcategoryposts/importSave', 'SubcategorypostController@importSave')->name('subcategoryposts.importSave');
                    
                    //subcategoryposts
                    Route::resource('/subcategoryposts', 'SubcategorypostController', ['except' => ['show']]);
                    
                    //setarticles
                    Route::resource('/setarticles', 'SetarticleController', ['except' => ['show']]);
                    
                    //posts
                    Route::resource('/posts', 'PostController', ['except' => ['show']]);
                    
                    // tags
                    Route::get('/tags', 'TagController@index')->name('tags.index');
                    
                    //categorypages
                    Route::get('/categorypages', 'CategorypageController@index')->name('categorypages.index');
                    
                    //pages
                    Route::resource('/pages', 'PageController', ['except' => ['show']]);
                    
                    //categorydownloads
                    Route::resource('/categorydownloads', 'CategorydownloadController', ['except' => ['show']]);
                    
                    // downloadfiles
                    Route::resource('/downloadfiles', 'DownloadfileController', ['except' => ['show']]);

                    // sliders
                    Route::resource('/sliders', 'SliderController', ['except' => ['show']]);
                    
                    // albums
                    Route::resource('/albums', 'AlbumController', ['except' => ['show']]);
                    
                    // photos
                    Route::resource('/photos', 'PhotoController', ['except' => ['show']]);
                    
                    // advertisements
                    Route::resource('/advertisements', 'AdvertisementController', ['except' => ['show']]);
                    
                    // widgets
                    Route::resource('/widgets', 'WidgetController', ['except' => ['show']]);

                });
            });
        });
    });


    
    // Laravel file manager
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    
    // Global View Composer frontend + Beckend
    View::composer('*', function($view) {
        $global_categories = Categorypost::with(['post'=> function($query){
            $query->published();
        }])->orderBy('title', 'asc')
        ->get();
        $view->with('global_categories', $global_categories);
    });
    
    // Global View Composer frontend + Beckend
    View::composer('*', function($view) {
        $global_setarticle = Setarticle::with(['post'=> function($query){
            $query->published();
        }])->orderBy('title', 'asc')->get();;
        $view->with('global_setarticle', $global_setarticle);
    });
    
    
    // Global View Composer frontend + Beckend
    View::composer('*', function($view) {
        $global_tags = Tag::orderBy('title', 'asc')->get();
        $view->with('global_tags', $global_tags);
    });
    
    // Global View Composer frontend + Beckend
    View::composer('*', function($view) {
        $global_settings = Setting::find(1);
        $view->with('global_settings', $global_settings);
    });
    // Global View Composer frontend + Beckend Popular Post
    View::composer('*', function($view) {
        $global_popular = Post::published()->popular()->take(6)->get();
        $view->with('global_popular', $global_popular);
    });
    // Global View Composer frontend + Beckend REcent Post
    View::composer('*', function($view) {
        $global_latest = Post::published()->latest()->take(6)->get();
        $view->with('global_latest', $global_latest);
    });
    // Global View Composer frontend + Beckend Selection Post 
    View::composer('*', function($view) {
        $global_featured = Post::published()->featured()->take(6)->get();
        $view->with('global_featured', $global_featured);
    });
    // Global View Composer frontend + Beckend
    View::composer('*', function($view) {
        $global_latestFooter = Post::published()->latest()->take(3)->get();
        $view->with('global_latestFooter', $global_latestFooter);
    });
    
    // Global View Composer frontend + Beckend
    View::composer('*', function($view) {
        $global_archives = Post::published()->archives();
        $view->with('global_archives', $global_archives);
    });
    
    // Global View Composer frontend + Beckend
    View::composer('*', function($view) {
        $global_pages = Page::latest()->get();
        $view->with('global_pages', $global_pages);
    });
    
    
    // Global View Composer frontend + Beckend
    View::composer('*', function($view) {
        $global_user = User::latest()->get();
        $view->with('global_user', $global_user);
    });
    
    // Global View Composer frontend + Beckend
    View::composer('*', function($view) {
        $global_social = Social::find(1);
        $view->with('global_social', $global_social);
    });
    // Global View Composer frontend + Beckend
    View::composer('*', function($view) {
        $global_adverstisment_hometop = Advertisement::where('position', '=', 'home-top')
                                        ->with('author')
                                        ->published()
                                        ->get();
        $view->with('global_adverstisment_hometop', $global_adverstisment_hometop);
    });
    View::composer('*', function($view) {
        $global_adverstisment_home_middle = Advertisement::where('position', '=', 'home-middle')
                                        ->with('author')
                                        ->published()
                                        ->get();
        $view->with('global_adverstisment_home_middle', $global_adverstisment_home_middle);
    });
    View::composer('*', function($view) {
        $global_adverstisment_home_bottom = Advertisement::where('position', '=', 'home-bottom')
                                        ->with('author')
                                        ->published()
                                        ->get();
        $view->with('global_adverstisment_home-bottom', $global_adverstisment_home_bottom);
    });

    View::composer('*', function($view) {
        $global_adverstisment_sidebar_top = Advertisement::where('position', '=', 'sidebar-right-middle')
                                            ->with('author')
                                            ->published()
                                            ->get();
        $view->with('global_adverstisment_sidebar_top', $global_adverstisment_sidebar_top);
    });
    View::composer('*', function($view) {
        $global_adverstisment_sidebarmiddle = Advertisement::where('position', '=', 'sidebar-right-middle')
                                            ->with('author')
                                            ->published()
                                            ->get();
        $view->with('global_adverstisment_sidebarmiddle', $global_adverstisment_sidebarmiddle);
    });
    View::composer('*', function($view) {
        $global_adverstisment_bottom = Advertisement::where('position', '=', 'sidebar-right-middle')
                                            ->with('author')
                                            ->published()
                                            ->get();
        $view->with('global_adverstisment_bottom', $global_adverstisment_bottom);
    });

    View::composer('*', function($view) {
        $global_widget_sidebar_top = Widget::where('position', '=', 'sidebar-right-top')
                                            ->with('author')
                                            ->published()
                                            ->get();
        $view->with('global_widget_sidebar_top', $global_widget_sidebar_top);
    });
    View::composer('*', function($view) {
        $global_widget_sidebar_right_middle = Widget::where('position', '=', 'sidebar-right-middle')
                                            ->with('author')
                                            ->published()
                                            ->get();
        $view->with('global_widget_sidebar_right_middle', $global_widget_sidebar_right_middle);
    });
    View::composer('*', function($view) {
        $global_widget_sidebar_right_bottom = Widget::where('position', '=', 'sidebar-right-bottom')
                                            ->published()
                                            ->with('author')
                                            ->get();
        $view->with('global_widget_sidebar_right_bottom', $global_widget_sidebar_right_bottom);
    });
    
    // Frontend
    Route::get('/', Home::class )->name('root');

    Route::prefix('post')->group(function(){
        Route::get('/detail/{post}', Show::class)->name('post.show');
        Route::get('/postall', Postsall::class)->name('post.all');
        Route::get('/archive', Archive::class)->name('post.archive');
        Route::get('/search', Search::class)->name('post.search');
        Route::get('/category/{post}', Postcategory::class)->name('categorypost.show');
        Route::get('/author/{post}', Postauthor::class)->name('author.show');
        Route::get('/tags/{post}', Posttags::class)->name('tag.show');
    });
    
    // view Pages in front end
    Route::get('/page/{page}', PageShow::class)->name('page.show');
    // view Pages in front end
    Route::get('/download/detail/{slug}', Detail::class)->name('download.detail');
    // view Pages in front end
    Route::get('/download', Index::class)->name('download.index');
