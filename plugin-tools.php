<?php

	function dt_seo_news() {
		include_once(ABSPATH.WPINC . '/feed.php');
		$rss = fetch_feed('http://www.seowned.co.uk/feed/');
		$rss_items = $rss->get_items( 0, $rss->get_item_quantity(5) );
		$content = '<ul>';
		if ( !$rss_items ) {
			$content .= '<li class="yoast">no news items, feed might be broken...</li>';
		} else {
			foreach ( $rss_items as $item ) {
				$content .= '<li class="yoast">';
				$content .= '<a class="rsswidget" href="'.esc_url( $item->get_permalink(), $protocolls=null, 'display' ).'">'. htmlspecialchars($item->get_title()) .'</a> ';
				$content .= '</li>';
			}
		}
		$content .= '<li class="rss"><a href="http://www.seowned.co.uk/feed/">Subscribe with RSS</a></li>';
		$content .= '</ul>';
		return $content;
	}

	function dt_options_header($dt_plugin_name) {
		echo '<div class="wrap">
				<h2>'.$dt_plugin_name.'</h2>
					<div class="postbox-container" style="width:65%; margin-right:20px;">
						<div class="metabox-holder">
							<div class="meta-box-sortables">
								<form method="post" action="options.php">
<div id="gasettings" class="postbox">
				<div class="handlediv" title="Click to toggle"><br /></div>
				<h3 class="hndle"><span>'.$dt_plugin_name.' Settings</span></h3>
				<div class="inside"><table class="form-table"> ';
	}

	function dt_options_footer() {
		echo '		</table><br class="clear"/>

				</div>
				</form>
				</div>
			</div>
		</div>
	</div>';
	}

	function dt_options_side($dtpluginurl, $dtpluginurlwp) {
		echo '<div class="postbox-container side" style="width:255px;">
			<div class="metabox-holder">
				<div class="meta-box-sortables">

				<div id="dtse-plugin-like" class="postbox">
				<div class="handlediv" title="Click to toggle"><br /></div>
					<h3 class="hndle"><span>Powered By SEOwned</span></h3>
					<div class="inside">
						<a href="http://www.seowned.co.uk"><img src="http://a1.sphotos.ak.fbcdn.net/hphotos-ak-ash4/294980_370750962966353_174367719271346_981785_1971943293_n.jpg" width="235" /></a>	
					</div>
				</div>


				<div id="dtse-plugin-like" class="postbox">
				<div class="handlediv" title="Click to toggle"><br /></div>
					<h3 class="hndle"><span>Like this plugin?</span></h3>
					<div class="inside">
						<p>Why not do any or all of the following:</p>
						<ul>
							<li><a href="'.$dtpluginurl.'">Link to it so other folks can find out about it.</a></li>
	                     	<li><a href="http://wordpress.org/extend/plugins/'.$dtpluginurlwp.'/">Give it a good rating on WordPress.org.</a></li>
	                    	<li><a href="http://wordpress.org/extend/plugins/'.$dtpluginurlwp.'/">Let other people know that it works with your WordPress setup.</a>
		                  	</li></ul>			
					</div>
				</div>
					<div id="donate" class="postbox">
				<div class="handlediv" title="Click to toggle"><br /></div>
				<h3 class="hndle"><span><strong class="red">Donate &pound;10, &pound;20 or &pound;50!</strong></span></h3>
				<div class="inside">
					<p>This plugin has cost me countless hours of work, if you use it, please donate a token of your appreciation!</p><br/>
                    <form style="margin-left:50px;" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="G3GK6QZQ3MNB2">
                    <input type="image" src="https://www.paypal.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
                    <img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
                    </form>
			</div>
			</div>

					<div id="dtseolatest" class="postbox">
				<div class="handlediv" title="Click to toggle"><br /></div>
				<h3 class="hndle"><span>Latest news from SEOwned</span></h3>
				<div class="inside">
					'.dt_seo_news().'				<p>Plugin backend inspired by <a href="http://yoast.com/" target="_blank">Yoast</a></p></div>
			</div>
						</div>
				<br/><br/><br/>
			</div>
		</div> ';
	}

	function dan_admin_plugin_scripts() {
		wp_enqueue_script('jquery');
		wp_enqueue_script('postbox');
		wp_enqueue_script('dashboard');
                wp_enqueue_script('thickbox');
	}

	function dan_admin_plugin_styles() {
		wp_enqueue_style('dashboard');
		wp_enqueue_style('thickbox');
		wp_enqueue_style('global');
		wp_enqueue_style('wp-admin');
	}
if($_SERVER['PHP_SELF'] == '/wp-admin/options-general.php') {
    add_action('admin_print_scripts', 'dan_admin_plugin_scripts');
    add_action('admin_print_styles', 'dan_admin_plugin_styles');
}