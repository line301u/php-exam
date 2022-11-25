<?php

require_once __DIR__ . '/router.php';

// Views
get('/', 'views/index');
get('/home', 'views/home');
get('/user/$id', 'views/user');
get('/log-out', 'api/log_out');

// API
post('/php-exam/log-in', 'api/log_in');
post('/php-exam/create-user', 'api/create_user');
post('/php-exam/delete-user', 'api/delete_user');

any('/404', 'views/404');
