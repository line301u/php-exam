<?php

require_once __DIR__ . '/router.php';

// Views
get('/php-exam', 'views/index');
get('/php-exam/home', 'views/home');
get('/php-exam/user/$id', 'views/user');

any('/php-exam/404', 'views/404');

// API
post('/php-exam/api-v1/user/$id', 'api/create_user');
put('/php-exam/api-v1/user/$id', 'api/update_user');
delete('/php-exam/api-v1/user/$id', 'api/delete_user');
