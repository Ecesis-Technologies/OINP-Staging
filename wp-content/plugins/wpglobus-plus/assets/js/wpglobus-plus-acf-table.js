/**
 * WPGlobus Plus ACF Table
 * Interface JS functions
 *
 * @since 1.1.55
 *
 * @package WPGlobus Plus
 * @subpackage Administration
 */
/*jslint browser: true*/
/*global jQuery, console, WPGlobusAdmin, WPGlobusAcf, WPGlobusPlusAcfTable*/
(function($) {
	"use strict";
	
	if ( 'undefined' === typeof WPGlobusPlusAcfTable ) {
		return;	
	}
	
	if ( 'undefined' === typeof WPGlobusAdmin ) {
		return;	
	}
	
	var api = {
		promise: $.when(),
		builder: false,
		has_translations: false,
		label: false,
		isBuilder: function() {
			return api.builder;
		},
		hasTranslations: function() {
			return api.has_translations;
		},
		parseBool: function(b)  {
			return !(/^(false|0)$/i).test(b) && !!b;
		},
		init: function() {
			api.builder = api.parseBool(WPGlobusAdmin.builder);
			api.setLabels();
		},
		getVendorAcfFields: function() {
			if ( 'undefined' === typeof WPGlobusAcf ) {
				return false;
			}
			return WPGlobusAcf.getVendorAcfFields();
		},
		setLabels: function() {
			var tableFields = $('.acf-field-table');
			if ( tableFields.length == 0 ) {
				return;
			}
			$.each( tableFields, function(i, tableField) {
				var key = $(tableField).data('key');
				if ( 'undefined' !== typeof key ) {
					api.label = $('label[for=acf-'+key+']');
					api.label.css({'display':'inline-block', 'width': '50px'});
					api.getField(key);
				}
			});
		},
		getLabel: function(key) {
			var label = '';
			if ( api.isBuilder() ) {
				if ( WPGlobusAcf.isVendorAcfField('acf-'+key) ) {
					var language = WPGlobusAdmin.data.en_language_name[WPGlobusAdmin.builder.language];
					label = '<i style="font-style:normal;" class="mce-i-wpglobus-plus-globe"></i>'+'<span>'+language+'</span>';
				} else {
					label = WPGlobusPlusAcfTable.l10n['fieldNotMultilingual'];
				}

			} else {
				if ( api.hasTranslations() ) {
					label = '<i style="font-style:normal;" class="mce-i-wpglobus-plus-globe"></i>'+WPGlobusPlusAcfTable.l10n['tableHasTranslations'];
				} else {
					label = '<i style="font-style:normal;" class="mce-i-wpglobus-plus-globe"></i>'+WPGlobusPlusAcfTable.l10n['tableWarning'];
				}
			}
			return label;
		},
		getField: function(key) {

			api.promise = api.promise.then( function() {

				var order = {};
				order['action'] 	= 'check_translation';
				order['meta_value'] = key;
				order['postID'] 	= WPGlobusPlusAcfTable.postID;

				return $.ajax({
					beforeSend:function(){
						if ( 'undefined' !== typeof api.beforeSend ) api.beforeSend(order);
					},
					type: 'POST',
					url: WPGlobusAdmin.ajaxurl,
					data: { action:WPGlobusPlusAcfTable.process_ajax, order:order },
					dataType: 'json' 
				});					
			}, function(){
				/* error in promise */
				/* return $.ajax( ); */
			}).then( function( result ) {
				if ( 'undefined' !== typeof result ) {
					if ( result['hasTranslations'] ) {
						api.has_translations = true;
					}
					$(api.getLabel(key)).insertAfter(api.label);					
				}		
			});			
		}
		
	}
	
	WPGlobusPlusAcfTable = $.extend({}, WPGlobusPlusAcfTable, api);
	WPGlobusPlusAcfTable.init();
	
})(jQuery);