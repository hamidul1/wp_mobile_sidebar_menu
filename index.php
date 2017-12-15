<?php
/*
Plugin Name: Mobile menu
Plugin URI: http://wordpress.org
Description: A simple plugin of mobile menu.
Version: 1.6
Author: HamidulBD
*/


/* Register the plugin script */
function mobile_menu_scripts_basic()
{

wp_enqueue_script( 'sliiide', plugins_url( '/js/sliiide.min.js', __FILE__ ) , array('jquery'));
/*wp_enqueue_script( 'owl.carousel', plugins_url( '/js/owl.carousel.js', __FILE__ ) , array('jquery'));*/

wp_enqueue_style( 'sliiidecss', plugins_url( '/css/sliiide.min.css', __FILE__ ) );
wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css' );


}
add_action( 'wp_enqueue_scripts', 'mobile_menu_scripts_basic' );



/*adding custom css */
add_action('wp_head', 'custom_css_add_mobile_menu');
function custom_css_add_mobile_menu(){
  ?>
<style>

</style>

  <?php
}


/*adding footer */
add_action('wp_footer', 'custom_css_footer_add_mobile_menu');
function custom_css_footer_add_mobile_menu(){
  ?>
  <script type="text/javascript">
  	jQuery(document).ready(function( $ ) {

  	var settings = {
      		toggle: "#sliiider-toggle", // the selector for the menu toggle, whatever clickable element you want to activate or deactivate the menu. A click listener will be added to this element.
      		exit_selector: ".slideout-overlay", // the selector for an exit button in the div if needed, when the exit element is clicked the menu will deactivate, suitable for an exit element inside the nav menu or the side bar
      		animation_duration: "0.5s", //how long it takes to slide the menu
     		place: "left", //where is the menu sliding from, possible options are (left | right | top | bottom)
      		animation_curve: "cubic-bezier(0.54, 0.01, 0.57, 1.03)", //animation curve for the sliding animation
      		body_slide: false, //set it to true if you want to use the effect where the entire page slides and not just the div
     		no_scroll: false, //set to true if you want the scrolling disabled while the menu is active
				auto_close: true //set to true if you want the slider to auto close everytime a child link of it is clicked
    			};

	$('#generate-slideout-menu').sliiide(settings); //initialize sliii

$('.menu-toggle').click(function(){
$('html').addClass('slide-opened');
$('body').addClass('slide-opened');
$(this).addClass('opened');
$('.slideout-overlay').show();

});

 $('.slideout-overlay').click(function(){
$('html').removeClass('slide-opened');
$('body').removeClass('slide-opened');
$('.opened').removeClass('opened');
$('.slideout-overlay').hide();

}); 


$('#generate-slideout-menu').click(function(){
$('html').removeClass('slide-opened');
$('body').removeClass('slide-opened');
$('.opened').removeClass('opened');
$('.slideout-overlay').hide();

}); 

});
  </script>



<style type='text/css'>
.slide-opened{overflow:hidden;}
#generate-slideout-menu {height:100% !important;}
.hideinmobile{display:block;}
.sidebar-cat{text-align:center;}
#menu-sidebar_menu {padding:30px;width:200px !important;}
#generate-slideout-menu.main-navigation ul ul {display:block;background:#FFFFFF !important;}
#generate-slideout-menu .main-navigation ul li a:hover ul {display:block !important;}
.opened::before{
    content: "\f00d" !important;
    font-family: FontAwesome;
}
#sliiider-toggle {background:none !important;display:none;}
.main-navigation {overflow-y: scroll;overflow-x: hidden;background:#FFFFFF;}
.menu-toggle{font-weight:400;}
.menu-toggle{margin:0;padding:0}.menu-toggle:before{content:"\f0c9";font-family:FontAwesome;line-height:1em;speak:none;width:1.28571429em;text-align:center;display:inline-block}.toggled .menu-toggle:before{content:"\f00d";speak:none}.menu-toggle .mobile-menu{padding-left:3px}.menu-toggle .mobile-menu:empty{display:none}.inside-navigation{position:relative}.main-navigation ul,.menu-toggle li.search-item{list-style:none;margin:0;padding-left:0}
@media (max-width:768px){
.hideinmobile{display:none;}
#sliiider-toggle {display:block;margin:10px auto;}
.main-navigation ul ul{background-color:#1e72bd;}
.main-navigation .main-nav ul ul li a{color:#FFFFFF;}
.main-navigation .main-nav ul ul li:hover > a,.main-navigation .main-nav ul ul li:focus > a,.main-navigation .main-nav ul ul li.sfHover > a{color:#FFFFFF;background-color:#2982d0;}
.main-navigation .main-nav ul ul li[class*="current-menu-"] > a{color:#FFFFFF;background-color:#2982d0;}
.main-navigation .main-nav ul ul li[class*="current-menu-"] > a:hover,.main-navigation .main-nav ul ul li[class*="current-menu-"].sfHover > a{color:#FFFFFF;background-color:#2982d0;} }

</style>

<nav itemtype="http://schema.org/SiteNavigationElement" itemscope="itemscope" id="generate-slideout-menu" class="main-navigation" >
		<div class="inside-navigation grid-container grid-parent">
			<div class="main-nav">

                <?php
        function wp_get_menu_arrays($current_menu) {
            $array_menu = wp_get_nav_menu_items($current_menu);
            $menu = array();
            foreach ($array_menu as $m) {
                if (empty($m->menu_item_parent)) {
                    $menu[$m->ID] = array();
                    $menu[$m->ID]['ID']          =   $m->ID;
                    $menu[$m->ID]['title']       =   $m->title;
                    $menu[$m->ID]['url']         =   $m->url;
                    $menu[$m->ID]['thumbnail_id'] =   $m->thumbnail_id;
                    $menu[$m->ID]['children']    =   array();
                }
            }
            $submenu = array();
            foreach ($array_menu as $m) {
                if ($m->menu_item_parent) {
                    $submenu[$m->ID]             = array();
                    $submenu[$m->ID]['ID']       =   $m->ID;
                    $submenu[$m->ID]['title']    =   $m->title;
                    $submenu[$m->ID]['url']      =   $m->url;
                    $submenu[$m->ID]['thumbnail_id'] =   $m->thumbnail_id;
                    $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
                }
            }
            return $menu;
        }
        $current_menus = 'sidebar_menu';
        $menus = wp_get_menu_arrays($current_menus);
        ?>

        <div class="menu-sidebar_menu-container">
            <ul id="menu-sidebar_menu" class="sidebar-cat">
                <?php foreach ($menus as $item) { ?>
                    <li id="menu-item-<?php ;echo $item[ID] ?>" class="menu-item menu-item-type-taxonomy menu-item-object-listing_cat menu-item-has-children menu-item-<?php echo $item[ID]; ?>">
                        <a href="#" class="menu-image-title-after menu-image-not-hovered">
                            <img src="<?php $image = wp_get_attachment_image_src($item[thumbnail_id]); echo $image[0]; ?>" class="menu-image menu-image-title-after" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>">
                            <span class="menu-image-title">
                                <?php echo $item[title]; ?>
                            </span>
                        </a>
                        <ul class="sub-menu">
                        <?php foreach ($item[children] as $subitem) { ?>
                            <li id="menu-item-<?php echo $subitem[ID]; ?>" class="menu-item menu-item-type-taxonomy menu-item-object-listing_cat menu-item-<?php echo $subitem[ID]; ?>">
                                <a href="<?php genlink('', $subitem[title], $item[title]); ?>" class="menu-image-title-after">
                                    <span class="menu-image-title">
                                        <?php echo $subitem[title]; ?>
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                        </ul>
                    </li>
                <?php }
                ?>
            </ul>
        </div>



			</div>					</div><!-- .inside-navigation -->
	</nav>
<div class="slideout-overlay" style="display: none;"></div>
  <?php
}
?>