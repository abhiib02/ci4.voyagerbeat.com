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
    <title>Happy Diwali! <?= $data['points_earned'] ?? 0 ?> gift points from <?= env('app.name') ?></title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #2a0f3d;
        }

        table {
            border-collapse: collapse;
        }

        a {
            color: #8a2b12;
        }

        @media only screen and (max-width:620px) {
            .container {
                width: 100% !important;
            }

            .pad {
                padding-left: 24px !important;
                padding-right: 24px !important;
            }

            .points-num {
                font-size: 44px !important;
            }

            .btn a {
                display: block !important;
            }
        }
    </style>
</head>

<body style="margin:0;padding:0;background:#2a0f3d;">

    <!-- Preheader (inbox preview text) -->
    <div style="display:none;max-height:0;overflow:hidden;opacity:0;color:#2a0f3d;">
        Happy Diwali! We’ve added <?= $data['points_earned'] ?? 0 ?> gift points to your account.
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#2a0f3d;">
        <tr>
            <td align="center" style="padding:32px 12px;">

                <table role="presentation" class="container" width="600" cellpadding="0" cellspacing="0" border="0" style="width:600px;max-width:600px;background:#fffaf0;border-radius:6px;">

                    <!-- Gold top strip -->
                    <tr>
                        <td height="6" style="height:6px;line-height:6px;font-size:0;background:#e8a317;border-radius:6px 6px 0 0;">&nbsp;</td>
                    </tr>

                    <!-- Header band -->
                    <tr>
                        <td class="pad" align="center" bgcolor="#2a0f3d" style="background:#2a0f3d;padding:32px 40px 28px 40px;">
                            <div style="font-family:Georgia,'Times New Roman',serif;font-size:16px;color:#f2c14e;padding-bottom:12px;"><?= env('app.name') ?></div>
                            <div style="font-size:44px;line-height:52px;">🪔</div>
                            <div style="font-family:Georgia,'Times New Roman',serif;font-size:34px;line-height:42px;color:#ffffff;padding-top:8px;">Happy Diwali, <?= $data['user_name'] ?? 'there' ?></div>
                            <div style="font-family:Arial,Helvetica,sans-serif;font-size:15px;line-height:22px;color:#f2c14e;padding-top:6px;">A festival gift, from us to you</div>
                        </td>
                    </tr>

                    <!-- Gold divider -->
                    <tr>
                        <td height="3" style="height:3px;line-height:3px;font-size:0;background:#e8a317;">&nbsp;</td>
                    </tr>

                    <!-- Intro -->
                    <tr>
                        <td class="pad" style="padding:32px 40px 24px 40px;font-family:Arial,Helvetica,sans-serif;font-size:16px;line-height:26px;color:#3a2a22;">
                            Hi <?= $data['user_name'] ?? 'there' ?>,<br><br>
                            As a Diwali thank you for being a loyal member of <?= env('app.name') ?>, we’ve added <strong><?= $data['points_earned'] ?? 0 ?> gift points</strong> directly to your account!
                        </td>
                    </tr>

                    <!-- Body copy -->
                    <tr>
                        <td class="pad" style="padding:24px 40px 8px 40px;font-family:Arial,Helvetica,sans-serif;font-size:16px;line-height:26px;color:#3a2a22;">
                            You can use your points right now on your next trip.
                        </td>
                    </tr>

                    <!-- Button -->
                    <tr>
                        <td class="pad btn" align="center" style="padding:16px 40px 32px 40px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" bgcolor="#8a2b12" style="border-radius:4px;">
                                        <a href="<?= env('app.baseURL') ?>/userdashboard" target="_blank" style="display:inline-block;padding:14px 32px;font-family:Arial,Helvetica,sans-serif;font-size:16px;font-weight:bold;color:#ffffff;text-decoration:none;">View your rewards account</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Sign-off -->
                    <tr>
                        <td class="pad" style="padding:0 40px 36px 40px;font-family:Arial,Helvetica,sans-serif;font-size:16px;line-height:26px;color:#3a2a22;">
                            Thanks for being part of our community. May your Diwali be filled with light, joy, and sweetness.<br><br>
                            Best regards,<br>
                            <strong><?= env('app.name') ?></strong>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="pad" align="center" style="padding:20px 40px 28px 40px;border-top:1px solid #efdfb8;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:18px;color:#8a7a68;">
                            <?= env('app.name') ?><br>
                            You’re receiving this email because you’re a booked trip with <?= env('app.name') ?>.<br>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>