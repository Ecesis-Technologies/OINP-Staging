(window.__googlesitekit_webpackJsonp=window.__googlesitekit_webpackJsonp||[]).push([[5],{1:function(t,n){t.exports=googlesitekit.i18n},102:function(t,n,e){"use strict";(function(t){e(51),e(52)}).call(this,e(26))},103:function(t,n,e){"use strict";(function(t){e.d(n,"b",(function(){return a})),e.d(n,"c",(function(){return o})),e.d(n,"a",(function(){return u}));var r=e(202),i=e(84),a=function(n){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};if(Number.isNaN(Number(n)))return"";var a=e.invertColor,o=void 0!==a&&a;return Object(r.a)(t.createElement(i.a,{direction:n>0?"up":"down",invertColor:o}))},o=function(t){var n,e,r,i,a,o,u,c,s,l,f,d,v,g,p;if(void 0!==t)return 1===(null==t||null===(n=t[0])||void 0===n||null===(e=n.data)||void 0===e||null===(r=e.rows)||void 0===r?void 0:r.length)||(null==t||null===(i=t[0])||void 0===i||null===(a=i.data)||void 0===a||null===(o=a.rows)||void 0===o||null===(u=o[0])||void 0===u||null===(c=u.metrics)||void 0===c||null===(s=c[0])||void 0===s||null===(l=s.values)||void 0===l?void 0:l[0])===(null==t||null===(f=t[0])||void 0===f||null===(d=f.data)||void 0===d||null===(v=d.totals)||void 0===v||null===(g=v[0])||void 0===g||null===(p=g.values)||void 0===p?void 0:p[0])},u=function(t,n){return t>0&&n>0?t/n-1:t>0?1:n>0?-1:0}}).call(this,e(3))},104:function(t,n,e){"use strict";(function(t){e.d(n,"a",(function(){return l}));var r=e(6),i=e.n(r),a=e(105),o=e(106);function u(t,n){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);n&&(r=r.filter((function(n){return Object.getOwnPropertyDescriptor(t,n).enumerable}))),e.push.apply(e,r)}return e}function c(t){for(var n=1;n<arguments.length;n++){var e=null!=arguments[n]?arguments[n]:{};n%2?u(Object(e),!0).forEach((function(n){i()(t,n,e[n])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):u(Object(e)).forEach((function(n){Object.defineProperty(t,n,Object.getOwnPropertyDescriptor(e,n))}))}return t}var s={activeModules:[],isAuthenticated:!1,referenceSiteURL:"",trackingEnabled:!1,trackingID:"",userIDHash:"",userRoles:[]};function l(n){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:t,r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:t,i=c(c({},s),n);i.referenceSiteURL&&(i.referenceSiteURL=i.referenceSiteURL.toString().replace(/\/+$/,""));var u=Object(a.a)(i,e);return{enableTracking:function(){i.trackingEnabled=!0},disableTracking:function(){i.trackingEnabled=!1},initializeSnippet:u,isTrackingEnabled:function(){return!!i.trackingEnabled},trackEvent:Object(o.a)(i,e,u,r)}}}).call(this,e(26))},105:function(t,n,e){"use strict";(function(t){e.d(n,"a",(function(){return a}));var r=e(61),i=e(36);function a(n,e){var a,o=Object(r.a)(e);return function(){var e=t.document;if(void 0===a&&(a=!!e.querySelector("script[".concat(i.b,"]"))),!a){var r=e.createElement("script");r.setAttribute(i.b,""),r.async=!0,r.src="https://www.googletagmanager.com/gtag/js?id=".concat(n.trackingID,"&l=").concat(i.a),e.head.appendChild(r),o("js",new Date),o("config",n.trackingID,{send_page_view:n.isSiteKitScreen}),a=!0}}}}).call(this,e(26))},106:function(t,n,e){"use strict";e.d(n,"a",(function(){return v}));var r=e(5),i=e.n(r),a=e(6),o=e.n(a),u=e(15),c=e.n(u),s=e(61),l=e(41);function f(t,n){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);n&&(r=r.filter((function(n){return Object.getOwnPropertyDescriptor(t,n).enumerable}))),e.push.apply(e,r)}return e}function d(t){for(var n=1;n<arguments.length;n++){var e=null!=arguments[n]?arguments[n]:{};n%2?f(Object(e),!0).forEach((function(n){o()(t,n,e[n])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):f(Object(e)).forEach((function(n){Object.defineProperty(t,n,Object.getOwnPropertyDescriptor(e,n))}))}return t}function v(t,n,e,r){var a=Object(s.a)(n);return function(){var n=c()(i.a.mark((function n(o,u,c,s){var f,v,g,p,b,h,m,y,k,w;return i.a.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:if(f=t.activeModules,v=t.referenceSiteURL,g=t.trackingEnabled,p=t.trackingID,b=t.userIDHash,h=t.userRoles,m=void 0===h?[]:h,y=t.isAuthenticated,k=t.pluginVersion,g){n.next=3;break}return n.abrupt("return");case 3:return e(),w={send_to:p,event_category:o,event_label:c,value:s,dimension1:v,dimension2:m.join(","),dimension3:b,dimension4:k||"",dimension5:Array.from(l.a).join(","),dimension6:f.join(","),dimension7:y?"1":"0"},n.abrupt("return",new Promise((function(t){var n,e,i=setTimeout((function(){r.console.warn('Tracking event "'.concat(u,'" (category "').concat(o,'") took too long to fire.')),t()}),1e3),c=function(){clearTimeout(i),t()};a("event",u,d(d({},w),{},{event_callback:c})),(null===(n=r._gaUserPrefs)||void 0===n||null===(e=n.ioo)||void 0===e?void 0:e.call(n))&&c()})));case 6:case"end":return n.stop()}}),n)})));return function(t,e,r,i){return n.apply(this,arguments)}}()}},279:function(t,n,e){"use strict";(function(t){var r=e(62),i=e.n(r),a=e(280),o=t._googlesitekitAPIFetchData||{},u=o.nonce,c=o.nonceEndpoint,s=o.preloadedData,l=o.rootURL;i.a.nonceEndpoint=c,i.a.nonceMiddleware=i.a.createNonceMiddleware(u),i.a.rootURLMiddleware=i.a.createRootURLMiddleware(l),i.a.preloadingMiddleware=Object(a.a)(s),i.a.use(i.a.nonceMiddleware),i.a.use(i.a.mediaUploadMiddleware),i.a.use(i.a.rootURLMiddleware),i.a.use(i.a.preloadingMiddleware),n.default=i.a}).call(this,e(26))},280:function(t,n,e){"use strict";var r=e(265);n.a=function(t){var n=Object.keys(t).reduce((function(n,e){return n[Object(r.getStablePath)(e)]=t[e],n}),{}),e=!1;return function(t,i){if(e)return i(t);setTimeout((function(){e=!0}),1e3);var a=t.parse,o=void 0===a||a,u=t.path;if("string"==typeof t.path){var c,s=(null===(c=t.method)||void 0===c?void 0:c.toUpperCase())||"GET",l=Object(r.getStablePath)(u);if(o&&"GET"===s&&n[l]){var f=Promise.resolve(n[l].body);return delete n[l],f}if("OPTIONS"===s&&n[s]&&n[s][l]){var d=Promise.resolve(n[s][l]);return delete n[s][l],d}}return i(t)}}},34:function(t,n,e){"use strict";(function(t){e.d(n,"a",(function(){return y})),e.d(n,"b",(function(){return m}));var r=e(104),i=t._googlesitekitTrackingData||{},a=i.activeModules,o=void 0===a?[]:a,u=i.isSiteKitScreen,c=i.trackingEnabled,s=i.trackingID,l=i.referenceSiteURL,f=i.userIDHash,d=i.isAuthenticated,v={activeModules:o,trackingEnabled:c,trackingID:s,referenceSiteURL:l,userIDHash:f,isSiteKitScreen:u,userRoles:i.userRoles,isAuthenticated:d,pluginVersion:"1.111.1"},g=Object(r.a)(v),p=g.enableTracking,b=g.disableTracking,h=(g.isTrackingEnabled,g.initializeSnippet),m=g.trackEvent;function y(t){t?p():b()}u&&c&&h()}).call(this,e(26))},36:function(t,n,e){"use strict";e.d(n,"a",(function(){return r})),e.d(n,"b",(function(){return i}));var r="_googlesitekitDataLayer",i="data-googlesitekit-gtag"},39:function(t,n,e){"use strict";(function(t){e.d(n,"a",(function(){return f})),e.d(n,"d",(function(){return m})),e.d(n,"f",(function(){return y})),e.d(n,"c",(function(){return k})),e.d(n,"e",(function(){return w})),e.d(n,"b",(function(){return O}));var r=e(5),i=e.n(r),a=e(15),o=e.n(a),u=(e(29),e(7));function c(t,n){var e="undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(!e){if(Array.isArray(t)||(e=function(t,n){if(!t)return;if("string"==typeof t)return s(t,n);var e=Object.prototype.toString.call(t).slice(8,-1);"Object"===e&&t.constructor&&(e=t.constructor.name);if("Map"===e||"Set"===e)return Array.from(t);if("Arguments"===e||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(e))return s(t,n)}(t))||n&&t&&"number"==typeof t.length){e&&(t=e);var r=0,i=function(){};return{s:i,n:function(){return r>=t.length?{done:!0}:{done:!1,value:t[r++]}},e:function(t){throw t},f:i}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var a,o=!0,u=!1;return{s:function(){e=e.call(t)},n:function(){var t=e.next();return o=t.done,t},e:function(t){u=!0,a=t},f:function(){try{o||null==e.return||e.return()}finally{if(u)throw a}}}}function s(t,n){(null==n||n>t.length)&&(n=t.length);for(var e=0,r=new Array(n);e<n;e++)r[e]=t[e];return r}var l,f="googlesitekit_",d="".concat(f).concat("1.111.1","_").concat(t._googlesitekitBaseData.storagePrefix,"_"),v=["sessionStorage","localStorage"],g=[].concat(v),p=function(){var n=o()(i.a.mark((function n(e){var r,a;return i.a.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:if(r=t[e]){n.next=3;break}return n.abrupt("return",!1);case 3:return n.prev=3,a="__storage_test__",r.setItem(a,a),r.removeItem(a),n.abrupt("return",!0);case 10:return n.prev=10,n.t0=n.catch(3),n.abrupt("return",n.t0 instanceof DOMException&&(22===n.t0.code||1014===n.t0.code||"QuotaExceededError"===n.t0.name||"NS_ERROR_DOM_QUOTA_REACHED"===n.t0.name)&&0!==r.length);case 13:case"end":return n.stop()}}),n,null,[[3,10]])})));return function(t){return n.apply(this,arguments)}}();function b(){return h.apply(this,arguments)}function h(){return(h=o()(i.a.mark((function n(){var e,r,a;return i.a.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:if(void 0===l){n.next=2;break}return n.abrupt("return",l);case 2:e=c(g),n.prev=3,e.s();case 5:if((r=e.n()).done){n.next=15;break}if(a=r.value,!l){n.next=9;break}return n.abrupt("continue",13);case 9:return n.next=11,p(a);case 11:if(!n.sent){n.next=13;break}l=t[a];case 13:n.next=5;break;case 15:n.next=20;break;case 17:n.prev=17,n.t0=n.catch(3),e.e(n.t0);case 20:return n.prev=20,e.f(),n.finish(20);case 23:return void 0===l&&(l=null),n.abrupt("return",l);case 25:case"end":return n.stop()}}),n,null,[[3,17,20,23]])})))).apply(this,arguments)}var m=function(){var t=o()(i.a.mark((function t(n){var e,r,a,o,u,c,s;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,b();case 2:if(!(e=t.sent)){t.next=10;break}if(!(r=e.getItem("".concat(d).concat(n)))){t.next=10;break}if(a=JSON.parse(r),o=a.timestamp,u=a.ttl,c=a.value,s=a.isError,!o||u&&!(Math.round(Date.now()/1e3)-o<u)){t.next=10;break}return t.abrupt("return",{cacheHit:!0,value:c,isError:s});case 10:return t.abrupt("return",{cacheHit:!1,value:void 0});case 11:case"end":return t.stop()}}),t)})));return function(n){return t.apply(this,arguments)}}(),y=function(){var n=o()(i.a.mark((function n(e,r){var a,o,c,s,l,f,v,g,p=arguments;return i.a.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return a=p.length>2&&void 0!==p[2]?p[2]:{},o=a.ttl,c=void 0===o?u.b:o,s=a.timestamp,l=void 0===s?Math.round(Date.now()/1e3):s,f=a.isError,v=void 0!==f&&f,n.next=3,b();case 3:if(!(g=n.sent)){n.next=14;break}return n.prev=5,g.setItem("".concat(d).concat(e),JSON.stringify({timestamp:l,ttl:c,value:r,isError:v})),n.abrupt("return",!0);case 10:return n.prev=10,n.t0=n.catch(5),t.console.warn("Encountered an unexpected storage error:",n.t0),n.abrupt("return",!1);case 14:return n.abrupt("return",!1);case 15:case"end":return n.stop()}}),n,null,[[5,10]])})));return function(t,e){return n.apply(this,arguments)}}(),k=function(){var n=o()(i.a.mark((function n(e){var r,a;return i.a.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return n.next=2,b();case 2:if(!(r=n.sent)){n.next=14;break}return n.prev=4,a=e.startsWith(f)?e:"".concat(d).concat(e),r.removeItem(a),n.abrupt("return",!0);case 10:return n.prev=10,n.t0=n.catch(4),t.console.warn("Encountered an unexpected storage error:",n.t0),n.abrupt("return",!1);case 14:return n.abrupt("return",!1);case 15:case"end":return n.stop()}}),n,null,[[4,10]])})));return function(t){return n.apply(this,arguments)}}(),w=function(){var n=o()(i.a.mark((function n(){var e,r,a,o;return i.a.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return n.next=2,b();case 2:if(!(e=n.sent)){n.next=14;break}for(n.prev=4,r=[],a=0;a<e.length;a++)0===(o=e.key(a)).indexOf(f)&&r.push(o);return n.abrupt("return",r);case 10:return n.prev=10,n.t0=n.catch(4),t.console.warn("Encountered an unexpected storage error:",n.t0),n.abrupt("return",[]);case 14:return n.abrupt("return",[]);case 15:case"end":return n.stop()}}),n,null,[[4,10]])})));return function(){return n.apply(this,arguments)}}(),O=function(){var t=o()(i.a.mark((function t(){var n,e,r,a;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,b();case 2:if(!t.sent){t.next=25;break}return t.next=6,w();case 6:n=t.sent,e=c(n),t.prev=8,e.s();case 10:if((r=e.n()).done){t.next=16;break}return a=r.value,t.next=14,k(a);case 14:t.next=10;break;case 16:t.next=21;break;case 18:t.prev=18,t.t0=t.catch(8),e.e(t.t0);case 21:return t.prev=21,e.f(),t.finish(21);case 24:return t.abrupt("return",!0);case 25:return t.abrupt("return",!1);case 26:case"end":return t.stop()}}),t,null,[[8,18,21,24]])})));return function(){return t.apply(this,arguments)}}()}).call(this,e(26))},40:function(t,n,e){"use strict";e.d(n,"a",(function(){return s}));var r=e(16),i=e.n(r),a=e(11),o=e.n(a),u=e(47),c=e(53),s=function(t){o()(Object(c.a)(t),u.e);var n=t.split("-"),e=i()(n,3),r=e[0],a=e[1],s=e[2];return new Date(r,a-1,s)}},41:function(t,n,e){"use strict";(function(t){var r,i;e.d(n,"a",(function(){return a})),e.d(n,"b",(function(){return o}));var a=new Set((null===(r=t)||void 0===r||null===(i=r._googlesitekitBaseData)||void 0===i?void 0:i.enabledFeatures)||[]),o=function(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:a;return n instanceof Set&&n.has(t)}}).call(this,e(26))},47:function(t,n,e){"use strict";e.d(n,"c",(function(){return r})),e.d(n,"e",(function(){return i})),e.d(n,"d",(function(){return a})),e.d(n,"b",(function(){return o})),e.d(n,"a",(function(){return u})),e.d(n,"f",(function(){return c}));var r="Date param must construct to a valid date instance or be a valid date instance itself.",i="Invalid dateString parameter, it must be a string.",a='Invalid date range, it must be a string with the format "last-x-days".',o=3600,u=86400,c=604800},48:function(t,n,e){"use strict";e.d(n,"a",(function(){return r}));var r=function(t){return t instanceof Date&&!isNaN(t)}},49:function(t,n,e){"use strict";e.d(n,"a",(function(){return i})),e.d(n,"f",(function(){return u})),e.d(n,"e",(function(){return c})),e.d(n,"c",(function(){return s})),e.d(n,"d",(function(){return l})),e.d(n,"b",(function(){return f}));e(14);var r=e(1),i="missing_required_scopes",a="insufficientPermissions",o="forbidden";function u(t){return(null==t?void 0:t.code)===i}function c(t){var n;return[a,o].includes(null==t||null===(n=t.data)||void 0===n?void 0:n.reason)}function s(t){var n;return!!(null==t||null===(n=t.data)||void 0===n?void 0:n.reconnectURL)}function l(t,n){return!(!(null==n?void 0:n.storeName)||c(t)||u(t)||s(t))}function f(t){return"internal_server_error"===(null==t?void 0:t.code)?Object(r.__)("There was a critical error on this website while fetching data.","google-site-kit"):"invalid_json"===(null==t?void 0:t.code)?Object(r.__)("The server provided an invalid response.","google-site-kit"):null==t?void 0:t.message}},53:function(t,n,e){"use strict";e.d(n,"a",(function(){return i}));var r=e(48),i=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",n="string"==typeof t;if(!n)return!1;var e=t.split("-");return 3===e.length&&Object(r.a)(new Date(t))}},61:function(t,n,e){"use strict";e.d(n,"a",(function(){return i}));var r=e(36);function i(t){return function(){t[r.a]=t[r.a]||[],t[r.a].push(arguments)}}},629:function(t,n,e){"use strict";(function(t){var r=e(5),i=e.n(r),a=e(15),o=e.n(a),u=e(11),c=e.n(u),s=e(279),l=e(276),f=e(39),d=e(7),v=e(49),g=e(711),p=e(8),b=!0,h=function(t,n,e){var r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:{},i=[t,n,e].filter((function(t){return!!t&&t.length}));return 3===i.length&&r&&r.constructor===Object&&Object.keys(r).length&&i.push(Object(d.z)(r)),i.join("::")},m=function(n){var e,r,i,a=null===(e=t.googlesitekit)||void 0===e||null===(r=e.data)||void 0===r||null===(i=r.dispatch)||void 0===i?void 0:i.call(r,p.a);a&&(Object(v.f)(n)?a.setPermissionScopeError(n):Object(v.c)(n)&&a.setAuthError(n))},y=function(){var n=o()(i.a.mark((function n(e,r,a){var o,u,v,p,b,y,k,O,j,_,x,S,D,P,E,N,A,T=arguments;return i.a.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:if(o=T.length>3&&void 0!==T[3]?T[3]:{},u=o.bodyParams,v=o.cacheTTL,p=void 0===v?d.b:v,b=o.method,y=void 0===b?"GET":b,k=o.queryParams,O=o.useCache,j=void 0===O?void 0:O,_=o.signal,c()(e,"`type` argument for requests is required."),c()(r,"`identifier` argument for requests is required."),c()(a,"`datapoint` argument for requests is required."),x="GET"===y&&(void 0!==j?j:w()),S=h(e,r,a,k),!x){n.next=18;break}return n.next=9,Object(f.d)(S);case 9:if(D=n.sent,P=D.cacheHit,E=D.value,!D.isError){n.next=16;break}throw m(E),E;case 16:if(!P){n.next=18;break}return n.abrupt("return",E);case 18:return n.prev=18,n.next=21,Object(s.default)({data:u,method:y,signal:_,path:Object(l.a)("/google-site-kit/v1/".concat(e,"/").concat(r,"/data/").concat(a),k)});case 21:if(N=n.sent,!x){n.next=25;break}return n.next=25,Object(f.f)(S,N,{ttl:p});case 25:return n.abrupt("return",N);case 28:if(n.prev=28,n.t0=n.catch(18),!(null==_?void 0:_.aborted)){n.next=32;break}throw n.t0;case 32:if(!(null===n.t0||void 0===n.t0||null===(A=n.t0.data)||void 0===A?void 0:A.cacheTTL)){n.next=35;break}return n.next=35,Object(f.f)(S,n.t0,{ttl:n.t0.data.cacheTTL,isError:!0});case 35:throw Object(g.a)({method:y,datapoint:a,type:e,identifier:r,error:n.t0}),m(n.t0),t.console.error("Google Site Kit API Error","method:".concat(y),"datapoint:".concat(a),"type:".concat(e),"identifier:".concat(r),'error:"'.concat(n.t0.message,'"')),n.t0;case 39:case"end":return n.stop()}}),n,null,[[18,28]])})));return function(t,e,r){return n.apply(this,arguments)}}(),k=function(){var t=o()(i.a.mark((function t(n,e,r,a){var o,u,c,s,l,f,d,v=arguments;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return o=v.length>4&&void 0!==v[4]?v[4]:{},u=o.method,c=void 0===u?"POST":u,s=o.queryParams,l=void 0===s?{}:s,f=o.signal,t.next=3,y(n,e,r,{bodyParams:{data:a},method:c,queryParams:l,useCache:!1,signal:f});case 3:return d=t.sent,t.next=6,O(n,e,r);case 6:return t.abrupt("return",d);case 7:case"end":return t.stop()}}),t)})));return function(n,e,r,i){return t.apply(this,arguments)}}(),w=function(){return b},O=function(){var t=o()(i.a.mark((function t(n,e,r){var a;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return a=h(n,e,r),t.next=3,Object(f.e)();case 3:t.sent.forEach((function(t){new RegExp("^".concat(f.a,"([^_]+_){2}").concat(a)).test(t)&&Object(f.c)(t)}));case 5:case"end":return t.stop()}}),t)})));return function(n,e,r){return t.apply(this,arguments)}}(),j={invalidateCache:O,get:function(t,n,e,r){var i=arguments.length>4&&void 0!==arguments[4]?arguments[4]:{},a=i.cacheTTL,o=void 0===a?d.b:a,u=i.useCache,c=void 0===u?void 0:u,s=i.signal;return y(t,n,e,{cacheTTL:o,queryParams:r,useCache:c,signal:s})},set:k,setUsingCache:function(t){return b=!!t},usingCache:w};n.a=j}).call(this,e(26))},66:function(t,n,e){"use strict";e.d(n,"d",(function(){return r.e})),e.d(n,"c",(function(){return r.d})),e.d(n,"b",(function(){return r.b})),e.d(n,"a",(function(){return r.a})),e.d(n,"e",(function(){return r.f})),e.d(n,"g",(function(){return u})),e.d(n,"h",(function(){return s})),e.d(n,"i",(function(){return l})),e.d(n,"j",(function(){return f.a})),e.d(n,"f",(function(){return v})),e.d(n,"k",(function(){return c.a}));var r=e(47),i=e(11),a=e.n(i),o=e(48),u=function(t){a()(Object(o.a)(t),r.c);var n="".concat(t.getMonth()+1),e="".concat(t.getDate());return[t.getFullYear(),n.length<2?"0".concat(n):n,e.length<2?"0".concat(e):e].join("-")},c=e(40),s=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",n=arguments.length>1?arguments[1]:void 0,e=Object(c.a)(t);return e.setDate(e.getDate()-n),u(e)},l=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",n=t.split("-");return 3===n.length&&"last"===n[0]&&!Number.isNaN(n[1])&&!Number.isNaN(parseFloat(n[1]))&&"days"===n[2]},f=e(53);var d=e(1);function v(){var t=function(t){return Object(d.sprintf)(
/* translators: %s: number of days */
Object(d._n)("Last %s day","Last %s days",t,"google-site-kit"),t)};return{"last-7-days":{slug:"last-7-days",label:t(7),days:7},"last-14-days":{slug:"last-14-days",label:t(14),days:14},"last-28-days":{slug:"last-28-days",label:t(28),days:28},"last-90-days":{slug:"last-90-days",label:t(90),days:90}}}},67:function(t,n,e){"use strict";e.d(n,"b",(function(){return i})),e.d(n,"a",(function(){return a})),e.d(n,"c",(function(){return o})),e.d(n,"d",(function(){return u}));var r=e(96);function i(t){try{return new URL(t).pathname}catch(t){}return null}function a(t,n){try{return new URL(n,t).href}catch(t){}return("string"==typeof t?t:"")+("string"==typeof n?n:"")}function o(t){return"string"!=typeof t?t:t.replace(/^https?:\/\/(www\.)?/i,"").replace(/\/$/,"")}function u(t,n){if(!Object(r.a)(t))return t;if(t.length<=n)return t;var e=new URL(t),i=t.replace(e.origin,"");if(i.length<n)return i;var a=i.length-Math.floor(n)+1;return"…"+i.substr(a)}},7:function(t,n,e){"use strict";e.d(n,"A",(function(){return i.b})),e.d(n,"x",(function(){return a.a})),e.d(n,"B",(function(){return a.b})),e.d(n,"z",(function(){return l})),e.d(n,"h",(function(){return f.a})),e.d(n,"v",(function(){return f.d})),e.d(n,"w",(function(){return f.e})),e.d(n,"s",(function(){return f.c})),e.d(n,"m",(function(){return f.b})),e.d(n,"t",(function(){return p})),e.d(n,"f",(function(){return b})),e.d(n,"b",(function(){return h.b})),e.d(n,"a",(function(){return h.a})),e.d(n,"c",(function(){return h.e})),e.d(n,"k",(function(){return h.g})),e.d(n,"i",(function(){return h.f})),e.d(n,"y",(function(){return h.k})),e.d(n,"j",(function(){return m.b})),e.d(n,"q",(function(){return m.c})),e.d(n,"e",(function(){return m.a})),e.d(n,"o",(function(){return y.b})),e.d(n,"l",(function(){return y.a})),e.d(n,"u",(function(){return y.c})),e.d(n,"r",(function(){return k})),e.d(n,"p",(function(){return w})),e.d(n,"n",(function(){return O})),e.d(n,"d",(function(){return j})),e.d(n,"C",(function(){return _})),e.d(n,"g",(function(){return x}));var r=e(14),i=e(34),a=e(77),o=e(33),u=e.n(o),c=e(98),s=e.n(c),l=function(t){return s()(JSON.stringify(function t(n){var e={};return Object.keys(n).sort().forEach((function(r){var i=n[r];i&&"object"===u()(i)&&!Array.isArray(i)&&(i=t(i)),e[r]=i})),e}(t)))};e(102);var f=e(73);function d(t){return t.replace(new RegExp("\\[([^\\]]+)\\]\\((https?://[^/]+\\.\\w+/?.*?)\\)","gi"),'<a href="$2" target="_blank" rel="noopener noreferrer">$1</a>')}function v(t){return"<p>".concat(t.replace(/\n{2,}/g,"</p><p>"),"</p>")}function g(t){return t.replace(/\n/gi,"<br>")}function p(t){for(var n=t,e=0,r=[d,v,g];e<r.length;e++){n=(0,r[e])(n)}return n}var b=function(t){return t=parseFloat(t),isNaN(t)||0===t?[0,0,0,0]:[Math.floor(t/60/60),Math.floor(t/60%60),Math.floor(t%60),Math.floor(1e3*t)-1e3*Math.floor(t)]},h=e(66),m=e(103),y=e(67);function k(t){var n=parseFloat(t)||0;return!!Number.isInteger(n)&&n>0}function w(t){if("number"==typeof t)return!0;var n=(t||"").toString();return!!n&&!isNaN(n)}var O=function(t){switch(t){case"minute":return 60;case"hour":return 3600;case"day":return 86400;case"week":return 604800;case"month":return 2592e3;case"year":return 31536e3}};function j(t,n){var e=function(t){return"0"===t||0===t};if(e(t)&&e(n))return 0;if(e(t)||Number.isNaN(t))return null;var r=(n-t)/t;return Number.isNaN(r)||!Number.isFinite(r)?null:r}var _=function(t){try{return JSON.parse(t)&&!!t}catch(t){return!1}},x=function(t){if(!t)return"";var n=t.replace(/&#(\d+);/g,(function(t,n){return String.fromCharCode(n)})).replace(/(\\)/g,"");return Object(r.unescape)(n)}},711:function(t,n,e){"use strict";e.d(n,"a",(function(){return s}));var r=e(5),i=e.n(r),a=e(15),o=e.n(a),u=e(7),c=["fetch_error"];function s(t){return l.apply(this,arguments)}function l(){return(l=o()(i.a.mark((function t(n){var e,r,a,o,s,l,f,d;return i.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:if(a=n.method,o=n.type,s=n.identifier,l=n.datapoint,(f=n.error)&&!c.includes(null==f?void 0:f.code)){t.next=3;break}return t.abrupt("return");case 3:return d="code: ".concat(f.code),(null===(e=f.data)||void 0===e?void 0:e.reason)&&(d+=", reason: ".concat(f.data.reason)),t.next=7,Object(u.A)("api_error","".concat(a,":").concat(o,"/").concat(s,"/data/").concat(l),"".concat(f.message," (").concat(d,")"),(null===(r=f.data)||void 0===r?void 0:r.status)||f.code);case 7:case"end":return t.stop()}}),t)})))).apply(this,arguments)}},73:function(t,n,e){"use strict";(function(t){e.d(n,"a",(function(){return j})),e.d(n,"d",(function(){return _})),e.d(n,"e",(function(){return S})),e.d(n,"c",(function(){return D})),e.d(n,"b",(function(){return P}));var r=e(16),i=e.n(r),a=e(33),o=e.n(a),u=e(6),c=e.n(u),s=e(25),l=e.n(s),f=e(14),d=e(78),v=e.n(d),g=e(1);function p(t,n){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);n&&(r=r.filter((function(n){return Object.getOwnPropertyDescriptor(t,n).enumerable}))),e.push.apply(e,r)}return e}function b(t){for(var n=1;n<arguments.length;n++){var e=null!=arguments[n]?arguments[n]:{};n%2?p(Object(e),!0).forEach((function(n){c()(t,n,e[n])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):p(Object(e)).forEach((function(n){Object.defineProperty(t,n,Object.getOwnPropertyDescriptor(e,n))}))}return t}var h=function(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},e=k(t,n),r=e.formatUnit,i=e.formatDecimal;try{return r()}catch(t){return i()}},m=function(t){var n=y(t),e=n.hours,r=n.minutes,i=n.seconds;return i=("0"+i).slice(-2),r=("0"+r).slice(-2),"00"===(e=("0"+e).slice(-2))?"".concat(r,":").concat(i):"".concat(e,":").concat(r,":").concat(i)},y=function(t){return t=parseInt(t,10),Number.isNaN(t)&&(t=0),{hours:Math.floor(t/60/60),minutes:Math.floor(t/60%60),seconds:Math.floor(t%60)}},k=function(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},e=y(t),r=e.hours,i=e.minutes,a=e.seconds;return{hours:r,minutes:i,seconds:a,formatUnit:function(){var e=n.unitDisplay,o=b(b({unitDisplay:void 0===e?"short":e},l()(n,["unitDisplay"])),{},{style:"unit"});return 0===t?S(a,b(b({},o),{},{unit:"second"})):Object(g.sprintf)(
/* translators: 1: formatted seconds, 2: formatted minutes, 3: formatted hours */
Object(g._x)("%3$s %2$s %1$s","duration of time: hh mm ss","google-site-kit"),a?S(a,b(b({},o),{},{unit:"second"})):"",i?S(i,b(b({},o),{},{unit:"minute"})):"",r?S(r,b(b({},o),{},{unit:"hour"})):"").trim()},formatDecimal:function(){var n=Object(g.sprintf)(// translators: %s: number of seconds with "s" as the abbreviated unit.
Object(g.__)("%ds","google-site-kit"),a);if(0===t)return n;var e=Object(g.sprintf)(// translators: %s: number of minutes with "m" as the abbreviated unit.
Object(g.__)("%dm","google-site-kit"),i),o=Object(g.sprintf)(// translators: %s: number of hours with "h" as the abbreviated unit.
Object(g.__)("%dh","google-site-kit"),r);return Object(g.sprintf)(
/* translators: 1: formatted seconds, 2: formatted minutes, 3: formatted hours */
Object(g._x)("%3$s %2$s %1$s","duration of time: hh mm ss","google-site-kit"),a?n:"",i?e:"",r?o:"").trim()}}},w=function(t){return 1e6<=t?Math.round(t/1e5)/10:1e4<=t?Math.round(t/1e3):1e3<=t?Math.round(t/100)/10:t},O=function(t){var n={minimumFractionDigits:1,maximumFractionDigits:1};return 1e6<=t?Object(g.sprintf)(// translators: %s: an abbreviated number in millions.
Object(g.__)("%sM","google-site-kit"),S(w(t),t%10==0?{}:n)):1e4<=t?Object(g.sprintf)(// translators: %s: an abbreviated number in thousands.
Object(g.__)("%sK","google-site-kit"),S(w(t))):1e3<=t?Object(g.sprintf)(// translators: %s: an abbreviated number in thousands.
Object(g.__)("%sK","google-site-kit"),S(w(t),t%10==0?{}:n)):S(t,{signDisplay:"never",maximumFractionDigits:1})};function j(t){var n={};return"%"===t?n={style:"percent",maximumFractionDigits:2}:"s"===t?n={style:"duration",unitDisplay:"narrow"}:t&&"string"==typeof t?n={style:"currency",currency:t}:Object(f.isPlainObject)(t)&&(n=b({},t)),n}function _(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};t=Object(f.isFinite)(t)?t:Number(t),Object(f.isFinite)(t)||(console.warn("Invalid number",t,o()(t)),t=0);var e=j(n),r=e.style,i=void 0===r?"metric":r;return"metric"===i?O(t):"duration"===i?h(t,e):"durationISO"===i?m(t):S(t,e)}var x=v()(console.warn),S=function(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},e=n.locale,r=void 0===e?P():e,a=l()(n,["locale"]);try{return new Intl.NumberFormat(r,a).format(t)}catch(n){x("Site Kit numberFormat error: Intl.NumberFormat( ".concat(JSON.stringify(r),", ").concat(JSON.stringify(a)," ).format( ").concat(o()(t)," )"),n.message)}for(var u={currencyDisplay:"narrow",currencySign:"accounting",style:"unit"},c=["signDisplay","compactDisplay"],s={},f=0,d=Object.entries(a);f<d.length;f++){var v=i()(d[f],2),g=v[0],p=v[1];u[g]&&p===u[g]||(c.includes(g)||(s[g]=p))}try{return new Intl.NumberFormat(r,s).format(t)}catch(n){return new Intl.NumberFormat(r).format(t)}},D=function(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},e=n.locale,r=void 0===e?P():e,i=n.style,a=void 0===i?"long":i,o=n.type,u=void 0===o?"conjunction":o;if(Intl.ListFormat){var c=new Intl.ListFormat(r,{style:a,type:u});return c.format(t)}
/* translators: used between list items, there is a space after the comma. */var s=Object(g.__)(", ","google-site-kit");return t.join(s)},P=function(){var n=arguments.length>0&&void 0!==arguments[0]?arguments[0]:t,e=Object(f.get)(n,["_googlesitekitLegacyData","locale"]);if(e){var r=e.match(/^(\w{2})?(_)?(\w{2})/);if(r&&r[0])return r[0].replace(/_/g,"-")}return n.navigator.language}}).call(this,e(26))},77:function(t,n,e){"use strict";e.d(n,"a",(function(){return o})),e.d(n,"b",(function(){return u}));var r=e(33),i=e.n(r),a=e(85),o=function(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return{__html:a.a.sanitize(t,n)}};function u(t){var n,e="object"===i()(t)?t.toString():t;return null==e||null===(n=e.replace)||void 0===n?void 0:n.call(e,/\/+$/,"")}},8:function(t,n,e){"use strict";e.d(n,"a",(function(){return r})),e.d(n,"b",(function(){return i})),e.d(n,"c",(function(){return a})),e.d(n,"t",(function(){return o})),e.d(n,"y",(function(){return u})),e.d(n,"A",(function(){return c})),e.d(n,"w",(function(){return s})),e.d(n,"x",(function(){return l})),e.d(n,"v",(function(){return f})),e.d(n,"u",(function(){return d})),e.d(n,"z",(function(){return v})),e.d(n,"d",(function(){return g})),e.d(n,"e",(function(){return p})),e.d(n,"f",(function(){return b})),e.d(n,"g",(function(){return h})),e.d(n,"h",(function(){return m})),e.d(n,"j",(function(){return y})),e.d(n,"k",(function(){return k})),e.d(n,"l",(function(){return w})),e.d(n,"m",(function(){return O})),e.d(n,"n",(function(){return j})),e.d(n,"p",(function(){return _})),e.d(n,"i",(function(){return x})),e.d(n,"r",(function(){return S})),e.d(n,"o",(function(){return D})),e.d(n,"s",(function(){return P})),e.d(n,"q",(function(){return E})),e.d(n,"C",(function(){return N})),e.d(n,"B",(function(){return A}));var r="core/user",i="connected_url_mismatch",a="__global",o="googlesitekit_authenticate",u="googlesitekit_setup",c="googlesitekit_view_dashboard",s="googlesitekit_manage_options",l="googlesitekit_read_shared_module_data",f="googlesitekit_manage_module_sharing_options",d="googlesitekit_delegate_module_sharing_management",v="googlesitekit_update_plugins",g="kmAnalyticsAdSenseTopEarningContent",p="kmAnalyticsEngagedTrafficSource",b="kmAnalyticsLeastEngagingPages",h="kmAnalyticsLoyalVisitors",m="kmAnalyticsNewVisitors",y="kmAnalyticsPopularContent",k="kmAnalyticsPopularProducts",w="kmAnalyticsTopCities",O="kmAnalyticsTopConvertingTrafficSource",j="kmAnalyticsTopCountries",_="kmAnalyticsTopTrafficSource",x="kmAnalyticsPagesPerVisit",S="kmAnalyticsVisitLength",D="kmAnalyticsTopReturningVisitorPages",P="kmSearchConsolePopularKeywords",E="kmAnalyticsVisitsPerVisitor",N=[g,p,b,h,m,y,k,w,O,j,_,x,S,D,E],A=[].concat(N,[P])},84:function(t,n,e){"use strict";(function(t){var r=e(0),i=e.n(r),a=e(12),o=e.n(a);function ChangeArrow(n){var e=n.direction,r=n.invertColor,i=n.width,a=n.height;return t.createElement("svg",{className:o()("googlesitekit-change-arrow","googlesitekit-change-arrow--".concat(e),{"googlesitekit-change-arrow--inverted-color":r}),width:i,height:a,viewBox:"0 0 10 10",fill:"none",xmlns:"http://www.w3.org/2000/svg"},t.createElement("path",{d:"M5.625 10L5.625 2.375L9.125 5.875L10 5L5 -1.76555e-07L-2.7055e-07 5L0.875 5.875L4.375 2.375L4.375 10L5.625 10Z",fill:"currentColor"}))}ChangeArrow.propTypes={direction:i.a.string,invertColor:i.a.bool,width:i.a.number,height:i.a.number},ChangeArrow.defaultProps={direction:"up",invertColor:!1,width:9,height:9},n.a=ChangeArrow}).call(this,e(3))},85:function(t,n,e){"use strict";(function(t){e.d(n,"a",(function(){return i}));var r=e(136),i=e.n(r)()(t)}).call(this,e(26))},945:function(t,n,e){"use strict";e.r(n),function(t){var r=e(629);void 0===t.googlesitekit&&(t.googlesitekit={}),void 0===t.googlesitekit.api&&(t.googlesitekit.api=r.a),n.default=r.a}.call(this,e(26))}},[[945,1,0]]]);