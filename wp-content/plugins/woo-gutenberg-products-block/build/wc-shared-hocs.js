this.wc=this.wc||{},this.wc.wcSharedHocs=function(t){var n={};function e(r){if(n[r])return n[r].exports;var o=n[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,e),o.l=!0,o.exports}return e.m=t,e.c=n,e.d=function(t,n,r){e.o(t,n)||Object.defineProperty(t,n,{enumerable:!0,get:r})},e.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},e.t=function(t,n){if(1&n&&(t=e(t)),8&n)return t;if(4&n&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(e.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&n&&"string"!=typeof t)for(var o in t)e.d(r,o,function(n){return t[n]}.bind(null,o));return r},e.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,"a",n),n},e.o=function(t,n){return Object.prototype.hasOwnProperty.call(t,n)},e.p="",e(e.s=57)}({0:function(t,n){!function(){t.exports=this.wp.element}()},13:function(t,n,e){var r=e(22),o=e(23),u=e(19),c=e(24);t.exports=function(t,n){return r(t)||o(t,n)||u(t,n)||c()}},17:function(t,n){function e(){return t.exports=e=Object.assign||function(t){for(var n=1;n<arguments.length;n++){var e=arguments[n];for(var r in e)Object.prototype.hasOwnProperty.call(e,r)&&(t[r]=e[r])}return t},e.apply(this,arguments)}t.exports=e},19:function(t,n,e){var r=e(20);t.exports=function(t,n){if(t){if("string"==typeof t)return r(t,n);var e=Object.prototype.toString.call(t).slice(8,-1);return"Object"===e&&t.constructor&&(e=t.constructor.name),"Map"===e||"Set"===e?Array.from(t):"Arguments"===e||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(e)?r(t,n):void 0}}},20:function(t,n){t.exports=function(t,n){(null==n||n>t.length)&&(n=t.length);for(var e=0,r=new Array(n);e<n;e++)r[e]=t[e];return r}},22:function(t,n){t.exports=function(t){if(Array.isArray(t))return t}},23:function(t,n){t.exports=function(t,n){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(t)){var e=[],r=!0,o=!1,u=void 0;try{for(var c,i=t[Symbol.iterator]();!(r=(c=i.next()).done)&&(e.push(c.value),!n||e.length!==n);r=!0);}catch(t){o=!0,u=t}finally{try{r||null==i.return||i.return()}finally{if(o)throw u}}return e}}},24:function(t,n){t.exports=function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}},29:function(t,n){!function(){t.exports=this.wc.wcSharedContext}()},3:function(t,n){!function(){t.exports=this.regeneratorRuntime}()},34:function(t,n){function e(t,n,e,r,o,u,c){try{var i=t[u](c),a=i.value}catch(t){return void e(t)}i.done?n(a):Promise.resolve(a).then(r,o)}t.exports=function(t){return function(){var n=this,r=arguments;return new Promise((function(o,u){var c=t.apply(n,r);function i(t){e(c,o,u,i,a,"next",t)}function a(t){e(c,o,u,i,a,"throw",t)}i(void 0)}))}}},57:function(t,n,e){"use strict";e.r(n),e.d(n,"withProductDataContext",(function(){return v}));var r=e(17),o=e.n(r),u=e(3),c=e.n(u),i=e(34),a=e.n(i),f=e(13),l=e.n(f),s=e(0),p=e(8),d=e.n(p),y=e(29),b=function(t){var n=t.productId,e=t.OriginalComponent,r=Object(s.useState)(null),o=l()(r,2),u=o[0],i=o[1],f=Object(s.useState)(!0),p=l()(f,2),b=p[0],v=p[1];return Object(s.useEffect)((function(){t.product&&(i(t.product),v(!1))}),[t.product]),Object(s.useEffect)((function(){n>0&&(v(!0),d()({path:"/wc/store/products/".concat(n)}).then((function(t){i(t)})).catch(a()(c.a.mark((function t(){return c.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:i(null);case 1:case"end":return t.stop()}}),t)})))).finally((function(){v(!1)})))}),[n]),b||u?Object(s.createElement)(y.ProductDataContextProvider,{product:u,isLoading:b},Object(s.createElement)(e,t)):null},v=function(t){return function(n){var e=Object(y.useProductDataContext)();return n.product||!e.hasContext?Object(s.createElement)(b,o()({},n,{OriginalComponent:t})):Object(s.createElement)(t,n)}}},8:function(t,n){!function(){t.exports=this.wp.apiFetch}()}});