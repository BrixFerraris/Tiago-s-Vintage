
<?php
  include_once './includes/sidebar.php';
?>




    <!-- End Main -->

</div>

<style>
  /* styles.css */


</style>
    <!-- Scripts -->
    <!-- Custom JS -->
    <script>

// SIDEBAR TOGGLE

let sidebarOpen = false;
const sidebar = document.getElementById('sidebar');

function openSidebar() {
  if (!sidebarOpen) {
    sidebar.classList.add('sidebar-responsive');
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if (sidebarOpen) {
    sidebar.classList.remove('sidebar-responsive');
    sidebarOpen = false;
  }
}


//category
document.addEventListener('DOMContentLoaded', function () {

});

</script>
  </body>
</html>

