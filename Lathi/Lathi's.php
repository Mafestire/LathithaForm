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
    $content .= '    max-width: 600px;';
    $content .= '    margin: 0 auto;';
    $content .= '}';
    // $content .= 'label {';
    // $content .= '    font-weight: bold;';
    // $content .= '    font-family: "Noto Sans", sans-serif;'; 
    // $content .= '    color: white;'; // Set label color to white
    // $content .= '}';
    $content .= 'input[type="text"], input[type="email"], textarea {';
    $content .= '    width: 100%;';
    $content .= '    padding: 10px;';
    $content .= '    margin-bottom: 10px;';
    $content .= '    border: 1px solid white;'; // Set input field border color to white
    $content .= '    color: white;'; // Set input field text color to white
    $content .= '    background-color: transparent;'; // Set input field background color to transparent
    $content .= '}';
    $content .= 'input[type="submit"] {';
    $content .= '    background-color: #0F77BE;';
    $content .= '    color: white;';
    $content .= '    padding: 10px 20px;';
    $content .= '    border: none;';
    $content .= '    border-radius: 5%;'; 
    $content .= '    font-family: "Lato", sans-serif;';
    $content .= '    cursor: pointer;';
    $content .= '}';
    $content .= '</style>';




    $content .= '<div class="form-container">';
    $content .= '<form method="post" action="https://formspree.io/f/mlekqqjp" >';
    
    // $content .= '<br />';
    $content .= '<input type="text" name="name" placeholder="Enter your name">';

    $content .= '<br />';
    $content .= '<input type="email" name="email" placeholder="Email Address>';

    $content .= '<br />';
    $content .= '<input type="phone" name="phone" placeholder="Phone Number>';

    $content .= '<select name="service" id="services">';
    $content .= '<option value="design"> Web Design </option>';
    $content .= '<option value="development"> Web Development </option>';
    $content .= '<option value="maintanance"> Web Maintanance </option>';
    $content .= '</select>';

    $content .= '<br />';
    $content .= '<textarea name="message" placeholder="Message...">';

    $content .= '<input type="submit" name="send" value="Submit">';

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
        $body .= 'Message: '$_POST['message'].' <br />';

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