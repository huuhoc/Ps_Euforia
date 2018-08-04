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

if( !class_exists("Megamodule") ){
class Megamodule extends Megasource {
	public $type = 'module';
	
	public function renderForm($data){
			$id_novpagemanage = Tools::getValue('id_novpagemanage') ? Tools::getValue('id_novpagemanage') : 0;
			$row = Tools::getValue('row') ? Tools::getValue('row') : 0;	
			$helper = new HelperForm();
			$hook = Tools::getValue('hook');
			$modules_none[0] = array('name' => 'none');
			$modules_infos = $this->getListModule();
			$modules_infos = array_merge( $modules_none, $modules_infos );	
			if(isset($data['name_module']) && $data['name_module']){
				$obj = Module::getInstanceByName($data['name_module']);
				$id_module = $obj->id;
				$hook_sp= $this->getHookByIdModule((int)$id_module,(int)Context::getContext()->shop->id);
				foreach($hook_sp as $hi){
					$hook_infos[] = array('name' => $hi);
				}	
			}
			else
				$hook_infos = array();
				
			$hook_none[0] = array('name' => 'none');	
			$hook_infos = array_merge( $hook_none, $hook_infos );	
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

			$image_icon	= '';	
			if($data &&  isset($data['image_icon']) && $data['image_icon']){
				$image_icon = _MODULE_DIR_.$this->name.'/img/'.$data['image_icon'];
				$image_icon = '<img src="'.$image_icon.'"/>';
			}
			$delete_image_icon 	= Context::getContext()->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name. '&type='. $this->type. '&hook='. $hook.'&id_novpagemanage='.$id_novpagemanage.'&removeImageicon=1&token=' . Tools::getAdminTokenLite('AdminModules');
			
			$this->fields_form[0]['form'] = array(
				'tinymce' => true,
	            'legend' => array(
	                'title' => $this->l('Module Form.'),
	            ),
	            'input' => array(
					array(
	                    'type' => 'text',
	                    'label' => $this->l('Module Title'),
	                    'name' => 'title',
	                    'default'=> '',
						'required'=> true,
	                    'lang'	=> true
	                ),
	                array(
						'type' => 'file',
						'label' => $this->l('Image Icon'),
						'name' => 'image_icon',
						'desc' => $this->l('Image icon with title'),
						'image' =>	$image_icon,
						'delete_url' => $delete_image_icon,
						'default'=> '',
					),

	                array(
	                    'type' => 'text',
	                    'label' => $this->l('Module Sub Title'),
	                    'name' => 'sub_title',
	                    'default'=> '',
	                    'lang'	=> true
	                ),
					array(
						'type' => 'switch',
						'label' => $this->l('Show Title'),
						'name' => 'show_title',
						'values' => $active,
						'default' => 1,
					),
					array(
	                    'type' => 'text',
	                    'label' => $this->l('Class'),
	                    'name' => 'class',
	                    'default'=> '',
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
					  'label' => $this->l('Select Modules'),         
					  'name' => 'name_module',   
					  'default' => 'none',		                          
					  'options' => array(
						'query' => $modules_infos,                          
						'id' => 'name',                           
						'name' => 'name'                               
					  )
					),
					array(
					  'type' => 'select',                              
					  'label' => $this->l('Select Hook'),          
					  'name' => 'sp_hook',   
					  'default' => 'none',		                          
					  'options' => array(
						'query' => $hook_infos,                          
						'id' => 'name',                           
						'name' => 'name'                               
					  )
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

			$action = AdminController::$currentIndex.'&configure=novpagemanage&token='.Tools::getAdminTokenLite('AdminModules');
			$html = '<script type="text/javascript">var action="'.$action.'";</script>';
			return  $html.$helper->generateForm( $this->fields_form );

		}
		
		public function getDataSource( $config ){
			$id_language = Context::getContext()->language->id;
			$data['title'] = isset($config['title_'.$id_language])?($config['title_'.$id_language]): "";
			$data['image_icon'] = isset($config['image_icon']) ? ($config['image_icon']) : '';
			$data['sub_title'] = isset($config['sub_title_'.$id_language])?($config['sub_title_'.$id_language]): "";
			$data['class'] = isset($config['class']) ? ($config['class']): "";	
			$data['show_title'] = isset($config['show_title']) ? ($config['show_title']): 1;
			$data['active'] = isset($config['active']) ? ($config['active']): 1;
			$data['columns'] = isset($config['columns']) ? ($config['columns']): 12;
			$result = array('source'=>'module','data' => $data );
	  		return $result;
		}
		public function getListModule(){
			$default = array( 'novpagemanage', 'novmegamenu','novthemeconfig','themeconfigurator', 'themeinstallator', 'cheque' );
			$id_shop = Context::getContext()->shop->id;
			$where = ' WHERE m.`name` NOT IN (\''.pSQL(implode("','",$default)).'\') AND m.`active` = 1';
			$sql = 'SELECT m.*
						FROM `'._DB_PREFIX_.'module` m
						JOIN `'._DB_PREFIX_.'module_shop` ms ON (m.`id_module` = ms.`id_module` AND ms.`id_shop` = '.(int)($id_shop).')
						'.$where;
			return Db::getInstance()->ExecuteS($sql);
		}
		
		public function getHookByIdModule($id_module,$id_shop){
			$hooks = $this->getHookFromModule($id_module);
			$object = new novpagemanage();
			$hook_function = array();
			if($hooks){
				foreach( $hooks as $hook){
					if (in_array($hook,$object->hookSupport)){
						$hook_function [] = $hook;
					}
				}
			}
			return 	$hook_function;
		}
		
		public function getHookFromModule($id_module){
			$sql = 'SELECT `id_hook` FROM `'._DB_PREFIX_.'hook_module` WHERE `id_module` = '.(int)$id_module;
			$id_hooks =  Db::getInstance()->executeS($sql);
			$hooks = array();
			if($id_hooks){
				foreach($id_hooks as $id_hook){
					$hooks[] = 'hook'.Hook::getNameById($id_hook['id_hook']);
				}
			}
			return $hooks;
		}		
	
	} 
}
?>