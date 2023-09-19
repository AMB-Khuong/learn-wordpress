<?php
require_once NTK_MP_PLUGIN_DIR . '/includes/support.php';



//setting API là tập hợp các phương thức 1 số hàm trước khi đưa vào bảng wp_option
///*Setting Register/Unregister     *Add field/Section
///-register_setting()               -add_settings_field($id,$title,$callback,$page,$section,$args)  tạo ra input selecbox radio này nọ
///-unregister_setting()             -add_settings_sections($id,$title,$callback,$page) id section title ten section $callback ham su xu $page trang hoac menu_slug

///*Options Form Rendering            *Error
///-setting_fields()                 -add_settings_error()
///-do_settings_sections()            -get_settings_errors()
///-do_settings-fields               -settings_errors()
class NtkMpAdmin
{

    private $_menuSlug = 'ntk-mp-my-setting';

    private $_settingOptions;


    public function __construct()
    {
        $this->_settingOptions = get_option('ntk_mp_name', array());



        add_action('admin_menu', array($this, 'settingMenu'));
        add_action('admin_init', array($this, 'register_setting_and_fields'));
    }

    public function register_setting_and_fields()
    {
        register_setting('ntk_mp_options', 'ntk_mp_name', array($this, 'validate_setting'));

        //MAIN SETTING
        $idMainSection = 'ntk_mp_main_section';

        add_settings_section($idMainSection, 'Main Setting', array($this, 'main_section_view'),  $this->_menuSlug);

        add_settings_field(
            'ntk_mp_new_title',
            'Site title',
            array($this, 'create_input'),
            $this->_menuSlug,
            $idMainSection
        );


        add_settings_field(
            'ntk_mp_logo',
            'Logo',
            array($this, 'logo_input'),
            $this->_menuSlug,
            $idMainSection
        );
    }

    public function validate_setting($data_input)
    {
        echo '<pre>';
        print_r($data_input);
        echo '</pre>';
        if (!empty($_FILES['ntk_mp_logo']['name'])) {
            if (!empty($this->_settingOptions['ntk_mp_logo_path'])) {

                $override = array('test_form' => false);
                $time = "2000/08";
                $fileInfo = wp_handle_upload($_FILES['ntk_mp_logo'], $override, $time);
                $data_input['ntk_mp_logo'] = $fileInfo['url'];
                $data_input['ntk_mp_logo_path'] = $fileInfo['file'];
            }
        }


        return $data_input; // lưu vào database

    }



    public function main_section_view()
    {
    }

    public function create_input()
    {
        echo '<input type="text" name="ntk_mp_name[ntk_mp_new_title]" value="' .  $this->_settingOptions['ntk_mp_new_title'] . '"/>';
    }

    public function logo_input()
    {

        echo '<input type="file" name="ntk_mp_logo" value=""/>';
        if (!empty($this->_settingOptions['ntk_mp_logo'])) {
            echo "</br></br><img src='" . $this->_settingOptions['ntk_mp_logo'] . "' width='200' />";
        }
    }

    public function settingMenu()
    {

        // add_menu_page('My Setting title', 'My Setting', 'manage_options', $this->_menuSlug,array($this,'settingPage'));
        add_options_page('My Setting title', 'My Setting', 'manage_options', $this->_menuSlug, array($this, 'settingPage'));
    }

    public function settingPage()
    {
        require_once NTK_MP_VIEWS_DIR . '/setting-page-setting.php';
    }
}