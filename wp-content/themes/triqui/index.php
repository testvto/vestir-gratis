<?php get_header(); ?>
<script type="text/javascript">
/*	SWFObject v2.2 <http://code.google.com/p/swfobject/> 
	is released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
var swfobject=function(){var D="undefined",r="object",S="Shockwave Flash",W="ShockwaveFlash.ShockwaveFlash",q="application/x-shockwave-flash",R="SWFObjectExprInst",x="onreadystatechange",O=window,j=document,t=navigator,T=false,U=[h],o=[],N=[],I=[],l,Q,E,B,J=false,a=false,n,G,m=true,M=function(){var aa=typeof j.getElementById!=D&&typeof j.getElementsByTagName!=D&&typeof j.createElement!=D,ah=t.userAgent.toLowerCase(),Y=t.platform.toLowerCase(),ae=Y?/win/.test(Y):/win/.test(ah),ac=Y?/mac/.test(Y):/mac/.test(ah),af=/webkit/.test(ah)?parseFloat(ah.replace(/^.*webkit\/(\d+(\.\d+)?).*$/,"$1")):false,X=!+"\v1",ag=[0,0,0],ab=null;if(typeof t.plugins!=D&&typeof t.plugins[S]==r){ab=t.plugins[S].description;if(ab&&!(typeof t.mimeTypes!=D&&t.mimeTypes[q]&&!t.mimeTypes[q].enabledPlugin)){T=true;X=false;ab=ab.replace(/^.*\s+(\S+\s+\S+$)/,"$1");ag[0]=parseInt(ab.replace(/^(.*)\..*$/,"$1"),10);ag[1]=parseInt(ab.replace(/^.*\.(.*)\s.*$/,"$1"),10);ag[2]=/[a-zA-Z]/.test(ab)?parseInt(ab.replace(/^.*[a-zA-Z]+(.*)$/,"$1"),10):0}}else{if(typeof O.ActiveXObject!=D){try{var ad=new ActiveXObject(W);if(ad){ab=ad.GetVariable("$version");if(ab){X=true;ab=ab.split(" ")[1].split(",");ag=[parseInt(ab[0],10),parseInt(ab[1],10),parseInt(ab[2],10)]}}}catch(Z){}}}return{w3:aa,pv:ag,wk:af,ie:X,win:ae,mac:ac}}(),k=function(){if(!M.w3){return}if((typeof j.readyState!=D&&j.readyState=="complete")||(typeof j.readyState==D&&(j.getElementsByTagName("body")[0]||j.body))){f()}if(!J){if(typeof j.addEventListener!=D){j.addEventListener("DOMContentLoaded",f,false)}if(M.ie&&M.win){j.attachEvent(x,function(){if(j.readyState=="complete"){j.detachEvent(x,arguments.callee);f()}});if(O==top){(function(){if(J){return}try{j.documentElement.doScroll("left")}catch(X){setTimeout(arguments.callee,0);return}f()})()}}if(M.wk){(function(){if(J){return}if(!/loaded|complete/.test(j.readyState)){setTimeout(arguments.callee,0);return}f()})()}s(f)}}();function f(){if(J){return}try{var Z=j.getElementsByTagName("body")[0].appendChild(C("span"));Z.parentNode.removeChild(Z)}catch(aa){return}J=true;var X=U.length;for(var Y=0;Y<X;Y++){U[Y]()}}function K(X){if(J){X()}else{U[U.length]=X}}function s(Y){if(typeof O.addEventListener!=D){O.addEventListener("load",Y,false)}else{if(typeof j.addEventListener!=D){j.addEventListener("load",Y,false)}else{if(typeof O.attachEvent!=D){i(O,"onload",Y)}else{if(typeof O.onload=="function"){var X=O.onload;O.onload=function(){X();Y()}}else{O.onload=Y}}}}}function h(){if(T){V()}else{H()}}function V(){var X=j.getElementsByTagName("body")[0];var aa=C(r);aa.setAttribute("type",q);var Z=X.appendChild(aa);if(Z){var Y=0;(function(){if(typeof Z.GetVariable!=D){var ab=Z.GetVariable("$version");if(ab){ab=ab.split(" ")[1].split(",");M.pv=[parseInt(ab[0],10),parseInt(ab[1],10),parseInt(ab[2],10)]}}else{if(Y<10){Y++;setTimeout(arguments.callee,10);return}}X.removeChild(aa);Z=null;H()})()}else{H()}}function H(){var ag=o.length;if(ag>0){for(var af=0;af<ag;af++){var Y=o[af].id;var ab=o[af].callbackFn;var aa={success:false,id:Y};if(M.pv[0]>0){var ae=c(Y);if(ae){if(F(o[af].swfVersion)&&!(M.wk&&M.wk<312)){w(Y,true);if(ab){aa.success=true;aa.ref=z(Y);ab(aa)}}else{if(o[af].expressInstall&&A()){var ai={};ai.data=o[af].expressInstall;ai.width=ae.getAttribute("width")||"0";ai.height=ae.getAttribute("height")||"0";if(ae.getAttribute("class")){ai.styleclass=ae.getAttribute("class")}if(ae.getAttribute("align")){ai.align=ae.getAttribute("align")}var ah={};var X=ae.getElementsByTagName("param");var ac=X.length;for(var ad=0;ad<ac;ad++){if(X[ad].getAttribute("name").toLowerCase()!="movie"){ah[X[ad].getAttribute("name")]=X[ad].getAttribute("value")}}P(ai,ah,Y,ab)}else{p(ae);if(ab){ab(aa)}}}}}else{w(Y,true);if(ab){var Z=z(Y);if(Z&&typeof Z.SetVariable!=D){aa.success=true;aa.ref=Z}ab(aa)}}}}}function z(aa){var X=null;var Y=c(aa);if(Y&&Y.nodeName=="OBJECT"){if(typeof Y.SetVariable!=D){X=Y}else{var Z=Y.getElementsByTagName(r)[0];if(Z){X=Z}}}return X}function A(){return !a&&F("6.0.65")&&(M.win||M.mac)&&!(M.wk&&M.wk<312)}function P(aa,ab,X,Z){a=true;E=Z||null;B={success:false,id:X};var ae=c(X);if(ae){if(ae.nodeName=="OBJECT"){l=g(ae);Q=null}else{l=ae;Q=X}aa.id=R;if(typeof aa.width==D||(!/%$/.test(aa.width)&&parseInt(aa.width,10)<310)){aa.width="310"}if(typeof aa.height==D||(!/%$/.test(aa.height)&&parseInt(aa.height,10)<137)){aa.height="137"}j.title=j.title.slice(0,47)+" - Flash Player Installation";var ad=M.ie&&M.win?"ActiveX":"PlugIn",ac="MMredirectURL="+O.location.toString().replace(/&/g,"%26")+"&MMplayerType="+ad+"&MMdoctitle="+j.title;if(typeof ab.flashvars!=D){ab.flashvars+="&"+ac}else{ab.flashvars=ac}if(M.ie&&M.win&&ae.readyState!=4){var Y=C("div");X+="SWFObjectNew";Y.setAttribute("id",X);ae.parentNode.insertBefore(Y,ae);ae.style.display="none";(function(){if(ae.readyState==4){ae.parentNode.removeChild(ae)}else{setTimeout(arguments.callee,10)}})()}u(aa,ab,X)}}function p(Y){if(M.ie&&M.win&&Y.readyState!=4){var X=C("div");Y.parentNode.insertBefore(X,Y);X.parentNode.replaceChild(g(Y),X);Y.style.display="none";(function(){if(Y.readyState==4){Y.parentNode.removeChild(Y)}else{setTimeout(arguments.callee,10)}})()}else{Y.parentNode.replaceChild(g(Y),Y)}}function g(ab){var aa=C("div");if(M.win&&M.ie){aa.innerHTML=ab.innerHTML}else{var Y=ab.getElementsByTagName(r)[0];if(Y){var ad=Y.childNodes;if(ad){var X=ad.length;for(var Z=0;Z<X;Z++){if(!(ad[Z].nodeType==1&&ad[Z].nodeName=="PARAM")&&!(ad[Z].nodeType==8)){aa.appendChild(ad[Z].cloneNode(true))}}}}}return aa}function u(ai,ag,Y){var X,aa=c(Y);if(M.wk&&M.wk<312){return X}if(aa){if(typeof ai.id==D){ai.id=Y}if(M.ie&&M.win){var ah="";for(var ae in ai){if(ai[ae]!=Object.prototype[ae]){if(ae.toLowerCase()=="data"){ag.movie=ai[ae]}else{if(ae.toLowerCase()=="styleclass"){ah+=' class="'+ai[ae]+'"'}else{if(ae.toLowerCase()!="classid"){ah+=" "+ae+'="'+ai[ae]+'"'}}}}}var af="";for(var ad in ag){if(ag[ad]!=Object.prototype[ad]){af+='<param name="'+ad+'" value="'+ag[ad]+'" />'}}aa.outerHTML='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"'+ah+">"+af+"</object>";N[N.length]=ai.id;X=c(ai.id)}else{var Z=C(r);Z.setAttribute("type",q);for(var ac in ai){if(ai[ac]!=Object.prototype[ac]){if(ac.toLowerCase()=="styleclass"){Z.setAttribute("class",ai[ac])}else{if(ac.toLowerCase()!="classid"){Z.setAttribute(ac,ai[ac])}}}}for(var ab in ag){if(ag[ab]!=Object.prototype[ab]&&ab.toLowerCase()!="movie"){e(Z,ab,ag[ab])}}aa.parentNode.replaceChild(Z,aa);X=Z}}return X}function e(Z,X,Y){var aa=C("param");aa.setAttribute("name",X);aa.setAttribute("value",Y);Z.appendChild(aa)}function y(Y){var X=c(Y);if(X&&X.nodeName=="OBJECT"){if(M.ie&&M.win){X.style.display="none";(function(){if(X.readyState==4){b(Y)}else{setTimeout(arguments.callee,10)}})()}else{X.parentNode.removeChild(X)}}}function b(Z){var Y=c(Z);if(Y){for(var X in Y){if(typeof Y[X]=="function"){Y[X]=null}}Y.parentNode.removeChild(Y)}}function c(Z){var X=null;try{X=j.getElementById(Z)}catch(Y){}return X}function C(X){return j.createElement(X)}function i(Z,X,Y){Z.attachEvent(X,Y);I[I.length]=[Z,X,Y]}function F(Z){var Y=M.pv,X=Z.split(".");X[0]=parseInt(X[0],10);X[1]=parseInt(X[1],10)||0;X[2]=parseInt(X[2],10)||0;return(Y[0]>X[0]||(Y[0]==X[0]&&Y[1]>X[1])||(Y[0]==X[0]&&Y[1]==X[1]&&Y[2]>=X[2]))?true:false}function v(ac,Y,ad,ab){if(M.ie&&M.mac){return}var aa=j.getElementsByTagName("head")[0];if(!aa){return}var X=(ad&&typeof ad=="string")?ad:"screen";if(ab){n=null;G=null}if(!n||G!=X){var Z=C("style");Z.setAttribute("type","text/css");Z.setAttribute("media",X);n=aa.appendChild(Z);if(M.ie&&M.win&&typeof j.styleSheets!=D&&j.styleSheets.length>0){n=j.styleSheets[j.styleSheets.length-1]}G=X}if(M.ie&&M.win){if(n&&typeof n.addRule==r){n.addRule(ac,Y)}}else{if(n&&typeof j.createTextNode!=D){n.appendChild(j.createTextNode(ac+" {"+Y+"}"))}}}function w(Z,X){if(!m){return}var Y=X?"visible":"hidden";if(J&&c(Z)){c(Z).style.visibility=Y}else{v("#"+Z,"visibility:"+Y)}}function L(Y){var Z=/[\\\"<>\.;]/;var X=Z.exec(Y)!=null;return X&&typeof encodeURIComponent!=D?encodeURIComponent(Y):Y}var d=function(){if(M.ie&&M.win){window.attachEvent("onunload",function(){var ac=I.length;for(var ab=0;ab<ac;ab++){I[ab][0].detachEvent(I[ab][1],I[ab][2])}var Z=N.length;for(var aa=0;aa<Z;aa++){y(N[aa])}for(var Y in M){M[Y]=null}M=null;for(var X in swfobject){swfobject[X]=null}swfobject=null})}}();return{registerObject:function(ab,X,aa,Z){if(M.w3&&ab&&X){var Y={};Y.id=ab;Y.swfVersion=X;Y.expressInstall=aa;Y.callbackFn=Z;o[o.length]=Y;w(ab,false)}else{if(Z){Z({success:false,id:ab})}}},getObjectById:function(X){if(M.w3){return z(X)}},embedSWF:function(ab,ah,ae,ag,Y,aa,Z,ad,af,ac){var X={success:false,id:ah};if(M.w3&&!(M.wk&&M.wk<312)&&ab&&ah&&ae&&ag&&Y){w(ah,false);K(function(){ae+="";ag+="";var aj={};if(af&&typeof af===r){for(var al in af){aj[al]=af[al]}}aj.data=ab;aj.width=ae;aj.height=ag;var am={};if(ad&&typeof ad===r){for(var ak in ad){am[ak]=ad[ak]}}if(Z&&typeof Z===r){for(var ai in Z){if(typeof am.flashvars!=D){am.flashvars+="&"+ai+"="+Z[ai]}else{am.flashvars=ai+"="+Z[ai]}}}if(F(Y)){var an=u(aj,am,ah);if(aj.id==ah){w(ah,true)}X.success=true;X.ref=an}else{if(aa&&A()){aj.data=aa;P(aj,am,ah,ac);return}else{w(ah,true)}}if(ac){ac(X)}})}else{if(ac){ac(X)}}},switchOffAutoHideShow:function(){m=false},ua:M,getFlashPlayerVersion:function(){return{major:M.pv[0],minor:M.pv[1],release:M.pv[2]}},hasFlashPlayerVersion:F,createSWF:function(Z,Y,X){if(M.w3){return u(Z,Y,X)}else{return undefined}},showExpressInstall:function(Z,aa,X,Y){if(M.w3&&A()){P(Z,aa,X,Y)}},removeSWF:function(X){if(M.w3){y(X)}},createCSS:function(aa,Z,Y,X){if(M.w3){v(aa,Z,Y,X)}},addDomLoadEvent:K,addLoadEvent:s,getQueryParamValue:function(aa){var Z=j.location.search||j.location.hash;if(Z){if(/\?/.test(Z)){Z=Z.split("?")[1]}if(aa==null){return L(Z)}var Y=Z.split("&");for(var X=0;X<Y.length;X++){if(Y[X].substring(0,Y[X].indexOf("="))==aa){return L(Y[X].substring((Y[X].indexOf("=")+1)))}}}return""},expressInstallCallback:function(){if(a){var X=c(R);if(X&&l){X.parentNode.replaceChild(l,X);if(Q){w(Q,true);if(M.ie&&M.win){l.style.display="block"}}if(E){E(B)}}a=false}}}}();
</script> 
<div id="wrap">
<div id="content">
     <div id="gamecontent">
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <div class = "gameleft">
               <div class="date">
               </div> <!-- end date div -->
          </div> <!-- end gameleft div -->
          <div class = "gameright">
          </div> <!-- end gameright div -->
          <div class = "clear"></div>		
          <div class = "description">
<h1><?php the_title(); ?></h1><br />
<center> 
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="clear:both;">
	<tr>
		<td width="180" valign="top"><h3>Categor&#237;as</h3>
			<ul>
				<?php wp_list_categories('title_li=0'); ?>
			</ul>
		</td>
		<td valign="top">
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
								<param name="movie" value="<?php bloginfo('template_url') ?>/images/afg-adloader.swf" /> 
								<param name="quality" value="high" /> 
								<param name="bgcolor" value="#ffffff" /> 
								<embed src="<?php bloginfo('template_url') ?>/images/afg-adloader.swf"
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
				<div id="containergame"  align="center" > 
				  

					 <object  classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="650" height="0" id="currentgame"> 
						  <param name="movie" value="<?php echo get_post_meta($post->ID, "swf_url", true); ?>" /> 
						  <param name="allowscriptaccess" value="always" /> 
						  <param name="quality" value="high">  
						  <!--[if !IE]>--> 
						  <object id="currentgame2" type="application/x-shockwave-flash" style="position:relative; padding:15px" data="<?php echo get_post_meta($post->ID, "swf_url", true); ?>" width="640"  height="0"> 
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
					 game.width=640;
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
						document.getElementById('currentgame').height='500';
						document.getElementById('currentgame2').height='500';
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
		<!--div style="position:relative">	
			<div class="flash">		
				  <embed src="<?php echo get_post_meta($post->ID, "swf_url", true); ?>" menu="false" quality="high" wmode="transparent" width="<?php echo get_post_meta($post->ID, "width", true); ?>" height="<?php echo get_post_meta($post->ID, "height", true); ?>" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			</div> 
		</div><!-- end flash div --></td>
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
						<div class="adbottom2"><img src="http://www.funkycoco.com/wp-content/themes/triqui/728.gif" alt="ads">
</div>
						<div class="box2" style="margin-top:0;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="150" align="left" valign="top"><h3>Descripcion</h3></td>
		<td align="left" valign="top"><?php echo str_replace("\n","<br />",get_post_meta($post->ID, "description", true)); ?></td>
	</tr>
	<tr>
		<td width="150" align="left" valign="top"><h3>Tags</h3></td>
		<td align="left" valign="top"><?php $post_tags = wp_get_post_tags($post->ID, array('fields' => 'name'));
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
		<div itemscope itemtype="http://schema.org/Rating">
		    <span itemprop="bestRating">
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
							  <div class="fb-comments" data-href="http://www.funkycoco.com/" data-num-posts="2" data-width="500"></div>
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
</div> 
</div>
<!-- end content div -->
<?php get_footer(); ?>