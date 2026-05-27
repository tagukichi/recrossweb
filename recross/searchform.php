<?php
/**
 * Search form
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="screen-reader-text" for="search-input">検索</label>
    <input type="search" id="search-input" class="search-form__input" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="サイト内検索…">
    <button type="submit" class="search-form__submit">検索</button>
</form>
