<?php
/** Template name: About Template
*
*/
get_header();
?>

<?php 

  $about_section_titles = get_field('about_section_titles'); 
  $about_section_description = get_field('about_section_description');
  $image = get_field('about_images');
  $group_list = get_field('about_list');

  $about_i = 1;
  $about_j = 1;
 ?>

<section id="about" class="section">

    <h2 class="section_title">
    <?php if($about_section_titles['about_title_1'] || $about_section_titles['about_title_2']): ?>  
      <span class="title1"><?php echo $about_section_titles['about_title_1'] ?><!--What we do --></span>
      <span class="title2"><?php echo $about_section_titles['about_title_2']; ?><!--Story About Us --></span>
    <?php else :  return;?>
    <?php endif; ?>   
    </h2>

    <div class="section_descr">
    <?php if($about_section_description) : ?>   
      <p><?php echo $about_section_description; ?></p>
    <?php else : echo '';?>
    <?php endif; ?>  
    </div> 

    <ul class="stories_list">  

      <?php foreach ( $image as $key => $value ) : ?>
      <?php if( $image['about_group_image_'.$about_j]['about_image_'.$about_j] && $image['about_group_image_'.$about_j]['about_caption_image_'.$about_j] )  : ?>     
        <li class="stories_l_item">
          <a href="#" class="image_link">
            <figure class="about_group_imageimage_wrap effect1_mod">
              <img src="<?php echo $image['about_group_image_'.$about_j]['about_image_'.$about_j]['url'] ?> " class="img" alt="<?php echo $image['about_group_image_'.$about_j]['about_caption_image_'.$about_j] ?>" />
              <figcaption class="image_caption story_mod">
                <?php echo $image['about_group_image_'.$about_j]['about_caption_image_'.$about_j] ?>  
              </figcaption>
            </figure>
          </a>
        </li> 
      <?php $about_j++; ?>
      <?php else: echo '' ; ?>      
      <?php endif; ?>      
      <?php endforeach; ?>  
      <?php wp_reset_postdata(); ?>
    </ul>
   
    <ul class="facts_list">
       
      <?php foreach ($group_list as $key => $value) : ?>
      <?php if( $group_list['group_list_'.$about_i]['about_list_text_'.$about_i] && $group_list['group_list_'.$about_i]['about_list_number_'.$about_i])  : ?>
        <li class="facts_l_item">
          <dl class="fact_block">
            <dt class="fact_text"><?php echo $group_list['group_list_'.$about_i]['about_list_text_'.$about_i]; ?></dt> 
            <!-- Web design projects / Happy clients / Award winner / Cup of coffee / Members -->
            <dd class="fact_num"><?php echo $group_list['group_list_'.$about_i]['about_list_number_'.$about_i]; ?></dd> 
            <!--42 / 125 / 15 / 99 / 24 -->
          </dl>
        </li>
      <?php $about_i++; ?>
      <?php else : echo ''; ?>  
      <?php endif; ?>
      <?php endforeach; ?> 
      <?php wp_reset_postdata(); ?>
    </ul>
   
</section>
<?php get_footer(); ?>