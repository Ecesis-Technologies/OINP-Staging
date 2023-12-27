/**
 * WPGlobus Plus Publish
 * Interface JS functions
 *
 * @since 1.0.0
 * @since 1.10.0 Added support WPGlobusEditPostSidebar plugin v.2.
 *
 * @package WPGlobus Plus
 * @subpackage Administration
 */
/*jslint browser: true*/
/*global jQuery, console, WPGlobusPlusPublish */
(function($) {
	"use strict";
	
	if ( 'undefined' === typeof WPGlobusPlusPublish ) {
		return;
	}
	
	var api = {
		option: {},
		statusBoxDelta: 0,
		init: function(args) {
			api.option = $.extend(api.option, args);
			this.handlePostStatus();
		},
		getParam: function(param) {
			if ( 'undefined' === typeof param ) {
				return WPGlobusPlusPublish.data;
			}
			return WPGlobusPlusPublish.data[param];
		},
		getPostId: function() {
			return api.getParam('post_id');
		},
		handlePostStatus: function() {
			var status_classes = [], order = {};
			
			$.each( WPGlobusPlusPublish.data.statuses, function(i,s) {
				status_classes[i] = 'wpglobus-status-' + s;
			});
			status_classes = status_classes.join(' ');
		
			$('.wpglobus-pub-language').each(function(i,e){
				var l = $(this).data('language'),
					s = $(this).data('status');
				$('#wpglobus-pub-'+l+' .wpglobus-status-'+s).addClass('wpglobus-pub-current-status');	
			});
			
			$(document).on('mouseenter mouseleave', '.wpglobus-pub-language', function(event) {
				var $this = $(this),
					l = $this.data('language');
				if ( 'mouseenter' == event.type ) {
					$('.wpglobus-pub-status').addClass('hidden');
					$('#wpglobus-pub-'+l).removeClass('hidden');
					api.statusBoxDelta = event.screenY;
				} else if ( 'mouseleave' == event.type ) {	
					if ( api.statusBoxDelta != 0 && event.screenY - api.statusBoxDelta < 0) {
						$('.wpglobus-pub-status').addClass('hidden');
					}	
				}	
			});
			$(document).on('mouseleave', '.wpglobus-pub-status', function(event) {
				$('.wpglobus-pub-status').addClass('hidden');
			});
			$(document).on('click', '.wpglobus-pub-status li', function(event){
				var $t = $(this), $s = $t.find('.wpglobus-spinner'), l = $t.data('language');
				var	beforeSend = function(){
					$s.css('visibility','visible');	
				};
				if ( ! $t.hasClass('wpglobus-pub-current-status') ) {
					var order = {};
					order['action'] = 'set_status';
					order['post_id'] = WPGlobusPlusPublish.data.post_id;
					order['language'] = l;
					order['status'] = $t.data('status');
					api.ajax(order, beforeSend).done(function(result) {
						if ( 'ok' == result['result'] ) {
							$('#wpglobus-pub-'+l+' li').removeClass('wpglobus-pub-current-status');
							$t.addClass('wpglobus-pub-current-status');
							$('.wpglobus-pub-selector-'+l).removeClass(status_classes).addClass('wpglobus-status-'+$t.data('status'));
							$('.wpglobus-pub-selector-'+l).data('status',result['status']);
						}	
					})
					.fail(function(error){})
					.always(function(jqXHR, status){$s.css('visibility','hidden');});
				}
			});
		},	
		ajax: function(order, beforeSend) {
			return $.ajax({
				beforeSend:function(){
					if ( typeof beforeSend === 'function' ) beforeSend();
				},
				type:'POST',
				url:ajaxurl,
				data:{action:WPGlobusPlusPublish.data.process_ajax, order:order},
				dataType:'json'
			});
		},
		postStatus: null,
		setStatus: function(status, language) {
			if ( api.postStatus === null ) {
				api.postStatus = WPGlobusPlusPublish.data.postStatus;
			}
			api.postStatus[language] = status;
		},
		getStatus: function(language) {
			if ( api.postStatus === null ) {
				api.postStatus = WPGlobusPlusPublish.data.postStatus;
			}			
			if ( 'undefined' === typeof language ) {
				return api.postStatus;
			}
			return api.postStatus[language];
		},
		dbUpdateStatus: function(status,language){
			var order = {
				action: 'set_status',
				post_id: WPGlobusPlusPublish.data.post_id,
				language: language,
				status: status,
			}
			api.ajax(order).done(function(result) {
				if ( 'ok' === result['result'] ) {}	
			})
			.fail(function(error){})
			.always(function(jqXHR, status){});			
		},
		getComponent: function(props){
			/**
			 * This function will be called from an external script.
			 * @see wpglobus\includes\builders\gutenberg\assets\js\wpglobus-gutenberg.js
			 */
			var useState = wp.element.useState;
			var useEffect = wp.element.useEffect;
			var useRef = wp.element.useRef;
			var el = wp.element.createElement;

			let {
				className = '',
				style = '',
				title = '',
				language = '',
			} = props;

			const [ currentStatus, setCurrentStatus ] = useState(api.getStatus(language));
			const didMount = useRef(false);
			
			useEffect(() => {
				if (didMount.current) {
					api.dbUpdateStatus(currentStatus, language);
				}
				didMount.current = true;
			}, [currentStatus]);
			
			let classes = 'components-pubstatus';
			if ( className !== '' ) {
				classes += ' ' + className;
				if ( api.getStatus(language) === 'draft' ) {
					classes += ' draft';
				}
			}
			
			const handleClick = (evnt) => {
				var languageSelected = evnt.target.dataset.language;
				if ( -1 === evnt.target.className.indexOf('draft') ) {
					evnt.target.classList.add('draft');
					api.setStatus('draft',languageSelected);
					setCurrentStatus('draft');
				} else {
					evnt.target.classList.remove('draft');
					api.setStatus('publish',languageSelected);
					setCurrentStatus('publish');
				}
			}

			return el(
				'div', 
				{
					className: classes,
					style: style,
					onClick: handleClick,
					title: title,
					'data-language': language
				},
				currentStatus
			)			
		},		
	};
	
	WPGlobusPlusPublish = $.extend({}, WPGlobusPlusPublish, api);
	WPGlobusPlusPublish.init();
	
})(jQuery);