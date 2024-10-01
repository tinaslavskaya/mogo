<!DOCTYPE html>
<html <?php language_attributes() ?>>
  <head>
    <meta charset="UTF-8"/>
    <meta charset="<?php bloginfo(); ?>">
    <title><?php bloginfo() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php wp_head() ?>
  </head>
  <body <?php body_class(); ?> >
    <header class="header">
      <div class="header_main_row">
        <h1 class="logo_wrap header_mod">
          
            <?php if(has_custom_logo()) : ?>
                <a href="/" class="logo_text header_mod"><?php mogo_prefix_the_custom_logo(); else: ?></a>
                <a href="/" class="logo_text header_mod"><?php bloginfo(); ?></a>
            <?php endif; ?>  
       
        </h1>
      </div>
      <div class="menu_trigger_wrap">
        <div id="menu_trigger" class="menu_trigger"><span class="menu_trigger_decor"></span></div>
      </div>
      <nav class="header_menu_row">

          <?php wp_nav_menu([
            'menu' => 'header_menu',
            'container' => false,
            'menu_class' => 'header_menu_list',
            'walker' => new Mogo_Header_Menu()

          ]); ?>
      </nav>
    </header> 
    <?php echo '<pre>' ?>
    <?php //print_r(get_theme_mods() )?>
     <?php echo '</pre>' ?>
