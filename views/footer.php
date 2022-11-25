</body>

</html>

<?php
// Remove form errors if the page is refreshed (Normal behavior)
if (isset($_SESSION['form_errors'])) {
  unset($_SESSION['form_errors']);
}
?>