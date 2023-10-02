<div class="wrap">

    <h2>My Setting</h2>

    <?php settings_errors( $this->_menuSlug, false, false );?>

    <p>Đây là trang hiển thị các cấu hình của NTK MyPlugin</p>
    <form method="post" action="options.php" id="" enctype="multipart/form-data">
        <?php echo settings_fields("ntk_mp_options");?>
        <?php echo do_settings_sections($this->_menuSlug);?>

        <!-- <?php  do_settings_fields($this->_menuSlug,'abc');?> -->
        <!-- <?php
        global $wpdb;

       echo  $table = $wpdb->prefix . 'test';

        $query = "SELECT * FROM {$table}";
      
        $info = $wpdb->get_results($query); // lấy ra duy nhất 1 cột tham số thứ 2 số cột muốn lấy

        echo '<pre>';
        print_r($info);
        echo '</pre>';
        ?> -->



        <!-- <p class="submit">
            <input id="btn-save-change" type="submit" name="submit" value="Save change" class="button button-primary">
        </p> -->
    </form>

</div>