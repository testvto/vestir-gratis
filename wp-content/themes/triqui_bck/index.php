<?php get_header(); ?>



<div id="content">



     <div id="gamecontent">



          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>



          <div class = "gameleft">



              





          </div> <!-- end gameleft div -->



          <div class = "gameright">



          </div> <!-- end gameright div -->



          <div class = "white"></div>		



       <div class = "description">



<div class ="adsensead">






 <p> 


      

  
                <script type="text/javascript"><!--
google_ad_client = "ca-pub-5691228106014912";
/* Vestir Above Game */
google_ad_slot = "3451787309";
google_ad_width = 336;
google_ad_height = 280;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5691228106014912";
/* Vestir Above Game */
google_ad_slot = "3451787309";
google_ad_width = 336;
google_ad_height = 280;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></p><br />
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5691228106014912";
/* Vertical Text Vestir */
google_ad_slot = "5174937587";
google_ad_width = 728;
google_ad_height = 15;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

 <h1><?php the_title(); ?></h1>

 <li>Description



                         <ul>



                              <li><?php echo str_replace("\n","<br />",get_post_meta($post->ID, "description", true)); ?></li>



                         </ul>



                    </li>
      <ul>



                   



                    <?php if (get_post_meta($post->ID, "instructions", true)): ?>



                    <li>Instructions



                         <ul>



                              <li><?php echo str_replace("\n","<br />",get_post_meta($post->ID, "instructions", true)); ?></li>



                         </ul>



                    </li>



                    <?php endif; ?>



               </ul>

      

  
<div id="loadergame" style="display:none;padding:10px" align="center"> 
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
            <param name="movie" value="http://www.juegosdevestirgratis.com.mx/afg-adloader.swf" /> 
            <param name="quality" value="high" /> 
            <param name="bgcolor" value="#ffffff" /> 
            <embed src="http://www.juegosdevestirgratis.com.mx/afg-adloader.swf"
                   quality="high" bgcolor="#ffffff"
                   width="400" height="300"
                   name="afg-adloader"
                   align="middle" allowScriptAccess="always"
                   allowFullScreen="false"
                   type="application/x-shockwave-flash"
                   flashVars="publisherId=ca-games-pub-5691228106014912&descriptionUrl=http%3A%2F%2Fwww.juegosdevestirgratis.com.mx%2Fplay%2F&age=1001&gender=2&channels=abcd;xyz"
                   pluginspage="http://www.adobe.com/go/getflashplayer" /> 
        </object> 
    </div> 
</div> 
<div id="containergame"  align="center" > 
  

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
    var site_url='http://www.juegosdevestirgratis.com.mx';
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
      <!-- end flash div -->



                   

                   <!-- a 728x90 adsense ad would fit good -->

                   



     



           




 </div>
 
 <?php boposts_show(); ?>

<div class ="adsensead">


<p align="left">
    <?php if(function_exists('the_ratings')) { the_ratings(); } ?>

  </p>





  <p><?php if(function_exists('the_views')) { the_views(); } ?>
<br>

</p>


          </div>  <div style="text-align:left; position:relative; width:700px; left:25px;;"><!-- end description div -->



          <!--



          <?php trackback_rdf(); ?>



          -->



          <?php endwhile; else: ?>



          <p><?php _e('Sorry, no game with this name.'); ?></p>



          <?php endif; ?>



          <?php comments_template(); // Get wp-comments.php template ?>



     </div> </div> <!-- end gamecontent div -->







  


</div> <!-- end content div -->


<?php get_footer(); ?>
