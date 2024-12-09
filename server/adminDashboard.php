<?php
session_start();
if (isset($_SESSION["role"])) {
  $role = $_SESSION["role"];

  if ($role === 'Super Admin') {
    include_once './includes/sidebar.php';
  } elseif ($role === 'Add Product') {
    include_once './includes/sidebarAdd_Product.php';
  } elseif ($role === 'Accept Orders') {
    include_once './includes/sidebarAccept_Order.php';
  } elseif ($role === 'Change Contents') {
    include_once './includes/sidebarChange_Contents.php';
  } else {
    include_once './includes/sidebar.php';
  }
} else {
  header("location: ./adminLogin.php?error=NotLoggedIn");
  exit();
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Main -->
<div class="notification-container">
  <div class="notification-icon">
    <i class="fas fa-bell"></i> <!-- Font Awesome bell icon -->
  </div>
  <div class="notification-dropdown">
    <ul id="notification-list"></ul>
  </div>
</div>


<main class="main-container">
  <div class="main-title">
    <p class="font-weight-bold"><?php echo $role; ?><br>DASHBOARD</p>
  </div>

  <div class="main-cards">

    <a href="./product.php" style="text-decoration:none;">
      <div class="card">
        <div class="card-inner">
          <p class="text-primary">PRODUCTS</p>
        </div>
        <span id="total-products" class="text-primary font-weight-bold">249</span>
      </div>
    </a>


    <a href="./purchaseOrders.php" style="text-decoration:none;">
      <div class="card">
        <div class="card-inner">
          <p class="text-primary">SALES ORDERS (DELIVERY)</p>
        </div>
        <span id="total-delivery" class="text-primary font-weight-bold">79</span>
      </div>
    </a>

    <a href="./purchaseOrders.php" style="text-decoration:none;">
      <div class="card">
        <div class="card-inner">
          <p class="text-primary">SALES ORDERS (PICK UP)</p>
        </div>
        <span id="total-pickup" class="text-primary font-weight-bold">79</span>
      </div>
    </a>


    <a href="./reports.php" style="text-decoration:none;">
      <div class="card">
        <div class="card-inner">
          <p class="text-primary">INVENTORY ALERTS</p>
        </div>
        <span id="inventory-alert" class="text-primary font-weight-bold">56</span>
      </div>
    </a>
  </div>

  <div class="charts" style=" display:flex; justify-content:center; align-items:center;">

    <div class="charts-card" style=" min-width:100%;">
      <div id="lalagyan">
        <p class="chart-title">Top 5 Products</p>
        <select id="month-select"></select>
      </div>

      <div id="bar-chart"></div>
    </div>

  </div>
</main>
<!-- End Main -->

</div>

<!-- Scripts -->
<!-- ApexCharts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
<!-- Custom JS -->
<script>
  const monthSelect = document.getElementById('month-select');

  const generateMonthOptions = () => {
    const currentDate = new Date();
    const options = [];

    for (let i = 5; i >= 0; i--) {
      const pastDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - i);
      const month = pastDate.getMonth() + 1; 
      const year = pastDate.getFullYear();
      options.push(`<option value="${month.toString().padStart(2, '0')}-${year}">${pastDate.toLocaleString('default', { month: 'long' })} ${year}</option>`);
    }

    for (let i = 1; i <= 12; i++) {
      const futureDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + i);
      const month = futureDate.getMonth() + 1;
      const year = futureDate.getFullYear();
      options.push(`<option value="${month.toString().padStart(2, '0')}-${year}">${futureDate.toLocaleString('default', { month: 'long' })} ${year}</option>`);
    }

    monthSelect.innerHTML = `<option value="Overall">Overall</option>` + options.join('');
  };

  generateMonthOptions();

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

  // ---------- CHARTS ----------

  const barChartOptions = {
    series: [
      {
        data: [],
      },
    ],
    chart: {
      type: 'bar',
      height: 350,
      toolbar: {
        show: false,
      },
    },
    colors: ['#246dec', '#cc3c43', '#367952', '#f5b74f', '#4f35a1'],
    plotOptions: {
      bar: {
        distributed: true,
        borderRadius: 4,
        horizontal: false,
        columnWidth: '40%',
      },
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    xaxis: {
      categories: [],
    },
    yaxis: {
      title: {
        text: 'Count',
      },
    },
  };

  const barChart = new ApexCharts(document.querySelector('#bar-chart'), barChartOptions);
  barChart.render();

  const getTopProducts = (monthYear = 'Overall') => {
    $.ajax({
      type: 'GET',
      url: './includes/getTopProducts.php',
      data: { monthYear: monthYear },
      dataType: 'json',
      success: function (response) {
        const productCounts = response.map(product => product.count);
        const productNames = response.map(product => product.product_name);
        barChartOptions.series[0].data = productCounts;
        barChartOptions.xaxis.categories = productNames;
        barChart.updateOptions(barChartOptions);
      },
      error: function (xhr, status, error) {
        console.error('AJAX Error: ', status, error);
      },
    });
  };

  // Event listener for dropdown change
  $('#month-select').on('change', function () {
    const selectedMonthYear = $(this).val();
    getTopProducts(selectedMonthYear);
  });

  // Initial load
  getTopProducts();

  // notification
  document.querySelector('.notification-icon').addEventListener('click', function () {
    const dropdown = document.querySelector('.notification-dropdown');
    dropdown.style.display = dropdown.style.display === 'none' || dropdown.style.display === '' ? 'block' : 'none';
  });

  // Close the dropdown if clicked outside
  document.addEventListener('click', function (event) {
    const dropdown = document.querySelector('.notification-dropdown');
    const icon = document.querySelector('.notification-icon');
    if (!icon.contains(event.target)) {
      dropdown.style.display = 'none';
    }
  });
  $(document).ready(function () {
    $.ajax({
      url: './includes/getDashboard.php',
      method: 'GET',
      dataType: 'json',
      success: function (data) {
        console.log(data);
        $('#total-customers').text(data.customers);
        $('#total-products').text(data.unique_products);
        $('#total-delivery').text(data.completed_delivery);
        $('#total-pickup').text(data.completed_pickup);
        $('#inventory-alert').text(data.low_stock_variations);
      }
    });
    function fetchNotifications() {
      $.ajax({
        url: './includes/fetchNotifications.php',
        method: 'GET',
        dataType: 'json',
        success: function (notifications) {
          const notificationList = $('#notification-list');
          notificationList.empty();

          if (notifications.length === 0) {
            notificationList.append('<li>No new notifications</li>');
            return;
          }

          notifications.forEach(notification => {
            let notificationHtml = '';
            if (notification.status === 'Pending' || notification.status === 'Ready For Pickup') {
              notificationHtml = `
                            <a data-transaction-id="${notification.transaction_id}" class="seen-notif" style="text-decoration:none;" href="adminPODetails.php?transaction_id=${notification.transaction_id}">
                              <li>
                                  <span class="notification-category purchase">
                                      <i class="fas fa-shopping-cart"></i> Purchase Order
                                  </span>
                                  ${notification.username} | #${notification.transaction_id} | ${notification.status}
                              </li>
                            </a>`;
            } else if (notification.status === 'Completed') {
              notificationHtml = `
                            <li class="seen-notif" data-transaction-id="${notification.transaction_id}">
                                <span class="notification-category sales">
                                    <i class="fas fa-dollar-sign"></i> Sales Order
                                </span>
                                ${notification.username} | #${notification.transaction_id} | ${notification.status}
                            </li>`;
            } else if (notification.status === 'Low Stock') {
              notificationHtml = `
                          <a class="seen-notif" data-variation-id="${notification.variation_id}"  style="text-decoration:none;" href="adminEditProduct.php?product_id=${notification.product_id}">
                            <li>
                                <span class="notification-category stock">
                                    <i class="fas fa-exclamation-triangle"></i> Low Stock
                                </span>
                                ${notification.product_name} | ${notification.variant} | Stock: ${notification.quantity}
                            </li>
                          </a>`;
            }

            notificationList.append(notificationHtml);
          });
        },
        error: function (xhr, status, error) {
          console.error('Error fetching notifications:', error);
          alert('Failed to fetch notifications.');
        }
      });
    }

    fetchNotifications();

    setInterval(fetchNotifications, 30000);
    $(document).on('click', '.seen-notif', function () {
      const transactionId = $(this).data('transaction-id');
      const variationId = $(this).data('variation-id');

      let tableToUpdate = '';
      if (variationId) {
        tableToUpdate = 'variations';
      } else {
        tableToUpdate = 'transactions';
      }

      $.ajax({
        url: './includes/updateSeen.php',
        method: 'POST',
        data: {
          transactionId: transactionId,
          variationId: variationId,
          table: tableToUpdate
        },
        success: function (response) {
          if (response === 'success') {
            alert('Status updated successfully');
            $(this).closest('li').remove();
          } else {
            alert('Failed to update status');
          }
        },
        error: function (xhr, status, error) {
          console.error('Error:', error);
          alert('An error occurred while updating the status');
        }
      });
    });
  });

</script>
</body>

</html>