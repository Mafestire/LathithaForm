<?php

/*
 * Plugin Name:       Lathitha Contact Form 
 * Description:       Dark Themed Contact Form.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Sibabalwe Mafestire
 */


function Contactform(){

    $content = '';
    $content .= '<style>';
    $content .= '.form-container {';
    $content .= '    width: 80%;';
    $content .= '    margin: 0 auto;';
    $content .= '}';
    $content .= '.first-row, .second-row {';
    $content .= 'display: flex;';
    $content .= 'justify-content: space-around;';
    $content .= '}';
    $content .= 'input[type="text"], input[type="email"], select{';
    $content .= '    width: 90% !important;';
    $content .= '   height: 40px;';
    $content .= '    padding: 10px;'; 
    $content .= '    margin-bottom: 10px;';
    $content .= '    border: 1px solid white;'; 
    $content .= '    color: white;';
    $content .= '    background-color: transparent;';
    $content .= '}';
    $content .= 'textarea {';
    $content .= '    width: 100% !important;';
    $content .= '   height: 100px;';
    $content .= '    padding: 10px;'; 
    $content .= '    margin-bottom: 10px;';
    $content .= '    border: 1px solid white;'; 
    $content .= '    color: white;';
    $content .= '    background-color: transparent;';
    $content .= '}';
    $content .= '</style>';




    $content .= '<div class="form-container">';
    $content .= '<form method="post" action="https://formspree.io/f/mlekqqjp" >';
    
    $content .= '<div class="first-row">';
    // Name
    $content .= '<input type="text" name="name" placeholder="Enter your name" style="width: 95%;">';

    // Email
    $content .= '<input type="email" name="email" placeholder="Email Address" style="width: 95%; margin-left: 4%;">';
    $content .= '</div>';

    $content .= '<br />';
    $content .= '<div class=" second-row">';
    // Phone
    $content .= '<input type="phone" name="phone" id="phone" placeholder="Phone Number" style="width: 95%; width: 90% !important;
    height: 40px;
    padding: 10px; 
    margin-bottom: 10px;
    border: 1px solid white;
    color: white;
    background-color: transparent">';

    // Select Button
    $content .= '<select name="service" id="services" style="width: 95%; margin-left: 4%;">';
    $content .= '<option value="design"> Graphic Design </option>';
    $content .= '<option value="development"> Web Development </option>';
    $content .= '<option value="maintenance"> Web Maintenance </option>';
    $content .= '</select>';
    $content .= '</div>';
    // textarea
    $content .= '<textarea name="message" placeholder="Message..." style="margin-top: 3%;"></textarea>';
    // Button
    $content .= '<input type="submit" name="send" value="Submit" style="margin-top: 3%; background-color: #2E2F31;  color: #DC143C;
    padding: 10px 20px;
    border: 2px solid #DC143C;
    align-item: center;
    font-family: "Lato", sans-serif;
    cursor: pointer;">';

    $content .= '</form>';
    $content .= '</div>';

    return $content;
};

add_shortcode('contact', 'Contactform');

function capture(){

    if(array_key_exists('send', $_POST)){
        $to = "seabaraven@gmail.com";
        $subject = "Lathitha";
        $body = '';

        $body .= 'service: '.$_POST['service']. ' <br /> ';
        $body .= 'Name: '.$_POST['name']. ' <br /> ';
        $body .= 'Email: '.$_POST['email'].' <br /> ';
        $body .= 'Message: '.$_POST['message'].' <br />';

           // Debug output
           error_log('Email body: ' . $body);

           $headers = array('Content-Type: text/html; charset=UTF-8');


           $sent = wp_mail($to, $subject, $body, $headers);
   
           if ($sent) {
               error_log('Email sent successfully');
           } else {
               error_log('Failed to send email');
           };

        // wp_mail($to,$subject,$body);
    };
};

add_action('wp_head', 'capture');
?>