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

if( !class_exists("Megaproducttab") ){
class Megaproducttab extends Megasource {
	public $type = 'producttab';
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
			
			$selected = array();
			$image = '';
			if($data &&  isset($data['categories']) && $data['categories'])
				$selected = $data['categories'];
			if($data &&  isset($data['image']) && $data['image'])
				$image = $data['image'];	
			
			$this->fields_form[0]['form'] = array(
				'tinymce' => true,
	            'legend' => array(
	                'title' => $this->l('Product Tab.'),
	            ),
	            'input' => array(
					array(
	                    'type' => 'text',
	                    'label' => $this->l('Product Tab Title'),
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
						'type' => 'switch',
						'label' => $this->l('Special Tab'),
						'name' => 'show_special',
						'desc' => $this->l('Show Special Tab.'),
						'default'=> 1,
						'values' => $active,
					),
					array(
						'type' => 'switch',
						'label' => $this->l('BestSeller Tab'),
						'name' => 'show_bestseller',
						'desc' => $this->l('Show BestSeller Tab.'),
						'default'=> 1,
						'values' => $active,
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Featured Tab'),
						'name' => 'show_display',
						'desc' => $this->l('Show Featured Tab.'),
						'default'=> 1,
						'values' => $active,
					),
					array(
						'type' => 'switch',
						'label' => $this->l('New Arrials Tab'),
						'name' => 'show_newproduct',
						'desc' => $this->l('Show New Arrials Tab.'),
						'default'=> 1,
						'values' => $active,
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Top Rating'),
						'name' => 'show_toprating',
						'desc' => $this->l('Show Top Rating Product.'),
						'default'=> 1,
						'values' => $active,
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Products Most View'),
						'name' => 'show_mostview',
						'desc' => $this->l('Show Products Most View.'),
						'default'=> 1,
						'values' => $active,
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
						'desc'  => $this->l('The  number of products in Tab (default: 6).')
	                ),
	                array(
	                    'type'  => 'text',
	                    'label' => $this->l('Item In Page'),
	                    'name'  => 'ipage',
	                    'default'=> 3,
						'desc'  => $this->l('The  number of products in  Page (default: 3).')
	                ),
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Colum In Tab'),
	                    'name'  => 'icolumn',
	                    'default'=> 3,
						'desc'  => 'The column products in  Page  (default: 3).'
	                ),
					array(
	                    'type'  => 'text',
	                    'label' => $this->l('Interval'),
	                    'name'  => 'interval',
	                    'default'=> 8000,
						'desc'  => $this->l('Value 0 to stop.')
	                ),
					array(
						'type' => 'file',
						'label' => $this->l('Image'),
						'name' => 'image',
						'desc' => $this->l('By default the image will appear in the left column. The recommended dimensions are 155 x 163px.'),
						'thumb' => _MODULE_DIR_.$this->name.'/img/'.$image,
						'default'=> '',
					),					
					array(
						'type' => 'switch',
						'label' => $this->l('Show Image'),
						'name' => 'show_image',
						'desc' => $this->l('Show Image Tab.'),
						'default'=> 0,
						'values' => $active
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
			$data['image'] = isset($config['image']) ? ($config['image']) : '';
			$data['show_newproduct'] = isset($config['show_newproduct']) ? ($config['show_newproduct']) : 1;
			$data['show_special'] = isset($config['show_special']) ? ($config['show_special']) : 1;
			$data['show_bestseller'] = isset($config['show_bestseller']) ? ($config['show_bestseller']) : 1;
			$data['show_display'] = isset($config['show_display']) ? ($config['show_display']) : 1;
			$data['show_toprating'] = isset($config['show_toprating']) ? ($config['show_toprating']) : 1;
			$data['show_mostview'] = isset($config['show_mostview']) ? ($config['show_mostview']) : 1;
			$data['show_image'] = isset($config['show_image']) ? ($config['show_image']) : 0;
			$nb = ($config['itab']) ? (int)($config['itab']) : 6;
            $orderby = ($config['orderby']) ? ($config['orderby']) : 'date_add';
			$orderway = ($config['orderway']) ? ($config['orderway']) : 'ASC';
			$ipage 	= 	($config['ipage']) ? (int)($config['ipage']) : 3;
            $icolumn 	= ($config['icolumn']) ? (int)($config['icolumn']) : 3;
			$interval 		= 	(isset($config['interval'])) ? (int)($config['interval']) : 8000;
			$data['special'] = array();
            $data['bestseller'] = array();
            $data['featured'] = array();
            $data['newproducts'] = array();
			$data['toprating'] = array();
			$data['mostview'] = array();
			
			$id_categorys = (isset($config['categories']) && $config['categories']) ? ($config['categories']) : array();
			if($id_categorys){
				$categories = implode(",",$id_categorys);
				$filter = ' AND  cp.id_category IN  (' . pSQL($categories) . ')';
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

			if ($config['show_display'] && $config['show_display'] == 1) {
				$category = new Category(Context::getContext()->shop->getCategory(), (int) Context::getContext()->language->id);
				$featured = $category->getProducts((int)Context::getContext()->language->id, 0, $nb,$orderby,$orderway);
				if ( isset($featured) && $featured) {
					foreach ($featured as &$product)
					{
						$product = $presenter->present(
							$presentationSettings,
							$assembler->assembleProduct($product),
							Context::getContext()->language
						);
					}
				}	
                $data['featured'] = $featured;
            }
			
            if ($config['show_newproduct'] && $config['show_newproduct'] == 1) {
				$newproducts = $this->getNewProducts($filter,$id_language, 0, $nb,false,$orderby,$orderway );
				if ( isset($newproducts) && $newproducts) {
					foreach ($newproducts as &$product)
					{
						$product = $presenter->present(
							$presentationSettings,
							$assembler->assembleProduct($product),
							Context::getContext()->language
						);
					}
				}
                $data['newproducts'] = $newproducts;
            }
            if ($config['show_special'] && $config['show_special'] == 1) {
				$special = $this->getPricesDrop($filter,$id_language, 0, $nb,false,$orderby,$orderway);
				if ( isset($special) && $special) {
					foreach ($special as &$product)
					{
						$product = $presenter->present(
							$presentationSettings,
							$assembler->assembleProduct($product),
							Context::getContext()->language
						);
					}
				}
                $data['special'] = $special;
            }

            if ($config['show_bestseller'] && $config['show_bestseller'] == 1) {
				$bestseller = $this->getBestSales($filter,(int)$id_language, 0, $nb,$orderby,$orderway);
				if ( isset($bestseller) && $bestseller) {
					foreach ($bestseller as &$product)
					{
						$product = $presenter->present(
							$presentationSettings,
							$assembler->assembleProduct($product),
							Context::getContext()->language
						);
					}
				}
				$data['bestseller'] = $bestseller;
            }
			
			if (isset($config['show_toprating']) && $config['show_toprating'] == 1) {
				$toprating = $this->getSpecialProducts(false, 0, $nb );
				foreach ($toprating as &$product)
				{
					$product = $presenter->present(
						$presentationSettings,
						$assembler->assembleProduct($product),
						Context::getContext()->language
					);
				}
				$data['toprating'] = $toprating;
            }
			
			if (isset($config['show_mostview']) && $config['show_mostview'] == 1) {
				$mostview = $this->getSpecialProducts(false, 0, $nb, true, null, 'mostview' );
				foreach ($mostview as &$product)
				{
					$product = $presenter->present(
						$presentationSettings,
						$assembler->assembleProduct($product),
						Context::getContext()->language
					);
				}
				$data['mostview'] = $mostview;
            }
			

			$data['interval'] = $interval; 
			$data['itempage'] = $ipage; 
			$data['colspage'] = $icolumn; 
			$data['scolumn']    = 12 / $icolumn;
			$data['tab'] = 'producttab'.rand(10,rand());
			$result = array('data' => $data );
			
	  		return $result;
		}
		
	} 
}
?>