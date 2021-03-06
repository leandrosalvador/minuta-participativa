<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

<div id="content" class="narrowcolumn" role="main">

  <div class="post">

    <?php if (have_posts()) : ?>

    <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
    <?php /* If this is a category archive */ if (is_category()) { ?>
    <h2 class="pagetitle">Lista de artigos para &#8216;<?php single_cat_title(); ?>&#8217;</h2>
    <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
    <h2 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
    <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
    <h2 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h2>
    <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
    <h2 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h2>
    <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
    <h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>
    <?php /* If this is an author archive */ } elseif (is_author()) { ?>
    <h2 class="pagetitle">Arquivo do autor</h2>
    <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
    <h2 class="pagetitle">Blog Archives</h2>
    <?php } ?>


    <div class="navigation">
      <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
      <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
    </div>

    <?php while (have_posts()) : the_post(); ?>
    <div class="archive-post">
      <h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
      <p class="date"><?php the_time('d/m/Y')?></p>

      <div class="entry">
        <?php the_content() ?>
      </div>

      <p class="postmetadata">
            <?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in
            <?php the_category(', ') ?> |
            <?php edit_post_link('Editar', '', ' | '); ?>
            <?php comments_popup_link('Nenhum comentário &#187;',
                                      '1 Comentário &#187;',
                                      '% Comentários &#187;'); ?>
          </p>

    </div>

    <?php endwhile; ?>

    <div class="navigation">
      <div class="alignleft"><?php next_posts_link('&laquo; Anteriores') ?></div>
      <div class="alignright"><?php previous_posts_link('Próximos &raquo;') ?></div>
    </div>
    <?php else :

  if ( is_category() ) { // If this is a category archive
    printf("<h2 class='center'>Desculpe, mas não há artigos pertencentes à categoria selecionada. </h2>", single_cat_title('',false));
  } else if ( is_date() ) { // If this is a date archive
    echo("<h2>Desculpe, mas não há artigos relativos a esta data.</h2>");
  } else if ( is_author() ) { // If this is a category archive
    $userdata = get_userdatabylogin(get_query_var('author_name'));
    printf("<h2 class='center'Desculpe, mas não há artigos pertencentes à %s ainda.</h2>", $userdata->display_name);
  } else {
    echo("<h2 class='center'>Nenhum artigo encontrado.</h2>");
  }
  get_search_form();

  endif;
    ?>

  </div>
</div>

<div id="widgets">
  <div id="sidebar2">
    <ul>
      <?php dynamic_sidebar('sidebar2'); ?>
    </ul>
  </div>
  <div id="sidebar">
    <ul>
      <?php dynamic_sidebar('sidebar1'); ?>
    </ul>
  </div>
</div>

<?php get_footer(); ?>
