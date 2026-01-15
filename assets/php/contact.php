<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require_once 'vendor/autoload.php';
    
   
    $recipientEmail = 'admin@zealhealthcare.cl';

    $recipientName = 'Zeal Healthcare Contact';


    // Form data validation and sanitization
    $senderName = isset($_POST['name']) ? $_POST['name'] : '';
    $senderPhone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $senderaddress = isset($_POST['address']) ? $_POST['address'] : '';
    $senderEmail = isset($_POST['email']) ? $_POST['email'] : '';
    $senderMessage = isset($_POST['message']) ? $_POST['message'] : '';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp-relay.brevo.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '9eb669001@smtp-brevo.com';
        $mail->Password   = 'E0XtqAINV6MwxJ17';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        // Enable verbose debug output (comment out in production)
        // $mail->SMTPDebug = 2;
        
        //Recipients
        $mail->setFrom('chetan.upare1234@gmail.com', 'Zeal Healthcare Contact Form');
        $mail->addReplyTo($senderEmail, $senderName);
        $mail->addAddress($recipientEmail, $recipientName);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Inquiry from ' . $senderName;
        
        // Modern HTML Email Template with Zeal Healthcare Branding
        $mail->Body = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap");
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
            background-color: #f5f5f5;
            line-height: 1.6;
        }
    </style>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; background-color: #f5f5f5;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #f5f5f5; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table cellpadding="0" cellspacing="0" border="0" width="600" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 15px rgba(32, 50, 64, 0.1); overflow: hidden; border: 1px solid #e0e0e0;">
                    
                    <!-- Header with Logo -->
                    <tr>
                        <td style="background-color: #203240; padding: 40px 30px; text-align: center;">
                            <img src="https://www.zealhealthcare.cl/assets/img/logo/Logo-RTM2.png" alt="Zeal Healthcare" style="max-width: 200px; height: auto; margin-bottom: 15px;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 600; letter-spacing: 0.5px;">New Contact Inquiry</h1>
                            <p style="color: #b8c5d0; margin: 10px 0 0 0; font-size: 14px;">You have received a new message from your website</p>
                        </td>
                    </tr>
                    
                    <!-- Content Section -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td style="padding-bottom: 30px;">
                                        <p style="color: #203240; font-size: 16px; margin: 0 0 20px 0; line-height: 1.6;">
                                            Hello,<br><br>
                                            A new contact form submission has been received through your website. Please find the details below:
                                        </p>
                                    </td>
                                </tr>';
        
        // Contact Details
        if ($senderName) {
            $mail->Body .= '
                                <tr>
                                    <td style="padding: 15px 20px; background-color: #f8f9fa; border-left: 4px solid #203240; margin-bottom: 12px;">
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tr>
                                                <td style="width: 120px; vertical-align: top;">
                                                    <strong style="color: #203240; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Name</strong>
                                                </td>
                                                <td style="color: #333333; font-size: 15px; font-weight: 500;">
                                                    ' . htmlspecialchars($senderName) . '
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td style="height: 12px;"></td></tr>';
        }
        
        if ($senderEmail) {
            $mail->Body .= '
                                <tr>
                                    <td style="padding: 15px 20px; background-color: #f8f9fa; border-left: 4px solid #203240; margin-bottom: 12px;">
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tr>
                                                <td style="width: 120px; vertical-align: top;">
                                                    <strong style="color: #203240; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Email</strong>
                                                </td>
                                                <td style="color: #333333; font-size: 15px;">
                                                    <a href="mailto:' . htmlspecialchars($senderEmail) . '" style="color: #203240; text-decoration: none; font-weight: 600;">' . htmlspecialchars($senderEmail) . '</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td style="height: 12px;"></td></tr>';
        }
        
        if ($senderPhone) {
            $mail->Body .= '
                                <tr>
                                    <td style="padding: 15px 20px; background-color: #f8f9fa; border-left: 4px solid #203240; margin-bottom: 12px;">
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tr>
                                                <td style="width: 120px; vertical-align: top;">
                                                    <strong style="color: #203240; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Phone</strong>
                                                </td>
                                                <td style="color: #333333; font-size: 15px;">
                                                    <a href="tel:' . htmlspecialchars($senderPhone) . '" style="color: #203240; text-decoration: none; font-weight: 600;">' . htmlspecialchars($senderPhone) . '</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td style="height: 12px;"></td></tr>';
        }
        
        if ($senderaddress) {
            $mail->Body .= '
                                <tr>
                                    <td style="padding: 15px 20px; background-color: #f8f9fa; border-left: 4px solid #203240; margin-bottom: 12px;">
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tr>
                                                <td style="width: 120px; vertical-align: top;">
                                                    <strong style="color: #203240; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Address</strong>
                                                </td>
                                                <td style="color: #333333; font-size: 15px;">
                                                    ' . nl2br(htmlspecialchars($senderaddress)) . '
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td style="height: 12px;"></td></tr>';
        }
        
        if ($senderMessage) {
            $mail->Body .= '
                                <tr>
                                    <td style="padding: 15px 20px; background-color: #f8f9fa; border-left: 4px solid #203240;">
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tr>
                                                <td style="width: 120px; vertical-align: top;">
                                                    <strong style="color: #203240; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Message</strong>
                                                </td>
                                                <td style="color: #333333; font-size: 15px; line-height: 1.7;">
                                                    ' . nl2br(htmlspecialchars($senderMessage)) . '
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>';
        }
        
        $mail->Body .= '
                            </table>
                            
                            <!-- Action Button -->
                            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-top: 35px;">
                                <tr>
                                    <td align="center">
                                        <a href="mailto:' . htmlspecialchars($senderEmail) . '" style="display: inline-block; padding: 14px 35px; background-color: #203240; color: #ffffff; text-decoration: none; border-radius: 5px; font-size: 15px; font-weight: 600; letter-spacing: 0.5px; box-shadow: 0 3px 10px rgba(32, 50, 64, 0.3);">Reply to ' . htmlspecialchars($senderName) . '</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #203240; padding: 25px 30px; text-align: center;">
                            <p style="color: #b8c5d0; font-size: 13px; margin: 0 0 8px 0; line-height: 1.5;">
                                This email was sent from the contact form on<br>
                                <a href="https://www.zealhealthcare.cl" style="color: #ffffff; text-decoration: none; font-weight: 600;">www.zealhealthcare.cl</a>
                            </p>
                            <p style="color: #8895a0; font-size: 12px; margin: 15px 0 0 0;">
                                © ' . date('Y') . ' Zeal Healthcare. All rights reserved.
                            </p>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';

        if (!$mail->send()) {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $mail->ErrorInfo . '</div>';
        } else {
            // Redirect to contact page with success message
            header('Location: ../contact.html?success=true');
            exit;
        }
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert">Message could not be sent. Error: ' . $mail->ErrorInfo . '</div>';
    }

?>
