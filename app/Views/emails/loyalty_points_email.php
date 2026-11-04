<?php

/**
 * @var array $data
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title><?= $data['points_earned'] ?> points added for your last booking</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f3efe8;
        }

        table {
            border-collapse: collapse;
        }

        @media only screen and (max-width:620px) {
            .container {
                width: 100% !important;
            }

            .pad {
                padding-left: 24px !important;
                padding-right: 24px !important;
            }

            .btn a {
                display: block !important;
            }
        }
    </style>
</head>

<body style="margin:0;padding:0;background:#f3efe8;">

    <!-- Preheader (inbox preview text) -->
    <div style="display:none;max-height:0;overflow:hidden;opacity:0;color:#f3efe8;">
        We’ve added <?= $data['points_earned'] ?> points to your account for your last booking.
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f3efe8;">
        <tr>
            <td align="center" style="padding:32px 12px;">

                <table role="presentation" class="container" width="600" cellpadding="0" cellspacing="0" border="0" style="width:600px;max-width:600px;background:#ffffff;border-radius:6px;">

                    <!-- Logo -->
                    <tr>
                        <td class="pad" align="center" style="padding:32px 40px 8px 40px;font-family:Georgia,'Times New Roman',serif;font-size:22px;font-weight:bold;color:#1f4d3a;">
                            [Brand Name]
                        </td>
                    </tr>

                    <!-- Message -->
                    <tr>
                        <td class="pad" style="padding:24px 40px 24px 40px;font-family:Arial,Helvetica,sans-serif;font-size:16px;line-height:26px;color:#3b3833;">
                            Hi <?= $data['user_name'] ?>,<br><br>
                            Thanks for your recent booking with <?= env('app.name') ?>. We’ve added <strong><?= $data['points_earned'] ?></strong> points to your account for your last booking.
                        </td>
                    </tr>

                    <!-- Balance box -->
                    <tr>
                        <td class="pad" style="padding:0 40px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#eef4f0;border-left:4px solid #1f4d3a;">
                                <tr>
                                    <td style="padding:16px 24px;font-family:Arial,Helvetica,sans-serif;font-size:15px;line-height:24px;color:#3b3833;">
                                        Points added: <strong>+<?= $data['points_earned'] ?></strong><br>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Button -->
                    <tr>
                        <td class="pad btn" align="center" style="padding:28px 40px 28px 40px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" bgcolor="#1f4d3a" style="border-radius:4px;">
                                        <a href="<?= env('app.baseURL') ?>/userdashboard" target="_blank" style="display:inline-block;padding:14px 32px;font-family:Arial,Helvetica,sans-serif;font-size:16px;font-weight:bold;color:#ffffff;text-decoration:none;">View your rewards account</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Sign-off -->
                    <tr>
                        <td class="pad" style="padding:0 40px 36px 40px;font-family:Arial,Helvetica,sans-serif;font-size:16px;line-height:26px;color:#3b3833;">
                            Thanks for being part of our community,<br><br>
                            Best regards,<br>
                            <strong><?= env('app.name') ?></strong>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="pad" align="center" style="padding:20px 40px 28px 40px;border-top:1px solid #e6e1d8;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:18px;color:#8a857b;">
                            <?= env('app.name') ?><br>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>