/**
 * WPGlobus Plus Main
 * Interface JS functions
 *
 * @since 1.0.0
 *
 * @package WPGlobus Plus
 * @subpackage Administration
 */
/*jslint browser: true*/
/*global jQuery, console, WPGlobusPlus*/
jQuery(document).ready(function($) {
	"use strict";

	$.fn.shake = function(intShakes, intDistance, intDuration) {
		this.each(function() {
			$(this).css('position','relative'); 
			for (var x=1; x<=intShakes; x++) {
				$(this).animate({top:(intDistance*-1)}, (((intDuration/intShakes)/4)))
					.animate({top:intDistance}, ((intDuration/intShakes)/2))
					.animate({top:0}, (((intDuration/intShakes)/4)));
			}
		});
		return this;
	};			
	
	var api = {
		promise: $.when(),
		parseBool: function(b){return !(/^(false|0)$/i).test(b) && !!b;},
		init: function() {
			if ( 'false' === WPGlobusPlus.tab || '' === WPGlobusPlus.tab ) {
				WPGlobusPlus.tab = api.parseBool(WPGlobusPlus.tab);
			}
			if ( false === WPGlobusPlus.tab ) {
				this.addMainMenuItem();
			} else if ( 'string' === typeof WPGlobusPlus.tab ) {
				this.addMainMenuItem();
				this.modulePublish();
				this.addListeners();
				this.setModules();
				this.setSections();
			}
		},
		addMainMenuItem: function() {
			setTimeout(
				function(){
					var menu = $('#toplevel_page_wpglobus_options .wp-submenu');
					if ( menu.length == 0 ) {
						menu = $('#toplevel_page_wpglobus-options .wp-submenu');
					}
					menu.append('<li><a href="'+WPGlobusPlus.option_page+'">'+WPGlobusPlus.caption_menu_item+'</a></li>');
				},
				200
			);
		},
		setSections: function() {
			if ( 'undefined' === typeof WPGlobusPlusSections ) {
				return;
			}
			setTimeout(
				function(){
					$(WPGlobusPlusSections.html).appendTo( $('.wpglobus-plus-sections') );
					$('.wpglobus-plus-sections').css({'display':'block'});
					$('.wpglobus-plus-section').addClass('tab-'+WPGlobusPlus.tab).addClass(WPGlobusPlusSections.section).addClass('section-'+WPGlobusPlusSections.section);
				},
				500
			);
			
		},
		modulePublish: function() {
			if ( 'publish' != WPGlobusPlus.tab ) {
				return;
			}
		},
		addListeners: function() {
			$(document).on('click', '.wpglobus-plus-module', function(ev){
				var $t = $(this), s; 
				s = $t.parents('.module-block').find('.wpglobus-plus-spinner');
				$t.css({'display':'none'});
				s.css({'display':'block'});				
				api.promise = api.promise.then(function() {
					return api.ajax({
						action: 'activate-module',
						module: $t.data('module'),
						active_status: $t.prop('checked') || '',
						'moduleData': WPGlobusPlus.modules[$t.data('module')]
					}, function(){})
					.done(function (data) {
						api.done( data );
					})
					.fail(function (error) {})
					.always(function (jqXHR, status){
						s.css({'display':'none'});
						$t.css({'display':'inline-block'});
					});	
				});
				
			});
		},	
		ajax: function(order, beforeSend) {
			return $.ajax({beforeSend:function(){
				if ( typeof beforeSend !== 'undefined' ) beforeSend();
			},type:'POST', url:ajaxurl, data:{action:WPGlobusPlus.process_ajax, order:order}, dataType:'json'});
		},	
		setModules: function( module, data ) {
			var modules = {};
			if ( 'undefined' === typeof module ) {
				$('.wpglobus-plus-module').each(function(i,modl) {
					modules[i] = $(modl).data('module');
				});
			} else {
				modules[0] = module;
			}
			$.each( modules, function(i, module){
				if ( 'undefined' === typeof data ) {
					if ( $( '#wpglobus-plus-'+module ).prop('checked') ) {
						$( '.subtitle-module-'+module ).css({'display':'block'});
					} else {
						$( '.subtitle-module-'+module ).css({'display':'none'});
					}							
				} else {
					if ( data.order.active_status == 'true' ) {
						$( '.subtitle-module-'+module ).css({'display':'block'});
					} else {
						$( '.subtitle-module-'+module ).css({'display':'none'});
					}	
				}
			});				
		},	
		done: function( data ) {
			if ( 'string' === typeof data.order.module ) {
				api.setModules( data.order.module, data );
			}
		}			
	};
	WPGlobusPlus = $.extend({}, WPGlobusPlus, api);
	WPGlobusPlus.init();
});