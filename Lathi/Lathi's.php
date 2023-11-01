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

    $content .= '<form method="post" action="https://formspree.io/f/mlekqqjp" >';
    
    $content .= '<br />';
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