<?php
/*
Plugin Name: WP cache blocks
Plugin URI: http://www.wpxue.com/wp-cache-blocks/
Description: WP cache blocks  is an extremely efficient WordPress page caching system to make you site much faster and responsive.WP cache blocks  can be cached in any part of the wordpress theme, Automatically update the cache expired,or Automatically update the cache when you add or updated post/comment. 
Author: wpxue
Version: 1.0.0
Author URI: http://www.wpxue.com
*/

define(CACHE_DIR,WP_CONTENT_DIR."/cache/");//DEFAULT CACHE_DIR

define(CACHE_TIME_DEFAULT,3600);//DEFAULT CACHE TIME *** s

define("WPcache","<!--CacheFile created at ".date("Y-m-d H:i:s")." by WP cache blocks -->");
###############WPxue_PayPal_Donate###############
if(!function_exists('WPxue_PayPal_Donate')){
function WPxue_PayPal_Donate($number,$image="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif",$name='Donate WPxue.com,Thank you very much!'){
$name=urlencode($name);
$number=urlencode($number);
$image1="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif";
$image2="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif";
$image3="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif";
$image4="https://www.paypal.com/en_GB/i/btn/btn_donateCC_LG.gif";

echo <<< html
<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=hnbwww%40qq%2ecom&lc=US&item_name=$name&item_number=$number&button_subtype=services&currency_code=USD&bn=PP%2dBuyNowBF%3abtn_buynowCC_LG%2egif%3aNonHosted" >
<img src="$image" border="0"   alt="If you like this Plugin , please Donate WPxue.com,Thank you very much!" title="If you like this Plugin , please Donate WPxue.com,Thank you very much! 
Make payments with PayPal - it's fast, free and secure!"/>
 </a>
html;
}
}
###############WPxue_PayPal_Donate###############
class wp_cache_blocksOptions {

	function getOptions() {
		$options = get_option('wp_cache_blocks_options');
		if (!is_array($options)) {
		   $options['wp_cache_blocks_Default_Cache_Time'] ='3600';
			$options['wp_cache_blocks_Updated_Posts'] ='';
			$options['wp_cache_blocks_comment_post'] = '';
			$options['wp_cache_blocks_edit_comment'] = '';
			$options['wp_cache_blocks_delete_comment'] = '';
			update_option('wp_cache_blocks_options', $options);
		}
		return $options;
	}

	function add() {
		if(isset($_POST['wp_cache_blocks_save'])) {//if wp_cache_blocks_save POST
			$options = wp_cache_blocksOptions::getOptions();
			$options['wp_cache_blocks_Default_Cache_Time'] =stripslashes($_POST['wp_cache_blocks_Default_Cache_Time']);
			$options['wp_cache_blocks_Updated_Posts'] =stripslashes($_POST['wp_cache_blocks_Updated_Posts']);
			$options['wp_cache_blocks_comment_post'] = stripslashes($_POST['wp_cache_blocks_comment_post']);
			$options['wp_cache_blocks_edit_comment'] = stripslashes($_POST['wp_cache_blocks_edit_comment']);
			$options['wp_cache_blocks_delete_comment'] = stripslashes($_POST['wp_cache_blocks_delete_comment']);
 
			 
			update_option('wp_cache_blocks_options', $options);

		} else {
			wp_cache_blocksOptions::getOptions();
		}

		add_options_page(__('WP Cache Blocks','wp_cache_blocks'), __('WP Cache Blocks','wp_cache_blocks'),5, basename(__FILE__), array('wp_cache_blocksOptions', 'display'));
	}

