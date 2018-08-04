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
use PrestaShop\PrestaShop\Adapter\Category\CategoryProductSearchProvider;
use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Core\Product\ProductListingPresenter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;
if( !class_exists("Megacountdown_product") ){
class Megacountdown_product extends Megasource {
	public $type = 'countdown_product';
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
			
			$type_product = array(
				array(
					'id' => 'new',
					'label' => $this->l('New')
				),
				array(
					'id' => 'bestseller',
					'label' => $this->l('Bestseller')
				),
				array(
					'id' => 'special',
					'label' => $this->l('Special')
				),
				array(
					'id' => 'featured',
					'label' => $this->l('Featured')
				),
				array(
					'id' => 'toprating',
					'label'  => $this->l('Products Top Rating')
				),
				array(
					'id' => 'mostview',
					'label'  => $this->l('Products Most View')
				)				
		 	);
			
			
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
			
			$orderWay = array(
			  array(
				'value' => 'ASC',                 
				'name' 	=> 	$this->l('Ascending')            
			  ),
			  array(
				'value' => 'DESC',               
				'name' 	=> 	$this->l('Descending')           
			  ),
			);
			$show_countdown = array(
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
			if($data &&  isset($data['categories']) && $data['categories'])
				$selected = $data['categories'];
				
			$this->fields_form[0]['form'] = array(
				'tinymce' => true,
	            'legend' => array(
	                'title' => $this->l('Countdown Product List.'),
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
	                    'type' 	  => 'select',
	                    'label'   => $this->l('Products'),
	                    'name' 	  => 'type_product',
	                    'options' => array(  'query' => $type_product,
		                    'id' 	  => 'id',
		                    'name' 	  => 'label' ),
	                    'default' => "new",
	                    'desc'    => $this->l('Select Product Type')
	                ),
					array(
					  'type' => 'select',                              
					  'label' => $this->l('Order By'),          
					  'name' => 'orderby',   
					  'default' => 'date_add',		                          
					  'options' => array(
						'query' => $orderBy,                          
						'id' => 'value',                           
						'name' => 'name'                               
					  )
					),
					array(
					  'type' => 'select',                              
					  'label' => $this->l('Order Way'),          
					  'name' => 'orderway',   
					  'default' => 'date_add',		                          
					  'options' => array(
						'query' => $orderWay,                          
						'id' => 'value',                           
						'name' => 'name'                               
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
						'desc'  => $this->l('Value 30px default')
	                ),
					array(
						'type' => 'switch',
						'label' => $this->l('Show CountDown Time'),
						'name' => 'show_countdown',
						'values' => $show_countdown,
						'default' => 0,
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Show list thumnail product'),
						'name' => 'show_thumnail',
						'values' => $active,
						'default' => 0,
					),
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Number thumnail'),
	                    'name'  => 'number_thumnail',
	                    'default'=> 3,
						'desc'  => $this->l('show 3 item thumnail')
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
			$data['show_thumnail'] = isset($config['show_thumnail']) ? ($config['show_thumnail']): 0;
			$data['number_thumnail'] = isset($config['number_thumnail']) ? ($config['number_thumnail']): 3;
			$data['columns'] = isset($config['columns']) ? ($config['columns']) : 12;
			$nb = ($config['itab']) ? (int)($config['itab']) : 6;
            $orderby = ($config['orderby']) ? ($config['orderby']) : 'date_add';
			$orderway = ($config['orderway']) ? ($config['orderway']) : 'ASC';
            $icolumn 	= ($config['icolumn']) ? (int)($config['icolumn']) : 3;
            $column_tablet 	= ($config['column_tablet']) ? (int)($config['column_tablet']) : 3;
            $column_mobile 	= ($config['column_mobile']) ? (int)($config['column_mobile']) : 2;
            $spacing_item 	= ($config['spacing_item']) ? (int)($config['spacing_item']) : 0;
			$filter = '';
			$id_categorys = (isset($config['categories']) && $config['categories']) ? ($config['categories']) : array();
			if($id_categorys){
				$categories = implode(",",$id_categorys);
				$filter = ' AND  cp.id_category IN  (' . pSQL($categories) . ')';
			}
			switch ( $config['type_product'] ) {
				case 'new':
					 $products = $this->getNewProducts($filter,$id_language, 0, $nb,false,$orderby,$orderway );
					break;
				case 'featured':
					$category = new Category(Context::getContext()->shop->getCategory(), $id_language );
					$products = $category->getProducts((int)$id_language, 1, $nb,$orderby,$orderway);
					break;
				case 'bestseller':
					$products = $this->getBestSales($filter,(int)$id_language, 0, $nb,$orderby,$orderway);
					break;	
				case 'special': 
					 $products = $this->getPricesDrop($filter,$id_language, 0, $nb,false,$orderby,$orderway);
					break;
		 		case 'toprating': 
			 		 $products = $this->getSpecialProducts($filter, 0, $nb );
			 		break;
		 		case 'mostview': 
			 		 $products = $this->getSpecialProducts($filter, 0, $nb, true, null, 'mostview' );
			 		break;					
			}
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
			if ( isset($products) && $products) {
				foreach ($products as &$product)
				{
					$product = $presenter->present(
						$presentationSettings,
						$assembler->assembleProduct($product),
						Context::getContext()->language
					);
				}
			}
			$data['spacing_item'] = $spacing_item;	
			$data['products'] = $products;
			$data['colspage'] = $icolumn;
			$data['column_tablet'] = $column_tablet;
			$data['column_mobile'] = $column_mobile;
			$data['scolumn']    = 12 / $icolumn;
			$data['name_tab'] = 'productlist'.rand(10,rand());
			$result = array('data' => $data );
	  		return $result;
		}
		
	} 
}
?>