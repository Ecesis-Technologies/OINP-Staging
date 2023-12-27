/**
 * WPGlobus Plus Publish Tab
 * Interface JS functions
 *
 * @since 1.3.0
 *
 * @package WPGlobus Plus
 * @subpackage Administration
 */
/*jslint browser: true*/
/*global jQuery,console,WPGlobusPlusPublishTab*/

(function($) {
	"use strict";
	if ( 'undefined' === typeof WPGlobusPlusPublishTab ) {
		return;
	}	
	
	var api = {
		selectSelector: '#wpglobus-plus-publish-languages',
		selectID: 'wpglobus-plus-publish-languages',
		bulkStartButtonSelector: '.wpglobus-plus-publish-bulk-start',
		languageIDs: [],
		selectedLanguageIDs: [],
		parseBool: function(b)  {
			return !(/^(false|0)$/i).test(b) && !!b;
		},			
		init: function() {
			if ( 'post-action' === WPGlobusPlusPublishTab.data.section ) {
				api.postAction();
				setTimeout(function(){
					api.setCSS();
				}, 1000);				
			} else if ( 'single-action' === WPGlobusPlusPublishTab.data.section ) {
				setTimeout(function(){
					api.singleAction();
				}, 500);	
			}
		},
		singleAction: function() {
			/** @since 1.8.7 */
			$('.about-wrap .feature-section .col').css({'margin-top':0});				
			var $itemTwo = $('.item-two');
			var $link = $('.wpglobus-plus-publish-single-action_link');	
			$link.removeAttr('href');
			
			var linkLanguage = {mask:'', value:''};
			var linkPostType = {mask:'', value:''};
		
			var setSelectListeners = function() {
				$('.wpglobus-select').on('change',function(ev){
					var $t = $(this), id = $t.attr('id'),
						mask = $t.data('mask'),
						val  = $t.val(),
						link = '';
					
					if ( 'language' === id ) {
						linkLanguage.mask  = mask;
						linkLanguage.value = val;
					} else if ( 'post_type' === id ) {
						linkPostType.mask  = mask;
						linkPostType.value = val;
					}
					
					link = WPGlobusPlus.publish_action_links['single-action'].replace( linkLanguage.mask, linkLanguage.value );
					link = link.replace( linkPostType.mask, linkPostType.value );
				
					if ( linkLanguage.mask !== linkLanguage.value && linkPostType.mask !== linkPostType.value ) {
						$link.attr('href',link); 
						$itemTwo.removeClass('inactive');
					} else {
						$link.removeAttr('href');
						$itemTwo.addClass('inactive');
					}
					$link.text(link);
				});
			}
			
			setSelectListeners();
		},
		setCSS: function() {
			var $img = $('img.module-publish-metabox-actions');
			if ( $img.length == 1 ) {
				$img.css({'display':'block'});
			}
		},
		postAction: function() {
			$(api.selectSelector).select2({
				placeholder: 'Select language(s)',
				width: '600px',
				maximumSelectionLength: -1,
				escapeMarkup: function (m) {
					return m;
				}
			});
			setTimeout(function(){
				var selectElement = document.getElementById(api.getSelectID());
				if ( api.parseBool(selectElement) ) {
					var options = selectElement.options;
					api.languageIDs = $.map(options ,function(option) {
						return option.value;
					});
				}
			}, 500);
			api.addListeners();			
		},
		getSelectID: function() {
			return api.selectID;
		},		
		getLanguageIDs: function() {
			return api.languageIDs;
		},
		getSelectedLanguageIDs: function() {
			return api.selectedLanguageIDs;
		},
		addListeners: function() {
			
			$(document).on('click', '.wpglobus-plus-publish-languages-add-all', function(evnt){
				$(api.selectSelector).val(api.languageIDs).trigger('select').trigger('change');
			});
			
			$(document).on('click', '.wpglobus-plus-publish-languages-delete-all', function(evnt){
				$(api.selectSelector).val([]).trigger('change');
			});
			
			$(api.selectSelector).on('change', function(evnt) {
				if ( 'undefined' === typeof evnt.val ) {
					/** It may be `select all` or `delete all` languages. */
					var options = $(api.selectSelector+' option:selected');
					api.selectedLanguageIDs = $.map(options, function(option) {
						return option.value;
					});
				} else {
					api.selectedLanguageIDs = evnt.val;
				}
				if ( api.selectedLanguageIDs.length == 0 ) {
					$(api.bulkStartButtonSelector).addClass('hidden');
				} else {
					$(api.bulkStartButtonSelector).removeClass('hidden');
				}
			});
			
			$('form[name="wpglobus-publish-form"]').submit( function(evnt){
				$(api.bulkStartButtonSelector).addClass('hidden');
				var postID = $(this).find('input[name="post-id"]').val();
				var ids = api.getSelectedLanguageIDs();
				var link = $('form[name="wpglobus-publish-form"] input[name="action-link"]').val();
				link = link.replace( '{{post_id}}', postID );
				link = link.replace( '{{language}}', ids );
				location = link;
				return false;
			});			
		}
	};
	
	WPGlobusPlusPublishTab = $.extend({}, WPGlobusPlusPublishTab, api);
	WPGlobusPlusPublishTab.init();
})(jQuery);		