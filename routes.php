<?php

require_once __DIR__ . '/router.php';

// Views
get('/php-exam', 'views/index');
get('/php-exam/home', 'views/home');
get('/php-exam/user/$id', 'views/user');
get('/php-exam/log-out', 'api/log_out');

// API
post('/log_in', 'api/log_in');
post('/create-user', 'api/create_user');
post('/delete-user', 'api/delete_user');
post('/update-user', 'api/update_user');

any('/404', 'views/404');
