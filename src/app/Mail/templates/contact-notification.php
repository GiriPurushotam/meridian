<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<?php

/**
 * @var string $name
 */ ?>

<body style="margin:0;padding:0;background:#f4f7fb;font-family:Arial,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f7fb;padding:40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:8px;overflow:hidden;
                    box-shadow:0 2px 12px rgba(0,0,0,0.08);">

                    <!-- Header -->
                    <tr>
                        <td style="background:#00529B;padding:28px 36px;">
                            <h1 style="margin:0;color:#ffffff;font-size:22px;font-weight:700;">
                                New Enquiry — Meridian FMS
                            </h1>
                            <p style="margin:6px 0 0;color:#d0e8ff;font-size:13px;">
                                Submitted via the website contact form
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:32px 36px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding:10px 0;border-bottom:1px solid #e8eef6;color:#5A6A80;font-size:13px;width:110px;">Name</td>
                                    <td style="padding:10px 0;border-bottom:1px solid #e8eef6;color:#1A2E4A;font-size:15px;font-weight:600;"><?= $name ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 0;border-bottom:1px solid #e8eef6;color:#5A6A80;font-size:13px;">Email</td>
                                    <td style="padding:10px 0;border-bottom:1px solid #e8eef6;color:#1A2E4A;font-size:15px;">
                                        <?php /** @var string $email */ ?>
                                        <a href="mailto:<?= $email ?>" style="color:#00529B;"><?= $email ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 0;border-bottom:1px solid #e8eef6;color:#5A6A80;font-size:13px;">Phone</td>
                                    <?php /** @var string $phone */ ?>
                                    <td style="padding:10px 0;border-bottom:1px solid #e8eef6;color:#1A2E4A;font-size:15px;"><?= $phone ?></td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 0 4px;color:#5A6A80;font-size:13px;vertical-align:top;">Message</td>
                                    <?php /** @var string $message */ ?>
                                    <td style="padding:14px 0 4px;color:#1A2E4A;font-size:15px;line-height:1.6;"><?= $message ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#F0F7FF;padding:18px 36px;border-top:3px solid #94B730;">
                            <p style="margin:0;color:#5A6A80;font-size:12px;">
                                Reply directly to this email to respond to the enquiry.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>