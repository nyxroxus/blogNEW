<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <label>
        <input type="text" class="search-field f1 tc default-clean-color"
            style="width:500px; height:80px;"
            placeholder="<?php echo esc_attr_x( 'search', 'placeholder' ) ?>"
            value="<?php the_search_query(); ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    </label><br><br>
    <input type="hidden" value="post" name="post_type" id="post_type" />
    <input type="submit" class="dn"
        value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
</form>
