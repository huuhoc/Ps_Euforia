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

if( !class_exists("Megamanufacture") ){
class Megamanufacture extends Megasource {
	public $type = 'manufacture';
	public function renderForm($data){
			$helper = new HelperForm();
			$images = ImageType::getImagesTypes('manufacturers');
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
	                'title' => $this->l('Manufacture Carousel.'),
	            ),
	            'input' => array(
					array(
	                    'type' => 'text',
	                    'label' => $this->l('Manufacture Title'),
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
						  'label' => $this->l('Image:'),         
						  'desc' => $this->l('Select type image for manufacture.'),  
						  'name' => 'size_image',   
						  'default' => 'small_default',		                          
						  'options' => array(
							'query' => $images,                          
							'id' => 'name',                           
							'name' => 'name'                            
					  )
					),
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Limit'),
	                    'name'  => 'itab',
	                    'default'=> 6,
						'desc'  => $this->l('The  number of products in Tab (default: 12).')
	                ),
	                array(
	                    'type'  => 'text',
	                    'label' => $this->l('Number row'),
	                    'name'  => 'number_row',
	                    'default'=> 1,
						'desc'  => $this->l('The number of products in Page (default: 1).')
	                ),
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Column on Desktop'),
	                    'name'  => 'icolumn',
	                    'default'=> 6,
						'desc'  => 'The column products in  Page  (default: 6).'
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
	                    'default'=> 30,
						'desc'  => 'Value 30px default'
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
			$id_language = Context::getContext()->language->id;
			$data['title'] = isset($config['title_'.$id_language])?($config['title_'.$id_language]): "";
			$data['class'] = isset($config['class']) ? ($config['class']): "";
			$data['show_title'] = isset($config['show_title']) ? ($config['show_title']): 1;
			$data['active'] = isset($config['active']) ? ($config['active']): 1;
			$data['columns'] = isset($config['columns']) ? ($config['columns']) : 12;
			$data['number_row'] = isset($config['number_row']) ? ($config['number_row']) : 1;
			$nb = ($config['itab']) ? (int)($config['itab']) : 6;
            $icolumn 	= ($config['icolumn']) ? (int)($config['icolumn']) : 6;
            $column_tablet 	= ($config['column_tablet']) ? (int)($config['column_tablet']) : 3;
            $column_mobile 	= ($config['column_mobile']) ? (int)($config['column_mobile']) : 2;
            $spacing_item 	= ($config['spacing_item']) ? (int)($config['spacing_item']) : 30;
			$image 		= 	($config['size_image']) ? ($config['size_image']) : 'manu_default';

			$manus = Manufacturer::getManufacturers(true, Context::getContext()->language->id, true, false ,$nb, false);

			foreach ($manus as &$item)
			{
				$id_images = (!file_exists(_PS_MANU_IMG_DIR_.'/'.$item['id_manufacturer'].'-'.$image.'.jpg')) ? Language::getIsoById(Context::getContext()->language->id).'-default' : $item['id_manufacturer'];
				$item['image'] = _THEME_MANU_DIR_.$id_images.'-'.$image.'.jpg';
			}
			$data['manufacturers'] = $manus; 
			$data['colspage'] = $icolumn;
			$data['column_tablet'] = $column_tablet;
			$data['column_mobile'] = $column_mobile;
			$data['spacing_item'] = $spacing_item;
			$data['scolumn']    = 12 / $icolumn;
			$data['name_tab'] = 'manufacture'.rand(10,rand());
			$result = array('data' => $data );
	  		return $result;
		}
		
	} 
}
?>