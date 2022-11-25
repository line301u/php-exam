<?php

require_once __DIR__ . '/router.php';

// Views
get('/', 'views/index');
get('/home', 'views/home');
get('/user/$id', 'views/user');
get('/login', 'views/user');

// API
post('/log_in', 'api/log_in');
post('/create-user', 'api/create_user');
post('/delete-user', 'api/delete_user');
post('/update-user', 'api/update_user');

any('/404', 'views/404');
