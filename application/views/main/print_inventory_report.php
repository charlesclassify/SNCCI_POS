<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Products</title>
    <style>
        /* Define print styles */
        @media print {
            body {
                font-family: Arial, sans-serif;
                font-size: 14px;
                line-height: 1.5;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            th,
            td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }
        }

        /* Hide sidebar and navbar in print view */
        @media print {

            .navbar,
            #layoutSidenav_nav {
                display: none;
            }
        }
    </style>
</head>

<body>
    <img src="<?php echo base_url('assets/images/GFI.jpg'); ?>" alt="Company Logo" style="display: block; margin: 0 auto; width:400px;height:80px;">
    <h1 style="text-align: center;">INVENTORY REPORT</h1>
    <table>
        <tr>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Product Brand</th>
            <th>Product Quantity</th>
            <th>UOM</th>
            <th>Selling Price</th>
        </tr>
        <?php if (isset($product) && !empty($product)) { ?>
            <?php foreach ($product as $key => $pro) { ?>
                <tr>
                    <td class="text-center"><?= $pro->product_code ?></td>
                    <td class="text-center"><?= $pro->product_name ?></td>
                    <td class="text-center"><?= $pro->product_brand ?></td>
                    <td class="text-center"><?= $pro->product_quantity ?></td>
                    <td class="text-center"><?= $pro->product_uom ?></td>
                    <td class="text-center">₱<?= $pro->product_price ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>