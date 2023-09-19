<div class="wrap">

    <h2>My Setting</h2>

    <!-- <?php settings_errors( $this->_menu_slug, false, false );?> -->

    <p>Đây là trang hiển thị các cấu hình của NTK MyPlugin</p>
    <form method="post" action="options.php" id="" enctype="multipart/form-data">
        <?php echo settings_fields("ntk_mp_options");?>
        <?php echo do_settings_sections($this->_menuSlug);?>

        <!-- <?php  do_settings_fields($this->_menuSlug,'abc');?> -->

        <p class="submit">
            <input id="btn-save-change" type="submit" name="submit" value="Save change" class="button button-primary">
        </p>
    </form>

</div>