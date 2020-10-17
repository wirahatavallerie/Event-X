<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event X</title>
    <link rel="stylesheet" href="style.css">
    <?php wp_head();?>
</head>
<body>
    <div class="body">
    <div class="featured">
        <div class="sidebar">
            <div class="bar-btn">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <div class="side-bar">
                <div class="close-btn-sidebar">
                    <div class="close"></div>
                    <div class="close"></div>
                    <div class="close"></div>
                </div>
                <div class="menu-header__small">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'header_menu'
                        ]);
                        ?>
                </div>
                <div class="sponsor-title">Sponsor</div>
                <div class="sponsor">
                    <div class="sponsor-list">
                    <?php 
                        dynamic_sidebar('sponsor')
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="logo">
            <a href="<?php echo site_url('/');?>"><img src="<?php echo get_theme_file_uri('/img/logo.png');?>" class="logo-desc"></img></a>
        </div>
        <div class="menu-right">
            <div class="menu-header">
                <?php
                wp_nav_menu([
                    'theme_location' => 'header_menu'
                    ]);
                    ?>
            </div>
            <?php
                if(!is_user_logged_in()){?>
                    <a class="login" href="<?php echo wp_login_url();?>">Login</a>
                <?php }else{ ?>
                    <a class="login" href="<?php echo wp_logout_url();?>">Logout</a>
                <?php }
            ?>
        </div>
    </div>