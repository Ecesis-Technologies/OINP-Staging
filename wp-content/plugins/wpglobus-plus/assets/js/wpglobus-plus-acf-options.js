/*@since 1.7.2*/
/*jslint browser: true*/
/*global jQuery, console, WPGlobusPlusAcfOptions, WPGlobusDialogApp*/
(function($) {
	"use strict";

	if ( 'undefined' === typeof WPGlobusPlusAcfOptions ) {
		return;
	}
	if ( 'undefined' === typeof WPGlobusDialogApp ) {
		return;
	}

	var api = {
		start: function() {
			setTimeout(function(){
				api.setClass();
			}, 500);
			api.attachListeners();
		},
		getData: function(key){
			if ( 'undefined' === typeof key ) {
				return WPGlobusPlusAcfOptions.data;
			}
			return WPGlobusPlusAcfOptions.data[key];
		},
		getTranslatableClass: function(){
			return WPGlobusPlusAcfOptions.data.translatableClass;
		},
		getFields: function(params){
			if ( 'undefined' === typeof params ) {
				return WPGlobusPlusAcfOptions.data.optionMlFields;
			}
			if ( 'object' === typeof params ) {
				var key = api.getKey(params);
				var fields = [];
				$.each(WPGlobusPlusAcfOptions.data.optionMlFields, function(id, data){
					if ( -1 !== $.inArray(data[key], params[key]) ) {
						fields.push(id);
					}
				});
				return fields;
			}
			return [];
		},
		getKey: function(obj){
			return Object.keys(obj)[0];	
		},
		getFieldProp: function(id, prop){
			return WPGlobusPlusAcfOptions.data.optionMlFields[id][prop];
		},
		setClass: function(){
			var fields = api.getFields({type:['text','textarea']});
			if ( fields.length > 0 ) {
				$.each(fields, function(indx, id){
					/* @since 1.8.0 */
					if ( api.getFieldProp(id, 'parent') ) {
						$('[name*="'+api.getFieldProp(id, 'key')+'"]').each(function(indx, elem){
							var _id = $(elem).attr('id');
							if ( 'undefined' !== typeof _id && -1 == _id.indexOf('acfcloneindex') ) {
								WPGlobusDialogApp.addElement({id:_id, dialogTitle:api.getFieldProp(id, 'label')});
							}
						});
					} else {
						WPGlobusDialogApp.addElement({id:id, dialogTitle:api.getFieldProp(id, 'label')});
					}
				});
			}
		},
		attachListeners: function(){
			var wysiwygFields = api.getFields({type:['wysiwyg']});
			$(document).on('MultilingualWysiwyg-TinymceEditorInit', function(evnt,args){
				/* @see multilingual-wysiwyg\assets\js\multilingual-wysiwyg.js */
				var res = false;
				var key = $('#wp-'+args.editor.id+'-wrap').parents('.acf-field-wysiwyg').data('key');
				if ( 'string' === typeof key ) {
					if ( wysiwygFields.includes(api.getData('fieldPrefix')+key) ) {
						res = true;
					}
				}
				return res;
			});
		}
	}

	WPGlobusPlusAcfOptions = $.extend({}, WPGlobusPlusAcfOptions, api);
	WPGlobusPlusAcfOptions.start();

})(jQuery);
