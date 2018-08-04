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

if( !class_exists("Megaslider_image") ){
class Megaslider_image extends Megasource {
	public $type = 'slider_image';
	public function renderForm($data){
			$hook = Tools::getValue('hook');
			$id_novpagemanage = Tools::getValue('id_novpagemanage') ? Tools::getValue('id_novpagemanage') : 0;
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
			$image1  = '';   
            if($data &&  isset($data['image1']) && $data['image1']){
                $image1 = _MODULE_DIR_.$this->name.'/img/'.$data['image1'];
                $image1 = '<img src="'.$image1.'"/>';
            }
            $delete_image1   = Context::getContext()->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name. '&type='. $this->type. '&hook='. $hook.'&id_novpagemanage='.$id_novpagemanage.'&removeImage=1&token=' . Tools::getAdminTokenLite('AdminModules');

            $image2  = '';   
            if($data &&  isset($data['image2']) && $data['image2']){
                $image2 = _MODULE_DIR_.$this->name.'/img/'.$data['image2'];
                $image2 = '<img src="'.$image2.'"/>';
            }
            $delete_image2   = Context::getContext()->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name. '&type='. $this->type. '&hook='. $hook.'&id_novpagemanage='.$id_novpagemanage.'&removeImage2=1&token=' . Tools::getAdminTokenLite('AdminModules');

            $image3  = '';   
            if($data &&  isset($data['image3']) && $data['image3']){
                $image3 = _MODULE_DIR_.$this->name.'/img/'.$data['image3'];
                $image3 = '<img src="'.$image3.'"/>';
            }
            $delete_image3   = Context::getContext()->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name. '&type='. $this->type. '&hook='. $hook.'&id_novpagemanage='.$id_novpagemanage.'&removeImage2=1&token=' . Tools::getAdminTokenLite('AdminModules');
			$image4  = '';   
            if($data &&  isset($data['image3']) && $data['image4']){
                $image4 = _MODULE_DIR_.$this->name.'/img/'.$data['image4'];
                $image4 = '<img src="'.$image4.'"/>';
            }
            $delete_image4   = Context::getContext()->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name. '&type='. $this->type. '&hook='. $hook.'&id_novpagemanage='.$id_novpagemanage.'&removeImage2=1&token=' . Tools::getAdminTokenLite('AdminModules');
			$image5  = '';   
            if($data &&  isset($data['image5']) && $data['image5']){
                $image5 = _MODULE_DIR_.$this->name.'/img/'.$data['image5'];
                $image5 = '<img src="'.$image5.'"/>';
            }
            $delete_image5   = Context::getContext()->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name. '&type='. $this->type. '&hook='. $hook.'&id_novpagemanage='.$id_novpagemanage.'&removeImage2=1&token=' . Tools::getAdminTokenLite('AdminModules');
			$image6  = '';   
            if($data &&  isset($data['image6']) && $data['image6']){
                $image6 = _MODULE_DIR_.$this->name.'/img/'.$data['image6'];
                $image6 = '<img src="'.$image6.'"/>';
            }
            $delete_image6   = Context::getContext()->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name. '&type='. $this->type. '&hook='. $hook.'&id_novpagemanage='.$id_novpagemanage.'&removeImage2=1&token=' . Tools::getAdminTokenLite('AdminModules');

			
			$this->fields_form[0]['form'] = array(
				'tinymce' => true,
	            'legend' => array(
	                'title' => $this->l('Image Form.'),
	            ),
	            'input' => array(
					array(
	                    'type' => 'text',
	                    'label' => $this->l('Title'),
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
						'type' => 'file',
						'label' => $this->l('Image 1'),
						'name' => 'image1',
						'desc' => $this->l('Please upload image'),
						'image' =>	$image1,
						'delete_url' => $delete_image1,
						'default'=> '',
					),
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Link 1'),
	                    'name'  => 'link_image1',
	                    'default'=> '#',
						'desc'  => $this->l('Link image 1.')
	                ),
					array(
						'type' => 'file',
						'label' => $this->l('Image 2'),
						'name' => 'image2',
						'desc' => $this->l('Please upload image'),
						'image' =>	$image2,
						'delete_url' => $delete_image2,
						'default'=> '',
					),
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Link 2'),
	                    'name'  => 'link_image2',
	                    'default'=> '#',
						'desc'  => $this->l('Link image 2.')
	                ),
					array(
						'type' => 'file',
						'label' => $this->l('Image 3'),
						'name' => 'image3',
						'desc' => $this->l('Please upload image'),
						'image' =>	$image3,
						'delete_url' => $delete_image3,
						'default'=> '',
					),
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Link 3'),
	                    'name'  => 'link_image3',
	                    'default'=> '#',
						'desc'  => $this->l('Link image 3.')
	                ),
					array(
						'type' => 'file',
						'label' => $this->l('Image 4'),
						'name' => 'image4',
						'desc' => $this->l('Please upload image'),
						'image' =>	$image4,
						'delete_url' => $delete_image4,
						'default'=> '',
					),
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Link 4'),
	                    'name'  => 'link_image4',
	                    'default'=> '#',
						'desc'  => $this->l('Link image 4.')
	                ),
					array(
						'type' => 'file',
						'label' => $this->l('Image 5'),
						'name' => 'image5',
						'desc' => $this->l('Please upload image'),
						'image' =>	$image5,
						'delete_url' => $delete_image5,
						'default'=> '',
					),
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Link 5'),
	                    'name'  => 'link_image5',
	                    'default'=> '#',
						'desc'  => $this->l('Link image 5.')
	                ),
					array(
						'type' => 'file',
						'label' => $this->l('Image 6'),
						'name' => 'image6',
						'desc' => $this->l('Please upload image'),
						'image' =>	$image6,
						'delete_url' => $delete_image6,
						'default'=> '',
					),
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Link 6'),
	                    'name'  => 'link_image6',
	                    'default'=> '#',
						'desc'  => $this->l('Link image 6.')
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
	                    'default'=> 30,
						'desc'  => $this->l('Value 30px default')
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
			$helper->currentIndex = Context::getContext()->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name. '&type='. $this->type. '&hook='. $hook.'&id_novpagemanage='.$id_novpagemanage.'&row='.$row;	;	
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
			$data['image1'] = isset($config['image1']) ? ($config['image1']) : '';
			$data['image2'] = isset($config['image2']) ? ($config['image2']) : '';
			$data['image3'] = isset($config['image3']) ? ($config['image3']) : '';
			$data['image4'] = isset($config['image4']) ? ($config['image4']) : '';
			$data['image5'] = isset($config['image5']) ? ($config['image5']) : '';
			$data['image6'] = isset($config['image6']) ? ($config['image6']) : '';
			$data['link_image1'] = isset($config['link_image1']) ? ($config['link_image1']) : '#';
			$data['link_image2'] = isset($config['link_image2']) ? ($config['link_image2']) : '#';
			$data['link_image3'] = isset($config['link_image3']) ? ($config['link_image3']) : '#';
			$data['link_image4'] = isset($config['link_image4']) ? ($config['link_image4']) : '#';
			$data['link_image5'] = isset($config['link_image5']) ? ($config['link_image5']) : '#';
			$data['link_image6'] = isset($config['link_image6']) ? ($config['link_image6']) : '#';
			
			$data['colspage'] = ($config['icolumn']) ? (int)($config['icolumn']) : 3;
			$data['column_tablet'] = ($config['column_tablet']) ? (int)($config['column_tablet']) : 3;
			$data['column_mobile'] = ($config['column_mobile']) ? (int)($config['column_mobile']) : 2;
			$data['spacing_item'] = ($config['spacing_item']) ? (int)($config['spacing_item']) : 30;
			$result = array('data' => $data );
			
	  		return $result;
		}
		
	} 
}
?>