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

if( !class_exists("Megagallery") ){
class Megagallery extends Megasource {
	public $type = 'gallery';
	public function renderForm($data){
			if(isset($data['image_gallery']) && $data['image_gallery'])
				$data['image_gallery[]'] = $data['image_gallery'];
			else
				$data['image_gallery[]'] = array();
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
			$images = array();
			$imgpngs = $this->getFileName(_PS_MODULE_DIR_ .'novpagemanage/img/gallery/', '.png');
			$imgjpgs = $this->getFileName(_PS_MODULE_DIR_ . 'novpagemanage/img/gallery/', '.jpg');
			$images = array_merge($imgjpgs, $imgpngs);
			
			$this->fields_form[0]['form'] = array(
				'tinymce' => true,
	            'legend' => array(
	                'title' => $this->l('Gallerytml Form.'),
	            ),
	            'input' => array(
					array(
	                    'type' => 'text',
	                    'label' => $this->l('Gallery Title'),
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
						'type' => 'select',                              
						'label' => $this->l('Images'),         
						'desc' => $this->l('Select Gallery Images' ), 
						'name' => 'image_gallery[]',   
						'multiple' => true,	
						'options' => array(
							'query' => $images,                          
							'id' => 'value',                           
							'name' => 'name'                               
						)
					),
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Colum In Rows'),
	                    'name'  => 'icolumn',
	                    'default'=> 3,
						'desc'  => 'The column products in  Rows  (default: 3).'
	                ),			
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Width'),
	                    'name'  => 'width',
	                    'default'=> '100px',
						'desc'  => 'The column products in  Page  (default: 3).'
	                ),		
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Height'),
	                    'name'  => 'height',
	                    'default'=> '100px',
						'desc'  => 'The column products in  Page  (default: 3).'
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
			$helper->currentIndex = Context::getContext()->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name. '&type='. $this->type. '&hook='. $hook.'&id_novpagemanage='.$id_novpagemanage;	
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
			$data['class'] = isset($config['class']) ? ($config['class']): "";	
			$data['show_title'] = isset($config['show_title']) ? ($config['show_title']): 1;
			$data['active'] = isset($config['active']) ? ($config['active']): 1;
			$data['columns'] = isset($config['columns']) ? ($config['columns']) : 12;
			$data['width'] = isset($config['width']) ? ($config['width']) : '100px';
			$data['height'] = isset($config['height']) ? ($config['height']) : '100px';
			$data['ipage'] = isset($config['icolumn']) ? (12/$config['icolumn']) : 3;
			$data['image_gallery'] = isset($config['image_gallery']) ? ($config['image_gallery']): array();
			$data['gallery'] = 'gallery'.rand(10,rand());
			$result = array('data' => $data );
	  		return $result;
		}
		
		private function getFileName($path,$file=false,$getname=false) {
			$result = array();
			$allfiles = glob($path . '*' . $file);
			foreach ($allfiles as $name) {
				if($getname)
					$name = basename($name, $file);
				else
					$name = basename($name);
				$array['name'] = $name;
				$array['value'] = $name;
				$result[] = $array;
			}
			return $result;
		}		
		
	} 
}
?>