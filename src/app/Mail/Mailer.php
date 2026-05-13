<?php

declare(strict_types=1);

namespace Meridian\Mail;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    /**
     * Throw a contact-form notification to the site owner
     *
     * @param array $data
     * @return boolean true on success, false on failure
     */
    public static function sendContactNotification(array $data): bool
    {
        $mail = new PHPMailer(true); // true = throw exception

        try {
            // --- Transport: --------------------------------------------------------
            if (defined('MAIL_HOST') && MAIL_HOST !== '') {
                $mail->isSMTP();
                $mail->Host        = MAIL_HOST;
                $mail->SMTPAuth    = true;
                $mail->Username    = MAIL_USER;
                $mail->Password    = MAIL_PASS;
                $mail->SMTPSecure  = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port        = (int) MAIL_PORT;
            } else {
                $mail->isMail();
            }

            $mail->setFrom(MAIL_FROM, MAIL_NAME);
            $mail->addAddress(MAIL_FROM, MAIL_NAME);
            $mail->addReplyTo(filter_var($data['email'], FILTER_SANITIZE_EMAIL), htmlspecialchars($data['name'], ENT_QUOTES));

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'New Enquiry via Meridian FMS Website';
            $mail->Body = self::renderTemplate($data);
            $mail->AltBody = self::plainBody($data);

            $mail->send();
            return true;
        } catch (\Exception $e) {
            error_log('[Meridian Mailer]' . $mail->ErrorInfo);
            return false;
        }
    }


    // Private helpers ---------------------------------------------------------------


    private static function renderTemplate(array $data): string
    {
        // Extract so the template uses $name, $email, $phone, $message directly. 


        $name     = htmlspecialchars($data['name'], ENT_QUOTES);
        $email    = htmlspecialchars($data['email'], ENT_QUOTES);
        $phone    = htmlspecialchars($data['phone'] ?? '', ENT_QUOTES) ?: 'Not Provided';
        $message = nl2br(htmlspecialchars($data['message'], ENT_QUOTES));


        ob_start();
        include __DIR__ . '/templates/contact-notification.php';
        return ob_get_clean();
    }


    private static function plainBody(array $data): string
    {
        $phone = ($data['phone'] ?? '') ?: 'Not Provided';
        return implode("\n", [
            'NEW INQUIRY - MERIDIAN FMS WEBSITE',
            str_repeat('-', 40),
            'Name:    ' . $data['name'],
            'Email:   ' . $data['email'],
            'Phone:   ' . $phone,
            '',
            'Message:',
            $data['message'],
        ]);
    }
}
