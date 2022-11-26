<?php
require_once __DIR__ . '/../global_validation.php';

// Remove form errors if the page is refreshed (Normal behavior)
if (isset($_SESSION[_SESSION_FORM_ERRORS])) {
  unset($_SESSION[_SESSION_FORM_ERRORS]);
}

if (isset($_SESSION[_SESSION_FORM_SUCCESSES])) {
  unset($_SESSION[_SESSION_FORM_SUCCESSES]);
}
?>

</main>
<footer class="position-absolute w-100 bottom-0">
  <p class="p-2 m-0">© 2022 KEA. Made by Linea, Niklas and Signe.</p>
</footer>
</body>

</html>