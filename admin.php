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
            // array($this, 'create_input'),
            array($this, 'create_form'),
            $this->_menuSlug,
            $idMainSection,
            array('name' => 'new_title_input')
        );



    }

    public function main_section_view() {
        
    }

    public function create_form($args)
    {
        $htmlObj = new ZendvnHtml();

        if ($args['name'] == 'new_title_input') {

            $attr = array(
                'id' =>'ntk_mp_new_title',
                'class' =>'abc',
                'style' => 'width:300px',
            );



           echo $htmlObj->textbox("ntk_mp_name[ntk_mp_new_title]", "this is a test");
          
        }

       
        
    }
    //===============================================
    //Kiem tra cac dieu kien truoc khi luu du lieu vao database
    //===============================================
    public function validate_setting($data_input)
    {
       

        return $data_input; // lưu vào database

    }

    //===============================================
    //Kiem tra phần mở rộng của file
    //===============================================
    private function fileExtionsValidate($file_name, $file_type)
    {
        $flag = false;

        $pattern = '/^.*\.(' . strtolower($file_type) . ')$/i'; //$file_type = JPG|PNG|GIF
        if (preg_match($pattern, strtolower($file_name)) == 1) {
            $flag = true;
        }

        return $flag;
    }
    //===============================================
    //Kiem tra chieu chieu dai cua chuoi
    //===============================================
    private function stringMaxValidate($val, $max)
    {
        $flag = false;

        $str = trim($val);
        if (strlen($str) <= $max) {
            $flag = true;
        }
        return $flag;
    }





    public function settingMenu()
    {

        add_menu_page('My Setting title', 'My Setting', 'manage_options', $this->_menuSlug, array($this, 'settingPage'));
    }
    

    public function settingPage()
    {
        require_once NTK_MP_VIEWS_DIR . '/setting-page-setting.php';
    }
}