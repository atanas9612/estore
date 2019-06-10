<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP Commerce
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header">
        <?php  get_template_part('template-parts/header/header','top');?>
        <div class="m-header">
            <div class="container">
                <?php   get_template_part('template-parts/header/header','middle');   ?>
            </div>
        </div>
        <div class="b-header">
            <?php get_template_part('template-parts/header/header','bottom');   ?>
        </div>
    </header>
    <?php if( is_home() || (!is_front_page())):?>
    <section class="t-breadcrumb">
        <div class="container">
          <nav aria-label="breadcrumb">
            <?php wp_commerce_inner_breadcrumb();?>
        </nav>
    </div>
</section>
<?php endif;?>