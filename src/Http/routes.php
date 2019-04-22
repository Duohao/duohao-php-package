<?php

Route::middleware('auth:api')->resource('/duohao/users', 'Duohao\Http\Controllers\StdUserController');
