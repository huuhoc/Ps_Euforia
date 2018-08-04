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

if( !class_exists("Megatwitter") ){
class Megatwitter extends Megasource {
	public $type = 'twitter';
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
	                'title' => $this->l('Twitter Form.'),
	            ),
	            'input' => array(
					array(
	                    'type' => 'text',
	                    'label' => $this->l('Twitter Title'),
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
						'type' => 'text',
						'label' => $this->l('Twitter'),
						'name' => 'twitter_id',
						'default' => '512250912429969409',
					),
					array(
						'type' => 'text',
						'label' => $this->l('Limit Items'),
						'name' => 'limit',
						'default' => 3,
					),
					array(
						'type' => 'text',
						'label' => $this->l('User'),
						'name' => 'twitter_name',
						'default' => 'vinovathemes',
					),
					array(
						'type' => 'color',
						'label' => $this->l('Border Color'),
						'name' => 'border_color',
						'default' => "#fff",
					),
					array(
						'type' => 'color',
						'label' => $this->l('Link Color'),
						'name' => 'link_color',
						'default' => "#fff",
					),
					array(
						'type' => 'color',
						'label' => $this->l('Text Color'),
						'name' => 'text_color',
						'default' => "#fff",
					),
					array(
						'type' => 'color',
						'label' => $this->l('Name Color'),
						'name' => 'name_color',
						'default' => "#fff",
					),
					array(
						'type' => 'color',
						'label' => $this->l('Mail Color'),
						'name' => 'mail_color',
						'default' => "#fff",
					),

					array(
						'type' => 'text',
						'label' => $this->l('Width'),
						'name' => 'tw_width',
						'default' => 200,
					),
					array(
						'type' => 'text',
						'label' => $this->l('Height'),
						'name' => 'tw_height',
						'default' => 250,
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Show Background'),
						'name' => 'transparent',
						'values' => $active,
						'default' => 0,
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Show Replies'),
						'name' => 'show_replies',
						'values' => $active,
						'default' => 0,
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Show Header'),
						'name' => 'show_header',
						'values' => $active,
						'default' => 0,
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Show Border'),
						'name' => 'show_border',
						'values' => $active,
						'default' => 0,
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Show Scrollbar'),
						'name' => 'show_scrollbar',
						'values' => $active,
						'default' => 0,
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Show Footer'),
						'name' => 'show_footer',
						'values' => $active,
						'default' => 0,
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
			$data['title'] 		= isset($config['title_'.$id_language])?($config['title_'.$id_language]): "";
			$data['class'] 		= isset($config['class']) ? ($config['class']): "";	
			$data['show_title'] = isset($config['show_title']) ? ($config['show_title']): 1;
			$data['active'] 	= isset($config['active']) ? ($config['active']): 1;
			$data['columns'] 	= isset($config['columns']) ? ($config['columns']) : 12;
			$data['limit'] 		= isset($config['limit']) ? ($config['limit']) : 3;
			$data['twitter_name'] 	= isset($config['twitter_name']) ? ($config['twitter_name']): "vinovathemes";	
			$data['twitter_id'] 	= isset($config['twitter_id']) ? ($config['twitter_id']): "vA1kw62CSISJOZKSEpBvNMHPV";	
			$data['border_color'] = isset($config['border_color']) ? ($config['border_color']): "#fff";	
			$data['link_color'] = isset($config['link_color']) ? ($config['link_color']): "#fff";
			$data['text_color'] = isset($config['text_color']) ? ($config['text_color']): "#fff";	
			$data['name_color'] = isset($config['name_color']) ? ($config['name_color']): "#fff";	
			$data['mail_color'] = isset($config['mail_color']) ? ($config['mail_color']): "#fff";
			$data['show_title'] = isset($config['show_title']) ? ($config['show_title']): 1;
			$data['tw_width'] 		= isset($config['tw_width']) ? ($config['tw_width']) : 200;
			$data['tw_height'] 	= isset($config['tw_height']) ? ($config['tw_height']) : 250;
			$data['iso_code'] 	= Context::getContext()->language->iso_code;
			$data['chrome'] = '';
			if (isset($config['show_header']) && $config['show_header'] == 0) {
				$data['chrome'] .= 'noheader ';
			}
			if ($config['show_footer'] == 0) {
				$data['chrome'] .= 'nofooter ';
			}
			if ($config['show_border'] == 0) {
				$data['chrome'] .= 'noborders ';
			}
			if ($config['transparent'] == 0) {
				$data['chrome'] .= 'transparent';
			}
			$data['show_replies'] 	= isset($config['show_replies']) ? ($config['show_replies']): 0;
			$data['show_header'] 	= isset($config['show_header']) ? ($config['show_header']): 0;
			$data['show_footer'] 	= isset($config['show_footer']) ? ($config['show_footer']): 0;
			$data['show_border'] 	= isset($config['show_border']) ? ($config['show_border']): 0;
			$data['show_scrollbar'] = isset($config['show_scrollbar']) ? ($config['show_scrollbar']): 0;
			$data['js_twitter'] = '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
			$result = array('data' => $data );
	  		return $result;
		}
		
	} 
}
?>