<?php
/*
Plugin Name:Wpease advanced widgets
Plugin URI:http://wpease.com/plugins/wpease-advanced-widgets/
Description:
version:beta
Author:Wpease Team.
*/
require(ABSPATH.'wp-config.php');
require(ABSPATH . "wp-content/plugins/wpease-advanced-widgets/widgets.php");
define('WIDGETPREFIX','__wpease_advanced_widgets_options');

class wpease_advanced_widgets{
	
	private $__all_widgets;
	
	
	
	private function __deactive_widget($widget_name)
	{
		$__all_widgets[$widget_name]['widget_status']=0;
	}
	
	private function __active_widget($widget_name)
	{
		$__all_widgets[$widget_name]['widget_status']=1;
	
	}
	
	private function __init(){
		$options=get_option(WIDGETPREFIX);
		if(!$options){
			$options=array(
					"advanced_categories" =>array(
						"widget_status" => 1,
						"widget_name"	=> 'Wpease Advanced Category',
						"widget_description" => ''
					),
					"advanced_rencent_posts" =>array(
						"widget_status" => 1,
						"widget_name"	=> 'Wpease Advanced Recent Posts',
						"widget_description" => ''
					)
			);
		} 
		$this->__all_widgets=$options;
	}
	public function setup()
	{
		$this->__init();
		if(is_array($this->__all_widgets)&&count($this->__all_widgets)>0)
		{
			foreach($this->__all_widgets as $widget_slug => $widget)
			{
				add_action('widgets_init', create_function('', 'return register_widget("'.$widget_slug.'");'));
			}
		}
	}	
} 
$wpease_advanced_widgets=new wpease_advanced_widgets();
$wpease_advanced_widgets->setup();  
?>