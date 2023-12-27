/*@since 1.8.0 */
/*jslint browser: true*/
/*global jQuery, console, WPGlobusCoreData, WPGlobusPlusAcfFieldGroup*/
(function($) {
	"use strict";

	if ( typeof WPGlobusCoreData === 'undefined' ) {
		return;
	}

	if ( typeof WPGlobusPlusAcfFieldGroup === 'undefined' ) {
		return;
	}

	var api = {
		sourceElementID: null,
		isAcfField: function(field){
			field = field || false;
			if ( field && 0 == field.indexOf('acf_fields') ) {
				return true;
			}
			return false;
		},
		setSourceElementID: function(id){
			api.sourceElementID = id;
		},
		getSourceElementID: function(){
			return api.sourceElementID;
		},
		init: function() {
			$('.titlediv-wpglobus').css({'display':'none'});
			$('.wpglobus-switch').css({'display':'none'});
			
			/* @see trigger in includes\js\wpglobus-admin-56.js */
			$(document).on('wpglobus_post_title', function(event, args){
				return WPGlobusPlusAcfFieldGroup.data.post.post_title;
			});			
		},
		start: function() {
			api.init();
			api.attachListeners();
			api.timeout();
		},
		attachListeners: function() {
			$(document).on('click', '.wpglobus_dialog_start', function(event){
				api.setSourceElementID( $(this).data('source-id') );
			});
			$(document).on('click', '.wpglobus-dialog-button.wpglobus-button-cancel', function(event){
				api.setSourceElementID(null);
			});			
			$(document).on('click', '.wpglobus-button-save', function(event){
				if ( ! api.isAcfField( api.getSourceElementID() ) ) {
					return;
				}
				$('#'+api.getSourceElementID()).trigger('change');
				var parent = $('#'+api.getSourceElementID()).parents('.acf-field-object');
				var fieldLabel = parent.find('.li-field-label .edit-field').eq(0);
				if ( 'undefined' !== typeof fieldLabel ) {
					fieldLabel.text(WPGlobusCore.TextFilter(fieldLabel.text(),WPGlobusCoreData.language));		
				}
				api.setSourceElementID(null);
			});
		},
		timeout: function() {
			setTimeout(function(){
				/* Init edit field anchors. */
				$('.edit-field').each(function(i,e){
					var val = $(e).text();
					$(e).text(WPGlobusCore.TextFilter(val,WPGlobusCoreData.language));					
				});
				
				// Make multilingual Field labels.
				$('.field-label').each(function(i,e){
					var id = $(e).attr('id');
					if ( 'undefined' !== typeof id ) {
						WPGlobusDialogApp.addElement({
							id:id,
							dialogTitle:'Field label'
						});
					}
				});
				
				// Make multilingual Instructions.
				$('.acf-field-setting-instructions textarea').each(function(i,e){
					var id = $(e).attr('id');
					if ( 'undefined' !== typeof id ) {
						WPGlobusDialogApp.addElement({id:id,dialogTitle:'Instructions'});
					}
				});	

				// Make multilingual Button labels.
				$('.acf-field-setting-button_label input').each(function(i,e){
					var id = $(e).attr('id');
					if ( 'undefined' !== typeof id ) {
						WPGlobusDialogApp.addElement({
							id:id,
							dialogTitle:'Button Label'
						});
					}
				});
					
				// 	Make multilingual post title.
				if ( WPGlobusDialogApp.addElement({id:'title',dialogTitle:'Edit title'}) ) {
					$('#wpglobus-title').css({
						'padding':'3px 8px',
						'font-size':'1.7em',
						'line-height':'100%',
						'height':'1.7em',
						'width':'97%',
						'outline':'none',
						'margin':'0 0 3px',
						'background-color':'#fff'
					})
				}
				
				// Give to the ACF information about the field change.
				$('.'+WPGlobusPlusAcfFieldGroup.data.translatableClass).on('blur', function(evnt){
					var id = false, $t = $(this);
					if ( $t.data('source-get-by') === 'id' ) {
						id = '#' + $(this).data('source-id');
					} else if ( $t.data('source-get-by') === 'name' ) {
						// @todo add code.
					}
					if ( id ) {
						$(id).trigger('change');
					}
				});
			},500);
		}		
	}

	WPGlobusPlusAcfFieldGroup = $.extend({}, WPGlobusPlusAcfFieldGroup, api);
	WPGlobusPlusAcfFieldGroup.start();

})(jQuery);
