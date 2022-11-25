</main>
<footer class="position-absolute w-100 bottom-0">
  <p class="p-2 m-0">© 2022 KEA. Made by Linea, Niklas and Signe.</p>
</footer>
</body>

</html>

<?php
// Remove form errors if the page is refreshed (Normal behavior)
if (isset($_SESSION['form_errors'])) {
  unset($_SESSION['form_errors']);
}
?>