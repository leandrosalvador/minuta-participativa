<?php get_header(); ?>

<div id="content">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div class="post">
    <h2><?php the_title(); ?></h2>
    <p class="date"><?php the_time('d/m/Y')?></p>
    <?php the_content('<p class="serif">Leia mais &raquo;</p>'); ?>
    <?php wp_link_pages(array('before'         => '<p><strong>Pages:</strong> ',
                              'after'          => '</p>',
                              'next_or_number' => 'number')); ?>
  </div><!-- fim .post -->
  <?php endwhile; endif; ?>

  <?php get_sidebar(); ?>

</div><!-- fim #content -->

<?php get_footer(); ?>
