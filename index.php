<?php 
/* 
Template name: Home Template
*/
get_header() ?>

<?php 
$team_block = get_field('team_block');
$team_web_link_class = ['facebook_mod', 'twitter_mod', 'instagram_mod','google-plus_mod'];
$team_web_link_i = 0;
$t = 1; 

$testimonials_block = get_field('testimonials_block');
$testimonials_position_i = 1;

?>

<div class="wrapper">
  <div class="base">
    <section id="home" class="section intro_mod" style="background: url(<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>)">
      <?php while ( have_posts() ) : the_post(); ?>     
        <h2 class="section_title intro_mod" style="color: #<?php echo get_theme_mod( 'header_textcolor') ?>">
          <span class="title1 intro_mod"><?php the_field('title1'); ?></span> <!-- Creative Template -->
          <span class="title2 intro_mod"><?php the_field('title2'); ?></span> <!-- Welcome To Mogo -->
        </h2>
      <?php endwhile;  ?>  
    </section>
    <!-- Team -->
    <section class="section">
        <?php 
          $team_arrg = array(
            'post_status' => 'publish',
            'post_type' => 'team',
            'order' => 'ASC',
            'posts_per_page' => -1,    
          );  
          $query_team = new WP_Query(  $team_arrg  ); 
          $count_posts_team = wp_count_posts('team')->publish;  
        ?>
        <h2 class="section_title">
          <?php if($team_block['team_block_title']['team_title_1'] || $team_block['team_block_title']['team_title_2']) : ?>
            <span class="title1"><?php echo $team_block['team_block_title']['team_title_1']; ?></span>
            <span class="title2"><?php echo $team_block['team_block_title']['team_title_2']; ?></span>
          <?php else: echo 'Добавьте заголовок'; ?>  
          <?php endif; ?>
        </h2>
        <div class="section_descr">
          <p><?php echo $team_block['team_block_text']; ?></p>
        </div>
        <ul class="team_list">
        <?php if( $count_posts_team >= 3) : ?>  
        <?php while($query_team->have_posts()) : $query_team->the_post();?>
          <li class="team_l_item">
            <div class="teammate_block">
              <figure class="image_wrap effect1_mod">
                <?php the_post_thumbnail('full', array('class'=>'img', 'title' => get_the_title(), 'alt' => get_the_title())); ?> 
                <figcaption class="image_caption"> 
                  <ul class="teammate_socials">
                  
                    <li class="teammate_s_item">
                        <?php foreach($team_block['team_block_list']['team_list_'.$t]['team_web_links'] as $team_link) : ?>
                        <?php if(!empty($team_link)) : ?>  
                         <a href="<?php echo $team_link ?>" class="teammate_s_link <?php echo $team_web_link_i < 4 ? $team_web_link_class[$team_web_link_i] : $team_web_link_class[$team_web_link_i = 0]; ?>"></a>                     
                        <?php endif; ?>  
                        <?php $team_web_link_i++; ?> 
                        <?php endforeach; ?>
                    </li>
                   
                  </ul>
                </figcaption>
              </figure>
              <span class="image_c_title"><?php echo the_title(); ?></span>
                <span class="image_c_text"><?php echo $team_block['team_block_list']['team_list_'.$t]['team_position'] ?></span>
            </div>
          </li>
        <?php $t++; ?>
        <?php endwhile; ?>
        <?php else: echo 'Добавьте запись минимум 3 ';  ?>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
        </ul>   
      </section>
      <!-- Testimonials -->
      <?php 
        $testimonials_arrg = array(
          'post_status' => 'publish',
          'post_type' => 'testimonials',
          'order' => 'ASC',
          'posts_per_page' => -1,    
        );  
        $query_testimonials = new WP_Query(  $testimonials_arrg  ); 
        $count_posts_testimonials = wp_count_posts('testimonials')->publish;  
      ?>
      <?php if(!empty($query_testimonials->have_posts())) : ?>
      <section class="section what_mod" style="background: url(<?php echo $testimonials_block['testimonials_background'] ?>)">
     
          <h2 class="section_title">
          <?php if(!empty($testimonials_block['testimonials_block_title'])) :?>  
            <span class="title1"><?php echo $testimonials_block['testimonials_block_title']['testimonials_title_1'] ?></span>
            <span class="title2"><?php echo $testimonials_block['testimonials_block_title']['testimonials_title_2'] ?></span>
          <?php endif; ?>  
          </h2>
          <div class="clients">
            <?php while($query_testimonials->have_posts()) : $query_testimonials->the_post(); ?>
            <div class="client_block">
              <div class="client_image">
                <?php the_post_thumbnail('full', array('class'=>'img', 'title' => get_the_title(), 'alt' => get_the_title())); ?>
              </div>
              <div class="text_wrap">
                <div class="image_c_title"><?php the_title(); ?></div>
                <?php if(!empty($testimonials_block['testimonials_block_position']['testimonials_position']['testimonials_position_'.$testimonials_position_i])) : ?>
                <div class="image_c_text"><?php echo $testimonials_block['testimonials_block_position']['testimonials_position']['testimonials_position_'.$testimonials_position_i]; ?>
                </div>
                <?php else: echo 'Введите Position'; ?>
                <?php endif; ?>
                <div class="text">
                  <p><?php the_content(); ?></p>
                </div>
              </div>
            </div>
            <?php $testimonials_position_i++; ?> 
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
          </div>
        </section>
      <?php endif; ?>
  </div>    
</div>

<?php get_footer() ?>