<?php
/******************
 * Vinova Themes  Framework for Prestashop 1.6.x 
 * @package   	novpagemanage
 * @version   	1.0
 * @author   	http://vinovathemes.com/
 * @copyright 	Copyright (C) October 2013 vinovathemes.com <@emai:vinovathemes@gmail.com>
 * <info@vinovathemes.com>.All rights reserved.
 * @license   GNU General Public License version 1
 * *****************/
if (!defined('_PS_VERSION_'))
    exit;
include_once(_PS_MODULE_DIR_ .'novpagemanage/class/Page.php');
require_once(_PS_MODULE_DIR_ .'novpagemanage/class/default.php');	
use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
use PrestaShop\PrestaShop\Adapter\Category\CategoryProductSearchProvider;
use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Core\Product\ProductListingPresenter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;
use PrestaShop\PrestaShop\Core\Foundation\Database\EntityManager;
class novpagemanage extends Module implements WidgetInterface {
		private $_html = '';
		private $themeName;
		private $hooks;
	    public function __construct(EntityManager $entity_manager=null) {
        global $currentIndex;
        $this->name = 'novpagemanage';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'VinovaThemes';
        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->secure_key = Tools::encrypt($this->name);
        parent::__construct();
		$this->entity_manager = $entity_manager;
		$this->themeName = Context::getContext()->shop->theme_name;
		require( _PS_ALL_THEMES_DIR_ .'vinova_euforia/layout.php');	
        $this->displayName = $this->l('Vinova Themes Pages Manage');
        $this->description = $this->l('Manage widget with hooks');
		$this->sources = $this->getFileName(_PS_MODULE_DIR_ .'novpagemanage/class/source/', '.php');
		$this->hooks = $this->getLayout($hooks);
		$this->hookSupport = $hookSupport;
		if($this->sources)
			foreach ($this->sources as $source)
				require_once(_PS_MODULE_DIR_ .'novpagemanage/class/source/'.$source.'.php');	
    }
	
	
	public function getLayout($hooks){
		$path_footer = _PS_ALL_THEMES_DIR_ . 'vinova_euforia/templates/_partials/layout/footer';
		$footer = $this->nov_get_file($path_footer);
		$result1 = array_merge($hooks, $footer);

		$path_header = _PS_ALL_THEMES_DIR_ . 'vinova_euforia/templates/_partials/layout/header';
		$header = $this->nov_get_file($path_header);
		$result = array_merge($header, $result1);
		
		
		return $result;
	}
	
	public function nov_get_file($path){
		$result = array();		
		$files = array_diff(scandir($path), array('..', '.'));
		if(count($files)>0){
			foreach ($files as  $file) {
				if (strpos($file, '.tpl') !== false)
					$result[] = str_replace(".tpl","",$file);
			}
		}
		return 	$result;
	}
	
	public function install()
	{
		/* Adds Module */
		if (parent::install() &&
			$this->registerHook('displayHeader') &&
			$this->registerHook('actionObjectLanguageAddAfter'))

		{
			foreach ($this->hooks as $hook)
			{
				if (!$this->registerHook ($hook))
					return false;
			}
			return true;
		}
		return false;
	}
	
	public function uninstall() {
       return parent::uninstall();
    }
	
	public function nov_uploadImage($name,$data){
		if (isset($_FILES[$name]) && isset($_FILES[$name]['tmp_name']) && !empty($_FILES[$name]['tmp_name'])) {
			if ($error = ImageManager::validateUpload($_FILES[$name], Tools::convertBytes(ini_get('upload_max_filesize'))))
				$errors .= $error;
			else
			{
				
				$type = Tools::strtolower(Tools::substr(strrchr($_FILES[$name]['name'], '.'), 1));
				$temp_name = tempnam(_PS_TMP_IMG_DIR_, 'PS');
				$salt = sha1(microtime());
				
				if (!$temp_name || !move_uploaded_file($_FILES[$name]['tmp_name'], $temp_name))
					return;
				elseif (!ImageManager::resize($temp_name,  dirname(__FILE__).'/img/'.Tools::encrypt($_FILES[$name]['name'].$salt).'.'.$type, null, null, $type))
					$errors[] = $this->displayError($this->l('An error occurred during the image upload process.'));
				if (isset($temp_name))
					@unlink($temp_name);
				$post[$name] = Tools::encrypt($_FILES[$name]['name'].$salt).'.'.$type;
			}
		}
		elseif (Tools::getValue($name.'_old') != '') {
			$post[$name] = Tools::getValue($name.'_old');
		}
		else {
			$post[$name] = ($data[$name]) ? ($data[$name]) : '';
		}	
		
		return $post[$name];
	}

