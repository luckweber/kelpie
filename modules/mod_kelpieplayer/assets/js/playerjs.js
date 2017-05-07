(function ( $ ) {
 
    $.fn.kelpie= function(type, options) {
		
		var settings = $.extend({
            // These are the defaults.
            color: "#556b2f",
            backgroundColor: "white",
			url:"dd",
			autoplay:false,
			volume:100,
			ratio:1
			
        }, options );
		
		
		
        if(type == 'youtube'){
				$(this).append(
					'<div id="screen" class="screen"></div>'+
					'<div class="bottom">'+
					'<div id="control_play" class="control_play">'+
					'<div id="btn_play" class="btn_play"></div>'+
					'<div id="btn_pause" class="btn_pause"></div>'+
					'</div>'+
					'<div id="control_progress" class="control_progress">'+
					'<div id="duration" class="duration">00:00:00 / 00:00:00</div>'+
					'</div>'+
					'<div id="control_volume" class="control_volume">'+
					'<div id="btn_volume" class="btn_volume">'+
					'<div id="slider_volume" class="slider_volume"></div>'+			
					'</div>'+
					'<div id="btn_maxima" class="btn_maxima">'+
					'</div>'+
					'</div>'+
					'</div>');
				
				//debug( this );
				
				var tag = document.createElement('script');
				tag.src = "https://www.youtube.com/player_api";
				var firstScriptTag = document.getElementsByTagName('script')[0];
				firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
				
				var player;
				var volume = 100;
				
				
				window.onYouTubeIframeAPIReady = function () {
					player = new YT.Player('screen', {
					  height: '360',
					  width: '640',
					  videoId:settings.url,
					  playerVars: {'allowfullscreen':0, 'rel':0, 'fs':0, 'showinfo': 0,  'modestbranding':1, 'color':'white' ,'autoplay': settings.autoplay, 'controls': 0,'autohide':1,'wmode':'opaque' },
						  events: {
							'onReady': onPlayerReady
							}
					});
				}
				
				
				function onPlayerReady(event) {
					event.target.setVolume(settings.volume);
					setVolume();
				}
				
				$("#btn_play").click(function(){
					if(player.getPlayerState() == 5){
						player.playVideo();	 
					}else if(player.getPlayerState() == 1){
						player.pauseVideo(); 
					}else if(player.getPlayerState() == 2){
						player.playVideo(); 
					}
				});
				
				
				$("#btn_pause").click(function(){
					 if(player.getPlayerState() == 5){
						player.playVideo();	 
					}else if(player.getPlayerState() == 1){
						player.pauseVideo(); 
					}else if(player.getPlayerState() == 2){
						player.playVideo(); 
					}
					
				});
				
				
				$("#control_progress").slider({
				  range: "max",
				  min: 0,
				  max: 100,
				  value: 1,
				  slide: function( event, ui ) {
					if(ui.value >= 100){
						
						$("#control_progress .ui-state-default").css("marginLeft", "-45px");
						
					}else if (ui.value <= 0){
					
						$("#control_progress .ui-state-default").css("marginLeft", "-3px");
					}
					
					if(player.getPlayerState() == 1 || player.getPlayerState() == 2){
						
						
						var totalMinuto = (player.getDuration() / 60).toFixed(2);
						var currentMinuto  =  totalMinuto/100;
						var finalMinuto = currentMinuto*ui.value;
						
						player.seekTo((finalMinuto*60), true);
						
					}
					
				  }
				});
				
				$("#slider_volume").slider({
				  orientation: "vertical",
				  range: "max",
				  min: 0,
				  max: 100,
				  value: volume,
				  slide: function( event, ui ) {
					if(player.isMuted()){
						player.unMute();
					}
					player.setVolume(ui.value);
				  }
				});
		  
				function runEffect(effect) {
				  var options = {};
				  // some effects have required parameters
				  if ( effect === "scale" ) {
					options = { percent: 50 };
				  } else if ( effect === "size" ) {
					options = { to: { width: 280, height: 185 } };
				  }
			 
				  $( "#slider_volume" ).show( effect, options, 1000 );
				};
				
				
				$("#btn_volume").click(function(){
		
					if($("#slider_volume").css("display") == "none"){
							runEffect('bounce');
					}else{
						$("#slider_volume").css("display", "none");
					}
				
				});
				
				
				$("body").on("mousedown", ".ui-slider-handle",function(){
					if(player.getPlayerState() == 1){
						
						player.pauseVideo();
					}
			  
				});
				
				$("body").on("mouseup", ".ui-slider-handle",function(){
	  
					 if(player.getPlayerState() == 2){
							
							player.playVideo();
						}
				  
				});
				
				var fullScreeen  = false;
	  
				$(".btn_maxima").click(function(){
					if(fullScreeen == false){
						
						toggleFullScreen();
						
						fullScreeen = true;
					}else{
						
						toggleFullScreen();
						
						fullScreeen = false;
					}
				
				
				});
			  
			  
			  
				function toggleFullScreen() {
					var doc = window.document;
					var docEl = doc.getElementById("player");

					var requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
					var cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;

				    if(!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
						requestFullScreen.call(docEl);
				    }
					else {
						cancelFullScreen.call(doc);
					}
				}
	  
	  
				$(".bottom").mouseleave(function(){
					if(fullScreeen){
						//$(".bottom").css("opacity", "0");
					}
				  
				});
		  
				$(".bottom").mouseenter(function(){
					if(fullScreeen){
						$(".bottom").css("opacity", "1");
					}
				  
				});
	  
	  
				function createChronos(h, m, s){
		
					var seconds  = s;
					var minutes = m;
		
					if((seconds.toString()).length == 1){
						seconds = "0"+ seconds;
					}
		
					if((minutes.toString()).length == 1){
						
						minutes = "0"+minutes;
					}
		
					return h+":"+minutes+":"+seconds;
		
	  
				}
	
				function setVolume(){	
				  setInterval(function(){
						if(player.getPlayerState() == 1){
							if($("#player_button_start").hasClass("player_button_play")){
								$("#player_button_start").removeClass();
								$("#player_button_start").addClass("player_button_pause");
							}
							
							var date = new Date(null);
							date.setSeconds(player.getDuration());
							var utc = date.toUTCString();
							
							var date2 = new Date(null);
							date2.setSeconds(player.getCurrentTime());
							var utc2 = date2.toUTCString();
							
							var totalTime = date.getUTCHours()+":"+date.getUTCMinutes()+":"+date.getUTCSeconds();
							
							
							var minutes = (player.getDuration() / 60).toFixed(2);
							var minuteCurrent = (player.getCurrentTime()/60).toFixed(2);
							var media = (minuteCurrent / minutes)*100;
							$("#duration").html(createChronos(date2.getUTCHours(), date2.getUTCMinutes(), date2.getUTCSeconds())+" / "+totalTime);
							$("#control_progress").slider({value:media.toFixed(0)});
							
						}else if(player.getPlayerState() == 2){
							if($("#player_button_start").hasClass("player_button_pause")){
								$("#player_button_start").removeClass();
								$("#player_button_start").addClass("player_button_play");
							}
						}else if(player.getPlayerState() == 3){$("#slider_volume").slider({value:player.getVolume()});
						}
				  }, 40);
				}
		}else if (type == 'html5'){
			
			$(this).append(
					'<div class="bottom">'+
					'<div id="control_play" class="control_play">'+
					'<div id="btn_play" class="btn_play"></div>'+
					'<div id="btn_pause" class="btn_pause"></div>'+
					'</div>'+
					'<div id="control_progress" class="control_progress">'+
					'<div id="duration" class="duration">00:00:00 / 00:00:00</div>'+
					'</div>'+
					'<div id="control_volume" class="control_volume">'+
					'<div id="btn_volume" class="btn_volume">'+
					'<div id="slider_volume" class="slider_volume"></div>'+			
					'</div>'+
					'<div id="btn_maxima" class="btn_maxima">'+
					'</div>'+
					'</div>'+
					'</div>'
			);
			
			
			var screen = $("<video/>", {class:'screen', id:'screen'});
			screen.attr("width","100%");
			screen.attr("height","100%");
			
			
			var source = $("<source/>");
			source.attr("src",settings.url);
			
			screen.append(source);
			
			
			
			$(".bottom").before(screen);
			var myVideo = document.getElementById("screen"); 
			
			
			myVideo.volume =  settings.volume/100;
			myVideo.autoplay = settings.autoplay;
			myVideo.load();
			
			$("#btn_play").click(function(){
				if (myVideo.paused){
					myVideo.play(); 
				}else{ 
					myVideo.pause();
				}
			});
			
			$("#slider_volume").slider({
				  orientation: "vertical",
				  range: "max",
				  min: 0,
				  max: 100,
				  value: settings.volume,
				  slide: function( event, ui ) {
					if(myVideo.muted){
						myVideo.volume = ui.value/100;
					}
					myVideo.volume = ui.value/100;
					
					
				
				  }
				});
		  
				function runEffect(effect) {
				  var options = {};
				  // some effects have required parameters
				  if ( effect === "scale" ) {
					options = { percent: 50 };
				  } else if ( effect === "size" ) {
					options = { to: { width: 280, height: 185 } };
				  }
			 
				  $( "#slider_volume" ).show( effect, options, 1000 );
				};
				
			
			$("#btn_volume").click(function(){
		
					if($("#slider_volume").css("display") == "none"){
							runEffect('bounce');
					}else{
						$("#slider_volume").css("display", "none");
					}
				
				});
			
			
			function createChronos(h, m, s){
		
				var seconds  = s;
				var minutes = m;
	
				if((seconds.toString()).length == 1){
					seconds = "0"+ seconds;
				}
				if((minutes.toString()).length == 1){
					minutes = "0"+minutes;
				}
				return h+":"+minutes+":"+seconds;
		
			}
			
			var fullScreeen  = false;
	  
				$(".btn_maxima").click(function(){
					if(fullScreeen == false){
						
						toggleFullScreen();
						
						fullScreeen = true;
					}else{
						
						toggleFullScreen();
						
						fullScreeen = false;
					}
				
				
				});
			  
			  
			  
				function toggleFullScreen() {
					var doc = window.document;
					var docEl = doc.getElementById("player");

					var requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
					var cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;

				    if(!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
						requestFullScreen.call(docEl);
				    }
					else {
						cancelFullScreen.call(doc);
					}
				}
			
			
			
			
			
			$("body").on("mousedown", ".ui-slider-handle",function(){
				
				if(myVideo.played){
					
					//myVideo.pause();
				}
				
			  
			});
			
			
			$("body").on("mouseup", ".ui-slider-handle",function(){
				
				if(myVideo.paused){
					
					//myVideo.play();
				}
				
			  
			});
			
			
			$("#control_progress").slider({
			  range: "max",
			  min: 0,
			  max: 100,
			  value: 1
			});

			
			
			
			myVideo.onplay = function() {
				
				myVideo.playbackRate = settings.ratio;
				
					setInterval(function(){
						
						
						var duration = new Date(null);
						duration.setSeconds(myVideo.duration);
						var utc = duration.toUTCString();
						
						
						var date2 = new Date(null);
						date2.setSeconds(myVideo.currentTime);
						var utc2 = date2.toUTCString();
						
						
						var minutes = (myVideo.duration / 60).toFixed(2);
						var minuteCurrent = (myVideo.currentTime/60).toFixed(2);
						var media = (minuteCurrent / minutes)*100;
						
						var totalTime = duration.getUTCHours()+":"+duration.getUTCMinutes()+":"+duration.getUTCSeconds();
						$("#duration").html(createChronos(date2.getUTCHours(), date2.getUTCMinutes(), date2.getUTCSeconds())+" / "+totalTime);
						
						$("#control_progress").slider({
							
							value:media,
							slide: function( event, ui ) {
							
							var totalMinuto = (myVideo.duration / 60).toFixed(2);
							var currentMinuto  =  totalMinuto/100;
							var finalMinuto = currentMinuto*ui.value;
							myVideo.currentTime = (finalMinuto*60);
								
						  }
						
						});

						
					},1000);
				
			};
			
		}
		
		
    };
	
 
}( jQuery ));