<?php 
class Nkt_Mp_Widget_Simple extends WP_Widget {
    public function __construct() {
        $id_base = 'ntk-mp-widget-simple';
        $name = "NTK Simple Widget";
        $widget_options = array(
              'classname' => 'ntk-mp-wg-css-simple',
              'description' => 'Day la mot widget don gian'
        );
        $control_options = array('width'=>'250px');

        parent::__construct($id_base, $name,$widget_options, $control_options);
        
    }

    public function widget($arg,$instance) {

    }

    public function form($instance) {

    }

    public function update($new_instance,$old_instance){
        
    }
}