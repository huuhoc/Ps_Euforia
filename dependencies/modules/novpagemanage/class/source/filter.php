<?php 
/******************
 * Vinova Themes  Framework for Prestashop 1.7.x 
 * @package   	novpagemanage
 * @version   	1.0
 * @author   	http://vinovathemes.com/
 * @copyright 	Copyright (C) May 2017 vinovathemes.com <@emai:vinovathemes@gmail.com>
 * <info@vinovathemes.com>.All rights reserved.
 * @license   GNU General Public License version 1
 
 * *****************/
use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
use PrestaShop\PrestaShop\Adapter\Category\CategoryProductSearchProvider;
use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Core\Product\ProductListingPresenter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;

if( !class_exists("Megafilter") ){
class Megafilter extends Megasource {
	public $type = 'filter';
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
			
			$selected = array();
			$image = '';
			if($data &&  isset($data['categories']) && $data['categories'])
				$selected = $data['categories'];
			if($data &&  isset($data['image']) && $data['image'])
				$image = $data['image'];	
			
			$this->fields_form[0]['form'] = array(
				'tinymce' => true,
	            'legend' => array(
	                'title' => $this->l('Ajax Filter Product'),
	            ),
	            'input' => array(
					array(
	                    'type' => 'text',
	                    'label' => $this->l('Ajax Filter Title'),
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
					'type'  => 'categories',
					'label' => $this->l('Categories'),
					'name'  => 'categories',
					'default' => '',	
					'tree'  => array(
						'id'                  => 'categories',
						'title'               => 'Categories',
						'selected_categories' => $selected,
						'use_search'          => true,
						'use_checkbox'        => true
						)
					),				
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Number Product Show First'),
	                    'name'  => 'limit',
	                    'default'=> 8,
						'desc'  => $this->l('The number of products in Tab (default: 8).')
	                ),
	                array(
	                    'type'  => 'text',
	                    'label' => $this->l('Number Product Load More'),
	                    'name'  => 'number_load',
	                    'default'=> 4,
						'desc'  => $this->l('The  number of products in Tab (default: 4).')
	                ),
	                array(
						'type' => 'switch',
						'label' => $this->l('Show tab "All product"'),
						'name' => 'show_all_product',
						'values' => $active,
						'default' => 1,
					),
	                array(
						'type' => 'switch',
						'label' => $this->l('Show SortBy'),
						'name' => 'show_sort',
						'values' => $active,
						'default' => 1,
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Show Filter'),
						'name' => 'show_filter',
						'values' => $active,
						'default' => 1,
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Show Loadmore'),
						'name' => 'show_loadmore',
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
			$id_language = Context::getContext()->language->id;
			$data['title'] = isset($config['title_'.$id_language])?($config['title_'.$id_language]): "";
			$data['sub_title'] = isset($config['sub_title_'.$id_language])?($config['sub_title_'.$id_language]): "";
			$data['class'] = isset($config['class']) ? ($config['class']): "";	
			$data['show_title'] = isset($config['show_title']) ? ($config['show_title']): 1;
			$data['active'] = isset($config['active']) ? ($config['active']): 1;
			$data['columns'] = isset($config['columns']) ? ($config['columns']) : 12;
			$data['limit'] = ($config['limit']) ? (int)($config['limit']) : 4;
			$data['number_load'] = ($config['number_load']) ? (int)($config['number_load']) : 4;
			$data['show_all_product'] = isset($config['show_all_product']) ? ($config['show_all_product']): 1;
			$data['show_sort'] = isset($config['show_sort']) ? ($config['show_sort']): 1;
			$data['show_filter'] = isset($config['show_title']) ? ($config['show_filter']): 1;
			$data['show_loadmore'] = isset($config['show_loadmore']) ? ($config['show_loadmore']): 1;
			$filter = '';
			$data['categories'] = array();
			$products = array();
			$id_categorys = (isset($config['categories']) && $config['categories']) ? ($config['categories']) : array();
			if($id_categorys){
				$id_categories = implode(",",$id_categorys);
				$filter = ' AND  cp.id_category IN  (' . pSQL($id_categories) . ')';
				$products = $this->getNewProducts($filter,$id_language, 0, $data['limit'],false);
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
				
				foreach($id_categorys as $id_category){
					$category = new Category((int)$id_category,Context::getContext()->language->id);
					$data['categories'][$category->id_category]	 			= $category->name;
				}	
			}

			$orderBy = array(
			  array(
				'value' => 'date_add',                
				'name' 	=> 	$this->l('Date Add')            
			  ),
			  array(
				'value' => 'date_upd',               
				'name' 	=> 	$this->l('Date Update')             
			  ),
			  array(
				'value' => 'name',
				'name' 	=> $this->l('Name')
			  ),
			  array(
				'value' => 'id_product',
				'name' 	=> $this->l('Product Id')
			  ),
			  array(
				'value' => 'price',
				'name' 	=> $this->l('Price')
			  ),
			);
			
			$atributes = array();
			$attribute_groups = AttributeGroup::getAttributesGroups(Context::getContext()->language->id);
			if($attribute_groups){
				foreach($attribute_groups as $attribute_group){
					$atributes[$attribute_group['id_attribute_group']]['name'] = $attribute_group['name'];
					$atributes[$attribute_group['id_attribute_group']]['is_color_group'] = $attribute_group['is_color_group'];
					$res = AttributeGroup::getAttributes(Context::getContext()->language->id,$attribute_group['id_attribute_group']);
					if($res){
						foreach ($res as &$row) {
							$row['texture'] = '';
							if (Tools::isEmpty($row['color']) && !@filemtime(_PS_COL_IMG_DIR_.$row['id_attribute'].'.jpg')) {
								continue;
							} elseif (Tools::isEmpty($row['color']) && @filemtime(_PS_COL_IMG_DIR_.$row['id_attribute'].'.jpg')) {
								$row['texture'] = _THEME_COL_DIR_.$row['id_attribute'].'.jpg';
							}
						}
					}
					//echo "<pre>".print_r($res,1);die();
					$atributes[$attribute_group['id_attribute_group']]['atribute'] = $res;
				}
			}

			$manus = Manufacturer::getManufacturers(true, Context::getContext()->language->id, true, false ,false, false);
			
			$aggregatedRanges = $this->getRangesFromList($products,'price_without_reduction');
			$data['products'] 					= $products;
			$data['atributes'] 					= $atributes;
			$data['scolumn']    				= $data['columns'] ;
			$data['orderby']					= $orderBy;
			$data['manus']						= $manus;
			$data['aggregatedRanges']			= $aggregatedRanges;
			$data['action']			= Context::getContext()->shop->physical_uri.Context::getContext()->shop->virtual_uri.'modules/'.$this->name.'/ajax_filter.php?secure_key='.Tools::encrypt($this->name);	
			$data['tab'] 			= 'productfilter'.rand(10,rand());
			$result = array('data' => $data );
			
	  		return $result;
		}		
		
		public function getRangesFromList(array $list, $valueColumnIndex)
		{
			$min = null;
			$max = null;

			$byValue = [];
			foreach ($list as $item) {
				$n = $item[$valueColumnIndex];
				if ($min === null || $n < $min) {
					$min = $n;
				}
				if ($max === null || $n > $max) {
					$max = $n;
				}

				$key = "n$n";
				if (!array_key_exists($key, $byValue)) {
					$byValue[$key] = [
						'count' => 0,
						'value' => $n,
					];
				}
				++$byValue[$key]['count'];
			}

			$ranges = [];
			$lastValue = null;
			$lastCount = 0;

			usort($byValue, function (array $a, array $b) {
				return $a['value'] > $b['value'] ? 1 : -1;
			});

			foreach ($byValue as $countAndValue) {
				$value = $countAndValue['value'];
				$count = $countAndValue['count'];
				if ($lastValue !== null) {
					$ranges[] = [
						'min' => $lastValue,
						'max' => $value,
						'count' => $count + $lastCount,
					];
				} else {
					$lastCount = $count;
				}
				$lastValue = $value;
				$lastCount = $count;
			}

			return [
				'min' => $min,
				'max' => $max,
				'ranges' => $ranges,
			];
		}		
		
	} 
}
?>