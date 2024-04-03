<style>
    .card {
        background-color: #fff;
        border: none;
        color: #000;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        /* x-offset y-offset blur-radius spread-radius color */
    }

    .card-header {
        background-color: #699E3C;
        border: none;
        color: #ffffff;
        font-weight: bolder;
    }

    .card-body {
        padding: 20px;
    }
</style>

<h4>Dashboard</h4>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card p-4 h-100">
                <div class="card-header">
                    Sales Summary
                </div>
                <div class="card-body">
                    <h5>Total Sales</h5>
                    <p>₱ <?= $total_sales ?></p>
                    <h5>Today's Sales</h5>
                    <p>₱ <?= $total_sales_today ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-4 h-100">
                <div class="card-header">
                    Products
                </div>
                <div class="card-body">
                    <h5>Available Products</h5>
                    <p><?= $total_prod ?></p>
                    <h5>Out of Stock</h5>
                    <p><?= $out_off_stock ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-4 h-100">
                <div class="card-header">
                    Orders
                </div>
                <div class="card-body">
                    <h5>Pending Orders</h5>
                    <p><?= $pending_po ?></p>
                    <h5>Completed Orders</h5>
                    <p><?= $completed_po ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-4 h-100">
                <div class="card-header">
                    Inventory
                </div>
                <div class="card-body">
                    <h5>Total Inventory</h5>
                    <p><?= $total_prod ?></p>
                    <h5>Low Stock Items</h5>
                    <p><?= $low_stocks ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bar Graph -->
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Sales Chart
                </div>
                <div class="card-body">
                    <canvas id="salesChart" class="bar-chart" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Critical Levels
                </div>
                <div class="card-body">
                    <canvas id="criticalLevelsChart" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Bar Chart Data
        var ctx = document.getElementById("salesChart").getContext('2d');

        // Assuming you have fetched the monthly sales data from the backend
        var monthlySalesData = <?php echo json_encode($monthly_sales); ?>;

        var labels = [];
        var data = [];

        monthlySalesData.forEach(function(item) {
            labels.push(monthName(item.month));
            data.push(item.monthly_sales);
        });

        var salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Monthly Sales',
                    data: data,
                    backgroundColor: 'rgb(167,167,167)',
                    borderColor: 'rgba(97, 93, 95, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return '₱' + value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); // Format as currency
                            },
                            color: 'black' // set y-axis label color to black
                        }
                    },
                    x: {
                        ticks: {
                            color: 'black' // set x-axis label color to black
                        }
                    }
                },
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                color: 'black' // set legend label color to black
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += '₱' + context.formattedValue.replace(/\d(?=(\d{3})+\.)/g, '$&,'); // Format as currency
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Function to convert month number to month name
        function monthName(monthNumber) {
            var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            return monthNames[monthNumber - 1];
        }


        // Assuming $low_stock_products is the variable passed from the controller
        var lowStockProducts = <?php echo json_encode($lowStockProducts); ?>;

        // Sort low stock products by quantity in descending order
        lowStockProducts.sort(function(a, b) {
            return b.product_quantity - a.product_quantity;
        });

        // Take the top 5 products
        var top5Products = lowStockProducts.slice(0, 5);

        // Extract product names and quantities from top5Products
        var productNames = top5Products.map(function(product) {
            return product.product_name;
        });

        var productQuantities = top5Products.map(function(product) {
            return product.product_quantity;
        });

        // Pie Chart Data
        var ctx2 = document.getElementById("criticalLevelsChart").getContext('2d');
        var salesDistributionChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: productNames,
                datasets: [{
                    data: productQuantities,
                    backgroundColor: ["#a7a7a7", "#b4b4b4", "#c0c0c0", "#cdcdcd", "#dadada"]
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                color: 'black' // set legend label color to black
                            }
                        }
                    }
                }
            }
        });
    </script>