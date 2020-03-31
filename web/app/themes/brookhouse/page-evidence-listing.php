<?php
/* Template Name: Evidence Listing Template */

get_header();

?>

<?php get_sidebar(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main documents-main">
        <?php while (have_posts()) : the_post(); ?>

            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>

                <?php
                    $query = new WP_Query( array( 'post_type' => 'evidence', 'paged' => $paged ) );

                    if ( $query->have_posts() ) : ?>
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                        <div class="entry">
                            <h2 class="title"><?php the_title(); ?></h2>
                            <p>Evidence type: <?php the_field( "evidence_type_to_upload" ); ?></p>
                            <p>Evidence format: <?php the_field( "evidence_format" ); ?> </p>
                            <p>Witness type: <?php the_field( "evidence_witness_type" ); ?></p>
                            <p>Evidence publication date: <?php the_field( "evidence_publish_date" ); ?></p>
                            <button>View file: <?php the_field( "evidence_upload" ); ?></button>
                        </div>

                    <?php endwhile; wp_reset_postdata(); ?>
                    <!-- show pagination here -->
                <?php else : ?>
                    <!-- show 404 error here -->
            <?php endif; ?>

        <?php endwhile; // end of the loop. ?>
    </main>
</div>

<?php get_footer(); ?>



<ul>
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $evidence_url = get_post_meta(get_the_ID(), 'evidence_url', true);
            $evidence_video = get_post_meta(get_the_ID(), 'evidence_video', true);
            if ($evidence_video) {
                echo "<li><a href='' class='popup-video' data-video-id='" . $evidence_video . "'>" . get_the_title() . " (video)</a></li>";
            } elseif ($evidence_url) {
                $evidence_id = get_attachment_id_from_src($evidence_url);
                $evidence_size = round(filesize(get_attached_file($evidence_id)) / 1024);
                echo "<li><a href='" . $evidence_url . "' target='_blank'>" . get_the_title() . " (" . substr($evidence_url, -3) . ", " . $evidence_size . "kb)</a></li>";
            }
        }
    } else {
        echo "<li>No evidence available for this hearing</li>";
    }
    ?>
</ul>
