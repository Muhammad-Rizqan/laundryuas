<?php

     use Illuminate\Support\Facades\Route;
     use App\Http\Controllers\HomeController;
     use App\Http\Controllers\Auth\LoginController;
     use App\Http\Controllers\Auth\RegisterController;
     use App\Http\Controllers\Admin\DashboardController;
     use App\Http\Controllers\Admin\PackageController;
     use App\Http\Controllers\Admin\OrderController;
     use App\Http\Controllers\Admin\CustomerController;

     Route::get('/', [HomeController::class, 'index'])->name('home');

     Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
     Route::post('/login', [LoginController::class, 'login']);
     Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

     Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
     Route::post('/register', [RegisterController::class, 'register']);

     Route::middleware('auth')->group(function () {
         Route::get('/dashboard', function () {
             if (auth()->user()->isAdmin()) {
                 return redirect()->route('admin.dashboard');
             }
             return redirect()->route('customer.dashboard');
         })->name('dashboard');

         Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
             Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
             Route::resource('packages', PackageController::class);
             Route::resource('orders', OrderController::class);
             Route::resource('customers', CustomerController::class);
             // Route khusus update status (POST)
            Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');
         });

         // Group semua route customer (wajib middleware auth)
// Group route customer (semua route di sini wajib login)
Route::prefix('customer')
    ->middleware('auth')
    ->name('customer.')  // Semua route di bawah ini akan punya prefix 'customer.'
    ->group(function () {

        // Dashboard utama
        Route::get('/dashboard', function () {
            $user = auth()->user();

            $orders = \App\Models\Order::where('user_id', $user->id)
                ->with('package')
                ->latest()
                ->paginate(10);

            $totalOrders     = \App\Models\Order::where('user_id', $user->id)->count();
            $pendingOrders   = \App\Models\Order::where('user_id', $user->id)->where('status', 'pending')->count();
            $completedOrders = \App\Models\Order::where('user_id', $user->id)
                ->whereIn('status', ['done', 'delivered'])
                ->count();

            return view('customer.dashboard', compact(
                'orders',
                'totalOrders',
                'pendingOrders',
                'completedOrders'
            ));
        })->name('dashboard');

        // Form pesan laundry baru
        Route::get('/order/create', [App\Http\Controllers\Customer\OrderController::class, 'create'])
            ->name('order.create');

        // Simpan pesanan baru
        Route::post('/order', [App\Http\Controllers\Customer\OrderController::class, 'store'])
            ->name('order.store');
    });
     });