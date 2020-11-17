<div class="comments-wrap">

    <div id="comments" >
        <div class="col-full">

            <h2 class="h2">

                <?php

                $writy_comment_num = get_comments_number();
                if ($writy_comment_num <= 1) {
                    echo esc_html($writy_comment_num) . __(' Comment', 'writy');
                } else {
                    echo esc_html($writy_comment_num) . __(' Comments', 'writy');
                }
                ?>

            </h2>

            <!-- commentlist -->
            <ol class="writy_commentlist">
                <?php

                wp_list_comments();

                ?>

            </ol> <!-- end commentlist -->

            <div class="comments-pagination">
                <?php

                the_comments_pagination(array(
                    'screen_reader_text' => __('Comments navigation', 'writy'),
                ))



                ?>
            </div>
            <!-- respond
                    ================================================== -->
            <div class="respond">

                <h3 class="h2"><?php _e('Add Comment', 'writy'); ?></h3>

                <?php

                comment_form();
                ?>
            </div> <!-- end respond -->

        </div> <!-- end col-full -->

    </div> <!-- end row comments -->
</div> <!-- end comments-wrap -->