/**
 * Multilingual WYSIWYG editor.
 *
 */
/*jslint browser: true*/
/*global _, jQuery, console, MultilingualWYSIWYG*/
jQuery(document).ready(function($){

	if ( 'undefined' === typeof MultilingualWYSIWYG ) {
		return;
	}

	var api = {
		started: false,
		formSubmited: false,
		// languageChanged: false,
		updateContent: true,
		editors: {},
		listBox: {},
		submitElements: {},
		buttonTypes: {},
		parseBool: function(b){return !(/^(false|0)$/i).test(b) && !!b;},
		isStarted: function(){return api.parseBool(MultilingualWYSIWYG.started);},
		isNum: function(val){return /^\d+$/.test(val);},
		isUpdateContent: function(){return api.updateContent;},
		isEnabledEditorID: function(id) {
			if ( /\*/.test(api.get('editor_id')) ) {
				var editorMask = api.get('editor_id')[0].replace('*', '');
				if ( editorMask.length == 0 ) {
					return true;
				}
				if ( id.indexOf(editorMask) == -1 ) {
					return false;
				}
			} else {
				if ( api.get('editor_id').indexOf(id) == -1 ) {
					return false;
				}
			}
			return true;
		},
		initEditor: function(editor){
			if ( api.get('provider') == 'WPGlobus' && 'undefined' !== typeof WPGlobusPlusTinyMCE ) {
				return false;
			}			
			if ( 'object' !== typeof editor || 'undefined' === typeof editor.id ) {
				return false;
			}
			if ( 'undefined' !== typeof api.editors[editor.id] ) {
				// Already initialized.
				return false;
			}
			if ( ! api.isEnabledEditorID(editor.id) ) {
				return false;
			}
		
			api.editors[editor.id] = {};
			api.editors[editor.id]['content'] = ''; // Init content.
			api.editors[editor.id]['language'] = api.getDefaultValue();
			return true;
		},
		getTinyMCEEditors: function(){
			return tinyMCE.editors;
		},
		getExistenceEditors: function(){
			return api.getTinyMCEEditors()
		},		
		getEditors: function(){
			return api.getEditor();
		},
		getEditor: function(editor){
			if ( 'undefined' === typeof editor ) {
				if ( _.isEmpty(api.editors) ) {
					return false;
				}
				return api.editors;
			}
			var id;
			if ( 'string' === typeof editor ) {
				id = editor;
			} else if ( 'object' === typeof editor ) {
				id = editor.id;
			} else {
				return false;
			}
			if ( 'undefined' === typeof api.editors[id] ) {
				return false;
			}
			return api.editors[id];
		},
		getEditorContent: function(editor){
			return api.getEditor(editor)['content'];
		},
		setEditorContent: function(editor, content){
			api.getEditor(editor)['content'] = content;
		},
		getEditorLanguages: function(){
			$.each(api.getEditor(), function(editorID, data){
				console.log('editor ID::',editorID,' > language::',data.language);
			});
		},
		getEditorLanguage: function(editor){
			return api.getEditor(editor)['language'];
		},
		setEditorLanguage: function(editor, language){
			if ( 'object' !== typeof editor || 'undefined' === typeof editor.id ) {
				return false;
			}			
			if ( 'undefined' === typeof api.editors[editor.id] ) {
				return false;
			}
			api.editors[editor.id]['language'] = language;
			return language;
		},		
		set: function(param, value) {
			MultilingualWYSIWYG.data[param] = value;
		},
		get: function(param) {
			if ( 'undefined' === typeof MultilingualWYSIWYG.data[param] ) {
				return undefined;
			}
			return MultilingualWYSIWYG.data[param];
		},
		getVersion: function() {
			return MultilingualWYSIWYG.version;
		},
		start: function() {
			if ( 'undefined' === typeof tinymce ) {
				return false;
			}
			if ( api.get('provider') != 'WPGlobus' ) {
				return false;
			}
			MultilingualWYSIWYG.started = true;
			api.init();
			api.addSwitcherListBox();
			setTimeout(function(){
				api.attachListeners();
			},1000);
		},
		init: function(){
			// Init data.
			api.initData();
			// Init listbox selector.
			api.initListBox();
			// Init button types.
			api.initButtonTypes();
			// Init editors.
			api.initEditors();
		},
		initData: function() {
			// Init `editor_id` param.
			var ids = api.get('editor_id');
			if ( 'string' === typeof ids ) {
				var __ids = [];
				__ids.push(ids);
				api.set( 'editor_id', __ids );
			}
		},
		initListBox: function() {
			api.listBox = {};
			var values = [];
			var languages = api.get('languages');
			var i = 0;
			for (var code in languages) {
			  var value = code;
			  if ( api.isNum(code) ) {
				  value = languages[code];
			  }
			  values.push( {text:languages[code],value:value} );
			  if ( i == 0 ) {
				  api.listBox['defaultValue'] = value;
				  api.listBox['defaultText'] = languages[code];
			  }
			  i++;
			}
			api.listBox['values'] = values;
		},
		initButtonTypes: function() {
			api.buttonTypes['listbox'] = {
				buttonClass: 'multilingual-wysiwyg-listbox'
			};
		},
		initEditors: function() {
			$(document).on('tinymce-editor-init', function(event, editor) {
				/** init content for default language. */
				var editorInit = $(document).triggerHandler('MultilingualWysiwyg-TinymceEditorInit', {editor:editor}) ;
				if ( undefined !== editorInit && ! editorInit ) {
					setTimeout(function(){
						$('.'+api.buttonTypes['listbox']['buttonClass']+'-'+editor.id).css({'display':'none'});
					}, 400);
					return;
				}
				if ( api.initEditor(editor) ) {
					
					api.editors[editor.id]['content'] = editor.getContent();
					editor.setContent( api.getTranslation(editor, api.get('defaultLanguage')) );
					
					/** tinymce */
					// editor.on('nodechange keyup', _.debounce( api.updateEditorContent, 300 ) );
					editor.on('keyup', _.debounce( api.updateEditorContent, 300 ) );
					/** textarea */
					$('#'+editor.id).on('input keyup', _.debounce( api.updateEditorContent, 300 ) );
					
					setTimeout(function(){
						$('#'+editor.iframeElement.id).css({'border-left':'3px solid blue', 'width':'99%'});
					}, 400);					
				}
			});
			// @todo All editors may be start in text mode.
			// if ( 'undefined' !== tinymce.editors && tinymce.editors.length == 0 ) {}
		},
		getValues: function() {
			if ( api.listBox['values'] ) {
				return api.listBox['values'];
			}
		},
		getDefaultText: function(){
			return api.listBox['defaultText'];
		},
		getDefaultValue: function(){
			return api.listBox['defaultValue'];
		},		
		getMLString: function(editor, text, language){
			var mlString = '';
			if ( api.get('provider') == 'WPGlobus' ) {			
				mlString = WPGlobusCore.getString(api.getEditorContent(editor),text,language);
			}
			return mlString;
		},
		getTranslation: function(editor, language){
			var translations = [];
			if ( api.get('provider') == 'WPGlobus' ) {
				translations = WPGlobusCore.getTranslations( api.getEditorContent(editor) );
			}
			if ( 'undefined' === typeof translations[language] ) {
				return '';
			}
			return translations[language];
		},
		addSwitcherListBox: function() {
			// @see https://www.tiny.cloud/docs-4x/demo/custom-toolbar-listbox/
			tinymce.PluginManager.add('ml_tinymce_language_select_button', function(editor,url) {
				if ( api.isEnabledEditorID(editor.id) ) {
					// @see https://www.tiny.cloud/docs-4x/advanced/creating-a-custom-button/#basicbutton
					editor.addButton('ml_tinymce_language_select_button', {
						type: 'listbox',
						text: api.getDefaultText(),
						icon: false,
						onselect: function(e){
							var language = this.value();
							if ( api.getEditorLanguage(editor) == language ) {
								// Do nothing.
							} else {
								api.updateContent = false;
								api.setEditorLanguage(editor, language);
								/* @since 1.4 */
								editor.setContent( api.getTranslation(editor, language) );
							}
						},
						values: api.getValues(),
						onPostRender: function(){
							if ( api.getDefaultValue() ) {
								this.value(api.getDefaultValue());
							}
							api.afterPostRender(this, editor);
						}
					});
				}					
			});				
		},
		afterPostRender: function(elem, editor) {
			var id = elem._id;
			if ( 'string' != typeof id ) {
				return;
			}
			id = '#'+id;
			if ( $(id).length == 1 ) {
				api.setListboxCSS(id);
				api.addClass(id, editor);
			}
		},
		addClass: function(id, editor) {
			var btnClass = api.buttonTypes['listbox']['buttonClass'];
			$(id).addClass(btnClass);
			$(id).addClass(btnClass+'-'+editor.id);
		},
		setListboxCSS: function(id) {
			$(id).attr('data-multilingual-wysiwyg-styled','true');
			$(id).css({'border-left':'3px solid blue'});
		},
		attachListeners: function() {
			setTimeout( function(){
				$.each( api.get('submit_element'), function(i, submitElement) {
					if ( submitElement.length == 0 ) {
						return true;
					}
					$(document).on('mouseenter', submitElement, function(event){
						api.updateContent = false;
						$.each( api.getEditors(), function(editorID, data){
							if ( tinymce.get(editorID) == null || tinymce.get(editorID).isHidden() ) {
								$( '#' + editorID ).val(data.content);
								// $( '#' + editorID + '-tmce' ).click();
								$( '#' + editorID + '-tmce' ).trigger('click');
							} else {
								tinymce.get(editorID).setContent(data.content,{format:'raw'});
							}
						});
					}).on('mouseleave', submitElement, function(event) {
						if ( api.formSubmited ) {
							return;
						}
						api.updateContent = false;
						$.each( api.getEditors(), function(editorID, data){
							var content = api.getTranslation(editorID, api.getEditorLanguage(editorID));
							if ( tinymce.get( editorID ) == null || tinymce.get(editorID).isHidden() ) {
								$('#' + editorID).val(content);
							} else {
								tinymce.get(editorID).setContent(content,{format:'raw'});
							}
						});
					}).on('click', submitElement, function(event){
						api.formSubmited = true;
					});
				});
			}, 500);				
		},
		updateEditorContent: function(event) {
			if ( event.selectionChange && ! api.isUpdateContent() ) {
				api.updateContent = true;
				return;
			}
			var editorID, text;

			if ( typeof event.target !== 'undefined' ) {
				editorID = event.target.id;
			} else {
				return;
			}

			if ( editorID == 'tinymce' ) {
				editorID = event.target.dataset.id;
			}
			if ( tinymce.get(editorID) == null || tinymce.get(editorID).isHidden() ) {
				text = $('#'+editorID).val();
			} else {
				text = tinymce.get(editorID).getContent({format:'raw'});
			}
			api.setEditorContent(
				editorID,
				api.getMLString( editorID,text,api.getEditorLanguage(editorID) )
			);	
		}
	}

	MultilingualWYSIWYG = $.extend({}, MultilingualWYSIWYG, api);
	MultilingualWYSIWYG.start();	 
});