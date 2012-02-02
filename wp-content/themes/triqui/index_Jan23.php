<?php get_header(); ?>
<div id="wrap">
<div id="content">
     <div id="gamecontent" itemscope itemtype="http://schema.org/Thing">
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <div class = "gameleft">
               <div class="date">
               </div> <!-- end date div -->
          </div> <!-- end gameleft div -->
          <div class = "gameright">
          </div> <!-- end gameright div -->
          <div class = "clear"></div>		
          <div class = "description" itemprop="name">             
<h1><?php the_title(); ?></h1><br />
<center> 
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<span itemscope itemtype="http://schema.org/CreativeWork">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="180" valign="top"><h3>Categor&#237;as</h3>
			<ul>
				<?php wp_list_categories('title_li=0'); ?>
			</ul>
		</td>
		
		<td valign="top">
		<div>
	       
<div id="loadergame" style="display:block;padding:10px" align="center"> 
    <a class="skip-ads" title="Skip this ads" href="javascript:;" onclick="skip_ads()">[x]</a> 
    <div id="loader"></div>  
    <div id="adsgame"> 
        <object
            classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
            codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0"
            width="400" height="300" 
            id="afg-adloader"
            align="middle">  
            <param name="allowScriptAccess" value="always" /> 
            <param name="allowFullScreen" value="false" /> 
            <param name="movie" value="http://www.funkycoco.com/afg-adloader.swf" /> 
            <param name="quality" value="high" /> 
            <param name="bgcolor" value="#ffffff" /> 
            <embed src="http://www.funkycoco.com/afg-adloader.swf"
                   quality="high" bgcolor="#ffffff"
                   width="400" height="300"
                   name="afg-adloader"
                   align="middle" allowScriptAccess="always"
                   allowFullScreen="false"
                   type="application/x-shockwave-flash"
                   flashVars="publisherId=ca-games-pub-5691228106014912&descriptionUrl=http%3A%2F%2Fwww.funkycoco.com%2Fplay%2F&age=1001&gender=2&channels=abcd;xyz"
                   pluginspage="http://www.adobe.com/go/getflashplayer" /> 
        </object> 
    </div> 
</div> 
	       
	       
	       <div class="flash">
                                                             
          <object  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="650" height="0" id="currentgame"> 
	       <param name="movie" value="<?php echo get_post_meta($post->ID, "swf_url", true); ?>" /> 
	       <param name="allowscriptaccess" value="always" /> 
	        <param name="quality" value="high">  
	        <!--[if !IE]>--> 
	   <object id="currentgame2" type="application/x-shockwave-flash" style="position:relative; padding:15px" data="<?php echo get_post_meta($post->ID, "swf_url", true); ?>" width="<?php echo get_post_meta($post->ID, "width", true); ?>"  height="<?php echo'0'; ?>"> 
	        <param name="allowscriptaccess" value="always" /> 
	        <param name="quality" value="high"> 
	       <!--<![endif]--> 
	        <a href="http://www.adobe.com/go/getflashplayer"> 
                <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /> 
	        </a> 
            <!--[if !IE]>--> 
        </object> 
        <!--<![endif]--> 
    </object> <br />
    
    
    
