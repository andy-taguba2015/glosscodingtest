<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="We Improve Thinking. You may not set strategy, but you make it happen! We are here to help you succeed.">
    <meta name="robots" content="index, follow">
    <title>Gloss Coding Test</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body>
    <section class="topbar">
        <i class="fab fa-facebook-f"></i>
        <i class="fab fa-linkedin-in"></i>
    </section>
    <header>
        <div class="logo"><?php the_field('logo'); ?></div>
        <nav>
         <?php
            $args = array(
                'menu_class' => '',
                'container_class' => '',
                'container_id' => '',
                'theme_location' => 'main_menu'        
        );
        wp_nav_menu($args);    
        ?>
            <button class="SignIn"><a href="#" alt="Sign In">Sign In</a></button>
        </nav>

    </header>


