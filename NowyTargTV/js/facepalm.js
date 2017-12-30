(function(){
	var root = {};
	root.launcher = function(){
		if( typeof root.page.default === 'function' ) root.page.default();
		var path = window.location.pathname.match(new RegExp('^' + root.bazar.basePath + '(.*)$','i'))[1];
		
		if(path == '/'){		// czy strona główna?
			if( typeof root.page.index === 'function' ) root.page.index();
			
		}
		else{		//podstrona
			var subpage = path.match(/([\w\-]+)\/$/)[1];
			var t = subpage.replace(/\-/g,'_');
			if(typeof subpage === 'string' && subpage.length){
				if(typeof root.page[t] === 'function'){
					root.page[t]();
					
				}
				else if( typeof root.page.alternate === 'function' ) root.page.alternate();
				
			}
			
		}
		
	},
	root.bazar = {
		// basePath: '/SzymonJ/nowytargtv_wp',		// ścieżka do podfolderu ze stroną (np: /adres/do/podfolderu, albo wartość pusta )
		basePath: '/SCEPTER',		// ścieżka do podfolderu ze stroną (np: /adres/do/podfolderu, albo wartość pusta )
		logger: /logger/i.test(window.location.hash),		// czy wyświetlać komunikaty o wywoływaniu funkcji
		mobile: /mobile/i.test(window.location.hash) || undefined,		// czy aktualnie używane urządzenie jest urządzeniem mobilnym
		
	},
	root.addon = {
		isLogger: function(){
			return root.bazar.logger || false;
		},
		isMobile: function(){
			var bazar = root.bazar;
			var logger = bazar.logger || false;
			if(logger) console.log('isMobile()');
			if(typeof bazar.mobile === 'undefined'){
				bazar.mobile = /Mobile|Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
				
			}
			
			return bazar.mobile;
			
		},
		youtube: function(arg){
			/*
				arg = {
					ID*			// ID filmu video na YT
					iframe*		// element jQuery albo selektor iframe do odtwarzania filmu
					autoplay	// automatyczne odtwarzanie filmu [1/0]
					loop		// zapętlanie filmu [1/0]
					controls	// kontrolki filmu [1/0]
					beforePlay	// funkcja wywoływana przed rozpoczęciem odtwarzania filmu
					onClose		// funkcja wywoływana przy zamykaniu filmu
					
				}
			*/
			
			try{
				var logger = root.bazar.logger || false;
				
				if(typeof arg.ID !== 'string') throw 'Niepoprawny ID filmu';
				if(!$(arg.iframe).length) throw 'iframe nie istnieje';
				arg.autoplay = arg.autoplay || 0;
				arg.loop = arg.loop || 0;
				arg.controls = arg.controls || 1;
				arg.beforePlay = arg.beforePlay || function(){};
				arg.onClose = arg.onClose || function(){};
				
				var ret = {
					el: arg.iframe,
					url: "https://www.youtube.com/embed/"+ arg.ID +"?controls="+ arg.controls +"&autoplay="+ arg.autoplay +"&loop="+ arg.loop,
					open: function(){
						arg.beforePlay(this.el);
						$(this.el).attr({
							src: this.url,
							
						});
						
					},
					close: function(){
						arg.onClose(this.el);
						$(this.el).attr({
							src: '',
							
						});
						
					}
					
					
				};
				
				return ret;
				
			}
			catch(err){
				if(logger) console.error(err);
				
			}
			finally{
				
			}
			
		},
		form:{
			filters:{
				imie: /^[a-zA-Z \-żźćńółąśęŻŹĆŃÓŁĄŚĘ]+$/,
				nazwa: /^[\w \-żźćńółąśęŻŹĆŃÓŁĄŚĘ]+$/,
				adres: /^[\w \-żźćńółąśęŻŹĆŃÓŁĄŚĘ\.,\d]+$/,
				telefon: /^[\d\+ \(\)]+$/,
				mail: /^[^\d_\.\-][\w\d \.\-!#\$%&'\*\+/=\?^`\{\|\}~]{1,64}@\w+(?:\.\w+)+$/,
				tekst: /^[\w\s \-żźćńółąśęŻŹĆŃÓŁĄŚĘ\[\]\{\}\|\+\?\.,\:;\$\^\*\(\)!#%~/\\]*$/,
				tekst_req: /^[\w\s \-żźćńółąśęŻŹĆŃÓŁĄŚĘ\[\]\{\}\|\+\?\.,\:;\$\^\*\(\)!#%~/\\]+$/,
			},
			verify: function(arg){		// arg = tablica obiektów {name, item, filterName}
				var logger = root.addon.isLogger();
				if(logger) console.log('form.verify()');
				var self = this;
				if(typeof arg === 'object' && typeof arg.length === 'number'){
					var errors = [];
					for(i in arg){
						var value = $(arg[i].item).val();
						if(typeof arg[i] === 'object' && typeof value !== 'undefined' && typeof arg[i].filterName === 'string' && typeof arg[i].name === 'string' && typeof self.filters[arg[i].filterName] !== 'undefined'){
							if(!self.filters[arg[i].filterName].test(value)){
								errors.push(arg[i].item);
							}
							
						}
						else return false;
						
					}
					
					if(errors.length){
						return errors;
						
					}
					else return true;
					
				}
				
				return false;
				
			},
		},
		
	},
	root.page = {
		default: function(){
			var addon = root.addon;
			var logger = addon.isLogger();
			
			if(logger){
				window.facepalm = root;
				console.log('page.default()');
			}
			
			/* slide w popupie galerii zdjęć w single */
			(function( popup, box, exit, slider, nav, view, galeria ){
				var lock = false;
				var TL_popup = new TimelineLite({
					paused: true,
					onStart: function(){
						popup.addClass( 'open' );
						
					},
					onComplete: function(){
						lock = false;
						
					},
					onReverseComplete: function(){
						popup.removeClass( 'open' );
						lock = false;
						
					},
					
				})
				.add(
					TweenLite.fromTo(
						popup,
						.3,
						{
							opacity: 0,
							
						},
						{
							opacity: 1,
							
						}
					)
				)
				.add(
					TweenLite.fromTo(
						box,
						.3,
						{
							opacity: 0,
							y: -200,
							
						},
						{
							opacity: 1,
							y: 0,
							
						}
					)
				);
				
				popup
				.on({
					show: function( e ){
						if( !lock ){
							lock = true;
							TL_popup.play();
							
						}
						
					},
					hide: function( e ){
						if( !lock ){
							lock = true;
							TL_popup.reverse();
							
						}
						
					},
					click: function( e ){
						popup.triggerHandler( 'hide' );
						
					},
					
				});
				
				var current = 0;
				
				slider
				.on({
					init: function( e ){
						galeria.each( function(){
							var uri = $(this).attr( 'href' );
							$( "<div class='item' style='background-image:url(" + uri + ")'></div>" )
							.appendTo( view );
							
						} );
						
					},
					set: function( e, num ){
						current = num;
						if( current < 0 ) current = 0;
						if( current >= galeria.length ) current = galeria.length - 1;
						
						TweenLite.to(
							view,
							.3,
							{
								scrollLeft: function(){
									return current * $( '#popup > .box > .slider' ).width();
									
								},
								onComplete: function(){
									lock = false;
									
								},
								
							}
						);
						
					},
					next: function( e ){
						if( !lock ){
							lock = true;
							current++;
							slider.triggerHandler( 'set', current );
							
						}
						
					},
					prev: function( e ){
						if( !lock ){
							lock = true;
							current--;
							slider.triggerHandler( 'set', current );
							
						}
						
					},
					click: function( e ){
						e.stopPropagation();
						
					},
					
				})
				.swipe({
					swipeLeft: function( e ){
						slider.triggerHandler( 'next' );
						
					},
					swipeRight: function( e ){
						slider.triggerHandler( 'prev' );
						
					},
					
				});
				
				slider.triggerHandler( 'init' );
				
				galeria.click( function( e ){
					e.preventDefault();
					popup.triggerHandler( 'show' );
					slider.triggerHandler( 'set', $(this).index() );
					
				} );
				
				nav.click( function( e ){
					
					if( $(this).hasClass( 'right' ) ){
						slider.triggerHandler( 'next' );
						
					}
					else if( $(this).hasClass( 'left' ) ){
						slider.triggerHandler( 'prev' );
						
					}
					
				} );
				
				exit.click( function(){
					popup.triggerHandler( 'hide' );
					
				} );
				
			})
			( $( '#popup' ), 
			$( '#popup > .box' ), 
			$( '#popup > .box > .exit' ), 
			$( '#popup > .box > .slider' ), 
			$( '#popup > .box > .slider > .nav' ), 
			$( '#popup > .box > .slider > .view' ), 
			$( '#galeria > .row > .item.popup' ) );
			
			/* toggle menu */
			(function( toggle, panel ){
				
				toggle.click( function( e ){
					
					if( panel.hasClass( 'show' ) ){
						toggle.removeClass( 'open' );
						
					}
					else{
						toggle.addClass( 'open' );
						
					}
					
				} );
				
			})
			( $( '.navbar-toggler > .box' ), $( '.navbar-collapse' ) );
			
			/* minipanel */
			(function( panel, popup, view, button ){
				popup
				.on({
					show: function( e, id ){
						if( typeof id !== undefined ){
							view
							.filter( "." + id )
							.addClass( 'open' )
							.siblings()
							.removeClass( 'open' );
							
						}
						
					},
					hide: function( e ){
						popup.fadeOut( function(){
							view.hide();
							
						} );
						
					},
					
				});
				
				button.click( function( e ){
					popup.triggerHandler( 'show', $(this).attr( 'view' ) );
					
					if( $(this).hasClass( 'active' ) ){
						console.log( 'hide' );
						// popup.removeClass( 'mob_open' );
						popup.toggleClass( 'mob_open' );
						
					}
					else{
						console.log( 'show' );
						popup.addClass( 'mob_open' );
						
					}
					
					$(this)
					.addClass( 'active' )
					.siblings()
					.removeClass( 'active' );
					
				} );
				
			})
			( $( '#minipanel' ), 
			$( '#minipanel .popup' ), 
			$( '#minipanel .popup > .view' ), 
			$( '#minipanel .item' ) );
			
		},
		alternate: function(){
			var addon = root.addon;
			var logger = addon.isLogger();
			
			if(logger) console.log('page.alternate()');
			
		},
		index: function(){
			var addon = root.addon;
			var logger = addon.isLogger();
			
			if(logger) console.log('page.index()');
			
			/* slider wydarzenia */
			(function( slider, view, items, pagin, navs ){
				var current = 0;
				var lock = false;
				var delay = 3000;
				var duration = 500;
				var itrv;
				var inview;
				var getInview = function(){
					return Math.floor( view.outerWidth() / items.first().outerWidth() );
				};
				
				slider
				.on({
					init: function(){
						slider.triggerHandler( 'stop' );
						inview = getInview();
						current = 0;
						
						var proto = pagin.children().first();
						
						proto
						.siblings()
						.remove();
						
						for( var i = 0; i < items.length - inview; i++ ){
							proto
							.clone()
							.appendTo( pagin );
							
						}
						
						slider.triggerHandler( 'set' );
						slider.triggerHandler( 'start' );
						
					},
					set: function(){
						if( current < 0 ) current = Math.floor( view.outerWidth() / items.first().outerWidth() );
						current %= items.length - Math.floor( view.outerWidth() / items.first().outerWidth() - 1 );
						
						// console.log( current );
						
						pagin
						.children()
						.eq( current )
						.addClass( 'active' )
						.siblings()
						.removeClass( 'active' );
						
						view
						.animate(
							{
								'scrollLeft': current * items.first().outerWidth( true ),
								
							},
							{
								duration: duration,
								complete: function(){
									lock = false;
									
								},
								
							}
						);
						
					},
					next: function(){
						if( !lock ){
							// console.log( 'next' );
							lock = true;
							current++;
							slider.triggerHandler( 'set' );
							
						}
						
					},
					prev: function(){
						if( !lock ){
							lock = true;
							current--;
							slider.triggerHandler( 'set' );
							
						}
						
					},
					stop: function(){
						window.clearInterval( itrv );
						
					},
					start: function(){
						slider.triggerHandler( 'stop' );
						itrv = window.setInterval(function(){
							slider.triggerHandler( 'next' );
							
						},delay);
						
					},
					mouseenter: function(){
						slider.triggerHandler( 'stop' );
						
					},
					mouseleave: function(){
						slider.triggerHandler( 'start' );
						
					},
					
				});
				
				view
				.swipe({
					swipeLeft: function(){
						slider.triggerHandler( 'stop' );
						slider.triggerHandler( 'next' );
						
					},
					swipeRight: function(){
						slider.triggerHandler( 'stop' );
						slider.triggerHandler( 'prev' );
						
					},
					
				});
				
				navs.click(function( e ){
					if( $(this).hasClass( 'right' ) ){
						slider.triggerHandler( 'next' );
						
					}
					else if( $(this).hasClass( 'left' ) ){
						slider.triggerHandler( 'prev' );
						
					}
					
				});
				
				pagin.on( 'click', '.item', function( e ){
					slider.triggerHandler( 'stop' );
					current = $(this).index();
					slider.triggerHandler( 'set' );
					
				} );
				
				slider.triggerHandler( 'init' );
				
				$( window ).resize( function(){
					
					if( inview !== getInview() ){
						slider.triggerHandler( 'init' );
						
					}
					
				} );
				
			})
			( $( '.wydarzenia > .slider' ), 
			$( '.wydarzenia > .slider > .view' ), 
			$( '.wydarzenia > .slider > .view > .item' ), 
			$( '.wydarzenia > .slider > .pagin' ), 
			$( '.wydarzenia > .slider > .arrow' ) );
			
		},
		
	}
	
	$(function(){
		root.launcher();
	});
	
})();
