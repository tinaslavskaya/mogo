<?php
/** Template name: Service Template
*
*/
get_header();
?>

<?php 
  $service_section_title = get_field('service_section_title');
  $service_class = ['photo_mod','design_mod', 'comp_mod', 'seo_mod', 'html_mod', 'digit_mod'];
  $services_img_i = 0;

  $arrg = array(
    'post_status' => 'publish',
    'post_type' => 'service',
    'order' => 'ASC',
    'posts_per_page' => 6,    
  );
      
  $query = new WP_Query(  $arrg );
  $count_posts = wp_count_posts('service')->publish;   

  $service_section_title2 = get_field('service_section_title_2');
  $service_block = get_field('service_block');
  $service_accordion_class = ['photo_mod', 'creative_mod', 'design_mod'];
  $service_accordion_i = 0;
?>

<section id="service" class="section">
        <h2 class="section_title">
        <?php if( !empty($service_section_title['service_title_1']) || !empty($service_section_title['service_title_2'])) : ?>
          <span class="title1"><?php echo $service_section_title['service_title_1'] ?></span> <!-- We work with -->
          <span class="title2"><?php echo $service_section_title['service_title_2'] ?></span><!-- Amazing services  -->
        <?php else: echo ''; ?>  
        <?php endif; ?>
        </h2>
                

        <ul class="services_list">
          <?php  if( $count_posts >= 3 && $count_posts <= 6) : ?>
          <?php   // The Loop
            while ( $query->have_posts() ): $query->the_post();  
              ?>
              <li class="services_l_item">
                <div class="service_block <?php echo $service_class[$services_img_i]; ?>">
                  <h3 class="service_title"><?php echo get_the_title() ;?></h3>
                  <div class="service_text">
                    <p><?php echo get_the_content(); ?></p>
                  </div>
                </div>
              </li>
              <?php $services_img_i++; ?>
            <?php endwhile; wp_reset_postdata();?>
          <?php else: echo 'Добавьте список мин. 3, макс. 6 елементов'; 
          endif;   ?>
          <?php wp_reset_postdata(); ?> 
        </ul>
</section>

<section class="section">
        <h2 class="section_title">
        <?php if( !empty($service_section_title2['service_title_3']) || !empty($service_section_title2['service_title_4'])) : ?>  
          <span class="title1"><?php echo $service_section_title2['service_title_3']; ?></span>
          <span class="title2"><?php echo $service_section_title2['service_title_4']; ?></span>
        <?php else: echo ''; ?>  
        <?php endif; ?>  
        </h2>
        <div class="section_descr">
        <?php if( !empty( $service_section_title2['service_text'])) : ?>   
          <p><?php echo  $service_section_title2['service_text']; ?></p>
        <?php else: echo ''; ?>  
        <?php endif; ?>   
        </div>
        <div class="what">
          <figure class="image_wrap what_mod">
            <img src="<?php echo $service_block['service_image']; ?>" class="img">
          </figure>
          <ul class="accordion">
            <?php foreach($service_block['service_accordion'] as $service_block_list) : ?>
            <li class="accordion_item">
              <h3 class="accordion_title <?php echo $service_accordion_class[$service_accordion_i] ?>"><?php echo $service_block_list['accordion_title']; ?></h3>
              <div class="accordion_content">
                <p><?php echo $service_block_list['accordion_description']; ?></p>
              </div>
            </li>
            <?php  $service_accordion_i++; ?>  
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
          </ul>
        </div>
</section>

<?php get_footer(); ?>

