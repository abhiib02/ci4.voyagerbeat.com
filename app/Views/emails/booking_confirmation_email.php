<?php

/**
 * @var object $data
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 30px;
            background-color: #f9f9f9;
        }

        h2 {
            color: #222;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        td,
        th {
            padding: 8px 6px;
            vertical-align: top;
        }

        th {
            text-align: left;
            background-color: #f0f0f0;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .footer {
            font-size: 12px;
            color: #555;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<?php
// php section

$perPersonSharing = json_decode($data->perPersonSharing, true);

$perPersonCost = json_decode($data->perPersonCost, true);

$gstCost = array_sum($perPersonCost) * GST;

$Balance = $data->total_package_cost - $data->amount;


$summary = [];

foreach ($perPersonSharing as $i => $raw) {
    $parts = explode('|', (string)$raw);

    // Use the 2nd part if it exists, otherwise fall back to the whole value
    $type = trim($parts[1] ?? $parts[0]);
    if ($type === '') {
        $type = 'Unknown';
    }

    // Safe numeric cost (strips commas, defaults to 0)
    $cost = isset($perPersonCost[$i])
        ? (float) str_replace(',', '', $perPersonCost[$i])
        : 0;

    if (!isset($summary[$type])) {
        $summary[$type] = ['count' => 0, 'total_cost' => 0];
    }

    $summary[$type]['count']++;
    $summary[$type]['total_cost'] += $cost;
}
?>

<body>
    <div class="container">
        <div class="logo">
            <img src="<?= getenv('app.LogoPath') ?>" alt="<?= getenv('app.Name') ?>" width="100">
            <h2>Booking Confirmation Receipt</h2>
            <p><strong><?= getenv('app.Name') ?></strong></p>
        </div>

        <h3>Customer Details</h3>
        <table>
            <tr>
                <td>Name</td>
                <td><?= esc($data->name) ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?= esc($data->email) ?></td>
            </tr>
            <tr>
                <td>Contact</td>
                <td><?= esc($data->contact) ?></td>
            </tr>
        </table>

        <h3>Booking Details</h3>
        <table>
            <tr>
                <td>Booking ID</td>
                <td><?= esc($data->ID) ?></td>
            </tr>
            <tr>
                <td>Order ID</td>
                <td><?= esc($data->order_id) ?></td>
            </tr>
            <tr>
                <td>Booking Date</td>
                <td><?= esc($data->created_at) ?></td>
            </tr>
        </table>

        <h3>Package Details</h3>
        <table>
            <tr>
                <td>Package ID</td>
                <td><?= esc($data->package_id) ?></td>
            </tr>
            <tr>
                <td>Package Name</td>
                <td><?= esc($data->package_name) ?></td>
            </tr>
            <tr>
                <td>Date of Travel</td>
                <td><?= esc($data->date) ?></td>
            </tr>
            <tr>
                <td>Adults</td>
                <td><?= esc($data->adults) ?></td>
            </tr>
        </table>

        <h3>Pricing Details</h3>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($summary as $type => $itemData): ?>
                    <tr>
                        <td><?= $itemData['count'] ?> x <?= $type ?></td>
                        <td>₹ <?= number_format($itemData['total_cost'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if ($data->gst_include): ?>
                    <tr>
                        <td>GST @ 5%</td>
                        <td>+ ₹ <?= number_format($gstCost, 2) ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($data->coupon_used): ?>
                    <tr>
                        <td>Coupon Applied (<?= $data->coupon_used ?>)</td>
                        <td>- ₹ <?= number_format($data->couponworth, 2) ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($data->points_used): ?>
                    <tr>
                        <td>Points Used </td>
                        <td>- ₹ <?= number_format($data->points_used, 2) ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <th>Total Payable</th>
                    <th>₹ <?= number_format($data->total_package_cost, 2) ?></th>
                </tr>

            </tbody>
        </table>

        <h3>Payment Details</h3>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Amount Paid</td>
                    <td>₹ <?= number_format($data->amount, 2) ?></td>
                </tr>
                <tr>
                    <th>BALANCE (To be paid 1 day prior to the trip)</th>
                    <th>₹ <?= number_format($Balance, 2) ?></th>
                </tr>

            </tbody>
        </table>

        <a style="font-size: 12px;" href="<?= esc($data->bookingConfirmationURL) ?>">Click here For All Details</a>
        <p style="font-size: 12px; color: #666;">* This is a system generated Booking Confirmation Receipt.</p>

        <div class="footer">
            <p>For any queries, please contact us at <a href="tel:<?= getenv('app.defaultContact') ?>"><?= getenv('app.defaultContact') ?></a> or mail us at <a href="mailto:<?= getenv('app.defaultMail') ?>"><?= getenv('app.defaultMail') ?></a></p>
        </div>
    </div>
</body>

</html>