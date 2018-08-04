<?php 
/******************
 * Vinova Themes  Framework for Prestashop 1.7.x 
 * @package   	novpagemanage
 * @version   	1.0
 * @author   	http://vinovathemes.com/
 * @copyright 	Copyright (C) October 2013 vinovathemes.com <@emai:vinovathemes@gmail.com>
 * <info@vinovathemes.com>.All rights reserved.
 * @license   GNU General Public License version 1
 
 * *****************/
 
use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
require_once (_PS_MODULE_DIR_.'smartblog/classes/SmartBlogPost.php');
require_once (_PS_MODULE_DIR_.'smartblog/smartblog.php');
if( !class_exists("Megablog_list") ){
class Megablog_list extends Megasource {
	
	public $type = 'blog_list';
	public function renderForm($data){
			$helper = new HelperForm();
			$hook = Tools::getValue('hook');
			$id_novpagemanage = Tools::getValue('id_novpagemanage') ? Tools::getValue('id_novpagemanage') : 0;
			
			$active = array(
				array(
					'id' => 'active_on',
					'value' => 1,
					'label' => $this->l('Enabled')
				),
				array(
					'id' => 'active_off',
					'value' => 0,
					'label' => $this->l('Disabled')
				)
			);
			
			$list_style = array(
			  array(
				'value' => 'type_grid',
				'name' 	=> 	$this->l('Type Grid')
			  ),
			  array(
				'value' => 'type_list',
				'name' 	=> 	$this->l('Type List')
			  ),
			  array(
				'value' => 'type_slider',
				'name' 	=> 	$this->l('Type Slider')
			  )
			);


			$this->fields_form[0]['form'] = array (
				'tinymce' => true,
	            'legend' => array(
	                'title' => $this->l('Blog List.'),
	            ),
	            'input' => array(
					array(
	                    'type' => 'text',
	                    'label' => $this->l('Blog List Title'),
	                    'name' => 'title',
	                    'default'=> '',
						'required'=> true,
	                    'lang'	=> true
	                ),
	                array(
	                    'type' => 'text',
	                    'label' => $this->l('Sub Title'),
	                    'name' => 'sub_title',
	                    'default'=> '',
	                    'lang'	=> true
	                ),
					array(
	                    'type' => 'text',
	                    'label' => $this->l('Class'),
	                    'name' => 'class',
	                    'default'=> '',
	                ),
					array(
						'type' => 'switch',
						'label' => $this->l('Show Title'),
						'name' => 'show_title',
						'values' => $active,
						'default' => 1,
					),
					array(
						'type' => 'select',                              
						'label' => $this->l('Colums Of Pages'),         
						'desc' => $this->l('The maximum colums in Page  (default: 12), cus-5 support for 5 column in 1 row' ), 
						'name' => 'columns',   
						'default' => 12,		                          
						'options' => array(
						'query' => $this->columns,                          
						'id' => 'value',                           
						'name' => 'value'                               
					  )
					),
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Limit'),
	                    'name'  => 'itab',
	                    'default'=> 6,
						'desc'  => $this->l('The number of products in Tab (default: 6).')
	                ),

	                array(
					  'type' => 'select',                              
					  'label' => $this->l('List Style'),
					  'name' => 'list_style',   
					  'default' => 'item_grid',		                          
					  'options' => array(
						'query' => $list_style,
						'id' => 'value',
						'name' => 'name'
					  )
					),

	                array(
	                    'type'  => 'text',
	                    'label' => $this->l('Number row'),
	                    'name'  => 'number_row',
	                    'default'=> 1,
						'desc'  => $this->l('The number of row in list product (default: 1).')
	                ),
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Column on Desktop'),
	                    'name'  => 'icolumn',
	                    'default'=> 3,
						'desc'  => 'The column products in Page (default: 3).'
	                ),
	                array(
	                    'type'  => 'text',
	                    'label' => $this->l('Column on Tablets'),
	                    'name'  => 'column_tablet',
	                    'default'=> 3,
						'desc'  => 'The column products on Tablets (default: 3).'
	                ),
	                array(
	                    'type'  => 'text',
	                    'label' => $this->l('Column on Mobile'),
	                    'name'  => 'column_mobile',
	                    'default'=> 2,
						'desc'  => 'The column products on mobile (default: 2).'
	                ),
	                array(
	                    'type'  => 'text',
	                    'label' => $this->l('Spacing Item'),
	                    'name'  => 'spacing_item',
	                    'default'=> 0,
						'desc'  => $this->l('Value 0px default')
	                ),
	                array(
						'type' => 'switch',
						'label' => $this->l('Show Prev/Next'),
						'name' => 'show_nav',
						'values' => $active,
						'default' => 0,
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Show Dots Navigation'),
						'name' => 'show_dots',
						'values' => $active,
						'default' => 0,
					),


	                array(
	                    'type'  => 'text',
	                    'label' => $this->l('Number words description'),
	                    'name'  => 'number_desc',
	                    'default'=> 100,
						'desc'  => $this->l('Value 100 default')
	                ),

	                array(
						'type' => 'switch',
						'label' => $this->l('Show Thumbnail'),
						'name' => 'show_thumb',
						'values' => $active,
						'default' => 1,
					),
					
					array(
						'type' => 'switch',
						'label' => $this->l('Active'),
						'name' => 'active',
						'values' => $active,
						'default' => 1,
					),
	            ),
				'buttons' => array(
					array(
						'title' => $this->l('Cancel'),
						'icon' => 'process-icon-cancel',
						'class' => 'pull-left',
						'type' => 'submit',
						'name' => 'submitCancel'
					),
					array(
						'title' => $this->l('Save And Stay'),
						'icon' => 'process-icon-save',
						'class' => 'pull-right',
						'type' => 'submit',
						'name' => 'submitDataAndStay'
					),
					array(
						'title' => $this->l('Save'),
						'icon' => 'process-icon-save',
						'class' => 'pull-right',
						'type' => 'submit',
						'name' => 'submitData'
					),
				)
	        );

			$row = Tools::getValue('row') ? Tools::getValue('row') : 0;						
			$helper->currentIndex = Context::getContext()->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name. '&type='. $this->type. '&hook='. $hook.'&id_novpagemanage='.$id_novpagemanage.'&row='.$row;		
		 	$helper->token = Tools::getAdminTokenLite('AdminModules');
			$helper->submit_action = false;
			$id_language_default = (int)Configuration::get('PS_LANG_DEFAULT');
			foreach (Language::getLanguages(false) as $lang)
				$helper->languages[] = array(
					'id_lang' => $lang['id_lang'],
					'iso_code' => $lang['iso_code'],
					'name' => $lang['name'],
					'is_default' => ($id_language_default == $lang['id_lang'] ? 1 : 0)
				);
			$helper->default_form_language = $id_language_default;
			$helper->allow_employee_form_lang = $id_language_default;
			$helper->tpl_vars = array(
	                'fields_value' => $this->getConfigFieldsValues($data),
	                'languages' => Context::getContext()->controller->getLanguages(),
	                'id_language' => $id_language_default
        	);  


			return  $helper->generateForm( $this->fields_form );

		}
		
		public function getDataSource( $config ){
			$id_language = Context::getContext()->language->id;
			$data['title'] = isset($config['title_'.$id_language])?($config['title_'.$id_language]): "";
			$data['sub_title'] = isset($config['sub_title_'.$id_language])?($config['sub_title_'.$id_language]): "";
			$data['class'] = isset($config['class']) ? ($config['class']): "";			
			$data['show_title'] = isset($config['show_title']) ? ($config['show_title']): 1;
			$data['active'] = isset($config['active']) ? ($config['active']): 1;
			$data['columns'] = isset($config['columns']) ? ($config['columns']) : 12;
			$data['number_row'] = isset($config['number_row']) ? ($config['number_row']) : 1;
			$data['list_style'] = isset($config['list_style']) ? ($config['list_style']) : "item_grid";
			$data['show_nav'] = isset($config['show_nav']) ? ($config['show_nav']) : 0;
			$data['show_dots'] = isset($config['show_dots']) ? ($config['show_dots']) : 0;
            
			$nb = ($config['itab']) ? (int)($config['itab']) : 6;
            $icolumn 	= ($config['icolumn']) ? (int)($config['icolumn']) : 3;
            $column_tablet 	= ($config['column_tablet']) ? (int)($config['column_tablet']) : 3;
            $column_mobile 	= ($config['column_mobile']) ? (int)($config['column_mobile']) : 2;
            $spacing_item 	= ($config['spacing_item']) ? (int)($config['spacing_item']) : 0;

            $data['number_desc'] = isset($config['number_desc']) ? ($config['number_desc']) : 100;
            $data['show_thumb'] = isset($config['show_thumb']) ? ($config['show_thumb']) : 1;

            $blogs = SmartBlogPost::GetPostLatestHome($nb);


			$data['spacing_item'] = $spacing_item;	
			$data['blogs'] = $blogs;
			$data['colspage'] = $icolumn;
			$data['column_tablet'] = $column_tablet;
			$data['column_mobile'] = $column_mobile;
			$data['scolumn']    = 12 / $icolumn;
			$data['name_tab'] = 'blog_list'.rand(10,rand());
			$result = array('data' => $data );
	  		return $result;
		}
		
	} 
}
?>