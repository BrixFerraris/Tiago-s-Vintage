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
    <span class="notification-badge">3</span>
  </div>
  <div class="notification-dropdown">
    <ul>
      <li>
        <span class="notification-category purchase"><i class="fas fa-shopping-cart"></i> Purchase Order</span>
        username, order id, status
      </li>
      <li>
        <span class="notification-category purchase"><i class="fas fa-shopping-cart"></i> Purchase Order</span>
        username, order id, status (ordered)
      </li>
      <li>
        <span class="notification-category purchase"><i class="fas fa-shopping-cart"></i> Purchase Order</span>
        username, order id, status (payment successful)
      </li>
      <li>
        <span class="notification-category purchase"><i class="fas fa-shopping-cart"></i> Purchase Order</span>
        Clark | #1111 | Paid
      </li>
      <li>
        <span class="notification-category purchase"><i class="fas fa-shopping-cart"></i> Purchase Order</span>
        Clark | #2222 | Ordered
      </li>

      <li>
        <span class="notification-category sales"><i class="fas fa-dollar-sign"></i> Sales Order</span>
        username, order id, status (completed)
      </li>
      <li>
        <span class="notification-category sales"><i class="fas fa-dollar-sign"></i> Sales Order</span>
        Clark | #3333 | Completed
      </li>

      <li>
        <span class="notification-category stock"><i class="fas fa-exclamation-triangle"></i> Low Stock</span>
        product id or name, current stock level
      </li>
      <li>
        <span class="notification-category stock"><i class="fas fa-exclamation-triangle"></i> Low Stock</span>
        Levi's Pants | #123 | Stock: 3
      </li>

      <li>
        <span class="notification-category purchase"><i class="fas fa-shopping-cart"></i> Purchase Order</span>
        Clark | #1111 | Paid
      </li>
      <li>
        <span class="notification-category purchase"><i class="fas fa-shopping-cart"></i> Purchase Order</span>
        Clark | #2222 | Ordered
      </li>
      <li>
        <span class="notification-category stock"><i class="fas fa-exclamation-triangle"></i> Low Stock</span>
        Levi's Pants | #123 | Stock: 3
      </li>
      <li>
        <span class="notification-category sales"><i class="fas fa-dollar-sign"></i> Sales Order</span>
        Clark | #3333 | Completed
      </li>
      <li>
        <span class="notification-category purchase"><i class="fas fa-shopping-cart"></i> Purchase Order</span>
        Clark | #2222 | Ordered
      </li>
      <li>
        <span class="notification-category purchase"><i class="fas fa-shopping-cart"></i> Purchase Order</span>
        Clark | #2222 | Ordered
      </li>
      <li>
        <span class="notification-category stock"><i class="fas fa-exclamation-triangle"></i> Low Stock</span>
        Levi's Pants | #123 | Stock: 3
      </li>
      <li>
        <span class="notification-category sales"><i class="fas fa-dollar-sign"></i> Sales Order</span>
        Clark | #3333 | Completed
      </li>
      <li>
        <span class="notification-category purchase"><i class="fas fa-shopping-cart"></i> Purchase Order</span>
        Clark | #2222 | Ordered
      </li>
      <li>
        <span class="notification-category purchase"><i class="fas fa-shopping-cart"></i> Purchase Order</span>
        Clark | #2222 | Ordered
      </li>
      <li>
        <span class="notification-category stock"><i class="fas fa-exclamation-triangle"></i> Low Stock</span>
        Levi's Pants | #123 | Stock: 3
      </li>
      <li>
        <span class="notification-category sales"><i class="fas fa-dollar-sign"></i> Sales Order</span>
        Clark | #3333 | Completed
      </li>
      <li>
        <span class="notification-category purchase"><i class="fas fa-shopping-cart"></i> Purchase Order</span>
        Clark | #2222 | Ordered
      </li>


    </ul>
  </div>
</div>


<main class="main-container">
  <div class="main-title">
    <p class="font-weight-bold">DASHBOARD</p>
  </div>

  <div class="main-cards">

    <div class="card">
      <div class="card-inner">
        <p class="text-primary">PRODUCTS</p>
      </div>
      <span id="total-products" class="text-primary font-weight-bold">249</span>
    </div>

    <div class="card">
      <div class="card-inner">
        <p class="text-primary">PURCHASE ORDERS</p>
      </div>
      <span id="total-purchase-orders" class="text-primary font-weight-bold">83</span>
    </div>

    <div class="card">
      <div class="card-inner">
        <p class="text-primary">SALES ORDERS</p>
      </div>
      <span id="total-sales-orders" class="text-primary font-weight-bold">79</span>
    </div>

    <div class="card">
      <div class="card-inner">
        <p class="text-primary">INVENTORY ALERTS</p>
      </div>
      <span id="inventory-alert" class="text-primary font-weight-bold">56</span>
    </div>

  </div>

  <div class="charts">

    <div class="charts-card">
      <p class="chart-title">Top 5 Products</p>
      <div id="bar-chart"></div>
    </div>

    <div class="charts-card">
      <p class="chart-title">Purchase and Sales Orders</p>
      <div id="area-chart"></div>
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
$(document).ready(function () {
  $.ajax({
    url: './includes/getDashboard.php',
    method: 'GET',
    dataType: 'json',
    success: function(data) {
      $('#total-products').text(data.unique_products);
      $('#total-sales-orders').text(data.completed_transactions);
      $('#inventory-alert').text(data.low_stock_variations);
    }
  });
});
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

  // ---------- CHARTS ----------

  // BAR CHART

        // Your bar chart options
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

        const getTopProducts = () => {
            $.ajax({
                type: 'GET', 
                url: './includes/getTopProducts.php',
                dataType: 'json',
                success: function(response) {
                    const productCounts = response.map(product => product.count);
                    const productNames = response.map(product => product.product_name);
                    barChartOptions.series[0].data = productCounts;
                    barChartOptions.xaxis.categories = productNames;
                    barChart.updateOptions(barChartOptions);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', status, error);
                }
            });
        };
        getTopProducts();
  

  // AREA CHART
  const areaChartOptions = {
    series: [
      {
        name: 'Purchase Orders',
        data: [31, 40, 28, 51, 42, 109, 100],
      },
      {
        name: 'Sales Orders',
        data: [11, 32, 45, 32, 34, 52, 41],
      },
    ],
    chart: {
      height: 350,
      type: 'area',
      toolbar: {
        show: false,
      },
    },
    colors: ['#4f35a1', '#246dec'],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: 'smooth',
    },
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
    markers: {
      size: 0,
    },
    yaxis: [
      {
        title: {
          text: 'Purchase Orders',
        },
      },
      {
        opposite: true,
        title: {
          text: 'Sales Orders',
        },
      },
    ],
    tooltip: {
      shared: true,
      intersect: false,
    },
  };

  const areaChart = new ApexCharts(
    document.querySelector('#area-chart'),
    areaChartOptions
  );
  areaChart.render();



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

</script>
</body>

</html>