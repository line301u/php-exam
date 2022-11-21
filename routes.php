<?php

require_once __DIR__ . '/router.php';

// Views
get('/php-exam', 'views/index');
get('/php-exam/home', 'views/home');
get('/php-exam/user/$id', 'views/user');

// API
post('/php-exam/user/$id', 'api/create_user');
put('/php-exam/user/$id', 'api/update_user');
delete('/php-exam/user/$id', 'api/delete_user');

any('/php-exam/404', 'views/404');
