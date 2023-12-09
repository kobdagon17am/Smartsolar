<?php

Route::get('/c', function () {
  $exitCode = Artisan::call('cache:clear');
  $exitCode = Artisan::call('config:clear');
  $exitCode = Artisan::call('view:clear');


  // $exitCode = Artisan::call('config:cache');
  return back();
});



Route::get('/', function () {
  if (Auth::guard('admin')->check()) {

    return redirect('admin/Dashboard');
} else {
    return view('auth.login_admin');
}

});

 
  
