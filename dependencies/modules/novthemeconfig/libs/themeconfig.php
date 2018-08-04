<?php

if (!defined('_PS_VERSION_')) exit;
require_once( dirname(__FILE__) . '/settings/scssphp/scss.inc.php');
use Leafo\ScssPhp\Compiler;
use Leafo\ScssPhp\Server;
class ThemeConfig extends Module {
	private $_output = '';
    private $_standardConfig = '';
    private $_styleConfig = '';
    private $_multiLangConfig = '';

    private $_bgImageConfig = '';
    private $_fontConfig = '';

    private $_cssRules = array();
    private $_configDefaults = array();
    private $systemFonts = array();
    private $googleFonts = array();
    private $_theme_manager;
	private $theme = '';
    private $themeName = '';
	private $hooks = array();
	public function __construct() {
		parent::__construct();
		$this->themeName = Context::getContext()->shop->theme_name;
		$this->_defineArrays();
	}
	
   
	public function getThemeFields() {
		$languages = $this->context->language->getLanguages();

        foreach ($languages as $language) {
			$copy_right_text[$language['id_lang']] = '© 2017 <span>Nova</span>. Designed by <span>vinovatheme.com</span>. All Rights Reserved';
            $wellcomemsg[$language['id_lang']] = 'Welcome to our store!';
			$loggedmsg[$language['id_lang']] = 'Hi to our store!';
        }
	
		$themeFields = array(
	    	// General Options
            'novthemeconfig_width_layout' => 1200,
            'novthemeconfig_mode_layout' => 'wide',
            'novthemeconfig_customlogo_enable' => '1',
            'novthemeconfig_customlogo' => 'logo-1',
            'novthemeconfig_logo_mobile' => 'logo-mobile.png',
			'novthemeconfig_payment_image' => 'payments-1.png',
            'novthemeconfig_logo_footer' => 'logo-footer-1.png',
            'novthemeconfig_wellcomemsg' => $wellcomemsg,
            'novthemeconfig_loggedmsg' =>  $loggedmsg,
            'novthemeconfig_copyright' => $copy_right_text,
            'novpopup_newsletter' => '1',
            'novpopup_newsletter_bg' => 'newsletter_bg.jpg',
			
			// Layout Options
			'novthemeconfig_themes_color'		=> '#12555d',
    		'novthemeconfig_themes_color_secondary' => '#ff8d31',
			'novthemeconfig_themecolorrand'	=> '0',
			'novthemeconfig_themecolorrandin'	=> '',
			'novthemeconfig_header_style' => 'displayheadernovone',
			'novthemeconfig_home_style' => 'displayhomenovone',
			'novthemeconfig_footer_style' => 'displayfooternovone',
			//'novthemeconfig_layout_style' => 'layout-full',
			'novthemeconfig_body_bg_pattern' => 'none',
			'novthemeconfig_body_bg_image' => '',
			'novthemeconfig_body_bg_repeat' => 'repeat',
			'novthemeconfig_body_bg_color' => '#ffffff',
			

            // Menu Options
            'novthemeconfig_count_showmore_vertical'      => '8',
            'novthemeconfig_enable_showmore_vertical'                  => '0',

			// Font Options
			'novthemeconfig_main_font' 		=> 'Roboto',
            		'novthemeconfig_main_font_primary'   => 'Oswald',

			// Category Page Options
			'novthemeconfig_category_image' => 0,
			'novthemeconfig_category_title' => 1,
			'novthemeconfig_category_desc' => 0,
			'novthemeconfig_sub_category' => 0,
			'novthemeconfig_grid_subcategory' => 4,
			'novthemeconfig_sub_category_image' => 0,
			'novthemeconfig_sub_category_title' => 0,
			'novthemeconfig_sub_category_desc' => 1,
            		'novthemeconfig_cat_product_type' =>'type_one',
			'novthemeconfig_cat_product_title' => 1,
			'novthemeconfig_cat_product_desc' => 0,
			'novthemeconfig_cat_product_price' => 1,
			'novthemeconfig_cat_product_label' => 1,
			'novthemeconfig_cat_product_stock' => 0,
			'novthemeconfig_second_img' => 0,
			'novthemeconfig_all_img' => 0,
			'novthemeconfig_cat_product_quickview' => 1,
			'novthemeconfig_cat_product_rate' => 0,
			
			// Product Page Options
            		'novthemeconfig_product_layout' => 'layout-right-column',
			'novthemeconfig_product_thumb' => 4,
			'novthemeconfig_product_thumbtype' => 'false',
			'novthemeconfig_product_rating' => 1,
			'novthemeconfig_share_buttons' => 1,
			'novthemeconfig_product_shortdesc' => 1,
			'novthemeconfig_moreinfo' => 'product-moreinfo-tab',
			'novthemeconfig_product_sku' => 1,
			'novthemeconfig_product_attribute' => 1,
			'novthemeconfig_product_availability' => 1,
	            	'novthemeconfig_product_customtab_show' => 1,
	            	'novthemeconfig_product_customtab_name' => 'Custom Tab',
			'novthemeconfig_product_customtab' => '',
            		'novthemeconfig_product_relate_col' => 3,

            // Blog Page Options
            'novthemeconfig_cateblog_layout' => 'layout-right-column',
            'novthemeconfig_cateblog_type' => 'grid',
            'novthemeconfig_cateblog_columns' => 1,

            // Contact info
			'contact_address' => 'North America',
			'contact_email' => 'vinovatheme@gmail.com',
			'contact_phone' => '1234 567 899',
            'contact_address_2' => 'North America',
            'contact_email_2' => 'support@gmail.com',
            'contact_phone_2' => '1234 567 899',
            'contact_fanpage' => 'https://www.facebook.com/vinovatheme/',
            'contact_desc' => '<p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec<br>
sagittis sem nibh id elit. Duis sed odio sit amet nibh vultate cursus a sit amet mauris. Proin gravida nibh vel velit auctor</p>',
            'store_latitude' => '40.5065372',
            'store_longitude' => '-74.2385045',
            'contact_fanpage' => 'https://www.facebook.com/vinovatheme/',

            // Soical  Options
			'social_in_footer' => 1,
            'social_facebook' => '#',
            'social_twitter' => '#',
            'social_google' => '#',
            'social_instagram' =>'#',
            'social_dribbble' =>'#',
            'social_flickr' =>'',
            'social_pinterest' => '',
            'social_linkedIn' => '',
            'social_skype' => '#',

			// Custom Codes
			'novthemeconfig_customCSS' => '',

	    );
		return $themeFields;
	}
	
	
    /* ------------------------------------------------------------- */
    /*  DEFINE ARRAYS
    /* ------------------------------------------------------------- */
   protected function _defineArrays()
    {
        
		$background_dir = $this->_path.'/images/';
		$bodySelectors = Configuration::get('novthemeconfig_main_font');	
        $bodySelectorsPrimary = Configuration::get('novthemeconfig_main_font_primary');
        // SPECIAL ARRAYS
        // These arrays are only for defining certain config values that needs to be handled differently.
        $this->_standardConfig = array(
            // General Options
            'novthemeconfig_customlogo_enable',
            'novthemeconfig_customlogo',
            'novthemeconfig_width_layout',
            'novthemeconfig_mode_layout',
            'novpopup_newsletter',
			
            // Layout Options
			'novthemeconfig_themes_color',
            'novthemeconfig_themes_color_secondary',
			'novthemeconfig_themecolorrand',
			'novthemeconfig_themecolorrandin',
            //'novthemeconfig_layout_style',
			'novthemeconfig_header_style',
			'novthemeconfig_home_style',
			'novthemeconfig_footer_style',

            //Menu option
            'novthemeconfig_count_showmore_vertical',
            'novthemeconfig_enable_showmore_vertical',
			
            // Category Page Options
			'novthemeconfig_sub_category',
			'novthemeconfig_grid_subcategory',
			'novthemeconfig_sidebarPosition',
			'novthemeconfig_category_image',
			'novthemeconfig_category_title',
			'novthemeconfig_category_desc',
			'novthemeconfig_sub_category_image',
			'novthemeconfig_sub_category_title',
			'novthemeconfig_sub_category_desc',
			'layouts[category]',
            'novthemeconfig_cat_product_type',
			'novthemeconfig_cat_product_title',
            'novthemeconfig_cat_product_desc',
			'novthemeconfig_cat_product_price',
			'novthemeconfig_cat_product_label',
            'novthemeconfig_second_img',
			'novthemeconfig_all_img',
            'novthemeconfig_cat_product_quickview',
			'novthemeconfig_cat_product_rate',
            'novthemeconfig_cat_product_stock',

            // Product Page Options
            'novthemeconfig_product_rating',
            'novthemeconfig_share_buttons',
            'novthemeconfig_product_shortdesc',
			'novthemeconfig_moreinfo',
            'novthemeconfig_product_sku',
			'novthemeconfig_product_attribute',
			'novthemeconfig_product_availability',
			//'novthemeconfig_productZoom',
            'novthemeconfig_product_layout',
			'novthemeconfig_product_thumb',
			'novthemeconfig_product_thumbtype',
			'novthemeconfig_product_customtab_show',
            'novthemeconfig_product_customtab_name',
            'novthemeconfig_product_customtab',
            'novthemeconfig_product_relate_col',

            // Blog Page Options
            'novthemeconfig_cateblog_layout',
            'novthemeconfig_cateblog_type',
            'novthemeconfig_cateblog_columns',
			
            // Font Options
			'novthemeconfig_main_font',
            'novthemeconfig_main_font_primary',
			
			// Social Options
            'contact_address',
            'contact_email',
            'contact_phone',
            'contact_address_2',
            'contact_email_2',
            'contact_phone_2',
            'contact_fanpage',
	    'contact_desc',
            'store_latitude',
            'store_longitude',
            
            'social_in_footer',
            'social_facebook',
            'social_twitter',
            'social_google',
            'social_instagram',
            'social_dribbble',
            'social_flickr',
            'social_pinterest',
            'social_linkedIn',
	    'social_skype',

			
	    // Custom Codes
            'novthemeconfig_customCSS',
        );

        $this->_styleConfig = array(
            // Background Options
	    'novthemeconfig_body_bg_pattern',
            'novthemeconfig_body_bg_repeat',
            'novthemeconfig_body_bg_color',
            'novthemeconfig_body_bg_image',
            'novthemeconfig_payment_image',
            'novthemeconfig_logo_mobile',
            'novpopup_newsletter_bg',
            'novthemeconfig_customlogo',
            'novthemeconfig_logo_footer',
        );

        $this->_multiLangConfig = array(
			'novthemeconfig_copyright',
        );

        
        $this->_bgImageConfig = array(
            'novthemeconfig_body_bg_image',
			'novthemeconfig_payment_image',
            'novthemeconfig_logo_mobile',
	        'novpopup_newsletter_bg',
            'novthemeconfig_customlogo',
            'novthemeconfig_logo_footer',
        );
        
		
        $this->_fontConfig = array(
            'novthemeconfig_main_font',
        );
        $this->_fontConfig = array(
            'novthemeconfig_main_font_primary',
        );
        // End - SPECIAL ARRAYS
        $this->_cssRules = array(
			'novthemeconfig_width_layout' => array(
                array(
                    'selector' => '.container',
                    'rule' => 'width',
                    'suffix' => 'px'
                )
            ),
			'novthemeconfig_body_bg_pattern' => array(
                array(
                    'selector' => 'body.layout-boxed,body.layout-framed,body.layout-rounded',
                    'rule' => 'background-image',
					'prefix' => 'url("' . $background_dir,
                    'suffix' => '.png")'
                )
            ),
            'novthemeconfig_body_bg_image' => array(
                array(
                    'selector' => 'body.layout-boxed,body.layout-framed,body.layout-rounded',
                    'rule' => 'background-image',
                    'prefix' => 'url("' . $background_dir,
                    'suffix' => '")'
                )
            ),
            'novthemeconfig_body_bg_repeat' => array(
                array(
                    'selector' => '.layout-boxed,.layout-framed,.layout-rounded',
                    'rule' => 'background-repeat'
                )
            ),
			
            // Body Background
            'novthemeconfig_body_bg_color' => array(
                array(
                    'selector' => '.layout-boxed,.layout-framed,.layout-rounded',
                    'rule' => 'background-color'
                )
            ),
			
            // Font
            'novthemeconfig_main_font' => array(
                array(
                    'selector' => ''.$bodySelectors.'',
                    'rule' => 'font-family'
                )
            ),
            // Font
            'novthemeconfig_main_font_primary' => array(
                array(
                    'selector' => ''.$bodySelectorsPrimary.'',
                    'rule' => 'font-family'
                )
            ),
           
        );
       
        // Web-safe Fonts
        $this->systemFonts = array('Arial', 'Helvetica', 'Verdana', 'Georgia', 'Times New Roman', 'sans-serif');

        // Google Fonts
        $this->googleFonts = array(
            'ABeeZee' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'Abel' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Abril Fatface' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Aclonica' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Acme' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Actor' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Adamina' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Advent Pro' => array('subsets' => array('latin', 'latin-ext', 'greek'), 'variants' => array('100', '200', '300', '400', '500', '600', '700')),
            'Aguafina Script' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Akronim' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Aladin' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Aldrich' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Alef' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Alegreya' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic', '900', '900italic')),
            'Alegreya SC' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic', '900', '900italic')),
            'Alegreya Sans' => array('subsets' => array('latin', 'latin-ext', 'vietnamese'), 'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '500', '500italic', '700', '700italic', '800', '800italic', '900', '900italic')),
            'Alegreya Sans SC' => array('subsets' => array('latin', 'latin-ext', 'vietnamese'), 'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '500', '500italic', '700', '700italic', '800', '800italic', '900', '900italic')),
            'Alex Brush' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Alfa Slab One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Alice' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Alike' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Alike Angular' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Allan' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Allerta' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Allerta Stencil' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Allura' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Almendra' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Almendra Display' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Almendra SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Amarante' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Amaranth' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Amatic SC' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Amethysta' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Anaheim' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Andada' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Andika' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Angkor' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Annie Use Your Telescope' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Anonymous Pro' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Antic' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Antic Didone' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Antic Slab' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Anton' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Arapey' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'Arbutus' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Arbutus Slab' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Architects Daughter' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Archivo Black' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Archivo Narrow' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Arimo' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Arizonia' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Armata' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Artifika' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Arvo' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Asap' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Asset' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Astloch' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Asul' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Atomic Age' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Aubrey' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Audiowide' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Autour One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Average' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Average Sans' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Averia Gruesa Libre' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Averia Libre' => array('subsets' => array('latin'), 'variants' => array('300', '300italic', '400', 'italic', '700', '700italic')),
            'Averia Sans Libre' => array('subsets' => array('latin'), 'variants' => array('300', '300italic', '400', 'italic', '700', '700italic')),
            'Averia Serif Libre' => array('subsets' => array('latin'), 'variants' => array('300', '300italic', '400', 'italic', '700', '700italic')),
            'Bad Script' => array('subsets' => array('cyrillic', 'latin'), 'variants' => array('400')),
            'Balthazar' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Bangers' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Basic' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Battambang' => array('subsets' => array('khmer'), 'variants' => array('400', '700')),
            'Baumans' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Bayon' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Belgrano' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Belleza' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'BenchNine' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '400', '700')),
            'Bentham' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Berkshire Swash' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Bevan' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Bigelow Rules' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Bigshot One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Bilbo' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Bilbo Swash Caps' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Bitter' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700')),
            'Black Ops One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Bokor' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Bonbon' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Boogaloo' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Bowlby One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Bowlby One SC' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Brawler' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Bree Serif' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Bubblegum Sans' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Bubbler One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Buda' => array('subsets' => array('latin'), 'variants' => array('300')),
            'Buenard' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Butcherman' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Butterfly Kids' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Cabin' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic')),
            'Cabin Condensed' => array('subsets' => array('latin'), 'variants' => array('400', '500', '600', '700')),
            'Cabin Sketch' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Caesar Dressing' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Cagliostro' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Calligraffitti' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Cambo' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Candal' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Cantarell' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Cantata One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Cantora One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Capriola' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Cardo' => array('subsets' => array('greek-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('400', 'italic', '700')),
            'Carme' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Carrois Gothic' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Carrois Gothic SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Carter One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Caudex' => array('subsets' => array('greek-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Cedarville Cursive' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Ceviche One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Changa One' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'Chango' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Chau Philomene One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Chela One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Chelsea Market' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Chenla' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Cherry Cream Soda' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Cherry Swash' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Chewy' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Chicle' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Chivo' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '900', '900italic')),
            'Cinzel' => array('subsets' => array('latin'), 'variants' => array('400', '700', '900')),
            'Cinzel Decorative' => array('subsets' => array('latin'), 'variants' => array('400', '700', '900')),
            'Clicker Script' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Coda' => array('subsets' => array('latin'), 'variants' => array('400', '800')),
            'Coda Caption' => array('subsets' => array('latin'), 'variants' => array('800')),
            'Codystar' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '400')),
            'Combo' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Comfortaa' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('300', '400', '700')),
            'Coming Soon' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Concert One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Condiment' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Content' => array('subsets' => array('khmer'), 'variants' => array('400', '700')),
            'Contrail One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Convergence' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Cookie' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Copse' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Corben' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Courgette' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Cousine' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Coustard' => array('subsets' => array('latin'), 'variants' => array('400', '900')),
            'Covered By Your Grace' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Crafty Girls' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Creepster' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Crete Round' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Crimson Text' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '600', '600italic', '700', '700italic')),
            'Croissant One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Crushed' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Cuprum' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Cutive' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Cutive Mono' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Damion' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Dancing Script' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Dangrek' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Dawning of a New Day' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Days One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Delius' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Delius Swash Caps' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Delius Unicase' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Della Respira' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Denk One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Devonshire' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Didact Gothic' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('400')),
            'Diplomata' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Diplomata SC' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Domine' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Donegal One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Doppio One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Dorsa' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Dosis' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('200', '300', '400', '500', '600', '700', '800')),
            'Dr Sugiyama' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Droid Sans' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Droid Sans Mono' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Droid Serif' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Duru Sans' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Dynalight' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'EB Garamond' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese'), 'variants' => array('400')),
            'Eagle Lake' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Eater' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Economica' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Electrolize' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Elsie' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '900')),
            'Elsie Swash Caps' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '900')),
            'Emblema One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Emilys Candy' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Engagement' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Englebert' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Enriqueta' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Erica One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Esteban' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Euphoria Script' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Ewert' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Exo' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic')),
            'Exo 2' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('100', '100italic', '200', '200italic', '300', '300italic', '400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic', '800', '800italic', '900', '900italic')),
            'Expletus Sans' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '500', '500italic', '600', '600italic', '700', '700italic')),
            'Fanwood Text' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'Fascinate' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Fascinate Inline' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Faster One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Fasthand' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Fauna One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Federant' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Federo' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Felipa' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Fenix' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Finger Paint' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Fjalla One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Fjord One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Flamenco' => array('subsets' => array('latin'), 'variants' => array('300', '400')),
            'Flavors' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Fondamento' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Fontdiner Swanky' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Forum' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Francois One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Freckle Face' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Fredericka the Great' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Fredoka One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Freehand' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Fresca' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Frijole' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Fruktur' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Fugaz One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'GFS Didot' => array('subsets' => array('greek'), 'variants' => array('400')),
            'GFS Neohellenic' => array('subsets' => array('greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Gabriela' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Gafata' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Galdeano' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Galindo' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Gentium Basic' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Gentium Book Basic' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Geo' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'Geostar' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Geostar Fill' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Germania One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Gilda Display' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Give You Glory' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Glass Antiqua' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Glegoo' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Gloria Hallelujah' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Goblin One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Gochi Hand' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Gorditas' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Goudy Bookletter 1911' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Graduate' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Grand Hotel' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Gravitas One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Great Vibes' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Griffy' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Gruppo' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Gudea' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700')),
            'Habibi' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Hammersmith One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Hanalei' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Hanalei Fill' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Handlee' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Hanuman' => array('subsets' => array('khmer'), 'variants' => array('400', '700')),
            'Happy Monkey' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Headland One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Henny Penny' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Herr Von Muellerhoff' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Holtwood One SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Homemade Apple' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Homenaje' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'IM Fell DW Pica' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'IM Fell DW Pica SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'IM Fell Double Pica' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'IM Fell Double Pica SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'IM Fell English' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'IM Fell English SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'IM Fell French Canon' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'IM Fell French Canon SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'IM Fell Great Primer' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'IM Fell Great Primer SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Iceberg' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Iceland' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Imprima' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Inconsolata' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Inder' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Indie Flower' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Inika' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Irish Grover' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Istok Web' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Italiana' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Italianno' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Jacques Francois' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Jacques Francois Shadow' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Jim Nightshade' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Jockey One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Jolly Lodger' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Josefin Sans' => array('subsets' => array('latin'), 'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic')),
            'Josefin Slab' => array('subsets' => array('latin'), 'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic')),
            'Joti One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Judson' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700')),
            'Julee' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Julius Sans One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Junge' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Jura' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('300', '400', '500', '600')),
            'Just Another Hand' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Just Me Again Down Here' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Kameron' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Kantumruy' => array('subsets' => array('khmer'), 'variants' => array('300', '400', '700')),
            'Karla' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Kaushan Script' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Kavoon' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Kdam Thmor' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Keania One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Kelly Slab' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Kenia' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Khmer' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Kite One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Knewave' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Kotta One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Koulen' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Kranky' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Kreon' => array('subsets' => array('latin'), 'variants' => array('300', '400', '700')),
            'Kristi' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Krona One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'La Belle Aurore' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Lancelot' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Lato' => array('subsets' => array('latin'), 'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '700', '700italic', '900', '900italic')),
            'League Script' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Leckerli One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Ledger' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Lekton' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700')),
            'Lemon' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Libre Baskerville' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700')),
            'Life Savers' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Lilita One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Lily Script One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Limelight' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Linden Hill' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'Lobster' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Lobster Two' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Londrina Outline' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Londrina Shadow' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Londrina Sketch' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Londrina Solid' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Lora' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Love Ya Like A Sister' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Loved by the King' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Lovers Quarrel' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Luckiest Guy' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Lusitana' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Lustria' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Macondo' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Macondo Swash Caps' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Magra' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Maiden Orange' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Mako' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Marcellus' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Marcellus SC' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Marck Script' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Margarine' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Marko One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Marmelad' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Marvel' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Mate' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'Mate SC' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Maven Pro' => array('subsets' => array('latin'), 'variants' => array('400', '500', '700', '900')),
            'McLaren' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Meddon' => array('subsets' => array('latin'), 'variants' => array('400')),
            'MedievalSharp' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Medula One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Megrim' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Meie Script' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Merienda' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Merienda One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Merriweather' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '300italic', '400', 'italic', '700', '700italic', '900', '900italic')),
            'Merriweather Sans' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '300italic', '400', 'italic', '700', '700italic', '800', '800italic')),
            'Metal' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Metal Mania' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Metamorphous' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Metrophobic' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Michroma' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Milonga' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Miltonian' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Miltonian Tattoo' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Miniver' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Miss Fajardose' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Modern Antiqua' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Molengo' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Molle' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('italic')),
            'Monda' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Monofett' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Monoton' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Monsieur La Doulaise' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Montaga' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Montez' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Montserrat' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Montserrat Alternates' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Montserrat Subrayada' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Moul' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Moulpali' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Mountains of Christmas' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Mouse Memoirs' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Mr Bedfort' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Mr Dafoe' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Mr De Haviland' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Mrs Saint Delafield' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Mrs Sheppards' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Muli' => array('subsets' => array('latin'), 'variants' => array('300', '300italic', '400', 'italic')),
            'Mystery Quest' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Neucha' => array('subsets' => array('cyrillic', 'latin'), 'variants' => array('400')),
            'Neuton' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('200', '300', '400', 'italic', '700', '800')),
            'New Rocker' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'News Cycle' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Niconne' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Nixie One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Nobile' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Nokora' => array('subsets' => array('khmer'), 'variants' => array('400', '700')),
            'Norican' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Nosifer' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Nothing You Could Do' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Noticia Text' => array('subsets' => array('latin', 'latin-ext', 'vietnamese'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Noto Sans' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Noto Serif' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Nova Cut' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Nova Flat' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Nova Mono' => array('subsets' => array('latin', 'greek'), 'variants' => array('400')),
            'Nova Oval' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Nova Round' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Nova Script' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Nova Slim' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Nova Square' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Numans' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Nunito' => array('subsets' => array('latin'), 'variants' => array('300', '400', '700')),
            'Odor Mean Chey' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Offside' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Old Standard TT' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700')),
            'Oldenburg' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Oleo Script' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Oleo Script Swash Caps' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Open Sans' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic', '800', '800italic')),
            'Open Sans Condensed' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('300', '300italic', '700')),
            'Oranienbaum' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Orbitron' => array('subsets' => array('latin'), 'variants' => array('400', '500', '700', '900')),
            'Oregano' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Orienta' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Original Surfer' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Oswald' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '400', '700')),
            'Over the Rainbow' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Overlock' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic', '900', '900italic')),
            'Overlock SC' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Ovo' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Oxygen' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '400', '700')),
            'Oxygen Mono' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'PT Mono' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400')),
            'PT Sans' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'PT Sans Caption' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400', '700')),
            'PT Sans Narrow' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400', '700')),
            'PT Serif' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'PT Serif Caption' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Pacifico' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Paprika' => array('subsets' => array('latin'), 'variants' => array('400')),
			'Poppins' => array('subsets' => array('latin', 'latin-ext', 'devanagari'), 'variants' => array('400', '500', '600','700')),
            'Parisienne' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Passero One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Passion One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700', '900')),
            'Pathway Gothic One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Patrick Hand' => array('subsets' => array('latin', 'latin-ext', 'vietnamese'), 'variants' => array('400')),
            'Patrick Hand SC' => array('subsets' => array('latin', 'latin-ext', 'vietnamese'), 'variants' => array('400')),
            'Patua One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Paytone One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Peralta' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Permanent Marker' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Petit Formal Script' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Petrona' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Philosopher' => array('subsets' => array('cyrillic', 'latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Piedra' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Pinyon Script' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Pirata One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Plaster' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Play' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('400', '700')),
            'Playball' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Playfair Display' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic', '900', '900italic')),
            'Playfair Display SC' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic', '900', '900italic')),
            'Podkova' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Poiret One' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Poller One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Poly' => array('subsets' => array('latin'), 'variants' => array('400', 'italic')),
            'Pompiere' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Pontano Sans' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Port Lligat Sans' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Port Lligat Slab' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Prata' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Preahvihear' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Press Start 2P' => array('subsets' => array('cyrillic', 'latin', 'latin-ext', 'greek'), 'variants' => array('400')),
            'Princess Sofia' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Prociono' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Prosto One' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Puritan' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Purple Purse' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Quando' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Quantico' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Quattrocento' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Quattrocento Sans' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Questrial' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Quicksand' => array('subsets' => array('latin'), 'variants' => array('300', '400', '700')),
            'Quintessential' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Qwigley' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Racing Sans One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Radley' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Raleway' => array('subsets' => array('latin'), 'variants' => array('100', '200', '300', '400', '500', '600', '700', '800', '900')),
            'Raleway Dots' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Rambla' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Rammetto One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Ranchers' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Rancho' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Rationale' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Redressed' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Reenie Beanie' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Revalia' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Ribeye' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Ribeye Marrow' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Righteous' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Risque' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Roboto' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('100', '100italic', '300', '300italic', '400', 'italic', '500', '500italic', '700', '700italic', '900', '900italic')),
            'Roboto Condensed' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('300', '300italic', '400', 'italic', '700', '700italic')),
            'Roboto Slab' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('100', '300', '400', '700')),
            'Rochester' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Rock Salt' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Rokkitt' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Romanesco' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Ropa Sans' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Rosario' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Rosarivo' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Rouge Script' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Ruda' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700', '900')),
            'Rufina' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Ruge Boogie' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Ruluko' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Rum Raisin' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Ruslan Display' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Russo One' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Ruthie' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Rye' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Sacramento' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Sail' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Salsa' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Sanchez' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Sancreek' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Sansita One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Sarina' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Satisfy' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Scada' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Schoolbell' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Seaweed Script' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Sevillana' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Seymour One' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Shadows Into Light' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Shadows Into Light Two' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Shanti' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Share' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Share Tech' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Share Tech Mono' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Shojumaru' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Short Stack' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Siemreap' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Sigmar One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Signika' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '400', '600', '700')),
            'Signika Negative' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '400', '600', '700')),
            'Simonetta' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic', '900', '900italic')),
            'Sintony' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Sirin Stencil' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Six Caps' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Skranji' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '700')),
            'Slackey' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Smokum' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Smythe' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Sniglet' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', '800')),
            'Snippet' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Snowburst One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Sofadi One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Sofia' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Sonsie One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Sorts Mill Goudy' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400', 'italic')),
            'Source Code Pro' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('200', '300', '400', '500', '600', '700', '900')),
            'Source Sans Pro' => array('subsets' => array('latin', 'latin-ext', 'vietnamese'), 'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic', '900', '900italic')),
            'Special Elite' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Spicy Rice' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Spinnaker' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Spirax' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Squada One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Stalemate' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Stalinist One' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Stardos Stencil' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Stint Ultra Condensed' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Stint Ultra Expanded' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Stoke' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('300', '400')),
            'Strait' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Sue Ellen Francisco' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Sunshiney' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Supermercado One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Suwannaphum' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Swanky and Moo Moo' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Syncopate' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Tangerine' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Taprom' => array('subsets' => array('khmer'), 'variants' => array('400')),
            'Tauri' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Telex' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Tenor Sans' => array('subsets' => array('cyrillic', 'cyrillic-ext', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Text Me One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'The Girl Next Door' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Tienne' => array('subsets' => array('latin'), 'variants' => array('400', '700', '900')),
            'Tinos' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'vietnamese', 'greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Titan One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Titillium Web' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('200', '200italic', '300', '300italic', '400', 'italic', '600', '600italic', '700', '700italic', '900')),
            'Trade Winds' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Trocchi' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Trochut' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700')),
            'Trykker' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Tulpen One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Ubuntu' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('300', '300italic', '400', 'italic', '500', '500italic', '700', '700italic')),
            'Ubuntu Condensed' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('400')),
            'Ubuntu Mono' => array('subsets' => array('cyrillic', 'greek-ext', 'cyrillic-ext', 'latin', 'latin-ext', 'greek'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Ultra' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Uncial Antiqua' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Underdog' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Unica One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'UnifrakturCook' => array('subsets' => array('latin'), 'variants' => array('700')),
            'UnifrakturMaguntia' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Unkempt' => array('subsets' => array('latin'), 'variants' => array('400', '700')),
            'Unlock' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Unna' => array('subsets' => array('latin'), 'variants' => array('400')),
            'VT323' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Vampiro One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Varela' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Varela Round' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Vast Shadow' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Vibur' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Vidaloka' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Viga' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Voces' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Volkhov' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Vollkorn' => array('subsets' => array('latin'), 'variants' => array('400', 'italic', '700', '700italic')),
            'Voltaire' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Waiting for the Sunrise' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Wallpoet' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Walter Turncoat' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Warnes' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Wellfleet' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Wendy One' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('400')),
            'Wire One' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Yanone Kaffeesatz' => array('subsets' => array('latin', 'latin-ext'), 'variants' => array('200', '300', '400', '700')),
            'Yellowtail' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Yeseva One' => array('subsets' => array('cyrillic', 'latin', 'latin-ext'), 'variants' => array('400')),
            'Yesteryear' => array('subsets' => array('latin'), 'variants' => array('400')),
            'Zeyada' => array('subsets' => array('latin'), 'variants' => array('400'))
        );

    }
	
    /* ------------------------------------------------------------- */
    /*  CREATE CONFIGS
    /* ------------------------------------------------------------- */
    protected function _defaultValues()
    {
	    $response = true;
        foreach($this->getThemeFields() as $k=>$v){
			$response &= Configuration::updateValue($k, $v,true);
		}
        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  DELETE CONFIGS
    /* ------------------------------------------------------------- */
    protected function _deleteConfigs()
    {
		$response = true;
        foreach($this->getThemeFields() as $k=>$v){
            $response &= Configuration::deleteByName($k);
		}
        return $response;
    }

   

    /* ------------------------------------------------------------- */
    /*  CREATE THE TAB MENU
    /* ------------------------------------------------------------- */
    protected function _createTab()
    {
        $response = true;
        // First check for parent tab
        $parentTabID = Tab::getIdFromClassName('AdminNov');

        if ($parentTabID) {
            $parentTab = new Tab($parentTabID);
        }
        else {
			$parentconfigure = Tab::getIdFromClassName('Configure');
            $parentTab = new Tab();
            $parentTab->active = 1;
            $parentTab->name = array();
            $parentTab->class_name = "AdminParentPreferences";
            foreach (Language::getLanguages() as $lang) {
                $parentTab->name[$lang['id_lang']] = "Vinova Framework";
            }
            $parentTab->id_parent = $parentconfigure;
            $parentTab->module = $this->name;
            $response &= $parentTab->add();
        }
		
		$tab_modules = array(
			"NovAdminConfig" => "Vinova Theme Configuration",
			"NovAdminPageManage" => "Vinova Page Manage",
            "NovAdminMegaMenu" => "Vinova Mega Menu",
            "NovAdminVerticalMenu" => "Vinova Vertical Menu",
            "NovAdminSlider" => "Vinova Nivo Slider",
            "NovAdminTestimonial" => "Vinova Manage Testimonial",
            //"NovAdminListShowMore" => "Vinova Product List Show More",
            "NovAdminWishlist" => "Vinova Wishlist",
            "NovAdminComment" => "Vinova Product Comment",
            "NovAdminTags" => "Vinova Block Tags",
		);
		
		foreach($tab_modules as $key=>$tab_module){
			$tab = new Tab();
			$tab->active = 1;
			$tab->class_name = $key;
			$tab->name = array();
			foreach (Language::getLanguages() as $lang) {
				$tab->name[$lang['id_lang']] = $tab_module;
			}
			$tab->id_parent = $parentTab->id;
			$tab->module = $this->name;
			$response &= $tab->add();			
		}

        return $response;
    }

    /* ------------------------------------------------------------- */
    /*  DELETE THE TAB MENU
    /* ------------------------------------------------------------- */
    protected function _deleteTab()
    {
        $parentTabID = Tab::getIdFromClassName('AdminParentPreferences');
		$tab_modules = array(
			"NovAdminConfig" => "Vinova Theme Configuration",
            "NovAdminPageManage" => "Vinova Page Manage",
            "NovAdminMegaMenu" => "Vinova Mega Menu",
            "NovAdminVerticalMenu" => "Vinova Vertical Menu",
            "NovAdminSlider" => "Vinova Nivo Slider",
            "NovAdminTestimonial" => "Vinova Manage Testimonial",
            //"NovAdminListShowMore" => "Vinova Product List Show More",
            "NovAdminWishlist" => "Vinova Wishlist",
            "NovAdminComment" => "Vinova Product Comment",
            "NovAdminTags" => "Vinova Block Tags",
		);
		
		foreach($tab_modules as $key=>$tab_module){
			$id_tab = Tab::getIdFromClassName($key);
			$tab = new Tab($id_tab);
			$tab->delete();			
		}

        // Get the number of tabs inside our parent tab
        // If there is no tabs, remove the parent
        $tabCount = Tab::getNbTabs($parentTabID);
        if ($tabCount == 0) {
            $parentTab = new Tab($parentTabID);
            $parentTab->delete();
        }

        return true;
    }
	
	 // Font Options
	 public function fontOptions() {
		$system = $google = array();
		foreach($this->systemFonts as $fontName)
			$system[] = array('id'=>$fontName,'name'=>$fontName);
		foreach($this->googleFonts as $fontName => $fontInfo)
			$google[] = array('id'=>$fontName,'name'=>$fontName);
		$module = new novthemeconfig();
		return array(
			array('name'=>$module->l('System Web fonts'),'query'=>$system),
			array('name'=>$module->l('Google Web Fonts'),'query'=>$google),
		);
	 }
	
	// images Options
	 public function getimagesArray(){
        $arr = array();
        for($i=1;$i<=9;$i++)
            $arr[] = array('id'=>$i,'name'=>$i); 
        return $arr;   
    }
	public function getimages(){
        $html = '';
        foreach(range(1,9) as $v)
            $html .= '<div class="parttern_wrap"><span>'.$v.'</span><img class="" src="'.$this->_path.'images/'.$v.'.png" /></div>';
        return $html;
    }
	
	public function getimagesHeaders(){
		$path_header = _PS_ALL_THEMES_DIR_ . $this->themeName.'/templates/_partials/layout/header';
		$headers = $this->nov_get_file($path_header,'Header Style');
		$vowels = array("display", "Nov");		
        $html = '';
        foreach($headers as $header)
            $html .= '<div class="header_wrap mb15"><span>'.$header['name'].'</span><img class="img-responsive" src="'.$this->_path.'images/headers/'.strtolower(str_replace($vowels, "", $header['value'])).'.jpg" /></div>';
        return $html;
    }
    public function getimagesLogos(){
        $path_logo_custom = _PS_ALL_THEMES_DIR_ . $this->themeName.'/assets/img';
        $headers = $this->nov_get_file($path_logo_custom,'Header Style');
        $vowels = array("display", "Nov");
        $html = '';
        foreach(range(1,5) as $v)
            $html .= '<div class="logo_wrap"><span>Logo '.$v.'</span><img class="img-responsive" src="'.$this->_path.'images/logos/logo-'.$v.'.png" /></div>';
        return $html;
    }


	public function getimagesFooters(){
		$path_footer = _PS_ALL_THEMES_DIR_ . $this->themeName.'/templates/_partials/layout/footer';
		$footers = $this->nov_get_file($path_footer,'Footer Style');
		$vowels = array("display", "Nov");
        $html = '';
        foreach($footers as $footer)
            $html .= '<div class="footers_wrap mb15"><span>'.$footer['name'].'</span><img class="img-responsive" src="'.$this->_path.'images/footers/'.strtolower(str_replace($vowels, "", $footer['value'])).'.jpg" /></div>';
        return $html;
    }		
	
	public function getimagesLayouts(){
        $html = '';
            $html .= '<div class="layouts_wrap w150 inline text-center"><span>'.$this->l('Boxed').'</span><img class="img-responsive m-auto" src="'.$this->_path.'images/layouts/body_boxed.jpg" /></div>';
			$html .= '<div class="layouts_wrap w150 inline text-center"><span>'.$this->l('Full Width').'</span><img class="img-responsive m-auto" src="'.$this->_path.'images/layouts/body_full.jpg" /></div>';
        return $html;
    }		
       
    public function getContent()
    {
			
        $id_shop = $this->context->shop->id;
        $languages = $this->context->language->getLanguages();
        $errors = array();
        $this->context->controller->addCss( 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' );
        $this->context->controller->addCSS(_MODULE_DIR_ . $this->name . '/css/themeconfig.css');
		$this->context->controller->addJs(_MODULE_DIR_ . $this->name . '/js/themeconfig.js');
        if (Tools::isSubmit('submit' . $this->name)) {
            foreach ($this->_standardConfig as $config) {
                if (Tools::isSubmit($config)) {
                    Configuration::updateValue($config, Tools::getValue($config),true);
                }
				
            }
			
            foreach ($this->_styleConfig as $config) {
                if (in_array($config, $this->_bgImageConfig)) {
				
                    if (isset($_FILES[$config]) && isset($_FILES[$config]['tmp_name']) && !empty($_FILES[$config]['tmp_name'])) {
                        if ($error = ImageManager::validateUpload($_FILES[$config], Tools::convertBytes(ini_get('upload_max_filesize')))) {
                            $errors[] = $error;
                        }
                        else {
                            $imageName = explode('.', $_FILES[$config]['name']);
                            $imageExt = $imageName[1];
                            $imageName = $imageName[0];
                            $backgroundImageName = $imageName . '-' . $id_shop . '.' . $imageExt;
							
                            if (!move_uploaded_file($_FILES[$config]['tmp_name'], _PS_MODULE_DIR_ . $this->name . '/images/' . $backgroundImageName)) {
                                $errors[] = $this->l('File upload error.');
                            }
                            else {
                                Configuration::updateValue($config, $backgroundImageName);
                            }
                        }
                    }

                    continue;
                }

                if (Tools::isSubmit($config)) {

                    Configuration::updateValue($config, Tools::getValue($config),true);
                }
				
            }
           
            foreach ($this->_multiLangConfig as $config) {
                foreach ($languages as $language) {
                    if (Tools::isSubmit($config . '_' . $language['id_lang'])) {
                        $multilangConfig[$language['id_lang']] = Tools::getValue($config . '_' . $language['id_lang']);
                    }
                }
				
				if (is_array($multilangConfig) && $multilangConfig) {
                    Configuration::updateValue($config, $multilangConfig, true);
                }

                $multilangConfig = false;
					
            }
			
            if (Tools::isSubmit('novthemeconfig_customCSS')) {
                Configuration::updateValue('novthemeconfig_customCSS', Tools::getValue('novthemeconfig_customCSS'));
            }		
			
        } elseif (Tools::isSubmit('deleteConfig')) {
            $config = Tools::getValue('deleteConfig');
            $configValue = Configuration::get($config);

            if (file_exists(_PS_MODULE_DIR_ . $this->name . '/images/' . $configValue)) {
                @unlink(_PS_MODULE_DIR_ . $this->name . '/images/' . $configValue);
            }

            Configuration::updateValue($config, null);

        }
		
		if(Tools::getValue('process') && Tools::getValue('process') == 'exportdata'){
			$datasample = new DataSample();
			$datasample->exportData();
		}
		if(Tools::getValue('process') && Tools::getValue('process') == 'importdata'){
			$datasample = new DataSample($this->themeName);
			if($datasample->importData())
				Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&token='.Tools::getAdminTokenLite('AdminModules').'&conf=4');	
			else
				$errors[] = $this->l('You have installed the sampledata twice !');
		}		
		if(Tools::getValue('process') && Tools::getValue('process') == 'compile_css'){
			
			ob_start();
            $sassDir = _PS_ALL_THEMES_DIR_ . $this->themeName . '/assets/sass/';
            $cssDir = _PS_ALL_THEMES_DIR_ . $this->themeName . '/assets/css/';
            $themeColorDefault = '';
            $themeColorSecondary = '';
            $variables = '';
            
            if (is_writable($sassDir) == false){
                @chmod($sassDir, 0755);
            }
            $scss = new Compiler();
            $scss->addImportPath($sassDir);
            $scss->setFormatter('Leafo\ScssPhp\Formatter\Compressed');

            require_once(_PS_ALL_THEMES_DIR_ . $this->themeName.'/sample/ConfigHomePage.php');
            foreach ($home_page as $key => $value_config) {
                $prefix_key = str_replace("home_","",$key);
                $variables = '$theme-color-default: '.$value_config['themes_color'].';';
                $variables .= '$theme-color-primary: '.$value_config['themes_color_secondary'].';';
                $variables .= '$font-family-default: '.$value_config['font_family'].';';
                $variables .= '$font-family-primary: '.$value_config['font_family_primary'].';';

                $string_sass = $variables . file_get_contents($sassDir . "theme.scss");
                $string_css = $scss->compile($string_sass);
                if($key != 'home_1') {
                    file_put_contents($cssDir . 'home'.$prefix_key.'.css', $string_css);
                }
            }

            $novconfig = $this->getConfigTheme();
            $variables1 = '$theme-color-default: '.$novconfig["novthemeconfig_themes_color"].';';
            $variables1 .= '$theme-color-primary: '.$novconfig["novthemeconfig_themes_color_secondary"].';';
            $variables1 .= '$font-family-default: '.$novconfig["novthemeconfig_main_font"].', sans-serif;';
            $variables1 .= '$font-family-primary: '.$novconfig["novthemeconfig_main_font_primary"].', sans-serif;';

            $string_sass1 = $variables1 . file_get_contents($sassDir . "theme.scss");
            $string_css1 = $scss->compile($string_sass1);
            file_put_contents($cssDir . 'theme.css', $string_css1);

			
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&token='.Tools::getAdminTokenLite('AdminModules').'&conf=4');	
		}			
		
		if (count($errors)) {
			$this->_output .= $this->displayError(implode('<br />', $errors));
		}
		else {
			Tools::clearSmartyCache();
			$this->_output .= $this->displayConfirmation($this->l('Configuration updated'));
		}
		// HTML content setting
        return $this->_output . $this->getFormHTML();
    }

    private function getFormHTML()
    {
        $id_default_lang = $this->context->language->id;
        $languages = $this->context->language->getLanguages();
        $id_shop = $this->context->shop->id;

        $helper = new HelperForm();
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;
        $helper->default_form_language = $id_default_lang;
        $helper->allow_employee_form_lang = $id_default_lang;
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->submit_action = 'submit' . $this->name;
        $helper->toolbar_btn = array(
            'save' => array(
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex . '&configure=' . $this->name . '&save' . $this->name . '&token=' . Tools::getAdminTokenLite('AdminModules'),
            )
        );

        foreach ($languages as $language) {
            $helper->languages[] = array(
                'id_lang' => $language['id_lang'],
                'iso_code' => $language['iso_code'],
                'name' => $language['name'],
                'is_default' => ($id_default_lang == $language['id_lang'] ? 1 : 0)
            );
        }

        foreach ($this->_standardConfig as $key => $standardField) {
            $helper->fields_value[$standardField] = Configuration::get($standardField);
			
        }
		
        foreach ($this->_styleConfig as $key => $cssField) {
            $helper->fields_value[$cssField] = Configuration::get($cssField);
        }
		
        foreach ($this->_multiLangConfig as $key => $multiLangField) {
            foreach ($languages as $language) {
                $helper->fields_value[$multiLangField][$language['id_lang']] = Tools::getValue($multiLangField . '_' . $language['id_lang'], Configuration::get($multiLangField, $language['id_lang']));
            }
        }
	
        $helper->tpl_vars = array(
            'sptabs' => $this->getfieldsTabs(),
            'imagePath' => _MODULE_DIR_ . $this->name . '/images/',
            'imagelogo' => _MODULE_DIR_ . $this->name . '/logo.png',
			'controller_url' => $this->context->link->getAdminLink('NovAdminConfig'),
            'shopId' => $id_shop
        );
		
        return $helper->generateForm(array(
			'general' 	=> $this->generalSettings(),
			'layout'  	=> $this->layoutSettings(),
            'header'      => $this->headerSettings(),
            'footer'      => $this->footerSettings(),
            'menu'    => $this->menuSettings(),
			'background'  	=> $this->backgroundSettings(),
			'fonts'  	=> $this->fontSettings(),
			'category'  => $this->categorySettings(),
			'listing'  => $this->listingSettings(),
			'product'  	=> $this->productSettings(),
            'blog'   => $this->cateblogSettings(),
			'contact' => $this->contactSettings(),
			'social'   => $this->socialSettings(),
            'responsive'  => $this->responsiveSettings(),
			'custom'   => $this->customSettings(),
			
		));
    }

    protected function getfieldsTabs(){
        $tabArray = array(
            'General' 				=> 'fieldset_general',
    	    'Layout' 				=> 'fieldset_layout',
            'Header'                => 'fieldset_header',
            'Footer'                => 'fieldset_footer',
            'Menu Settings'         => 'fieldset_menu',
    	    'Background' 			=> 'fieldset_background',
    	    'Fonts' 				=> 'fieldset_fonts',
            'Category Pages' 		=> 'fieldset_category',
    	    'Product Category' 		=> 'fieldset_listing',
            'Product Detail' 		=> 'fieldset_product',
            'Blogs'                 => 'fieldset_blog',
    	    'Contact Info' 			=> 'fieldset_contact',
    	    'Social' 				=> 'fieldset_social',
            'Responsive'            => 'fieldset_responsive',
    	    'Custom Css' 			=> 'fieldset_custom'
        );
        return $tabArray;
    }
	
	protected function generalSettings() {
        $path_logo_custom = _PS_ALL_THEMES_DIR_ . $this->themeName.'/assets/img/logo-custom';
        $logo_custom = $this->nov_get_file_logo($path_logo_custom,'Logo home');
		$fields_form = array(
			$this->field_text ('novthemeconfig_width_layout', 'Layout width', 'input-large', false, 'Change width container website on the frontend','px'),
            array(
                'type' => 'select',
                'name' => 'novthemeconfig_mode_layout',
                'label' => $this->l('Mode Layout'),
                'required' => false,
                'lang' => false,
                'options' => array(
                    'query' => array(
                        array('value' => 'wide', 'name' => 'Wide'),
                        array('value' => 'boxed', 'name' => 'Boxed'),
                    ),
                    'id' => 'value',
                    'name' => 'name'
                )
            ),
            $this->field_onOff('novthemeconfig_customlogo_enable','Using Logo Custom','Logo custom using in header item layout'),
            array(
                 'type' => 'select',
                 'label' => $this->l('Select Logo Custom'),
                 'name' => 'novthemeconfig_customlogo',
                 'options' => array(
                     'query' => $logo_custom,
                     'id' => 'value',
                     'name' => 'name',
                 ),
                 'desc' => $this->getimagesLogos(),
            ),
	    $this->field_onOff('novpopup_newsletter', 'Enable Popup Newsletter'),
            array(
                'type' => 'file',
                'name' => 'novpopup_newsletter_bg',
                'label' => $this->l('Background Image Newsletter'),
            ),		
        );
		return $this->getFormSection($fields_form, 'General');
	}

	protected function layoutSettings() {
		require_once(_PS_ALL_THEMES_DIR_ . $this->themeName.'/layout.php');
		$home = array();
		foreach($hooks as $hook){
		   if (strpos($hook, 'Home') !== false){
			   $item['value'] 	= $hook;
			   $item['name'] 	= str_replace("display","",$hook);
			   $item['name'] = ucwords(str_replace("Nov"," ",$item['name']));
			   $home[] = $item;
		   }
		}		
		$fields_form = array(
			array(
				'type' => 'color',
				'label' => $this->l('Main Theme Color'),
				'name' => 'novthemeconfig_themes_color'
			),
            array(
                'type' => 'color',
                'label' => $this->l('Theme Color Secondary'),
                'name' => 'novthemeconfig_themes_color_secondary'
            ),
			array(
				 'type' => 'select',
				 'label' => $this->l('Home layout'),
				 'name' => 'novthemeconfig_home_style',
				 'options' => array(
					 'query' => $home,
					 'id' => 'value',
					 'name' => 'name',
				 ),
			),
		
        );
		return $this->getFormSection($fields_form, 'Layout');
	}

    protected function headerSettings() {
		$path_header = _PS_ALL_THEMES_DIR_ . $this->themeName.'/templates/_partials/layout/header';
		$headers = $this->nov_get_file($path_header,'Header Style');
        $fields_form = array(
            array(
                 'type' => 'select',
                 'label' => $this->l('Header'),
                 'name' => 'novthemeconfig_header_style',
                 'col'  => 10,
                 'options' => array(
                     'query' => $headers,
                     'id' => 'value',
                     'name' => 'name',
                 ),
                 'desc' => $this->getimagesHeaders(),
            ),
        
        );
        return $this->getFormSection($fields_form, 'Header');
    }	

    protected function footerSettings() {
		$path_footer = _PS_ALL_THEMES_DIR_ . $this->themeName.'/templates/_partials/layout/footer';
		$footers = $this->nov_get_file($path_footer,'Footer Style');
        $fields_form = array(
            array(
                'type' => 'select',
                'label' => $this->l('Footer'),
                'name' => 'novthemeconfig_footer_style',
                'col'  => 10,
                'options' => array(
                    'query' => $footers,
                    'id' => 'value',
                    'name' => 'name',
                ),
                'desc' => $this->getimagesFooters(),
            ),
            array(
                'type' => 'file',
                'name' => 'novthemeconfig_payment_image',
                'label' => $this->l('Payment Image'),
            ),
            array(
                'type' => 'file',
                'name' => 'novthemeconfig_logo_footer',
                'label' => $this->l('Logo Footer'),
            ),
            $this->field_text ('novthemeconfig_copyright', 'Copyright Text', '', true),
        
        );
        return $this->getFormSection($fields_form, 'Footer');
    }
	
	public function nov_get_file($path,$name){
		$result = array();		
		$files = array_diff(scandir($path), array('..', '.'));
		if(count($files)>0){
			foreach ($files as  $file) {
				if (strpos($file, '.tpl') !== false){
					$item['value']	= str_replace(".tpl","",$file);
					$vowels = array(".tpl", "display");
					$item['name'] 	= str_replace($vowels, "", $file);
					$item['name'] 	= ucwords(str_replace("Nov"," ",$item['name']));
					$result[] = $item;
				}	
			}
		}
		return $result;
	}
    public function nov_get_file_logo($path,$name){
        $result = array();      
        $files = array_diff(scandir($path), array('..', '.'));
        if(count($files)>0){
            foreach ($files as  $file) {
                if (strpos($file, '.png') !== false){
                    $item['value']  = str_replace(".png","",$file);
                    $vowels = array(".png", "display");
                    $item['name']   = str_replace($vowels, "", $file);
                    $item['name']   = ucwords(str_replace("Nov"," ",$item['name']));
                    $result[] = $item;
                }   
            }
        }
        return $result;
    }   	
	
	protected function backgroundSettings() {
		$fields_form = array(
			array(
				'type' => 'color',
				'label' => $this->l('Background Color:'),
				'name' => 'novthemeconfig_body_bg_color',
			),
			array(
				'type' => 'select',
				'name' => 'novthemeconfig_body_bg_repeat',
				'label' => $this->l('Repeat'),
				'options' => array(
					'query' => array(
						array('value' => 'repeat-x','name' => 'Repeat-X'),
						array('value' => 'repeat-y','name' => 'Repeat-Y'),
						array('value' => 'repeat','name' => 'Repeat Both'),
						array('value' => 'no-repeat','name' => 'No Repeat')
					),
					'id' => 'value',
					'name' => 'name'
				)
			),
			array(
				'type' => 'select',
				'label' => $this->l('Background Image'),
				'name' => 'novthemeconfig_body_bg_pattern',
				'options' => array(
					'query' => $this->getimagesArray(),
					'id' => 'id',
					'name' => 'name',
					'default' => array(
						'value' => 'none',
						'label' => $this->l('None')
					),
				),
				'desc' => $this->getimages(),
				'validation' => 'isUnsignedInt',
			),
			array(
				'type' => 'file',
				'name' => 'novthemeconfig_body_bg_image',
				'label' => $this->l('Upload Background Image'),
			),
		
        );
		return $this->getFormSection($fields_form, 'Background');
	}


    protected function menuSettings() {
        $fields_form = array(
            $this->field_onOff('novthemeconfig_enable_showmore_vertical','ShowMore Vertical Menu','Enable showmore when item menu than number show'),
            $this->field_text ('novthemeconfig_count_showmore_vertical', 'Number Show Menu Vertical', 'input-large', false, 'Count item show with showmore in vertical menu',''),
        
        );
        return $this->getFormSection($fields_form, 'Menu Settings');
    }
	
	protected function fontSettings() {
		$fields_form = array(
			array(
				'type' => 'select',
				'label' => $this->l('Body font'),
				'name' => 'novthemeconfig_main_font',
				'onchange' => 'handle_font_change(this,\''.implode(',',$this->systemFonts).'\');',
				'class' => 'fontOptions',
				'options' => array(
				   'optiongroup' => array (
						'query' => $this->fontOptions(),
						'label' => 'name'
					),
					'options' => array (
						'query' => 'query',
						'id' => 'id',
						'name' => 'name'
					),
					'default' => array(
						'value' => 0,
						'label' => $this->l('Use default')
					),
				),
				'desc' => '<p  id="novthemeconfig_main_font_example" class="fontshow">Example normal text</p>',
				'validation' => 'isGenericName',
			),
            array(
                'type' => 'select',
                'label' => $this->l('Heading Font'),
                'name' => 'novthemeconfig_main_font_primary',
                'onchange' => 'handle_font_change(this,\''.implode(',',$this->systemFonts).'\');',
                'class' => 'fontOptions',
                'options' => array(
                   'optiongroup' => array (
                        'query' => $this->fontOptions(),
                        'label' => 'name'
                    ),
                    'options' => array (
                        'query' => 'query',
                        'id' => 'id',
                        'name' => 'name'
                    ),
                    'default' => array(
                        'value' => 0,
                        'label' => $this->l('Use default')
                    ),
                ),
                'desc' => '<p  id="novthemeconfig_main_font_primary_example" class="fontshow">Example normal text</p>',
                'validation' => 'isGenericName',
            )
        );
		return $this->getFormSection($fields_form, 'Fonts');
	}

	protected function categorySettings() {
		$fields_form = array(
			$this->field_onOff('novthemeconfig_category_title', 'Show category title'),
			$this->field_onOff('novthemeconfig_category_image', 'Show category image'),
			$this->field_onOff('novthemeconfig_category_desc','Show category description'),
			$this->field_onOff('novthemeconfig_sub_category', 'Show subcategories '),
			array(
				'type' => 'select',
				'name' => 'novthemeconfig_grid_subcategory',
				'label' => $this->l('Number of Subcategories in one row '),
				'required' => false,
				'lang' => false,
				'options' => array(
					'query' => array(
						array('value' => '1', 'name' => '1 Category'),
						array('value' => '2', 'name' => '2 Categories'),
						array('value' => '3', 'name' => '3 Categories'),
						array('value' => '4', 'name' => '4 Categories'),
					),
					'id' => 'value',
					'name' => 'name'
				)
			),
			$this->field_onOff('novthemeconfig_sub_category_image', 'Show sub category image'),
			$this->field_onOff('novthemeconfig_sub_category_title', 'Show sub category title'),
			$this->field_onOff('novthemeconfig_sub_category_desc','Show sub category description'),
						
        );
		return $this->getFormSection($fields_form, 'Category Pages');
	}
	
	protected function listingSettings() {
		$fields_form = array(
            array(
                'type' => 'select',
                'name' => 'novthemeconfig_cat_product_type',
                'label' => $this->l('Product Item Type'),
                'required' => false,
                'lang' => false,
                'options' => array(
                    'query' => array(
                        array('value' => 'type_one', 'name' => 'Item Type One'),
                        array('value' => 'type_two', 'name' => 'Item Type Two'),
                        array('value' => 'type_three', 'name' => 'Item Type Three'),
                    ),
                    'id' => 'value',
                    'name' => 'name'
                )
            ),
			$this->field_onOff('novthemeconfig_cat_product_title','Product title'),
			$this->field_onOff('novthemeconfig_cat_product_desc','Show product description'),
			$this->field_onOff('novthemeconfig_cat_product_quickview','Show Quick view'),
			$this->field_onOff('novthemeconfig_cat_product_price','Show product price'),
			$this->field_onOff('novthemeconfig_cat_product_label','Show product label (New/Sale)'),
			$this->field_onOff('novthemeconfig_cat_product_stock','Stock information'),
			$this->field_onOff('novthemeconfig_second_img', 'Display Second Image'),
			
        );
		return $this->getFormSection($fields_form, 'Product Category');
	}

	protected function productSettings() {
		$fields_form = array(
            array(
                'type' => 'select',
                'name' => 'novthemeconfig_product_layout',
                'label' => $this->l('Product Detail Layout'),
                'required' => false,
                'lang' => false,
                'options' => array(
                    'query' => array(
                        array('value' => 'layout-both-columns', 'name' => 'One large central column and 2 side columns'),
                        array('value' => 'layout-right-column', 'name' => 'Two Columns, small right column'),
                        array('value' => 'layout-left-column', 'name' => 'Two Columns, small left column'),
                        array('value' => 'layout-one-column', 'name' => 'One Columns, no small column'),
                    ),
                    'id' => 'value',
                    'name' => 'name'
                )
            ),
			array(
				'type' => 'select',
				'name' => 'novthemeconfig_product_thumbtype',
				'label' => $this->l('Thumbnails Type'),
				'required' => false,
				'lang' => false,
				'options' => array(
					'query' => array(
						array('value' => 'true', 'name' => 'Vertical Thumbnails'),
						array('value' => 'false', 'name' => 'Horizontal Thumbnails'),
					),
					'id' => 'value',
					'name' => 'name'
				)
			),
			array(
				'type' => 'select',
				'name' => 'novthemeconfig_product_thumb',
				'label' => $this->l('Display thumbnails'),
				'required' => false,
				'lang' => false,
				'options' => array(
					'query' => array(
						array('value' => '1', 'name' => '1 Thumbnail'),
						array('value' => '2', 'name' => '2 Thumbnails'),
						array('value' => '3', 'name' => '3 Thumbnails'),
						array('value' => '4', 'name' => '4 Thumbnails'),
						array('value' => '5', 'name' => '5 Thumbnails'),
					),
					'id' => 'value',
					'name' => 'name'
				)
			),
			$this->field_onOff('novthemeconfig_product_sku','Display Product SKU'),
			$this->field_onOff('novthemeconfig_product_attribute','Display Product Attribute'),				
			$this->field_onOff('novthemeconfig_product_availability','Display Product Availability'),	
			$this->field_onOff('novthemeconfig_share_buttons','Share buttons'),
			$this->field_onOff('novthemeconfig_product_shortdesc','Short Product Description'),
			array(
				 'type' => 'select',
				 'label' => $this->l('Product More Info Styles'),
				 'name' => 'novthemeconfig_moreinfo',
				 'options' => array(
					 'query' => array(
						 array('value' => 'tab', 'name' => 'Product Moreinfo Tab'),
						 array('value' => 'accordion', 'name' => 'Product Moreinfo Accordion'),
						 array('value' => 'list', 'name' => 'Product Moreinfo List'),
					 ),
					 'id' => 'value',
					 'name' => 'name',
				 ),
			 ),
             $this->field_onOff('novthemeconfig_product_customtab_show','Custom Tab Show'),
             $this->field_text('novthemeconfig_product_customtab_name','Custom Tab Name', 'input-large', false),
			 $this->field_textarea ('novthemeconfig_product_customtab', 'Custom Tab Content','',false,true),
             array(
                'type' => 'select',
                'name' => 'novthemeconfig_product_relate_col',
                'label' => $this->l('Display Product Relate'),
                'required' => false,
                'lang' => false,
                'options' => array(
                    'query' => array(
                        array('value' => '3', 'name' => '3 Columns'),
                        array('value' => '4', 'name' => '4 Columns'),
                        array('value' => '5', 'name' => '5 Columns'),
                    ),
                    'id' => 'value',
                    'name' => 'name'
                )
            ),
        );
		return $this->getFormSection($fields_form, 'Product Detail');
	}

    protected function cateblogSettings() {
        $fields_form = array(
            array(
                'type' => 'select',
                'name' => 'novthemeconfig_cateblog_layout',
                'label' => $this->l('Category Blog Layout'),
                'required' => false,
                'lang' => false,
                'options' => array(
                    'query' => array(
                        array('value' => 'layout-both-columns', 'name' => 'One large central column and 2 side columns'),
                        array('value' => 'layout-right-column', 'name' => 'Two Columns, small right column'),
                        array('value' => 'layout-left-column', 'name' => 'Two Columns, small left column'),
                        array('value' => 'layout-one-column', 'name' => 'One Columns, no small column'),
                        array('value' => 'layout-full-width', 'name' => 'Full width'),
                    ),
                    'id' => 'value',
                    'name' => 'name'
                )
            ),
            array(
                'type' => 'select',
                'name' => 'novthemeconfig_cateblog_type',
                'label' => $this->l('Category Blog Item Type'),
                'required' => false,
                'lang' => false,
                'options' => array(
                    'query' => array(
                        array('value' => 'grid', 'name' => 'Grid Item'),
                        array('value' => 'list', 'name' => 'List Item'),
                        //array('value' => 'masonry', 'name' => 'Masonry Item'),
                    ),
                    'id' => 'value',
                    'name' => 'name'
                )
            ),
            array(
                'type' => 'select',
                'name' => 'novthemeconfig_cateblog_columns',
                'label' => $this->l('Number column in category blog page'),
                'required' => false,
                'lang' => false,
                'options' => array(
                    'query' => array(
                        array('value' => '1', 'name' => 'One column'),
                        array('value' => '2', 'name' => 'Two column'),
                        array('value' => '3', 'name' => 'Three column'),
                        array('value' => '4', 'name' => 'Four column')
                    ),
                    'id' => 'value',
                    'name' => 'name'
                )
            ),
        );
        return $this->getFormSection($fields_form, 'Category Blog');
    }

	protected function contactSettings() {
		$fields_form = array(
			$this->field_text('contact_address','Address <i class="icon-home"> </i>', 'input-xxlarge', false),
			$this->field_text('contact_email','Email <i class="icon-paper-plane"> </i>', 'input-xxlarge', false),
            $this->field_text('contact_phone','Phone <i class="icon-phone"> </i>', 'input-xxlarge', false),
            $this->field_text('contact_address_2','Address 2 <i class="icon-home"> </i>', 'input-xxlarge', false),
            $this->field_text('contact_email_2','Email 2<i class="icon-paper-plane"> </i>', 'input-xxlarge', false),
            $this->field_text('contact_phone_2','Phone 2<i class="icon-phone"> </i>', 'input-xxlarge', false),
            $this->field_text('contact_fanpage','Fanpage Facebook', 'input-xxlarge', false),
	        $this->field_textarea ('contact_desc', 'Contact Description','',false,false),
            $this->field_text('store_latitude','Store latitude', 'input-xxlarge', false),
            $this->field_text('store_longitude','Store longitude', 'input-xxlarge', false),
            $this->field_text('contact_fanpage','Fanpage Facebook', 'input-xxlarge', false),
        );
		return $this->getFormSection($fields_form, 'Contact Information');
	}
	
	protected function socialSettings() {
		$fields_form = array(
			$this->field_onOff('social_in_footer', 'Show block '),
            $this->field_text('social_facebook','Facebook <i class="icon-facebook-square"> </i>', 'input-large', false),
            $this->field_text('social_twitter','Twitter <i class="icon-twitter-square"> </i> ', 'input-large', false),
            $this->field_text('social_google','Google <i class="icon-google-plus-square"> </i> ', 'input-large', false),
            $this->field_text('social_dribbble','Dribbble <i class="icon-dribbble" aria-hidden="true"></i> ', 'input-large', false),
            $this->field_text('social_instagram','Instragram <i class="icon-instagram" aria-hidden="true"></i> ', 'input-large', false),
            $this->field_text('social_flickr','Flickr <i class="icon-flickr"> </i> ', 'input-large', false),
            $this->field_text('social_pinterest','Pinterest <i class="icon-pinterest"> </i>', 'input-large', false),
            $this->field_text('social_linkedIn','LinkedIn <i class="icon-linkedin-square"> </i>', 'input-large', false),
			$this->field_text('social_skype','Skype <i class="fa fa-skype"></i>', 'input-xxlarge', false),
			
        );
		return $this->getFormSection($fields_form, 'Social Accounts');
	}

	protected function responsiveSettings() {
        $fields_form = array(
            array(
                'type' => 'file',
                'name' => 'novthemeconfig_logo_mobile',
                'label' => $this->l('Logo mobile'),
            ),
            
        );
        return $this->getFormSection($fields_form, 'Responsive');
    }

	protected function customSettings() {
		$fields_form = array(
			$this->field_textarea ('novthemeconfig_customCSS', 'Custom CSS Code','Important Note: Use this area if only there are rules you cannot override with using normal css files. This will add css rules as inline code and it is not the best practice. Try using "custom.css" file located under "themes/your_themes/css/" folder to add your custom css rules.',false,false),
        );
		return $this->getFormSection($fields_form, 'Custom Css');
	}
	
    private function _getThemeConfig($standard = true, $style = true, $multiLang = true) {
        $id_default_lang = $this->context->language->id;
        $config = array();
		
        if ($standard) {
            foreach ($this->_standardConfig as $configItem) {
                $config[$configItem] = Configuration::get($configItem);
            }
        }
		
        if ($style) {
            foreach ($this->_styleConfig as $configItem) {
                $config[$configItem] = Configuration::get($configItem);
            }
        }

        if ($multiLang) {
            foreach ($this->_multiLangConfig as $configItem) {
                $config[$configItem] = Configuration::get($configItem, $id_default_lang);
            }
			
        }
		
        return $config;
    }

    protected function _prepHook($params){
        $config 		= 	$this->_getThemeConfig();
		$isLogged 		= 	$this->context->customer->isLogged();
		$firstname		=	$this->context->customer->firstname;
		$lastname		=	$this->context->customer->lastname;
		$novthemeconfig_loggedmsg	=	Configuration::get('novthemeconfig_loggedmsg', $this->context->language->id);
		$novthemeconfig_wellcomemsg	=	Configuration::get('novthemeconfig_wellcomemsg', $this->context->language->id);
        $novthemeconfig_logo_mobile   =   Configuration::get('novthemeconfig_logo_mobile');
		$novthemeconfig_payment_image	=	Configuration::get('novthemeconfig_payment_image');
        $novthemeconfig_logo_footer   =   Configuration::get('novthemeconfig_logo_footer');
		$background_dir = $this->_path.'/images/';

		
        if ($config) {
            foreach ($config as $key => $value) {
				$this->smarty->assignGlobal($key ,$value);
            }
        }
		
		/*Welcome msg*/
		$wellcome_txt= $isLogged  ? $novthemeconfig_loggedmsg.' '.$firstname.' '.$lastname : $novthemeconfig_wellcomemsg;
		$this->context->smarty->assign('wellcome_txt',$wellcome_txt);
		$this->context->smarty->assign('payment_image',$background_dir.$novthemeconfig_payment_image);
        $this->context->smarty->assign('logo_mobile',$background_dir.$novthemeconfig_logo_mobile);
        $this->context->smarty->assign('logo_footer',$background_dir.$novthemeconfig_logo_footer);
			
		/* COPYRIGHT */
		$copyRight = Configuration::get('novthemeconfig_copyright',$this->context->language->id);
		if($copyRight !=''){
			$copyRight_short = str_replace('{year}', date('Y'), $copyRight);
			$copyRight_by = '';
			$copyRight_txt = $copyRight_short.' '.$copyRight_by; 
			$this->context->smarty->assign('copyRight_txt',$copyRight_txt);
		}
    }
	
	protected function field_textarea ($name, $label, $class = '', $lang = false, $editor = true, $hint = '') {
		$field = array ();
		$field['type'] = 'textarea';
		$field['rows'] = 12;
		$field['label'] = $this->l($label);
		$field['name'] = $name;
		if($class) $field['class'] = $class;
		if($lang) $field['lang'] = $lang;
		if($editor) $field['autoload_rte'] = $editor;
		if($hint) $field['hint'] = $this->l($hint);
		
		return $field;
	}

	protected function field_text ($name, $label, $class = '', $lang = false, $hint = '',$suffix = '') {
		$field = array ();
		$field['type'] = 'text';
		$field['label'] = $label;
		$field['name'] = $name;
		
		if($class) $field['class'] = $class;
		if($lang) $field['lang'] = $lang;
		if($hint) $field['hint'] = $this->l($hint);
		if (!empty($suffix)) $field['suffix'] = $suffix;
		
		return $field;
	}

	protected function field_onOff ($name, $label,$des ='') {
		return array(
			'type' => 'switch',
			'label' => $label,
			'name' => $name,
			'desc' => $des,
			'is_bool' => true,
			'values' => array(
				array(
					'id' => $name.'_ON',
					'value' => 1,
					'label' => $this->l('Enabled')
				),
				array(
					'id' => $name.'_OFF',
					'value' => 0,
					'label' => $this->l('Disabled')
				)
			)
		);
	}

	protected function getFormSection ($fields_form, $title, $icon = 'icon-cogs') {
		return array(
			'form' => array(
				'legend' => array(
					'title' => $title,
					'icon' => $icon
				),
				'input' => $fields_form,
				'submit' => array(
				'title' => $this->l('Save'),
                    		'class' => 'btn btn-primary',
				),
                'buttons' =>  array(
                    array (
                        'title' => $this->l('Live Preview'),
                        'icon' => 'visibility',
						'href'	=> Tools::getHttpHost(true).__PS_BASE_URI__,
						'target' => "_blank"
                    ),
					array (
                        'title' => $this->l('Install Sample'),
                        'icon' => 'cloud_download',
						'href'	=> AdminController::$currentIndex . '&configure=' . $this->name . '&token=' . Tools::getAdminTokenLite('AdminModules') .'&process=importdata',
						'class'	=> "pull-right",
                    ),					
					array (
                        'title' => $this->l('Compile Css'),
                        'icon' => 'cloud_download',
						'href'	=> AdminController::$currentIndex . '&configure=' . $this->name . '&token=' . Tools::getAdminTokenLite('AdminModules') .'&process=compile_css',
						'class'	=> "pull-right",
                    )
                )				
			)
		);
	}
	public function getConfigTheme(){
		$novconfig = array();
		$id_lang = Context::getContext()->language->id;
		foreach($this->defaults as $key => $value) {
			if(is_array($value)){
				$novconfig[$key] = Configuration::get($key,$this->context->language->id);
			}else{
				$prefix_key = str_replace("novthemeconfig_","",$key);
				
				$novconfig[$key] = Configuration::get($key);
				
				if(Tools::getValue($prefix_key)){
					Tools::clearSmartyCache();
					$novconfig[$key] = Tools::getValue($prefix_key);
					$this->context->cookie->__set($prefix_key,  Tools::getValue($prefix_key));
				}
				
				if($this->context->cookie->__get($prefix_key)){
					$novconfig[$key] = $this->context->cookie->__get($prefix_key);
				}
					
			}	
		}
		return 	$novconfig;
	}	
}
?>