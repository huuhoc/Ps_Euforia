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

class PageManage extends ObjectModel
{
	public $id;
    public $id_novpagemanage;
	public $id_shop;
    public $position;
	public $data;
	public $type;
	public $hook;
	/**
	 * @see ObjectModel::$definition
	 */
 public static $definition = array(
        'table' => 'novpagemanage',
        'primary' => 'id_novpagemanage',
        'multilang' => false,
        'fields' => array(
			'type' => array('type' => self::TYPE_STRING, 'validate' => 'isCatalogName', 'size' => 50),
			'hook' => array('type' => self::TYPE_STRING, 'validate' => 'isCatalogName', 'size' => 50),
            'position' => array('type' => self::TYPE_INT),
            'data' => array('type' => self::TYPE_STRING, 'lang' => false, 'validate' => 'isString'),
			'id_shop' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
        ),
    );

	public function add($autodate = true,$null_values = false)
	{
		return parent::add($autodate,$null_values);
	}

	public function update($null_values = false)
	{
		parent::update($null_values);
	}
	
	public function delete()
	{
		parent::delete();
	}
	
	public function getDataPage($hooks){
		$id_lang    = Context::getContext()->language->id;
		$id_shop    = Context::getContext()->shop->id;
		$sql = ' SELECT *
					FROM ' . _DB_PREFIX_ . 'novpagemanage 
							WHERE id_shop = ' . (int) ($id_shop).'
								ORDER BY position
							';		
		$result = 	Db::getInstance()->executeS($sql);
		$data = array();

		foreach($hooks as $hook){
			$data[$hook] = array();
			if($result){
				foreach($result as $key=>$item){
					$item_type = explode("-",$item['type']);
					if($item['hook'] == $hook && !isset($item_type[1])){
						$item['data'] = Tools::jsonDecode(base64_decode($item['data']), true);
						if($item['type'] == 'module'){
							$name_module = $item['data']['name_module'];
							$module_instance = Module::getInstanceByName($name_module);
							if (Validate::isLoadedObject($module_instance) && method_exists($module_instance, 'getContent'))
								$item['data']['link_module'] = Context::getContext()->link->getAdminLink('AdminModules', true).'&configure='.urlencode($module_instance->name).'&tab_module='.$module_instance->tab.'&module_name='.urlencode($module_instance->name);
						}elseif($item['type'] == 'row'){
							foreach($result as $key1=>$item1){
								$item1['data'] = Tools::jsonDecode(base64_decode($item1['data']), true);
								$item_type1 = explode("-",$item1['type']);
								if(isset($item_type1[1]) && ($item_type1[1] == "row".$item['id_novpagemanage']))
								$item['row'][] = 	$item1;
							}
						}
						$data[$hook][] = $item;
					}
				}
			}
		}	
		//echo "<pre>".print_r($data,1);
		return $data;					
	}
	
	public function getDataByHook($hook){
		$id_lang    = Context::getContext()->language->id;
		$id_shop    = Context::getContext()->shop->id;
		$sql = ' SELECT *
					FROM ' . _DB_PREFIX_ . 'novpagemanage 
							WHERE id_shop = ' . (int) ($id_shop).'
							AND hook = \''.pSQL($hook).'\'
							ORDER BY position'
							;		
		$result = 	Db::getInstance()->executeS($sql);
		$data = array();
		if($result){
			foreach($result as $key=>$item){
				if($item['hook'] == $hook){
					$item['data'] = Tools::jsonDecode(base64_decode($item['data']), true);
					$data[] = $item;
				}
			}
		}
		return $data;					
	}
	
	public function getPositon($hook){
		$sql = ' SELECT MAX(position) as max
					FROM ' . _DB_PREFIX_ . 'novpagemanage
					WHERE  hook = \''.pSQL($hook).'\'';
		$max =  Db::getInstance()->getRow($sql);
		return $max['max'] + 1;	
	}
	public static function getAllManage($id_shop = null){
		if(!$id_shop)
			$id_shop    = Context::getContext()->shop->id;
		$sql = ' SELECT id_novpagemanage,type
			FROM ' . _DB_PREFIX_ . 'novpagemanage
			WHERE  id_shop ='.(int)$id_shop;
		return 	Db::getInstance()->executeS($sql);
	}
}
