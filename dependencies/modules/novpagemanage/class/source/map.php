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

if( !class_exists("Megamap") ){
class Megamap extends Megasource {
	public $type = 'map';
	public function renderForm($data){
			
			$helper = new HelperForm();
			
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
			$this->fields_form[0]['form'] = array(
				'tinymce' => true,
	            'legend' => array(
	                'title' => $this->l('Map Form.'),
	            ),
	            'input' => array(
					array(
	                    'type' => 'text',
	                    'label' => $this->l('Map Title'),
	                    'name' => 'title',
	                    'default'=> '',
						'required'=> true,
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
	                    'label' => $this->l('Latitude'),
	                    'name'  => 'latitude',
	                    'default'=> 25.76500500,
	                ),
	                array(
	                    'type'  => 'text',
	                    'label' => $this->l('Longitude'),
	                    'name'  => 'longitude',
	                    'default'=> -80.24379700,
	                ),
	                array(
	                    'type'  => 'text',
	                    'label' => $this->l('Zoom'),
	                    'name'  => 'zoom',
	                    'default'=> 11,
	                ),
	                array(
	                    'type'  => 'text',
	                    'label' => $this->l('Width'),
	                    'name'  => 'width',
	                    'default'=> '100%',
						'desc'	=> 'Ex: 200px , 30%'
	                ),
	                 array(
	                    'type'  => 'text',
	                    'label' => $this->l('Height'),
	                    'name'  => 'height',
	                    'default'=> '200px',
						'desc'	=> 'Ex: 200px , 30%'
	                ),
					array(
						'type' => 'switch',
						'label' => $this->l('Show Market'),
						'name' => 'show_market',
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
			$hook = Tools::getValue('hook');
			$id_novpagemanage = Tools::getValue('id_novpagemanage') ? Tools::getValue('id_novpagemanage') : 0;	
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
			$default_country = new Country((int)Configuration::get('PS_COUNTRY_DEFAULT'));
			$id_language = Context::getContext()->language->id;
			$data['title'] 			= isset($config['title_'.$id_language])?($config['title_'.$id_language]): "";
			$data['class'] 			= isset($config['class']) ? ($config['class']): "";	
			$data['show_title'] 	= isset($config['show_title']) ? ($config['show_title']): 1;
			$data['active'] 		= isset($config['active']) ? ($config['active']): 1;
			$data['columns'] 		= isset($config['columns']) ? ($config['columns']) : 12;
			$data['latitude'] 		= isset($config['latitude']) ? ($config['latitude']) : 25.76500500;
			$data['longitude'] 		= isset($config['longitude']) ? ($config['longitude']) : -80.24379700;
			$data['zoom'] 			= isset($config['zoom']) ? ($config['zoom']) : 11;
			$data['width'] 			= isset($config['width']) ? ($config['width']) : '100%';
			$data['height'] 		= isset($config['height']) ? ($config['height']) : '200px';
			$data['show_market'] 	= isset($config['show_market']) ? ($config['show_market']): 1;
			$data['iso_code'] 		= Tools::substr($default_country->iso_code, 0, 2);
			$result = array('data' => $data );
	  		return $result;
		}
		
	} 
}
?>