    public function renderWidget($hookName, array $configuration)
    {
       return $this->processHook(array(),$hookName);
    }	

    public function getWidgetVariables($hookName, array $configuration)
    {
		return true;
    }	
	
	public function getContent() {
		$id_lang_default = (int)Configuration::get('PS_LANG_DEFAULT');
		$languages = Language::getLanguages(false);
		if(Tools::getValue('action') && Tools::getValue('action') == 'additem'){
			$id_novpagemanage = Tools::getValue('id_novpagemanage') ? Tools::getValue('id_novpagemanage') : 0;
			$type = Tools::getValue('type') ;
			$class = "Mega".ucfirst($type);
			$object = new $class;
			$novpagemanage = new PageManage($id_novpagemanage);
			$data = ($novpagemanage->data) ? Tools::jsonDecode(base64_decode($novpagemanage->data), true) : array();
			return $object->renderForm($data);
		}
		elseif(Tools::isSubmit('submitData') || Tools::isSubmit('submitDataAndStay')){
			$errors = array();
			if (Tools::strlen(Tools::getValue('title_'.$id_lang_default)) == 0)
				$errors[] = $this->l('The title is not set.');	
			if (count($errors))
			{
				$this->_html .= $this->displayError(implode('<br />', $errors));
				return false;
			}
			$id_novpagemanage = Tools::getValue('id_novpagemanage') ? Tools::getValue('id_novpagemanage') : 0;	
			$homepage = new PageManage($id_novpagemanage);
			$homepage->id_shop = Context::getContext()->shop->id;
			$homepage->type = Tools::getValue('type');
			if(Tools::getValue('row') && Tools::getValue('row') != 0)
				$homepage->type = Tools::getValue('type').'-row'.Tools::getValue('row');
			$homepage->hook = Tools::getValue('hook');
			if($homepage->data){
				$data = Tools::jsonDecode(base64_decode($homepage->data), true);
			}
			if(!Tools::getValue('id_novpagemanage'))
				$homepage->position = $homepage->getPositon($homepage->hook);
			$post = $_POST;
			if($post){
				if(isset($_FILES) && $_FILES){
					foreach($_FILES as $key=>$_FILE){
						$post[$key] = $this->nov_uploadImage($key,$data);
					} 
				}
				foreach ($languages as $language)
					$post['title_'.$language['id_lang']] =  ($post['title_'.$language['id_lang']]) ? $post['title_'.$language['id_lang']] : $post['title_'.$id_lang_default];
			}	
				
			$homepage->data = base64_encode(Tools::jsonEncode($post));
			$res = $homepage->save();
			$this->clearCache($homepage);
			$this->_html .= ($res ? $this->displayConfirmation($this->l('Configuration updated')) : $this->displayError($this->l('The configuration could not be updated.')));
			if(Tools::isSubmit('submitDataAndStay')){
				$homepage_type = $homepage->type;
				$homepage_type = explode("-",$homepage_type);
				if(isset($homepage_type[1]) && $homepage_type[1])
					$row = str_replace("row","",$homepage_type[1]);
				else
					$row = 0;
				Tools::redirectAdmin(Context::getContext()->link->getAdminLink('AdminModules', false) . '&action=additem&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name. '&type='. $homepage_type[0]. '&hook='. $homepage->hook.'&row='.$row.'&id_novpagemanage='.$homepage->id.'&token='.Tools::getAdminTokenLite('AdminModules').'&conf=4');	
			} 
			else
				Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&conf=4');	
		}
		elseif( Tools::getValue('deletedata')){
            $id_novpagemanage = Tools::getValue('id_novpagemanage') ? Tools::getValue('id_novpagemanage') : 0;
			$homepage = new PageManage((int)$id_novpagemanage);
			if($homepage->type == "row"){
				$homepage->delete();
				$datas =  $this->getNovpagemanage();	
				if($datas){
					foreach ($datas as  $data){
						$str = "row".$id_novpagemanage;
						$pos = strpos($data["type"], $str);
						if ($pos !== false) {
							$homepage1 = new PageManage((int)$data['id_novpagemanage']);
							$homepage1->delete();
						}
					}
				}
			}else{
				$homepage->delete();
			}	
			$this->clearCache($homepage);
			die($homepage);
        }
		
		elseif( Tools::isSubmit('submitCancel')){
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
        }
		
		elseif( Tools::getValue('changemodule')){
            $name_module = Tools::getValue('name_module') ? Tools::getValue('name_module') : 'none';
			$obj = Module::getInstanceByName($name_module);
			$id_module = $obj->id;
			$hook_module = $this->getHookByIdModule((int)$id_module,(int)Context::getContext()->shop->id);
			$html = '';
			if($hook_module){
				foreach($hook_module as $hook){
					$html .= '<option value="'.$hook.'">'.$hook.'</option>';
				}	
			}
			die($html);
        }
		elseif( Tools::getValue('action') && Tools::getValue('action') == 'updatePosition'){
			$pages = Tools::getValue('pages');
			$manage_pages = Tools::jsonDecode($pages,true);
			foreach ($manage_pages as $hook => $items){
				if($items){
					foreach ($items as $position => $id_novpagemanage){
						$pos = strpos($id_novpagemanage, 'row');
						if ($pos !== false) {
							$id_novpagemanage = explode("-",$id_novpagemanage);
							if($id_novpagemanage){
								foreach ($id_novpagemanage as $key => $id_novpage){
									if($key != 0){
										$homepage = new PageManage((int)$id_novpage);
										$home_type = $homepage->type;
										$home_type = explode("-",$home_type);
										$homepage->hook = $hook;
										$homepage->position = $key;
										$homepage->type = $home_type[0]."-".$id_novpagemanage[0];
										$homepage->save();	
									}		
								}
							}
						}else{
							$homepage = new PageManage((int)$id_novpagemanage);
							$home_type = $homepage->type;
							$home_type = explode("-",$home_type);
							$homepage->type = $home_type[0];
							$homepage->hook = $hook;
							$homepage->position = $position;
							$homepage->save();							
						}
					}
				}
			}
			die($pages);
        }
		elseif( Tools::getValue('action') && Tools::getValue('action') == 'updateCol' && Tools::getValue('id_novpagemanage')){
			$homepage = new PageManage((int)Tools::getValue('id_novpagemanage'));
			$data = Tools::jsonDecode(base64_decode($homepage->data), true);
			$data['columns'] = Tools::getValue('col');
			$homepage->data = base64_encode(Tools::jsonEncode($data));
			$homepage->update();
			$this->clearCache($homepage);
			die($homepage);			
        }		
		elseif(Tools::getValue('changestatus')){
			$homepage = new PageManage((int)Tools::getValue('id_novpagemanage'));
			$data = Tools::jsonDecode(base64_decode($homepage->data), true);
			if ($data['active'] == 0)
				$data['active'] = 1;
			else
				$data['active'] = 0;
			$homepage->data = base64_encode(Tools::jsonEncode($data));
			$homepage->update();
			$this->clearCache($homepage);
			die($homepage);
        }
		elseif(Tools::getValue('removeImage')){
			$homepage = new PageManage((int)Tools::getValue('id_novpagemanage'));
			$data = Tools::jsonDecode(base64_decode($homepage->data), true);
			$data['image1'] = "";
			$homepage->data = base64_encode(Tools::jsonEncode($data));
			$homepage->update();
			$this->clearCache($homepage);
			$item_type = explode("-",$homepage->type);
			Tools::redirectAdmin(Context::getContext()->link->getAdminLink('AdminModules', false) . '&action=additem&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name. '&type='. $item_type[0]. '&hook='. $homepage->hook.'&row='.$row.'&id_novpagemanage='.$homepage->id.'&token='.Tools::getAdminTokenLite('AdminModules').'&conf=4');	
        }
        elseif(Tools::getValue('removeImage2')){
			$homepage = new PageManage((int)Tools::getValue('id_novpagemanage'));
			$data = Tools::jsonDecode(base64_decode($homepage->data), true);
			$data['image2'] = "";
			$homepage->data = base64_encode(Tools::jsonEncode($data));
			$homepage->update();
			$this->clearCache($homepage);
			$item_type = explode("-",$homepage->type);
			Tools::redirectAdmin(Context::getContext()->link->getAdminLink('AdminModules', false) . '&action=additem&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name. '&type='. $item_type[0]. '&hook='. $homepage->hook.'&row='.$row.'&id_novpagemanage='.$homepage->id.'&token='.Tools::getAdminTokenLite('AdminModules').'&conf=4');	
        }
		elseif(Tools::getValue('removeImageicon')){
			$homepage = new PageManage((int)Tools::getValue('id_novpagemanage'));
			$data = Tools::jsonDecode(base64_decode($homepage->data), true);
			$data['image_icon'] = "";
			$homepage->data = base64_encode(Tools::jsonEncode($data));
			$homepage->update();
			$this->clearCache($homepage);
			$item_type = explode("-",$homepage->type);
			Tools::redirectAdmin(Context::getContext()->link->getAdminLink('AdminModules', false) . '&action=additem&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name. '&type='. $item_type[0]. '&hook='. $homepage->hook.'&row='.$row.'&id_novpagemanage='.$homepage->id.'&token='.Tools::getAdminTokenLite('AdminModules').'&conf=4');	
        }
		$this->_html .= $this->renderForm();
		return $this->_html;
    }
	
	public function getNovpagemanage(){
		$id_shop    = Context::getContext()->shop->id;
		$sql = ' SELECT *
					FROM ' . _DB_PREFIX_ . 'novpagemanage 
							WHERE id_shop = ' . (int) ($id_shop).'
								ORDER BY position
							';		
		$result = 	Db::getInstance()->executeS($sql);
		return $result;
	}
	
	public function renderForm() {
		$this->context->controller->addJqueryUI('ui.sortable');
        $this->context->controller->addJqueryUI('ui.draggable');
		$this->context->controller->addCss( 'https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' ); 
		$this->context->controller->addCss( __PS_BASE_URI__.'modules/'.$this->name.'/libs/css/form.css' );
		$this->context->controller->addJS( __PS_BASE_URI__.'modules/'.$this->name.'/libs/js/form.js' ); 
		$this->context->controller->addJS( __PS_BASE_URI__.'modules/'.$this->name.'/libs/js/jquery.ui.js' );
		$helper = new HelperForm();
		$novpagemanage = new PageManage();	
		$type_header 	= Configuration::get("novthemeconfig_header_style"); 
		$type_top		= str_replace( 'displayHomeNov', 'displayTop', Configuration::get("novthemeconfig_home_style") );
		$type_home 		= Configuration::get("novthemeconfig_home_style");
		$type_footer 	= Configuration::get("novthemeconfig_footer_style"); 
		$hooks = array();
		
		foreach($this->hooks as $hook){
			if (preg_match("/displayHeaderNov/", $hook, $match)) {
				if($hook == $type_header)
					$hooks[] = $hook;
			}elseif(preg_match("/displayFooterNov/", $hook, $match)){
				if($hook == $type_footer)
					$hooks[] = $hook;
			}elseif(preg_match("/displayTop/", $hook, $match)){
				if($hook == $type_top)
					$hooks[] = $hook;
			}
			elseif(preg_match("/displayHomeNov/", $hook, $match)){
				if($hook == $type_home)
					$hooks[] = $hook;
			}
			else{
				$hooks[] = $hook;
			}	
		}

		$datas =  $novpagemanage->getDataPage($hooks);	
		$fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->l('Manage Page'),
                'image' => __PS_BASE_URI__.'modules/'.$this->name.'/logo.png'
            ),
            'submit' => array(
                'title' => $this->l('Save'),
            ),
            'input' => array(
                array(
                    'type' => 'homepage',
                    'name' => 'homepage',
                ),
            ),
            'submit' => array(
            ),
        );
		
        $helper->base_tpl= 'form.tpl';
        
        $helper->show_toolbar = false;
        $lang = new Language((int) Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form = array();
        $helper->module = $this;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitMenu';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $language = new Language((int) Configuration::get('PS_LANG_DEFAULT'));
        $helper->tpl_vars = array(
            'base_url' => $this->context->shop->getBaseURL(),
            'language' => array(
                'id_lang' => $language->id,
                'iso_code' => $language->iso_code
            ),
            'languages' 	=> $this->context->controller->getLanguages(),
            'id_language' 	=> $this->context->language->id,
			'hooks'			=> $hooks,
			'datas'			=> $datas,
			'currentIndex' 	=> $helper->currentIndex.'&token='.$helper->token,
			'sources'		=> $this->sources
        );
        $helper->override_folder = '/';
     return $helper->generateForm($fields_form);
    }
	
	public function processHook($params,$hook="displayHome")
	{
		$html ='';
		
		$homepage = new PageManage();
		$datas = $homepage->getDataByHook($hook);
		if(!$datas)
			return;
			foreach($datas as $data){
				$config = ($data['data']) ? $data['data'] : array();
				if($config['active'] == 1){
					$data_type = $data['type'];
					$data_type = explode("-",$data_type);
					$class = "Mega".ucfirst($data_type[0]);
					$object = new $class;
					$item 	= $object->getDataSource($config);	
					$item_type = explode("-",$data['type']);
					if($data['type'] == 'module'){
						$html .= $this->getContentModule( $config,$item,$params);
					}elseif($data['type'] == 'row'){
						$col = $item['data']['columns'];
						$class = ($item['data']['class']) ? ($item['data']['class']) : '' ;
						$style_row = '';
						if (isset($item['data']['bg_color']) && $item['data']['bg_color'] != '') {
							$style_row .= 'style="';
							$style_row .= "background-color: ". $item['data']['bg_color'] . ";";
							$style_row .= '"';
						}
						$bg_row = '';
						if (isset($item['data']['image1']) && $item['data']['image1'] != ''){
							$bg_row .= '<div class="background-row" style="';
							$bg_row .= 'background-image: url('._MODULE_DIR_. $this->name. '/img/'. $item["data"]["image1"] .');';
							$bg_row .= '"></div>';
						}
						
						if (isset($item['data']['has_container']) && $item['data']['has_container'] == 1)
							$html .= '<div class="nov-row '.$class.'" '. $style_row .'>'. $bg_row .'<div class="container">';
						else 
						$html .= '<div class="nov-row '.$class.' col-lg-'.$col.' col-xs-12" '. $style_row .'>'. $bg_row;
						if(isset($item['data']['show_title']) && $item['data']['show_title'] == 1 && isset($item['data']['title']) && !empty($item['data']['title']))
						{	
							$html .='<div class="title_block">';
								if (isset($item['data']['image_icon']) && $item['data']['image_icon'])
									$html .= '<img src="'. _MODULE_DIR_.$this->name .'/img/'. $item['data']['image_icon'] .'" alt="icon title" />';
								$html .= '<span>'.$item['data']['title'].'</span>';
								if(isset($item['data']['sub_title']) && !empty($item['data']['sub_title'])){
									$html .= '<span class="sub_title">'.$item['data']['sub_title'].'</span>';
								}
							$html .='</div>';
						}
						$html .= '<div class="nov-row-wrap row">';
							foreach($datas as $key=>$data1){
								$item_type1 = explode("-",$data1['type']);
								if(isset($item_type1[1]) && ($item_type1[1] == "row".$data['id_novpagemanage'])){
									$config1 = ($data1['data']) ? $data1['data'] : array();
									if($config1['active'] == 1){
										$data1_type = $data1['type'];
										$data1_type = explode("-",$data1_type);
										$class = "Mega".ucfirst($data1_type[0]);
										$object = new $class;
										$item1 	= $object->getDataSource($config1);
										if(strpos($data1['type'], "module") === false)
											$html .= $this->getDataBySource($data1['id_novpagemanage'],$item1['data'],$data1['hook'],$data1['type']); 	
										else
											$html .= $this->getContentModule( $config1,$item1,$params);
									}
								}
							}
						if (isset($item['data']['has_container']) && $item['data']['has_container'] == 1)
							$html .= '</div></div></div>';
						else
							$html .= '</div></div>';
					}elseif(strpos($data['type'], "row") === false){
						$html .= $this->getDataBySource($data['id_novpagemanage'],$item['data'],$data['hook'],$data['type']); 
					}
				}	
			}	
		
		return $html;
	}
	
	public function getContentModule( $config,$item,$params){
		$html = '';
		$name_module = $config['name_module'];
		if(file_exists(_PS_MODULE_DIR_ .$name_module.'/'.$name_module.'.php')){
			include_once(_PS_MODULE_DIR_ .$name_module.'/'.$name_module.'.php');
			$class_module = new $name_module($this->entity_manager);
			$col = $item['data']['columns'];
			$class = ($item['data']['class']) ? ($item['data']['class']) : '' ;
			$html .= '<div class="nov-modules col-lg-'.$col.' col-md-'.$col.' '. $class .'">';
			$html .= '<div class="block nov-wrap">';
			if(isset($item['data']['show_title']) && $item['data']['show_title'] == 1 && isset($item['data']['title']) && !empty($item['data']['title']))
			{	
				$html .='<div class="title_block">';
					if( isset($item['data']['image_icon']) && !empty($item['data']['image_icon'])){
						$html .= '<img class="img-fluid" src="'. _MODULE_DIR_. $this->name. '/img/'. $item["data"]["image_icon"] .'" alt="icon title">';
					}
					$html .= $item['data']['title'];
					if( isset($item['data']['sub_title']) && !empty($item['data']['sub_title']) ){
						$html .='<span class="sub_title">'.$item['data']['sub_title'].'</span>';
					}
				$html .='</div>';
			}	
			
			$moduleInstance = Module::getInstanceByName($name_module);
			$sp_hook = $config['sp_hook'];
			$hook = str_replace("hook","",$sp_hook);
			$content_module = '';
			if (is_callable(array($moduleInstance,$sp_hook))){
				$content_module = $class_module->$sp_hook($params);	
			}else{
				$content_module = $class_module->renderWidget($hook, $params);
			}								
			$html .= $content_module;
			$html .= '</div></div>';	
		}	
		return $html;	
	}	
	
	public function getHookByIdModule($id_module,$id_shop){
		$hooks = $this->getHookFromModule($id_module);
		$module = Module::getInstanceById((int)($id_module));
		$name_module = $module->name;
		$moduleInstance = Module::getInstanceByName($name_module);
		$hook_function = array();
		if($hooks){
			foreach( $hooks as $hook){
				if (in_array($hook,$this->hookSupport)){
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
	
	public function getDataBySource($id_novpagemanage,$data ,$hook,$type){
        $this->smarty->assign( $data );
		$type = explode("-",$type);
		if(file_exists(_PS_ALL_THEMES_DIR_.$this->themeName.'/modules/'.$this->name.'/views/source/'.$hook.'/'.$type[0].'.tpl')){
            $html = $this->display(__FILE__, 'views/source/'.$hook.'/'.$type[0].'.tpl',$this->getCacheId($this->name.'_'.$hook.'_'.$id_novpagemanage) );
        }else {
            $html = $this->display(__FILE__, 'views/source/'.$type[0].'.tpl',$this->getCacheId($this->name.'_'.$hook.'_'.$id_novpagemanage) );
        }

        return $html;
    }

    public function hookdisplayHeader($params)
    {
		$this->context->controller->addJS( __PS_BASE_URI__.'modules/'.$this->name.'/libs/js/filter.js' );
        $this->context->controller->registerJavascript('instagram', 'modules/'.$this->name.'/libs/js/instafeed.min.js', ['position' => 'bottom', 'priority' => 150]);
        $this->smarty->assign('novpagemanage_img' , _MODULE_DIR_.$this->name.'/img/');
    }
	
	public function hookCategoryAddition($params) {
        $this->clearCacheAllHook();
    }
	
	public function hookAddProduct($params) {
        $this->clearCacheAllHook();
    }

    public function hookUpdateProduct($params) {
        $this->clearCacheAllHook();
    }

    public function hookDeleteProduct($params) {
        $this->clearCacheAllHook();
    }
	

    public function hookCategoryUpdate($params) {
        $this->clearCacheAllHook();
    }

    public function hookCategoryDeletion($params) {
        $this->clearCacheAllHook();
    }
    
	private function getFileName($path,$file) {
        $result = array();
        $allfiles = glob($path . '*' . $file);
        foreach ($allfiles as $name) {
            $name = basename($name);
            $name = str_replace($file, '', $name);
            $result[$name] = $name;
        }
        return $result;
    }
	
	public function clearCache($homepage){
			if($homepage)
				$this->_clearCache($homepage->type.'tpl', $this->name.'_'.$homepage->hook.'_'.$homepage->id);	
    }
	
	public function clearCacheAllHook(){
		$homepage = new PageManage();
		foreach($this->hooks as $hook){
           	$datas = $homepage->getDataByHook($hook);
			foreach($datas as $data){
				if($data){
					$this->_clearCache($data['type'].'tpl', $this->name.'_'.$data['hook'].'_'.$data['id_novpagemanage']);	
				}
			}
        }
    }
	
	public function hookActionObjectLanguageAddAfter($params)
	{
		return $this->installFixtures((int)$params['object']->id);
	}
	
	public function installFixtures($id_lang = null)
	{
		$res = true;
		$id_shop    = Context::getContext()->shop->id;
		$manages = PageManage::getAllManage($id_shop);
		foreach ($manages as $manage)
		{
			$homepage = new PageManage((int)$manage['id_novpagemanage']);
			$data = Tools::jsonDecode(base64_decode($homepage->data), true);
			$id_lang_default = Configuration::get('PS_LANG_DEFAULT');
			$data['title_'.$id_lang] = $data['title_'.$id_lang_default] ? $data['title_'.$id_lang_default] : '';
			if($manage['type'] = 'html')
				$data['html_'.$id_lang] = $data['html_'.$id_lang_default] ? $data['html_'.$id_lang_default] : '';
				$homepage->data = base64_encode(Tools::jsonEncode($data));	
				$result = $homepage->save();
		}
		
		return $result;
	}
	public function ajaxFilterProduct($id_category,$id_manufacture,$id_attribute,$orderby,$limit,$count_showmore,$numberload,$min_price,$max_price){
		$id_language = Context::getContext()->language->id;
		$filter_category = $filter_manufacture = $filter_attribute = $filter_price = "";
		if($id_category && $id_category != 0)
			$filter_category = ' AND  cp.id_category =  '.(int)($id_category). ' ';
		if($id_manufacture)
			$filter_manufacture = ' AND  m.id_manufacturer IN  (' . pSQL($id_manufacture) . ') ';
		if($id_attribute)
			$filter_attribute = ' AND lpa.id_attribute IN (' . pSQL($id_attribute) . ') ';	
		if($min_price && $max_price)
			$filter_price =  ' AND  p.price BETWEEN  '.(float)($min_price).' AND '.(float)($max_price).'';		
		$orderway = "DESC";
		$products = $this->getFilterProducts($filter_category,$filter_manufacture,$filter_attribute,$filter_price,$id_language,$count_showmore, $limit,$numberload,false,$orderby,$orderway);	
		$assembler = new ProductAssembler(Context::getContext());
		$presenterFactory = new ProductPresenterFactory(Context::getContext());
		$presentationSettings = $presenterFactory->getPresentationSettings();
		$presenter = new ProductListingPresenter(
			new ImageRetriever(
				Context::getContext()->link
			),
			Context::getContext()->link,
			new PriceFormatter(),
			new ProductColorsRetriever(),
			Context::getContext()->getTranslator()
		);	
		
		if($products){
			foreach ($products as &$product)
			{
				$product = $presenter->present(
								$presentationSettings,
								$assembler->assembleProduct($product),
								Context::getContext()->language
						);
			}						
		}		

		$this->smarty->assign(array(
			'products'	=> $products,
			'link'	=> Context::getContext()->link,
			'static_token'	=> Tools::getToken(false),
			'number_load' => $numberload
		));
		return $this->display(__FILE__, 'views/source/filter_products.tpl');
	}	
	
	public  function getFilterProducts($filter_category,$filter_manufacture,$filter_attribute,$filter_price,$id_lang, $page_number = 0, $nb_products = 10, $numberload = 4, $count = false, $order_by = null, $order_way = null, Context $context = null)
	{
		if (!$context)
			$context = Context::getContext();

		$front = true;
		if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
			$front = false;

		if ($page_number < 0) $page_number = 0;
		if ($nb_products < 1) $nb_products = 10;
		if (empty($order_by) || $order_by == 'position') $order_by = 'date_add';
		if (empty($order_way)) $order_way = 'DESC';
		if ($order_by == 'id_product' || $order_by == 'price' || $order_by == 'date_add'  || $order_by == 'date_upd')
			$order_by_prefix = 'p';
		else if ($order_by == 'name')
			$order_by_prefix = 'pl';
		if (!Validate::isOrderBy($order_by) || !Validate::isOrderWay($order_way))
			die(Tools::displayError());

		$sql_groups = '';
		if (Group::isFeatureActive())
		{
			$groups = FrontController::getCurrentCustomerGroups();
			$sql_groups = 'AND p.`id_product` IN (
				SELECT cp.`id_product`
				FROM `'._DB_PREFIX_.'category_group` cg
				LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (cp.`id_category` = cg.`id_category`)
				WHERE cg.`id_group` '.(count($groups) ? 'IN ('.implode(',', $groups).')' : '= 1').' 
			)';
		}

		if (strpos($order_by, '.') > 0)
		{
			$order_by = explode('.', $order_by);
			$order_by_prefix = $order_by[0];
			$order_by = $order_by[1];
		}

		if ($count)
		{
			$sql = 'SELECT COUNT(p.`id_product`) AS nb
					FROM `'._DB_PREFIX_.'product` p
					'.Shop::addSqlAssociation('product', 'p').'
					WHERE product_shop.`active` = 1
					AND product_shop.`date_add` > "'.date('Y-m-d', strtotime('-'.(Configuration::get('PS_NB_DAYS_NEW_PRODUCT') ? (int)Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY')).'"
					'.($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '').'
					'.$sql_groups;
			return (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($sql);
		}

		$sql = new DbQuery();
		$sql->select(
			'p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity, pl.`description`, pl.`description_short`, pl.`link_rewrite`, pl.`meta_description`,
			pl.`meta_keywords`, pl.`meta_title`, pl.`name`, pl.`available_now`, pl.`available_later`, MAX(image_shop.`id_image`) id_image, il.`legend`, m.`name` AS manufacturer_name,
			product_shop.`date_add` > "'.date('Y-m-d', strtotime('-'.(Configuration::get('PS_NB_DAYS_NEW_PRODUCT') ? (int)Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY')).'" as new'
		);

		$sql->from('product', 'p');
		$sql->join(Shop::addSqlAssociation('product', 'p'));
		$sql->leftJoin('product_lang', 'pl', '
			p.`id_product` = pl.`id_product`
			AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl')
		);
		$sql->leftJoin('image', 'i', 'i.`id_product` = p.`id_product`');
		$sql->join(Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1'));
		$sql->leftJoin('image_lang', 'il', 'i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)$id_lang);
		$sql->leftJoin('manufacturer', 'm', 'm.`id_manufacturer` = p.`id_manufacturer`');
		$sql->leftJoin('category_product', 'cp', 'cp.`id_product` = p.`id_product`');
		$sql->leftJoin('layered_product_attribute', 'lpa', 'lpa.`id_product` = p.`id_product`');

		$sql->where('product_shop.`active` = 1'.$filter_category.$filter_manufacture.$filter_attribute.$filter_price);
		if ($front)
			$sql->where('product_shop.`visibility` IN ("both", "catalog")');
		$sql->where('product_shop.`date_add` > "'.date('Y-m-d', strtotime('-'.(Configuration::get('PS_NB_DAYS_NEW_PRODUCT') ? (int)Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY')).'"');
		if (Group::isFeatureActive())
			$sql->where('p.`id_product` IN (
				SELECT cp.`id_product`
				FROM `'._DB_PREFIX_.'category_group` cg
				LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (cp.`id_category` = cg.`id_category`)
				WHERE cg.`id_group` '.$sql_groups.'
			)');
		$sql->groupBy('product_shop.id_product');

		$sql->orderBy((isset($order_by_prefix) ? pSQL($order_by_prefix).'.' : '').'`'.pSQL($order_by).'` '.pSQL($order_way));
		if($page_number == 0) {
			$sql->limit($nb_products, 0);
		} else {
			$sql->limit( $numberload, $nb_products + ( ($page_number-1) * $numberload) );
		}
		

		if (Combination::isFeatureActive())
		{
			$sql->select('MAX(product_attribute_shop.id_product_attribute) id_product_attribute');
			$sql->leftOuterJoin('product_attribute', 'pa', 'p.`id_product` = pa.`id_product`');
			$sql->join(Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.default_on = 1'));
		}
		$sql->join(Product::sqlStock('p', Combination::isFeatureActive() ? 'product_attribute_shop' : 0));
		//echo"<pre>".print_r($sql,1);die();		
		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
		if ($order_by == 'price')
			Tools::orderbyPrice($result, $order_way);
		if (!$result)
			return false;

		$products_ids = array();
		//echo"<pre>".print_r($result,1);die();
		foreach ($result as $row)
			$products_ids[] = $row['id_product'];
		// Thus you can avoid one query per product, because there will be only one query for all the products of the cart
		Product::cacheFrontFeatures($products_ids, $id_lang);
		return Product::getProductsProperties((int)$id_lang, $result);
	}		
}