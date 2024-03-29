<?php 
defined( 'ABSPATH' ) || exit;
get_header();
$post_id             = get_the_ID();
$author_id           = get_post_field('post_author', $post_id);
$comment_author_data = get_userdata($author_id);
$product_id          = get_post_meta($post_id, '_product_id', true);
$author_url          = get_author_posts_url($author_id);
$author_avatar       = get_avatar($author_id, 96);
$author_name         = $comment_author_data ? $comment_author_data->display_name : 'Anonymous';
$authors             = get_the_terms($product_id, 'authors');
$product             = wc_get_product($product_id);
$book_rating         = get_post_meta($post_id, '_review_rating', true);
$regular_price       = get_post_meta( $product_id, '_regular_price', true );
$sale_price          = get_post_meta( $product_id, '_sale_price', true );
?>

<section class="wp-single-wbr">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="wbr-review-content">
                    <div class="wbr-review-image">
                        <?php 
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('large', array('class' => 'img-fluid'));
                            }
                        ?>
                    </div>
                    <h2><?php echo wp_kses_post(get_the_title()); ?></h2>

                    <div class="wbr-product-user">
                        <?php echo get_avatar( $author_id, 32, '', '', ); ?>
                        <div class="wbr-product-team">
                            <h3>ফজর ফায়ার টীম</h3>
                            <p>মোট ২৩টি  রিভিউ লিখেছেন </p>
                        </div>
                        <button>বাটন থাকেত পাের</button>
                    </div>
                
                    <?php //if ($authors): ?>
                        <!-- <p class="wbr-product-authors">Product Authors:
                            <?php // foreach ($authors as $author): ?>
                                <a href="<?php //echo get_term_link($author); ?>"><?php //echo esc_html($author->name); ?></a>
                            <?php //endforeach; ?>
                        </p> -->
                    <?php //endif; ?>
                    
                    <div class="wbr-book-meta-info">
                        <div class="">
                        <!-- <h4><?php // echo get_the_title( get_the_ID()); ?> বই িনেয় টুকেরা কথা</h4> -->

                            <!-- <?php // echo get_avatar( $author_id, 32, '', '', array('class' => 'rounded-circle mr-2')); ?> -->
                            <!-- <p class="wbr-review-author"><a href="<?php //echo esc_url($author_url); ?>"><?php echo esc_html($author_name); ?></a></p> -->
                            <!-- <p class="m-0"><?php // echo esc_html(get_the_author()); ?></p> -->
                            <!-- <p class="m-0"><?php //echo count_user_posts($author_id, 'review' ); ?> Posts</p> -->

                            <div class="reviewer-rating">
                                <h4>রেটিং দিয়েছেন</h4>
                                <?php 
                                    $rating = intval($book_rating); // Convert rating to an integer
                                    $filled_stars = min(5, max(0, $rating)); // Ensure the rating is between 0 and 5

                                    for ($i = 0; $i < $filled_stars; $i++) {
                                        echo '<i class="fas fa-star text-warning"></i>';
                                    }

                                    for ($i = $filled_stars; $i < 5; $i++) {
                                        echo '<i class="far fa-star text-warning"></i>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="wbr-book-review-box">
                        <div class="review-header">
                            <h5>যে বই সম্পর্কে রিভিউ লেখা হয়েছে</h5>
                        </div>
                        <div class="review-book-img">
                            <img src="https://cdn.pixabay.com/photo/2015/11/19/21/10/glasses-1052010_640.jpg" alt="">
                        </div>
                        <div class="book-info">
                            <ul>
                                <li>বই: হায়াতের দিন ফুরালে</li>
                                <li>লেখক: আরিফ আজাদ</li>
                                <li>বিষয়: আত্মশুদ্ধি</li>
                            </ul>
                        </div>
                        <div class="book-price">
                            <ul>
                                <li>মোট রিভিউ: ১২০ টি  (4.8 এর রেটিং )</li>
                                <li>মূল্য: <del>৩৩০ টাকা</del>/২৩৫ টাকা</li>
                            </ul>
                            <div class="price-btn">
                                <button>বইটি  কিনুন </button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="reviewed-book-info">
                        <h4><?php // echo esc_html( get_the_title( $product_id ) ); ?></h4>
                            <div class="review-book-image">
                                <?php // echo get_the_post_thumbnail( $product_id, 'thumbnail' ); 
                                // echo esc_html( get_the_title( $product_id ) );
                                    if( ! empty( $authors ) || is_countable( $authors ) || is_object( $authors ) ){
                                        foreach ( $authors as $author): ?>
                                        <a href="<?php //echo get_term_link($author); ?>"><?php //echo esc_html($author->name); ?></a>
                                        <?php endforeach; 
                                    }

                                    $categories = get_the_terms( $product_id, 'product_cat' );
                                    if( ! empty( $categories ) || is_countable( $categories ) || is_object( $categories ) ){
                                    foreach ( $categories as $cat ): ?>
                                        <a href="<?php //echo get_term_link($cat); ?>"><?php //echo esc_html($cat->name); ?></a>
                                    <?php endforeach;
                                    }

                                    $total_review =  wpr_get_total_review_and_average( $product_id );

                                // echo '<p>Total reviews' . $total_review['total_reviews'] . '</p>';
                                    //echo '<p>Average rating' . $total_review['average_rating'] . '</p>';

                                    if( ! empty( $regular_price ) ) {
                                    // echo '<p>Regular Price: ' .  wc_price( $regular_price ) . '</p>';
                                    }

                                    if( ! empty( $sale_price ) ) {
                                    // echo '<p>Sale Price: ' .  wc_price( $sale_price ) . '</p>';
                                    }

                                ?>

                            </div>
                    </div> -->
                    <div class="wbr-review-text">
                        <p><?php echo wp_kses_post(get_the_content()); ?></p>
                    </div>
                </div>
                <?php 
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>
            </div>
        </div>
    </div>
<?php include __DIR__ . '/views/single/related-review.php'; ?>
</section>

<?php get_footer(); ?>