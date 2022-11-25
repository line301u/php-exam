<?php

define('_USER_FIRST_NAME_MIN_LEN', 2);
define('_USER_FIRST_NAME_MAX_LEN', 20);
define('_USER_LAST_NAME_MIN_LEN', 2);
define('_USER_LAST_NAME_MAX_LEN', 20);
define('_USER_PASSWORD_MIN_LEN', 6);
define('_USER_PASSWORD_MAX_LEN', 50);
define('_REGEX_EMAIL', '^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$');
define('_SESSION_FORM_ERRORS', 'form_errors');

// ##############################
function _validate_first_name(string $input_name, string $form_name, string $error_message_name = 'first_name', $error_message = null)
{
    $default_error_message = 'First name ' . _USER_FIRST_NAME_MIN_LEN . ' to ' . _USER_FIRST_NAME_MAX_LEN . ' characters';

    if (is_null($error_message)) {
        $error_message = $default_error_message;
    }

    if (!isset($_POST[$input_name])) {
        $_SESSION[_SESSION_FORM_ERRORS][$form_name][$error_message_name] = ucfirst($error_message);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    $_POST[$input_name] = trim($_POST[$input_name]);

    if (strlen($_POST[$input_name]) < _USER_FIRST_NAME_MIN_LEN || strlen($_POST[$input_name]) > _USER_FIRST_NAME_MAX_LEN) {
        $_SESSION[_SESSION_FORM_ERRORS][$form_name][$error_message_name] = ucfirst($error_message);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    return $_POST[$input_name];
}

// ##############################
function _validate_last_name(string $input_name, string $form_name, string $error_message_name = 'last_name', $error_message = null)
{
    $default_error_message = 'Last name ' . _USER_LAST_NAME_MIN_LEN . ' to ' . _USER_LAST_NAME_MAX_LEN . ' characters';

    if (is_null($error_message)) {
        $error_message = $default_error_message;
    }

    if (!isset($_POST[$input_name])) {
        $_SESSION[_SESSION_FORM_ERRORS][$form_name][$error_message_name] = ucfirst($error_message);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    $_POST[$input_name] = trim($_POST[$input_name]);

    if (strlen($_POST[$input_name]) < _USER_LAST_NAME_MIN_LEN || strlen($_POST[$input_name]) > _USER_LAST_NAME_MAX_LEN) {
        $_SESSION[_SESSION_FORM_ERRORS][$form_name][$error_message_name] = ucfirst($error_message);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    return $_POST[$input_name];
}

// ##############################
function _validate_password(string $input_name, string $form_name, string $error_message_name = 'password', $error_message = null)
{
    $default_error_message = 'Password ' . _USER_PASSWORD_MIN_LEN . ' to ' . _USER_PASSWORD_MAX_LEN . ' characters';

    if (is_null($error_message)) {
        $error_message = $default_error_message;
    }

    if (!isset($_POST[$input_name])) {
        $_SESSION[_SESSION_FORM_ERRORS][$form_name][$error_message_name] = ucfirst($error_message);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    $_POST[$input_name] = trim($_POST[$input_name]);

    if (strlen($_POST[$input_name]) < _USER_PASSWORD_MIN_LEN || strlen($_POST[$input_name]) > _USER_PASSWORD_MAX_LEN) {
        $_SESSION[_SESSION_FORM_ERRORS][$form_name][$error_message_name] = ucfirst($error_message);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }

    return $_POST[$input_name];
}

// ##############################
function _validate_email(string $input_name, string $form_name, string $error_message_name = 'email', $error_message = null)
{
    $default_error_message = "Invalid {$input_name}";

    if (is_null($error_message)) {
        $error_message = $default_error_message;
    }

    if (!isset($_POST[$input_name])) {
        $_SESSION[_SESSION_FORM_ERRORS][$form_name][$error_message_name] = ucfirst($error_message);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }
    $_POST[$input_name] = trim($_POST[$input_name]);
    if (!preg_match('/' . _REGEX_EMAIL . '/', $_POST[$input_name])) {
        $_SESSION[_SESSION_FORM_ERRORS][$form_name][$error_message_name] = ucfirst($error_message);
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }
    return $_POST[$input_name];
}

// ##############################

function _validate_image(string $input_name)
{
    if ($_FILES[$input_name]['error'] === UPLOAD_ERR_INI_SIZE) {
        _respond('item_image too large', 400);
    }
    $item_image_temp_name = $_FILES[$input_name]["tmp_name"]; // C:\xampp\tmp\php791.tmp || C:\xampp\tmp\php5245.tmp
    $target_dir = "./images/";
    $target_file = $target_dir . basename($_FILES[$input_name]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // just reads the extension of the file
    $image_mime = mime_content_type($_FILES[$input_name]["tmp_name"]); // reads the mime inside the file
    $accepted_image_formats = ['image/png', 'image/jpeg'];
    if (!in_array($image_mime, $accepted_image_formats)) {
        http_response_code(400);
        echo 'image not allowed';
        exit();
    }
    $random_image_name = bin2hex(random_bytes(16));
    switch ($image_mime) {
        case 'image/png':
            $random_image_name .= '.png';
            break;
        case 'image/jpeg':
            $random_image_name .= '.jpeg';
            break;
    }

    if (move_uploaded_file($_FILES[$input_name]["tmp_name"], 'images/2.png')) {
        echo 'ok';
        exit();
    }
}


// ##############################
function _respond($message = '', $status = 200)
{
    http_response_code($status);
    header('Content-Type: application/json');
    $res = is_array($message) ? $message : ['info' => $message];
    echo json_encode($res);
    exit();
}
