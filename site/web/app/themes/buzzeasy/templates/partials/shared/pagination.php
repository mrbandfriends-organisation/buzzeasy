<?php
    use Roots\Sage\Utils;

    $max_number_page = ( !empty($max_number_pages) ? $max_number_pages : 1 );

        $big = 999999999; // need an unlikely integer

        $pagination_args = array (
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'current'   => max( 1, get_query_var('paged') ),
            'total'     => $max_number_page,
            'type'      => 'array',
            // 'prev_text' => __('Prev'),
            // 'next_text' => __('Next'),
            'prev_text' => '<span class="pagination__arrow pagination__arrow--prev">' . Utils\icon('arrow', 'Pagination arrow', 'svg-icon--primary') . '</span>',
            'next_text' => '<span class="pagination__arrow pagination__arrow--next">' . Utils\icon('arrow', 'Pagination arrow', 'svg-icon--primary') . '</span>',
            'mid_size'  => 1,
            'end_size'  => 1
        );

        $pagination = paginate_links( $pagination_args );

    if ( !empty( $pagination ) ) {
        $prev = array_shift( $pagination );
        $next = array_pop( $pagination );
    }
?>


<?php if ( !empty( $pagination ) ): ?>
    <div class="band pagination-container">
        <ul class="pagination">
            <li class="pagination__item pagination__item--prev">
                <?php echo $prev; ?>
            </li>

            <?php foreach ( $pagination as $link ): ?>
                <li class="pagination__item pagination__item--number">
                    <?php echo $link; ?>
                </li>
            <?php endforeach; ?>

            <li class="pagination__item pagination__item--next">
                <?php echo $next; ?>
            </li>
        </ul>
    </div>
<?php endif; ?>
