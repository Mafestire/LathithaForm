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
    $content .= '    align-items: center;';
    $content .= '    justify-content: center;';
    $content .= '}';
    $content .= '.first-row, .second-row {';
    $content .= 'display: flex;';
    $content .= 'justify-content: space-around;';
    $content .= '}';
    $content .= 'input[type="text"], input[type="email"], input[name="phone", textarea, select{';
    $content .= '    width: 90% !important;';
    $content .= '   height: 40px;';
    $content .= '    padding: 10px;';
    $content .= '    margin-bottom: 10px;';
    $content .= '    border: 1px solid white;'; // Set input field border color to white
    $content .= '    color: white;'; // Set input field text color to white
    $content .= '    background-color: transparent;'; // Set input field background color to transparent
    $content .= '}';
    $content .= ' .second-row {';
    $content .= '   margin-bottom: 3rem;';
    $content .= '}';
    $content .= 'input[type="submit"] {';
    $content .= '    background-color: #2E2F31;';
    $content .= '    color: #DC143C;';
    $content .= '    padding: 10px 20px;';
    $content .= '    border: 2px solid #DC143C;';
    $content .= '   align-item: center;';
    $content .= '    font-family: "Lato", sans-serif;';
    $content .= '    cursor: pointer;';
    $content .= '}';
    $content .= '</style>';




    $content .= '<div class="form-container">';
    $content .= '<form method="post" action="https://formspree.io/f/mlekqqjp" >';
    
    $content .= '<div class="first-row">';
    $content .= '<input type="text" name="name" placeholder="Enter your name" style="width: 90%;">';

    $content .= '<input type="email" name="email" placeholder="Email Address" style="width: 90%;">';
    $content .= '</div>';

    $content .= '<br />';
    $content .= '<div class=" second-row">';
    $content .= '<input type="phone" name="phone" placeholder="Phone Number" style="width: 90%;">';

    $content .= '<select name="service" id="services" style="width: 90%;">';
    $content .= '<option value="design"> Graphic Design </option>';
    $content .= '<option value="development"> Web Development </option>';
    $content .= '<option value="maintenance"> Web Maintenance </option>';
    $content .= '</select>';
    $content .= '</div>';

    $content .= '<textarea name="message" placeholder="Message..."></textarea>';
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