<?php
/** Template name: Blog Template
*
*/
get_header();
?>
<?php 
$blog_title = get_field('blog_title');

$blog_arrg = array(
  'post_status' => 'publish',
  'post_type' => 'post',
  'order' => 'DESC',
  'posts_per_page' => 3,    
);
    
$blog_query = new WP_Query( $blog_arrg );
?>
<section id="blog" class="section">
  <h2 class="section_title">
    <span class="title1"><?php echo $blog_title['blog_title_1']; ?></span>
    <span class="title2"><?php echo $blog_title['blog_title_2']; ?></span>
  </h2>
  <ul class="recent_list">
    <?php if($blog_query->have_posts()) : ?>
    <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>  
    <li class="recent_item">
      <article class="post">
        <div class="image_wrap blog_mod">    
          <?php echo the_post_thumbnail('full', array( 'class' => 'img blog_mod', 'sizes' => '(max-width:400px)')); ?>
        </div>
        <h2 class="post_title"><a href="#" class="post_link"><?php the_title(); ?></a></h2>
        <div class="post_text">
          <p><?php the_content(); ?></p>
        </div>
        <a href="#" class="post_date">
          <span class="post_d_day"><?php echo get_the_date('d'); ?></span>
          <span class="post_d_month"><?php echo get_the_date('M'); ?></span>
        </a>
        <div class="post_stat_wrap"><a href="#views" class="post_stat views_mod">123</a><a href="#comments" class="post_stat comm_mod">20</a></div>
      </article>
    </li>
    <?php endwhile; ?>
    <?php endif; ?>
  </ul>
</section>

<?php get_footer(); ?>