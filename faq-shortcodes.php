<?php

/*
Plugin Name: GrowthRocks - FAQ Shortcodes
Plugin URI: 
Description: Display a listing of custom post types with FAQ Schema. 
Version: 1.0.0
Author: Chris Saliampoukos
Author URI: https://growthrocks.com/
*/ 

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wp_enqueue_style( 'gr-movies-sync-css', plugin_dir_url( __FILE__ ). 'faq_generate.css', [], FALSE ); 

add_action( 'admin_menu', 'faq_submenu' );

function faq_submenu(){

	add_submenu_page(
		'tools.php', // parent page slug
		'FAQ Generator',
		'FAQ Generator',
		'manage_options',
		'faq_generator',
		'faq_page_callback',
		0 // menu position
	);
}

function faq_page_callback(){
    ?>
    <h1> FAQ Generator </h1> 
    <p> FAQ Shortcodes for Wordpress. </p> 

    <h2> Description </h2> 
    <p> Shortocodes that generates <br> 
       1) A list of Custom Post Types with a FAQ Schema Markup as described in the official Google Search Central Documentation:  https://developers.google.com/search/docs/appearance/structured-data/faqpage
        <br>
        2) An FAQ Schema Markup. Use the second shortcode only for single post template.
    </p>

    <h2> How to use it </h2> 
    <p> Theere are two types of shortcode you can use and their formats are the below:  <br> <br>
     <strong> [faq_generate post='' number='' heading='' accordion='' answer-field=''] </strong>
     <br>
     <strong> [faq_generate_single heading='' answer-field=''] </strong>
     <br>
     where attributes mean: 
     <ul> 
        <li>post -> the slug of any post type you want to display (ex. 'post' || 'faq') </li>
        <li>number -> the number of posts you want to display </li>
        <li>heading -> The HTML Heading of the Question (h1, h2, h3 etc) </li>
        <li>accordion -> Whether you want to display your FAQ as accordion or just plain Question and answer. (It can take values of 1 or 0) </li>
        <li>answer-field -> The custom field of post where answer is saved </li>
    </ul>
    <br> 
    The default attributes' values are: <br>
    <strong> [faq_generate post='post' number='5' heading='h3' accordion='0' answer-field='answer'] </strong>
    <br> 
    <strong> [faq_generate_single heading='h1'  answer-field='answer'] </strong>

<br> 
That means that you can use any of the attributes you want or none of them (just [faq_generate])

        
    </p> 
    <?php

}

include 'functions.shortcodes.php';

