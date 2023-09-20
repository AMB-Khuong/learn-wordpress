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


        add_settings_field(
            'ntk_mp_logo',
            'Logo',
            // array($this, 'logo_input'),
            array($this, 'create_form'),
            $this->_menuSlug,
            $idMainSection,
            array('name' => 'logo_input')
        );

        //   $tmp = get_settings_errors($this->_menuSlug);
        //  echo '<pre>';
        //  print_r($tmp);
        //  echo '</pre>';
    }

    public function create_form($args)
    {
        if ($args['name'] == 'new_title_input') {
            echo '<input type="text" name="ntk_mp_name[ntk_mp_new_title]"
            value="' . $this->_settingOptions['ntk_mp_new_title'] . '"/>';
            echo '<p class="description">Nhập vào một chuỗi không quá 20 ký tự</p>';
        }

        if ($args['name'] == 'logo_input') {
            echo '<input type="file" name="ntk_mp_logo" />';
			echo '<p class="description">Chỉ được phép upload các tập tin có định dang JPG - PNG - GIF</p>';
			if(!empty( $this->_settingOptions['ntk_mp_logo'])){
				echo "<img src='" . $this->_settingOptions['ntk_mp_logo'] . "' width='200' />";
			}
        }
    }
    //===============================================
    //Kiem tra cac dieu kien truoc khi luu du lieu vao database
    //===============================================
    public function validate_setting($data_input)
    {
        $errors = array();

        if ($this->stringMaxValidate($data_input['ntk_mp_new_title'], 20) == false) {
            $errors['ntk_mp_new_title'] = "Site title: Chuoi dai qua so ky tu da qui dinh";
        }

        if (!empty($_FILES['ntk_mp_logo']['name'])) {
            if ($this->fileExtionsValidate($_FILES['ntk_mp_logo']['name'], "JPG|PNG|GIF") == false) {
                $errors['ntk_mp_logo'] = "Logo: Khong dung voi dinh dang da qui dinh";
            } else {
                if (!empty($this->_settingOptions['ntk_mp_logo_path'])) {
                    @unlink($this->_settingOptions['ntk_mp_logo_path']);
                }
                $override = array('test_form' => false);
                $time = "2000/08";
                $fileInfo = wp_handle_upload($_FILES['ntk_mp_logo'], $override, $time);
                $data_input['ntk_mp_logo'] = $fileInfo['url'];
                $data_input['ntk_mp_logo_path'] = $fileInfo['file'];
            }
        } else {
            $data_input['ntk_mp_logo']         = $this->_settingOptions['ntk_mp_logo'];
            $data_input['ntk_mp_logo_path']     = $this->_settingOptions['ntk_mp_logo_path'];
        }

        if (count($errors) > 0) {
            $data_input =  $this->_settingOptions;
            $strErrors = '';
            foreach ($errors as $key => $val) {
                $strErrors .= $val . '<br/>';
            }

            add_settings_error($this->_menuSlug, 'my-setting', $strErrors, 'error');
        } else {
            add_settings_error($this->_menuSlug, 'my-setting', 'Cap nhat du lieu thanh cong', 'updated');
        }
        //die();


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




    public function main_section_view()
    {
    }

    // public function create_input()
    // {
    //     echo '<input type="text" name="ntk_mp_name[ntk_mp_new_title]" value="' .  $this->_settingOptions['ntk_mp_new_title'] . '"/>';
    // }

    // public function logo_input()
    // {

    //     echo '<input type="file" name="ntk_mp_logo" value=""/>';
    //     if (!empty($this->_settingOptions['ntk_mp_logo'])) {
    //         echo "</br></br><img src='" . $this->_settingOptions['ntk_mp_logo'] . "' width='200' />";
    //     }
    // }

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