<script type="text/javascript"> 
    var intervalProgress;
    var game_max_width=810;
    var game=new Array();
    game.id=11383;
    game.height=450;
    game.width=<?php echo get_post_meta($post->ID, "width", true); ?>;
    var site_url='http://www.funkycoco.com';
    var rating_reset_html='<input name="game_rating" type="radio" class="auto-submit-star" value="1" />'
        +'<input name="game_rating" type="radio" class="auto-submit-star" value="2" checked="checked"/>'
        +'<input name="game_rating" type="radio" class="auto-submit-star" value="3" />'
        +'<input name="game_rating" type="radio" class="auto-submit-star" value="4" />'
        +'<input name="game_rating" type="radio" class="auto-submit-star" value="5" />';
        +'';
    var message_rating_ok='Thank you for your rating';
    var message_rating_error='There was an error, try again';
    var start_time;
    function updateProgressBar(){
        var currentgame=swfobject.getObjectById('currentgame');
		var currentgame2=swfobject.getObjectById('currentgame2');
        if(currentgame){
            var loaded=currentgame.PercentLoaded();
            document.getElementById('progress-loaded').style.width=parseInt(loaded*300/100)+'px';
            document.getElementById('progress-indicator').innerHTML=loaded+" % Cargando el Juego";
            if(loaded==100){
                if(document.getElementById('afg-adloader')){
                    end_time=new Date().getTime();
                    if((end_time-start_time)<18000){
                        return;
                    }
                }
                clearInterval(intervalProgress);
                skip_ads();
            }
        }
    }
 
    function skip_ads(){
        document.getElementById('loadergame').style.display='none';
        document.getElementById('loadergame').innerHTML='';
        document.getElementById('containergame').style.visibility='visible';
		document.getElementById('currentgame').height='<?php echo get_post_meta($post->ID, "height", true); ?>';
		document.getElementById('currentgame2').height='<?php echo get_post_meta($post->ID, "height", true); ?>';
		reset_rating();
    }
    function game_zoom_out(){//alejar
        var currentgame=swfobject.getObjectById('currentgame');
        if(currentgame.width>150){
            var i=parseInt(-50);
            i=(parseInt(currentgame.width)+i>game_max_width)?game_max_width-parseInt(game.width):parseInt(currentgame.width)+i-parseInt(game.width);
            var width=parseInt(game.width)+(i);
            var height=(parseInt(game.height)*(parseInt(game.width)+i))/parseInt(game.width);
            height=parseInt(height);
            width=parseInt(width);
            currentgame.width=width;
            currentgame.height=height;
        }
    }
    function game_zoom_in(){//acercar
        var currentgame=swfobject.getObjectById('currentgame');
        if(currentgame.width<game_max_width){
            var i=parseInt(50);
            i=(parseInt(currentgame.width)+i>game_max_width)?game_max_width-parseInt(game.width):parseInt(currentgame.width)+i-parseInt(game.width);
            var width=parseInt(game.width)+(i);
            var height=(parseInt(game.height)*(parseInt(game.width)+i))/parseInt(game.width);
            height=parseInt(height);
            width=parseInt(width);
            currentgame.width=width;
            currentgame.height=height;
        }
    }

 
    if (window.XMLHttpRequest) {
        document.getElementById('loader').innerHTML='<div id="progress-indicator"></div><div class="progress-border"><span class="progress-bar"><span id="progress-loaded"></span></span></div><div style="clear:both"></div>';
        document.getElementById('containergame').style.visibility='hidden';
        document.getElementById('loadergame').style.display='';
        start_time=new Date().getTime();
        intervalProgress =window.setInterval(updateProgressBar, 25);
    }else{
        skip_ads();
    }
    
 
</script>    
               
	       
	       </div> 
			   
			   
		</div>
		<!-- end flash div --></td>
		
		
		<td width="130" valign="top" align="center">
		
		<div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="box_count" data-width="48" data-show-faces="false" align="center"></div><br>
		
		<span class='st_twitter_vcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span><br><span class='st_plusone_vcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='share'></span>
		
		</td>
	</tr>
</table>

              

</div>

  <div class="box4">
				<p align="right"><?php get_related_posts_thumbnails(); ?></p>
			   </div>
			   
			   <table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td valign="top" >
						<div class="adbottom2"><img src="http://www.juegosdemotos.pro/wp-content/themes/triqui/728.gif" alt="ads">
</div>
						<div class="box2" style="margin-top:0;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="150" align="left" valign="top"><h3>Descripcion</h3></td>
		<td align="left" valign="top"><span itemprop="description"><?php echo str_replace("\n","<br />",get_post_meta($post->ID, "description", true)); ?></span></td>
	</tr>
	<tr>
		<td width="150" align="left" valign="top"><h3>Tags</h3></td>
		<td align="left" valign="top"><?php $post_tags = wp_get_post_tags($post->ID, array('fields' => 'name'));
               //print_r($post_tags);
	       foreach($post_tags as $tags){
		    $curr_tags = $tags->name.',';
	       }		
	       echo $dis_tags = substr($curr_tags,0,-1);

		?></td>
	</tr>
	<tr>
		<td width="150" align="left" valign="top"><h3>Juega</h3></td>
		<td align="left" valign="top"><?php echo str_replace("\n","<br />",get_post_meta($post->ID, "views", true)); ?> veces</td>
	</tr>
	<tr>
		<td width="150" align="left" valign="top"><h3>Valora este juego</h3></td>
		<td align="left" valign="top">
		<div itemprop="reviews" itemscope itemtype="http://schema.org/Review">
		    <span itemprop="reviewRating">
		<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
		    </span>
		</div>    
		
		</td>
	</tr>	
</table>
						</div>
					</td>
						<td width="250" valign="top" style="padding:12px ">
						<div>     <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar-Game') ) : ?><?php endif; ?>
						</div>
						<div style="padding-top:15px;"><script type="text/javascript">
<!--
google_ad_client = "ca-pub-5691228106014912";
/* Game Page */
google_ad_slot = "5222539967";
google_ad_width = 250;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>					
						</div>
						</td>
					</tr>
				</table>   
				
				<div class="box3">
                                   
                                   <div class="fb-comments" data-href="http://www.juegosdevestirgratis.com.mx/" data-num-posts="2" data-width="500"></div>
						  </div>
						  <br clear="all"/> 
	  
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


          <!--
          <?php trackback_rdf(); ?>
          -->
          <?php endwhile; else: ?>
          <p><?php _e('Sorry, no game with this name.'); ?></p>

          <?php endif; ?>
          <?php //comments_template(); // Get wp-comments.php template ?>
	  <br class="all"/>
     </div> <!-- end gamecontent div -->
</span>     
</div> 
</div>
<!-- end content div -->
<?php get_footer(); ?>