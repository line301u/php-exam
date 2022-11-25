<?php

require_once __DIR__ . '/router.php';

// Views
get('/php-exam', 'views/index');
get('/php-exam/home', 'views/home');
get('/php-exam/user/$id', 'views/user');
get('/php-exam/log-out', 'api/log_out');

// API
post('/php-exam/log-in', 'api/log_in');
post('/php-exam/create-user', 'api/create_user');
post('/php-exam/delete-user', 'api/delete_user');

any('/404', 'views/404');
