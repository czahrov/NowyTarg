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
		basePath: '',		// ścieżka do podfolderu ze stroną (np: /adres/do/podfolderu, albo wartość pusta )
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
			
			/* slider w popupie galerii zdjęć w single */
			(function( popup, box, exit, slider, nav, view, galeria ){
				var lock = false;
				var tout;
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
					wheel: function( e ){
						e.preventDefault();
						e.stopPropagation();
						
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
				
				$( 'body' ).on({
					keyup: function( e ){
						if( $( '#popup' ).hasClass( 'open' ) ){
							switch( e.key ){
								case "ArrowRight":
									slider.triggerHandler( 'next' );
									
								break;
								case "ArrowLeft":
									slider.triggerHandler( 'prev' );
									
								break;
								case "Escape":
									popup.triggerHandler( 'hide' );
									
								break;
								
							}
							
						}
						
					},
					keydown: function( e ){
						if( $( '#popup' ).hasClass( 'open' ) ){
							switch( e.key ){
								case "ArrowUp":
								case "ArrowDown":
								case " ":
									e.preventDefault();
									e.stopPropagation();
									
								break;
								
							}
							
						}
						
					},
					
				});
				
				$( window ).resize( function( e ){
					window.clearTimeout( tout );
					tout = window.setTimeout( function(){
						slider.triggerHandler( 'set', current );
						
					}, 300 );
					
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
			(function( toggler, toggle, panel ){
				
				toggle.click( function( e ){
					console.log( 'toggle' );
					
					if( panel.hasClass( 'show' ) ){
						toggle.removeClass( 'open' );
						
					}
					else{
						toggle.addClass( 'open' );
						
					}
					
				} );
				
			})
			( $( '.navbar-toggler' ),
			$( '.navbar-toggler > .box' ), 
			$( '.navbar-collapse' ) );
			
			/* minipanel */
			(function( panel, popup, view, more, button ){
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
						// console.log( 'hide' );
						// popup.removeClass( 'mob_open' );
						popup.toggleClass( 'mob_open' );
						
					}
					else{
						// console.log( 'show' );
						popup.addClass( 'mob_open' );
						
					}
					
					$(this)
					.addClass( 'active' )
					.siblings()
					.removeClass( 'active' );
					
				} );
				
				more.click( function( e ){
					$(this).toggleClass( 'open' );
					
				} );
				
			})
			( $( '#minipanel' ), 
			$( '#minipanel .popup' ), 
			$( '#minipanel .popup > .view' ), 
			$( '#minipanel .popup > .view.weather > .more' ), 
			$( '#minipanel .item' ) );
			
			/* ładuj więcej */
			(function( link ){
				link.click( function( e ){
					try{
						var self = $(this);
						// id kategorii, z której pobierane są wpisy
						var cat_ID = parseInt( self.attr( 'item-cat') );
						if( isNaN( cat_ID ) ) throw "Identyfikator kategorii jest błędny";
						// liczba pobieranych wpisów
						var num = 4;
						// liczba już załadowanych wpisów na stronie
						var offset = null;
						
						switch( self.attr( 'item-segment' ) ){
							case 'aktualnosci':
							case 'przeglad':
								offset = self
								.parents( '.row:first' )
								.find( '.link_post' )
								.length;
								
							break;
							case 'reportaze':
								offset = self
								.siblings( '.top_news_list' )
								.children( '.item' )
								.length;
								
							break;
							case 'sport':
								offset = self
								.siblings( '.row.sport' )
								.find( '.link_post' )
								.length;
								
							break;
							case 'kultura':
								offset = self
								.parent()
								.siblings( '.item' )
								.length;
								
							break;
							default:
								
						}
						
						$.ajax({
							type: 'POST',
							url: '/more',
							data: {
								category: cat_ID,
								offset: offset,
								num: num,
								
							},
							success: function( data, status ){
								if( data.length === 0 ) throw "Pusta odpowiedź";
								var resp = JSON.parse( data );
								// klonowany obiekt
								var proto = null;
								
								switch( self.attr( 'item-segment' ) ){
									case 'aktualnosci':
									case 'przeglad':
										proto = self
										.parents( '.row:first' )
										.find( '.link_post:not(.big):first' );
										
									break;
									case 'reportaze':
										proto = self
										.siblings( '.top_news_list')
										.children( '.item:first');
										
									break;
									case 'sport':
										proto = self
										.siblings( '.row.sport' )
										.find( '.link_post:not(.big):first' )
										.parent();
										
									break;
									case 'kultura':
										proto = self
										.parent()
										.siblings( '.item:first' );
										
									break;
									default:
										
								}
								
								// kopiowanie obiektu, wypełnianie danymi z odpowiedzi i wklejanie
								$.each( resp, function( k, item ){
									var t = proto.clone();
									
									switch( self.attr( 'item-segment' ) ){
										case 'aktualnosci':
										case 'przeglad':
											
											t
											.attr( 'href', item.url )
											.children( '.post_news_small' )
											.css( 'background-image', 'url('+ item.img +')' )
											.html( item.icon )
											.siblings( '.post_news_small_tiitle' )
											.html( item.title + item.icon );
											
											self
											.parent()
											.before( t );
											
										break;
										case 'reportaze':
											
											t
											.attr( 'href', item.url )
											.find( '.img_link' )
											.css( 'background-image', 'url('+ item.img +')' )
											.next( 'p' )
											.html( item.title + item.icon );
											
											self
											.siblings( '.top_news_list' )
											.append( t );
											
										break;
										case 'sport':
											
											t
											.children( '.link_post' )
											.attr( 'href', item.url )
											.children( '.overview_small' )
											.html( item.icon )
											.css( 'background-image', 'url('+ item.img +')' )
											.next( 'span' )
											.html( item.title );
											
											self
											.prev( '.row.sport' )
											.append( t );
											
										break;
										case 'kultura':
											
											t
											.attr( 'href', item.url )
											.find( '.img_link' )
											.css( 'background-image', 'url('+ item.img +')' )
											.next( 'p' )
											.html( item.title + item.icon );
											
											self
											.parent()
											.before( t );
											
										break;
										default:
										
									}
									
								} );								
								
							},
							
						});
						
					}
					catch( err ){
						console.error( err );
						
					}					
					
					
				} );
				
			})
			( $( 'a.load_more' ) );
			
			// popup
			(function( popup ){
				popup.on({
					open: function( e ){
						$(this).addClass( 'open' );
						
					},
					close: function( e ){
						$(this).removeClass( 'open' );
						
					},
					click: function( e ){
						$(this).triggerHandler( 'close' );
						
					},
					wheel: function( e ){
						e.preventDefault();
						
					},
					
				});
				
			})
			( $( '#popup_side') );
			
			// mapa google
			(function( btn_open, popup, mapa ){
				
				mapa.click( function( e ){
					e.stopPropagation();
					
				} );
				
				btn_open.click( function( e ){
					
					popup.triggerHandler( 'open' );
					
					var point_krakow = [ 50.036171, 19.940513 ];
					var point_zakopane = [ 49.309807, 19.968819 ];
					
					$( mapa )
					.gmap3({
						address:"Zakopianka",
						zoom: 10,
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						navigationControl: true,
						scrollwheel: true,
						
					})
					.trafficlayer()
					.marker([
						{
							position: point_krakow,
						},
						{
							position: point_zakopane,
						},
						
					]);
					
				} );
				
			})
			( $( '#sidestick > .traffic' ),
			$( '#popup_side' ),
			$( '#popup_side #gmap' ) );
			
			// custom parallax
			(function( parallax ){
				parallax.each(function(){
					try{
						var self = $(this);
						var url = self.attr('parallax-img');
						var min_height = parseInt( self.attr('parallax-min-height') );
						var view_pos = function(){
							return $( 'html, body' ).prop( 'scrollTop' );
							
						};
						var parallax_start = function(){
							return self.offset().top + self.height() - window.innerHeight;
							
						};
						var parallax_end = function(){
							return self.offset().top + self.height();
							
						};
						var factor = function(){
							return self.height() / ( parallax_end() - parallax_start() );
							
						};
						
						var img = $('<img src="'+ url +'" />')
						.appendTo( self )
						.on({
							load: function( e ){
								self
								.css({
									height: img.height(),
									
								});
								
							},
							
						});
						
						$(window)
						.on({
							resize: function( e ){
								self
								.css({
									height: img.height(),
									
								});
								
							},
							scroll: function( e ){
								
								if( img.height() > min_height ){
									img
									.css({
										transform: function(){
											var y;
											
											if( view_pos() <= parallax_start() - self.height() ){
												y = self.height() - img.height();
												
											}
											else if( view_pos() >= parallax_end() ){
												y = 0;
												
											}
											else{
												y = ( view_pos() - self.offset().top ) * factor();
												
											}
											
											return "translateY("+ y +"px)";
										},
										
									});
									
								}
								else{
									img
									.css({
										transform: "translateY(0)",
										
									})
								}
								
							},
							
						});
						
					}
					catch( err ){
						console.error( err );
						
					}
					
				});
				
			})
			(
				$( '.custom_parallax:not(.standard)' )
			);
			
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
