<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <p></p>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="site-header">

<div class="logo">
    <?php
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        bloginfo('name');
    }
    ?>
</div>
	 <h1>
  <?php echo get_theme_mod('arsal_header_text', 'Welcome to My Website'); ?>
</h1>


    <nav class="main-nav">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'header-menu'
        ));
        ?>
    </nav>

</header>