	function display() {
		$options = wp_cache_blocksOptions::getOptions();
?>
<form action="" method="post" enctype="multipart/form-data" name="wp_cache_blocks_form">

		<div class="wrap">
<?php if(isset($_POST['wp_cache_blocks_save'])) { ?>
<div class="updated fade"><p><strong>Save OK !</strong></p> </div>
<?php } ?>	

<?php if(isset($_POST['wp_cache_detete_cache'])) { WPxue_deldir(CACHE_DIR); ?>
<div class="updated fade"><p><strong> ALL CACHE DELETED!</strong></p> </div>
<?php } ?>	
	
<div id="icon-page" class="icon32"><br></div>

<h2>WP Cache blocks</h2>
 			<input class="button-primary" type="submit" name="wp_cache_detete_cache" value="<?php _e('DELETE ALL CACHE','wp_cache_blocks'); ?>" />
			
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
										<?php _e('Default Cache Time','wp_cache_blocks'); ?>
 
					</th>
					<td>
					 
						<label><?php echo CACHE_TIME_DEFAULT;?> s  <?php _e('(Tips:The cache file will auto updated when Expired)','wp_cache_blocks'); ?></label>
					
					</td>
				</tr>
			</tbody>
		</table>
<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
 						<?php _e('Updated Posts','wp_cache_blocks'); ?>
					</th>
					<td>
 
						<label>
							<textarea name="wp_cache_blocks_Updated_Posts" cols="50" rows="3" style="width:98%;font-size:12px;"><?php echo($options['wp_cache_blocks_Updated_Posts']); ?></textarea>
						</label>
					
					</td>
				</tr>
			</tbody>
		</table>
 <table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
		 						<?php _e('comment_post','wp_cache_blocks'); ?>
					</th>
					<td>
 
						<label>
							<input name="wp_cache_blocks_comment_post" style="width:96.6%;font-size:12px;" value="<?php echo($options['wp_cache_blocks_comment_post']); ?>"> 
						</label>
					
					</td>
				</tr>
			</tbody>
		</table>
		
 <table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
		 						<?php _e('edit_comment','wp_cache_blocks'); ?>
					</th>
					<td>
 
						<label>
							<input name="wp_cache_blocks_edit_comment" style="width:96.6%;font-size:12px;" value="<?php echo($options['wp_cache_blocks_edit_comment']); ?>"> 
						</label>
					
					</td>
				</tr>
			</tbody>
		</table>
 <table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
		 						<?php _e('delete_comment','wp_cache_blocks'); ?>
					</th>
					<td>
 
						<label>
							<input name="wp_cache_blocks_delete_comment" style="width:96.6%;font-size:12px;" value="<?php echo($options['wp_cache_blocks_delete_comment']); ?>"> 
						</label>
					
					</td>
				</tr>
			</tbody>
		</table>
		
		<p class="submit">
			<input class="button-primary" type="submit" name="wp_cache_blocks_save" value="<?php _e('Save Changes','wp_cache_blocks'); ?>" />
<?php WPxue_PayPal_Donate('WP Cache blocks');?>
		</p>
		
				<p><?php _e('<strong>Descrption:</strong><br/>WP cache blocks  is an extremely efficient WordPress page caching system to make you site much faster and responsive.<br/>WP cache blocks  can be cached in any part of the wordpress theme, Automatically update the cache expired,or Automatically update the cache when you add or updated post/comment.<br/><br/>1)Default Cache Time ,edit plugin file <code>define(CACHE_TIME_DEFAULT,3600);//DEFAULT CACHE TIME *** s
</code>;<br/>2)If you want to auto update the cache, please fill in the corresponding table width the cache ID.Comma separated,like this:if you want to  auto update the cache (1 and 2 and 3)when add post;you will fill Updated Posts with 1,2,3<br/>
<br/><strong>Usage:</strong><br/>Access the Theme Editor from the Administration > Appearance > Editor menu.<br/>Add cache block areas to the any parts of your theme. <br/>use like this in any template file:<br/><br/><strong>Warning:cache_id must be unique.</strong><br/><br/>&lt;?php WPxue_StartCache(cache_id);if(!WPxue_Have_Cached(cache_id)){ ?&gt;<br/>//the content you want to cache<br/>//it can be any code<br/>&lt;?php }	WPxue_EndCache(cache_id);?&gt;
','wp_cache_blocks'); ?></p>
		
</div>	
</form>
 <?php


}}
add_action('admin_menu', array('wp_cache_blocksOptions','add'));

$wp_cache_blocks_Options = wp_cache_blocksOptions::getOptions();


function WPxue_CreateCache($id,$Content){
if (!file_exists(CACHE_DIR)){ mkdir (CACHE_DIR);}
	$path = CACHE_DIR.$id.".txt";
 
	$fp = @fopen( $path , "w+" );
	if( $fp ){
		@chmod($path, 0666 ) ;
		@flock($fp ,LOCK_EX );

		// write the file。
		fwrite( $fp , $Content );
		@flock($fp, LOCK_UN);
		fclose($fp);
	 }
}

function WPxue_DeleteCache($id){
$path = CACHE_DIR.$id.".txt";
@unlink($path);
}

#==========================================
//@deldir删除指定文件夹下所有内容
 
function WPxue_deldir($dir) {
  $dh=opendir($dir);//打开目录
  while (false !==($file=readdir($dh))) {//遍历目录
    if($file!="." && $file!="..") {//若不是目录
      $fullpath=$dir."/".$file;
      if(!is_dir($fullpath)) {//若不是目录
          unlink($fullpath);
      } else {
          WPxue_deldir($fullpath);
      }
    }
  }

  closedir($dh);
//@删除目录
#  if(rmdir($dir)) {    return true;  } else {    return false;  }
  
  }

#==========================================

function WPxue_StartCache($id,$time=CACHE_TIME_DEFAULT){


$path = CACHE_DIR.$id.".txt";
$have_cached = false;
if (file_exists($path)){
    $file_time = filemtime($path);
	$cache_time	=	date('Y-m-d H:i:s',$file_time);
	if ((time()	- $file_time) <= $time ){ //
		#echo "<!-- Start Cache ID:$id  $cache_time -->";
		echo(file_get_contents($path));
		echo "<!-- End Cache ID:$id  -->";
        $have_cached = true;
    }
}
//no cached
if(!$have_cached){	ob_start();}

}
#==========================================

function WPxue_EndCache($id,$time=CACHE_TIME_DEFAULT){
$path = CACHE_DIR.$id.".txt";
$have_cached = false;

if (file_exists($path)){
    $file_time = filemtime($path);
	if ((time()	- $file_time) <= $time ){ 
        $have_cached = true;
    }
}

// no cached
if(!$have_cached){ 
    $Content = ob_get_contents();
    ob_end_clean();	
    echo $Content;
	WPxue_CreateCache($id,$Content);
	} 
//end cached

}

function WPxue_Have_Cached($id,$time=CACHE_TIME_DEFAULT){
$path = CACHE_DIR.$id.".txt";
$have_cached = false;
if (file_exists($path)){//
    $file_time = filemtime($path);
	if ((time()	- $file_time) <= $time ){ 
        $have_cached = true;
    }
}
return  $have_cached;
}




function save_post_DeleteCache(){
global $wp_cache_blocks_Options;
$del=$wp_cache_blocks_Options['wp_cache_blocks_Updated_Posts'];
$path=explode(',',$del); 
foreach ($path as $id){	WPxue_DeleteCache($id);}
}


function comment_post_DeleteCache(){
global $wp_cache_blocks_Options;
$del=$wp_cache_blocks_Options['wp_cache_blocks_comment_post'] ;
$path=explode(',',$del); 
foreach ($path as $id){	WPxue_DeleteCache($id);}
}

function edit_comment_DeleteCache(){
global $wp_cache_blocks_Options;
$del=$wp_cache_blocks_Options['wp_cache_blocks_edit_comment'];
$path=explode(',',$del); 
foreach ($path as $id){	WPxue_DeleteCache($id);}
}

function delete_comment_DeleteCache(){
global $wp_cache_blocks_Options;
print_r ($wp_cache_blocks_Options);
$del=$wp_cache_blocks_Options['wp_cache_blocks_delete_comment'];
$path=explode(',',$del); 
foreach ($path as $id){	WPxue_DeleteCache($id);}
}

//update cached
/*========================================================
save_post   Runs whenever a post or page is created or updated
comment_post  Runs just after a comment is saved in the database
delete_comment 
========================================================*/
//update Delete cached
add_action('save_post','save_post_DeleteCache');
add_action('comment_post','comment_post_DeleteCache');
add_action('delete_comment','delete_comment_DeleteCache');
add_action('edit_comment','edit_comment_DeleteCache');