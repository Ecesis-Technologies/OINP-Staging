/**
 * WPGlobus Plus Slug Admin
 * Interface JS functions
 *
 * @since 1.1.42
 * @since 1.10.0 Added support WPGlobusEditPostSidebar plugin v.2.
 *
 * @package WPGlobus Plus
 * @subpackage Administration
 */
/*jslint browser: true*/
/*global jQuery, console, WPGlobusCore, WPGlobusPlusSlug*/

(function($) {
	"use strict";
	var api = {
		option: {},
		real_slug: $('#post_name'),
		revert_slug: $('#post_name').val(),
		currentExtraLanguage: undefined,
		promise: $.when(),
		init: function(args) {
			api.option = $.extend(api.option, args);
			api.localizePermalink(true);
			this.attachListeners();
			api.yoastSettings();
		},
		yoastSettings: function() {
			if ( WPGlobusAdmin.builder.language == WPGlobusCoreData.default_language ) {
				return;
			}
			if ( 'YoastSEO' == WPGlobusPlusSlug.yoastSeo ) {
				setTimeout(function() {
					$('.wpseo-metabox-root button').each(function(i,e){
						var classes = $(e).attr('class');
						if ( -1 != classes.indexOf('Button__BaseButton-') ) {
							$(e).addClass('wpglobus-plus-base-button');
						}
					});
					$(document).on('click', '.wpglobus-plus-base-button', function(ev){
						setTimeout(function() {
							$('#snippet-editor-field-slug').prop('disabled', true);
						}, 500);
					});
				}, 1500);
			}
		},
		localizePermalink: function(init) {
			if ( 'undefined' === typeof init ) {
				init = false;
			}
			if ( 'gutenberg' == WPGlobusPlusSlug.builderID ) {
				// @see getComponent
				api.blockEditorInit();
			} else {
				if ( WPGlobusCoreData.default_language != WPGlobusPlusSlug.builder.language ) {
					/**
					 * Modify permalink data.
					 */
					var homeURL = WPGlobusPlusSlug.homeURL;
					var permalink = $('#sample-permalink').html();
					var regexp = new RegExp(WPGlobusPlusSlug.homeURL, 'g');
					var localized = permalink.replace( regexp, WPGlobusPlusSlug.homeLocalizedURL );
					
					if ( init ) {
						if ( null !== WPGlobusPlusSlug.slug ) {
							localized = localized.replace(new RegExp($('#post_name').val()), WPGlobusPlusSlug.slug );
						}
						$('#sample-permalink').html(localized);
						if ( null === WPGlobusPlusSlug.slug && null === WPGlobusPlusSlug.shortenSlug ) {
							// do nothing.
						} else {
							$('#editable-post-name-full').text(WPGlobusPlusSlug.slug);
							$('#editable-post-name').text(WPGlobusPlusSlug.shortenSlug);
						}
					} else {
						localized = localized.replace(new RegExp($('#post_name').val()), $('#editable-post-name-full').text() );
						$('#sample-permalink').html(localized);
						
					}

				}
			}
		},
		attachListeners: function() {
			
			if ( 'gutenberg' == WPGlobusPlusSlug.builderID ) {
				$(document).on('blur', '.wpglobus-editable-post-name', function(ev) {
					// @todo may be 'focusout' event.
					var $t = $(this);
					var newName = $t.val();
							
					if ( newName == $t.data('old-name') ) {
						return;
					}

					if ( newName.length > 0 ) {
						api.getSamplePermalink($t.data('post-id'), $t.data('language'), newName);
					} else {
						api.remove($t.data('post-id'), $t.data('language'));
					}
				});
			} else {
				
				$(document).ajaxSend(function(event, jqxhr, settings){
					if ( 'undefined' === typeof settings.data ) {
						return;	
					}
					var lang;
					if ( 'undefined' === typeof api.currentExtraLanguage ) {
						lang = $('input[name="wpglobus_language"]').val();
						if ( 'undefined' === typeof lang || lang == WPGlobusCoreData.default_language ) {
							return;
						}
					}

					/**
					 * action=sample-permalink
					 * @see Save permalink changes in wp-admin\js\post.js
					 */
					if ( -1 != settings.data.indexOf('action=sample-permalink') ) {
						api.currentExtraLanguage = lang;
					}
					
				});
				$(document).ajaxComplete(function(event, jqxhr, settings){
					if ( 'undefined' === typeof api.currentExtraLanguage ) {
						return;
					}
					/**
					 * Check `action=sample-permalink` again @see ajaxSend()
					 * This is important for slow internet connection.
					 * @see Save permalink changes in wp-admin\js\post.js
					 * @since 1.2.2
					 */
					if ( -1 == settings.data.indexOf('action=sample-permalink') ) {
						return;
					}	
					api.save( WPGlobusAdmin.$_get.post, api.currentExtraLanguage, $('#editable-post-name-full').text() );
					/**
					 * Restore slug for default language.
					 */
					api.real_slug.val( api.revert_slug );
					api.localizePermalink(false);
					api.currentExtraLanguage = undefined;
				});
			}
		},
		getSamplePermalink: function(postId, language, new_slug) {
		
			$.post(
				ajaxurl,
				{
					action: 'sample-permalink',
					post_id: postId,
					new_slug: new_slug,
					new_title: $('#title').val(),
					samplepermalinknonce: $('#samplepermalinknonce').val()
				},
				function(data) {
					var match = data.match(/<span id="editable-post-name-full">.*<\/span>/);
					if ( 'undefined' !== typeof match[0] ) {
						var __name = match[0].replace('<span id="editable-post-name-full">', '');
						__name = __name.replace('</span>', '');
						api.save(postId, language, __name);
						$('#editable-post-name-'+language).val(__name);
					}
				}
			);
			
		},
		remove: function(post_id, language) {
			
			api.promise = api.promise.then( function() {

				var order = {};
				order['action'] 	= 'wpglobus-remove-name';
				order['post_id'] 	= post_id;
				order['language'] 	= language;
	
				return $.ajax({
					beforeSend:function(){
						if ( 'undefined' !== typeof api.beforeSend ) api.beforeSend(order);
					},
					type: 'POST',
					url: WPGlobusAdmin.ajaxurl,
					data: {action:WPGlobusPlusSlug.process_ajax, order:order},
					dataType: 'json' 
				});					
			}, function(){
				/* error in promise */
				/* return $.ajax( ); */
			}).then( function( result ) {
				if ( 'success' == result.status ) {
					$('#editable-post-name-'+result.language).data('old-name', result.new_name);
				}
			});			
			
		},
		save: function(post_id, language, newName) {
			
			api.promise = api.promise.then( function() {

				var order = {};
				order['action'] 	= 'wpglobus-save-name';
				order['post_id'] 	= post_id;
				order['language'] 	= language;
				order['new_name'] 	= newName;
	
				return $.ajax({
					beforeSend:function(){
						if ( 'undefined' !== typeof api.beforeSend ) api.beforeSend(order);
					},
					type: 'POST',
					url: WPGlobusAdmin.ajaxurl,
					data: {action:WPGlobusPlusSlug.process_ajax, order:order},
					dataType: 'json' 
				});					
			}, function(){
				/* error in promise */
				/* return $.ajax( ); */
			}).then( function( result ) {
				if ( 'success' == result.status ) {
					$('#editable-post-name-'+result.language).data('old-name', result.new_name);
					/**
					 * @since 1.1.54
					 */
					$(document).trigger('wpglobus-sample-permalink:done', [result, result.language] );
				}	
			});
		},
		blockEditorInit: function() {
			WPGlobusCoreData.enabled_languages.map((language) => {
				api.store.setSlug(language, WPGlobusPlusSlug.postSlugs[language]);
			});
		},
		store: {
			slug: [],
			getSlug(language) {
				if ( 'undefined' === typeof language ) {
					return api.store.slug;
				}
				if ( 'undefined' === typeof api.store.slug[language] ) {
					return null;
				}
				return api.store.slug[language];
			},
			setSlug(language,value) {
				api.store.slug[language] = value;
			}
		},
		getStore: function() {
			return api.store;
		},
		getPermalinkTemplates: function() {
			return WPGlobusPlusSlug.permalinkTemplates;
		},
		getPermalink: function(language) {
			var template = WPGlobusPlusSlug.permalinkTemplates[language];
			var _slug = api.store.getSlug(language);
			if ( '' === _slug ) {
				_slug = api.store.getSlug(WPGlobusCoreData.default_language);
			}
			if ( null === _slug ) {
				return template;
			}
			/**
			 *  %postname%
			 *  %pagename%
			 */
			return template.replace(/%\S+%/, _slug); 
		},
		isHomePage: function() {
			if ( WPGlobusPlusSlug.postID === WPGlobusPlusSlug.pageOnFront ) {
				return true;
			}
			return false;
		},
		getPublishStatus: function(language) {
			if ( 'undefined' === typeof WPGlobusPlusPublish ) {
				return 'publish';
			}
			if ( 'undefined' === typeof WPGlobusPlusPublish.getStatus(language) ) {
				return 'publish';
			}
			return WPGlobusPlusPublish.getStatus(language);
		},
		getComponent: function(props) {
			/**
			 * This function will be called from an external script.
			 * @see wpglobus\includes\builders\gutenberg\assets\js\wpglobus-gutenberg.js
			 */
			var el = wp.element.createElement;
			var useState = wp.element.useState;
			var useEffect = wp.element.useEffect;
			var useCallback = wp.element.useCallback;
			var useContext = wp.element.useContext;
			let { tagName = '', ...others } = props;
			
			/**
			 * Component ExternalButton.
			 */
			const ExternalButton = (props) => {

				let {
					className = '',
					style = {},
					target = '',
					children = '',
					language = WPGlobusCoreData.default_language,
				} = props;
				
				const defaultTagName = 'a';
				const [ elem, setElem ] = useState({
					children: children.replace('{{externalUrl}}', api.getPermalink(language)),
					href: api.getPublishStatus(language) === 'publish' ? children.replace('{{externalUrl}}', api.getPermalink(language)) : '#',
					tagName: api.getPublishStatus(language) === 'publish' ? defaultTagName : 'span',
					classes: className === '' ? '' : className,
					target: api.getPublishStatus(language) === 'publish' ? target : null,
				});
			
				useEffect(() => {
					$(document).on('ajaxComplete', function(event, jqxhr, settings){
						if ( 'undefined' === typeof jqxhr.responseJSON || 'undefined' === typeof jqxhr.responseJSON.payload ) {
							return;
						}
						if ( language !== jqxhr.responseJSON.payload.language ) {
							return;
						}					
						const actions = [
							'getSlug',
							'updateSlug',
							'set_status', // From WPGlobusPlusPublish
						]
						actions.forEach( (action) => {
							if ( action === jqxhr.responseJSON.payload.action ) {
								if ( api.getPublishStatus(language) === 'publish' ) {
									setElem( (prevElem) => {
										var updatedValues = { 
											tagName: defaultTagName,
											classes: 'components-' + defaultTagName + ' ' + className,
											target: target,
										}
										if ( 'set_status' === action ) {
											updatedValues.href = prevElem.children;											
										} else {
											updatedValues.children = children.replace('{{externalUrl}}', api.getPermalink(language));
											updatedValues.href = updatedValues.children;
										}
										return {...prevElem, ...updatedValues};
									});
								} else {
									setElem( (prevElem) => {
										var updatedValues = {
											tagName: 'span',
											classes: 'components-span' + ' ' + className,
											href: null,
											target: null,
										}
										if ( 'set_status' === action ) {
											// 
										} else {
											updatedValues.children = children.replace('{{externalUrl}}', api.getPermalink(language));
										}
										return {...prevElem, ...updatedValues};
									});
								}								
								return false;
							}
						});
					});
					return () => {
						$(document).off('ajaxComplete')
					};
				},[])			

				return el(
					elem.tagName, 
					{
						href: elem.href,
						className: elem.classes,
						target: elem.target,
						style: style,
					},
					elem.children
				)
			}	

			/**
			 * Component InputSlug.
			 */
			const InputSlug = (props) => {
				const {
					className = '',
					style = {},
					placeholder = '',
					language = WPGlobusCoreData.default_language,
				} = props;

				const [elValue, setElValue] = useState('');
				
				const fetchSlug = useCallback(async(props) => {
					const {language, value} = props;
					var action;
					if ( 'undefined' === typeof value ) {
						if (api.store.getSlug(language) !== null) {
							setElValue(api.store.getSlug(language));
							return;
						}
						action = 'getSlug';
					} else {
						action = 'updateSlug';
						if ( value === api.store.getSlug(language) ) {
							return;
						}
					}
					
					var order = {
						action: action,
						post_id: WPGlobusPlusSlug.postID,
						language: language,
					}
					if (action === 'updateSlug') {
						order.value = value;
					}
					
					$.ajax({
						type:'POST',
						url:WPGlobusPlusSlug.ajaxurl,
						data:{action:WPGlobusPlusSlug.process_ajax, order:order},
						dataType:'json'
					}).done(function(response) {
						if ( 'success' === response['status'] ) {
							setElValue(response['slug']);
							api.store.setSlug(language, response['slug']);
						}	
					})
					.fail(function(error){})
					.always(function(jqXHR, status){});	
				}, [])
				
				useEffect(() => {	
					fetchSlug({language:language});
				},[])
	
				let classes = 'components-text';
				if ( className !== '' ) {
					classes += ' ' + className;
				}
			
				let disabled = '';
				if ( language === WPGlobusCoreData.default_language ) {
					disabled = 'disabled';
				}

				const handleChange = (evnt) => {
					setElValue( () => {
						var value = evnt.target.value.replace( /\s{2}/g, ' ' );
						value = value.replace( /\s/g, '-' );
						return value;
					});
				}
				
				const handleBlur = (evnt) => {
					fetchSlug({language:language, value:elValue});
				}
				
				return el(
					'input', 
					{
						type: 'text',
						value: elValue,
						className: classes,
						style: style,
						disabled: disabled,
						placeholder: placeholder,
						onChange: handleChange,
						onBlur: handleBlur,
					}
				)
			}
			
			var element;
			if ( 'InputSlug' === tagName ) {
				element = el(
					InputSlug, 
					{
						style: others.style,
						title: 'title',
						className: others.className,
						language: others.language,
						placeholder: others.placeholder,
					},
					'currentStatus'
				)
			} else if ( 'ExternalButton' === tagName ) {
				element = el(
					ExternalButton, 
					{
						className: others.className,
						style: others.style,
						isSmall: others.isSmall,
						isPrimary: others.isPrimary,
						href: others.href,
						target: others.target,
						language: others.language,
					},
					others.children
				)
			}

			return element;	
		}
	};
	
	WPGlobusPlusSlug = $.extend({}, WPGlobusPlusSlug, api);
	WPGlobusPlusSlug.init();
	
})(jQuery);