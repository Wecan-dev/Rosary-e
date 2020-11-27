(window.__wcAdmin_webpackJsonp=window.__wcAdmin_webpackJsonp||[]).push([[12],{172:function(e,t,n){"use strict";var c=n(9),r=n(19),a=n(4),o=n.n(a),i=n(0);function s(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var c=Object.getOwnPropertySymbols(e);t&&(c=c.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,c)}return n}t.a=function(e){var t=e.as,n=void 0===t?"div":t,a=e.className,u=Object(r.a)(e,["as","className"]);return function(e){var t=e.as,n=void 0===t?"div":t,c=Object(r.a)(e,["as"]);return"function"==typeof c.children?c.children(c):Object(i.createElement)(n,c)}(function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?s(Object(n),!0).forEach((function(t){Object(c.a)(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):s(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({as:n,className:o()("components-visually-hidden",a)},u))}},253:function(e,t,n){"use strict";var c=n(0),r=n(4),a=n.n(r),o=n(172);function i(e){var t=e.id,n=e.label,r=e.hideLabelFromVision,s=e.help,u=e.className,l=e.children;return Object(c.createElement)("div",{className:a()("components-base-control",u)},Object(c.createElement)("div",{className:"components-base-control__field"},n&&t&&(r?Object(c.createElement)(o.a,{as:"label",htmlFor:t},n):Object(c.createElement)("label",{className:"components-base-control__label",htmlFor:t},n)),n&&!t&&(r?Object(c.createElement)(o.a,{as:"label"},n):Object(c.createElement)(i.VisualLabel,null,n)),l),!!s&&Object(c.createElement)("p",{id:t+"__help",className:"components-base-control__help"},s))}i.VisualLabel=function(e){var t=e.className,n=e.children;return t=a()("components-base-control__label",t),Object(c.createElement)("span",{className:t},n)},t.a=i},66:function(e,t,n){"use strict";n.d(t,"a",(function(){return s})),n.d(t,"h",(function(){return u})),n.d(t,"c",(function(){return l})),n.d(t,"d",(function(){return m})),n.d(t,"g",(function(){return d})),n.d(t,"e",(function(){return f})),n.d(t,"i",(function(){return p})),n.d(t,"f",(function(){return b})),n.d(t,"b",(function(){return y}));var c=n(9),r=n(28),a=n(2),o=n(3);function i(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:window,t=e.navigator.platform;return-1!==t.indexOf("Mac")||Object(a.includes)(["iPad","iPhone"],t)}var s=8,u=9,l=13,m=27,d=32,f=37,p=38,b=39,y=40,v="alt",h="ctrl",O="shift",j={primary:function(e){return e()?["meta"]:[h]},primaryShift:function(e){return e()?[O,"meta"]:[h,O]},primaryAlt:function(e){return e()?[v,"meta"]:[h,v]},secondary:function(e){return e()?[O,v,"meta"]:[h,O,v]},access:function(e){return e()?[h,v]:[O,v]},ctrl:function(){return[h]},alt:function(){return[v]},ctrlShift:function(){return[h,O]},shift:function(){return[O]},shiftAlt:function(){return[O,v]}},_=(Object(a.mapValues)(j,(function(e){return function(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:i;return[].concat(Object(r.a)(e(n)),[t.toLowerCase()]).join("+")}})),Object(a.mapValues)(j,(function(e){return function(t){var n,o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:i,s=o(),u=(n={},Object(c.a)(n,v,s?"⌥":"Alt"),Object(c.a)(n,h,s?"^":"Ctrl"),Object(c.a)(n,"meta","⌘"),Object(c.a)(n,O,s?"⇧":"Shift"),n),l=e(o).reduce((function(e,t){var n=Object(a.get)(u,t,t);return[].concat(Object(r.a)(e),s?[n]:[n,"+"])}),[]),m=Object(a.capitalize)(t);return[].concat(Object(r.a)(l),[m])}})));Object(a.mapValues)(_,(function(e){return function(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:i;return e(t,n).join("")}})),Object(a.mapValues)(j,(function(e){return function(t){var n,s=arguments.length>1&&void 0!==arguments[1]?arguments[1]:i,u=s(),l=(n={},Object(c.a)(n,O,"Shift"),Object(c.a)(n,"meta",u?"Command":"Control"),Object(c.a)(n,h,"Control"),Object(c.a)(n,v,u?"Option":"Alt"),Object(c.a)(n,",",Object(o.__)("Comma")),Object(c.a)(n,".",Object(o.__)("Period")),Object(c.a)(n,"`",Object(o.__)("Backtick")),n);return[].concat(Object(r.a)(e(s)),[t]).map((function(e){return Object(a.capitalize)(Object(a.get)(l,e,e))})).join(u?" ":" + ")}})),Object(a.mapValues)(j,(function(e){return function(t,n){var c=arguments.length>2&&void 0!==arguments[2]?arguments[2]:i,r=e(c);return!!r.every((function(e){return t["".concat(e,"Key")]}))&&(n?t.key===n:Object(a.includes)(r,t.key.toLowerCase()))}}))},727:function(e,t,n){"use strict";var c=n(14),r=n.n(c),a=n(13),o=n.n(a),i=n(16),s=n.n(i),u=n(17),l=n.n(u),m=n(6),d=n.n(m),f=n(0),p=n(4),b=n.n(p),y=n(1),v=n.n(y),h=n(701),O=n(68);n(729);function j(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,c=d()(e);if(t){var r=d()(this).constructor;n=Reflect.construct(c,arguments,r)}else n=c.apply(this,arguments);return l()(this,n)}}var _=function(e){s()(n,e);var t=j(n);function n(){return r()(this,n),t.apply(this,arguments)}return o()(n,[{key:"render",value:function(){var e=this.props,t=e.className,n=e.menu,c=e.subtitle,r=e.title,a=e.unreadMessages,o=b()({"woocommerce-layout__inbox-panel-header":c,"woocommerce-layout__activity-panel-header":!c},t),i=a||0;return Object(f.createElement)("div",{className:o},Object(f.createElement)("div",{className:"woocommerce-layout__inbox-title"},Object(f.createElement)(h.a,{variant:"title.small"},r),Object(f.createElement)(h.a,{variant:"button"},i>0&&Object(f.createElement)("span",{className:"woocommerce-layout__inbox-badge"},a))),Object(f.createElement)("div",{className:"woocommerce-layout__inbox-subtitle"},c&&Object(f.createElement)(h.a,{variant:"body.small"},c)),n&&Object(f.createElement)("div",{className:"woocommerce-layout__activity-panel-header-menu"},n))}}]),n}(f.Component);_.propTypes={className:v.a.string,unreadMessages:v.a.number,title:v.a.string.isRequired,subtitle:v.a.string,menu:v.a.shape({type:v.a.oneOf([O.EllipsisMenu])})},t.a=_},729:function(e,t,n){},730:function(e,t,n){"use strict";n.d(t,"a",(function(){return R})),n.d(t,"b",(function(){return N}));var c=n(14),r=n.n(c),a=n(13),o=n.n(a),i=n(16),s=n.n(i),u=n(17),l=n.n(u),m=n(6),d=n.n(m),f=n(0),p=n(4),b=n.n(p),y=n(90),v=n.n(y),h=n(15),O=n.n(h),j=n(1),_=n.n(j),E=n(68),g=(n(731),n(2));function w(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,c=d()(e);if(t){var r=d()(this).constructor;n=Reflect.construct(c,arguments,r)}else n=c.apply(this,arguments);return l()(this,n)}}var k=function(e){s()(n,e);var t=w(n);function n(){return r()(this,n),t.apply(this,arguments)}return o()(n,[{key:"render",value:function(){var e=this.props,t=e.className,n=e.hasAction,c=e.hasDate,r=e.hasSubtitle,a=e.lines,o=b()("woocommerce-activity-card is-loading",t);return Object(f.createElement)("div",{className:o,"aria-hidden":!0},Object(f.createElement)("span",{className:"woocommerce-activity-card__icon"},Object(f.createElement)("span",{className:"is-placeholder"})),Object(f.createElement)("div",{className:"woocommerce-activity-card__header"},Object(f.createElement)("div",{className:"woocommerce-activity-card__title is-placeholder"}),r&&Object(f.createElement)("div",{className:"woocommerce-activity-card__subtitle is-placeholder"}),c&&Object(f.createElement)("div",{className:"woocommerce-activity-card__date"},Object(f.createElement)("span",{className:"is-placeholder"}))),Object(f.createElement)("div",{className:"woocommerce-activity-card__body"},Object(g.range)(a).map((function(e){return Object(f.createElement)("span",{className:"is-placeholder",key:e})}))),n&&Object(f.createElement)("div",{className:"woocommerce-activity-card__actions"},Object(f.createElement)("span",{className:"is-placeholder"})))}}]),n}(f.Component);k.propTypes={className:_.a.string,hasAction:_.a.bool,hasDate:_.a.bool,hasSubtitle:_.a.bool,lines:_.a.number},k.defaultProps={hasAction:!1,hasDate:!1,hasSubtitle:!1,lines:1};var N=k;function S(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,c=d()(e);if(t){var r=d()(this).constructor;n=Reflect.construct(c,arguments,r)}else n=c.apply(this,arguments);return l()(this,n)}}var R=function(e){s()(n,e);var t=S(n);function n(){return r()(this,n),t.apply(this,arguments)}return o()(n,[{key:"render",value:function(){var e=this.props,t=e.actions,n=e.className,c=e.children,r=e.date,a=e.icon,o=e.subtitle,i=e.title,s=e.unread,u=b()("woocommerce-activity-card",n),l=Array.isArray(t)?t:[t];return Object(f.createElement)("section",{className:u},s&&Object(f.createElement)("span",{className:"woocommerce-activity-card__unread"}),a&&Object(f.createElement)("span",{className:"woocommerce-activity-card__icon","aria-hidden":!0},a),Object(f.createElement)("header",{className:"woocommerce-activity-card__header"},Object(f.createElement)(E.H,{className:"woocommerce-activity-card__title"},i),o&&Object(f.createElement)("div",{className:"woocommerce-activity-card__subtitle"},o),r&&Object(f.createElement)("span",{className:"woocommerce-activity-card__date"},O.a.utc(r).fromNow())),Object(f.createElement)(E.Section,{className:"woocommerce-activity-card__body"},c),t&&Object(f.createElement)("footer",{className:"woocommerce-activity-card__actions"},l.map((function(e,t){return Object(f.cloneElement)(e,{key:t})}))))}}]),n}(f.Component);R.propTypes={actions:_.a.oneOfType([_.a.arrayOf(_.a.element),_.a.element]),className:_.a.string,children:_.a.node.isRequired,date:_.a.string,icon:_.a.node,subtitle:_.a.node,title:_.a.oneOfType([_.a.string,_.a.node]).isRequired,unread:_.a.bool},R.defaultProps={icon:Object(f.createElement)(v.a,{icon:"notice-outline",size:48}),unread:!1}},731:function(e,t,n){},86:function(e,t){function n(e,t,n,c,r,a,o){try{var i=e[a](o),s=i.value}catch(e){return void n(e)}i.done?t(s):Promise.resolve(s).then(c,r)}e.exports=function(e){return function(){var t=this,c=arguments;return new Promise((function(r,a){var o=e.apply(t,c);function i(e){n(o,r,a,i,s,"next",e)}function s(e){n(o,r,a,i,s,"throw",e)}i(void 0)}))}}},913:function(e,t,n){"use strict";n.r(t);var c=n(14),r=n.n(c),a=n(13),o=n.n(a),i=n(16),s=n.n(i),u=n(17),l=n.n(u),m=n(6),d=n.n(m),f=n(0),p=n(3),b=n(270),y=n(24),v=n(1),h=n.n(v),O=n(90),j=n.n(O),_=n(68),E=n(41),g=n(730),w=n(727),k=n(12),N=n.n(k),S=n(86),R=n.n(S),P=n(10),q=n.n(P),C=n(72),D=n(253),A=n(4),x=n.n(A),T=n(66),L=n(2),I=n(33),F=n(61);function M(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,c=d()(e);if(t){var r=d()(this).constructor;n=Reflect.construct(c,arguments,r)}else n=c.apply(this,arguments);return l()(this,n)}}var V=function(e){s()(c,e);var t,n=M(c);function c(e){var t;return r()(this,c),(t=n.call(this,e)).state={quantity:e.product.stock_quantity,editing:!1,edited:!1},t.beginEdit=t.beginEdit.bind(q()(t)),t.cancelEdit=t.cancelEdit.bind(q()(t)),t.onQuantityChange=t.onQuantityChange.bind(q()(t)),t.handleKeyDown=t.handleKeyDown.bind(q()(t)),t.onSubmit=t.onSubmit.bind(q()(t)),t}return o()(c,[{key:"recordStockEvent",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};Object(F.recordEvent)("activity_panel_stock_".concat(e),t)}},{key:"beginEdit",value:function(){var e=this,t=this.props.product;this.setState({editing:!0,quantity:t.stock_quantity},(function(){e.quantityInput&&e.quantityInput.focus()})),this.recordStockEvent("update_stock")}},{key:"cancelEdit",value:function(){var e=this.props.product;this.setState({editing:!1,quantity:e.stock_quantity}),this.recordStockEvent("cancel")}},{key:"handleKeyDown",value:function(e){e.keyCode===T.d&&this.cancelEdit()}},{key:"onQuantityChange",value:function(e){this.setState({quantity:e.target.value})}},{key:"onSubmit",value:(t=R()(N.a.mark((function e(){var t,n,c,r,a;return N.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return t=this.props,n=t.product,c=t.updateProductStock,r=t.createNotice,a=this.state.quantity,this.setState({editing:!1,edited:!0}),e.next=5,c(n,a);case 5:e.sent.success?r("success",Object(p.sprintf)(Object(p.__)("%s stock updated.",'woocommerce'),n.name)):r("error",Object(p.sprintf)(Object(p.__)("%s stock could not be updated.",'woocommerce'),n.name)),this.recordStockEvent("save",{quantity:a});case 8:case"end":return e.stop()}}),e,this)}))),function(){return t.apply(this,arguments)})},{key:"getActions",value:function(){return this.state.editing?[Object(f.createElement)(C.a,{key:"save",type:"submit",isPrimary:!0},Object(p.__)("Save",'woocommerce')),Object(f.createElement)(C.a,{key:"cancel",type:"reset"},Object(p.__)("Cancel",'woocommerce'))]:[Object(f.createElement)(C.a,{key:"update",isSecondary:!0,onClick:this.beginEdit},Object(p.__)("Update stock",'woocommerce'))]}},{key:"getBody",value:function(){var e=this,t=this.props.product,n=this.state,c=n.editing,r=n.quantity;return c?Object(f.createElement)(f.Fragment,null,Object(f.createElement)(D.a,{className:"woocommerce-stock-activity-card__edit-quantity"},Object(f.createElement)("input",{className:"components-text-control__input",type:"number",value:r,onKeyDown:this.handleKeyDown,onChange:this.onQuantityChange,ref:function(t){e.quantityInput=t}})),Object(f.createElement)("span",null,Object(p.__)("in stock",'woocommerce'))):Object(f.createElement)("span",{className:"woocommerce-stock-activity-card__stock-quantity"},Object(p.sprintf)(Object(p.__)("%d in stock",'woocommerce'),t.stock_quantity))}},{key:"render",value:function(){var e=this,t=this.props.product,n=this.state,c=n.edited,r=n.editing,a=Object(I.g)("notifyLowStockAmount",0),o=Number.isFinite(t.low_stock_amount)?t.low_stock_amount:a,i=t.stock_quantity<=o;if(!i&&!c)return null;var s=Object(f.createElement)(_.Link,{href:"post.php?action=edit&post="+(t.parent_id||t.id),onClick:function(){return e.recordStockEvent("product_name")},type:"wp-admin"},t.name),u=null;"variation"===t.type&&(u=Object.values(t.attributes).map((function(e){return e.option})).join(", "));var l=Object(L.get)(t,["images",0])||Object(L.get)(t,["image"]),m=x()("woocommerce-stock-activity-card__image-overlay__product",{"is-placeholder":!l||!l.src}),d=Object(f.createElement)("div",{className:"woocommerce-stock-activity-card__image-overlay"},Object(f.createElement)("div",{className:m},Object(f.createElement)(_.ProductImage,{product:t}))),p=x()("woocommerce-stock-activity-card",{"is-dimmed":!r&&!i}),b=Object(f.createElement)(g.a,{className:p,title:s,subtitle:u,icon:d,actions:this.getActions()},this.getBody());return r?Object(f.createElement)("form",{onReset:this.cancelEdit,onSubmit:this.onSubmit},b):b}}]),c}(f.Component),K=Object(b.a)(Object(y.withDispatch)((function(e){var t=e("core/notices").createNotice;return{updateProductStock:e(E.ITEMS_STORE_NAME).updateProductStock,createNotice:t}})))(V);function z(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,c=d()(e);if(t){var r=d()(this).constructor;n=Reflect.construct(c,arguments,r)}else n=c.apply(this,arguments);return l()(this,n)}}var Q=function(e){s()(n,e);var t=z(n);function n(){return r()(this,n),t.apply(this,arguments)}return o()(n,[{key:"renderEmptyCard",value:function(){return Object(f.createElement)(g.a,{className:"woocommerce-empty-activity-card",title:Object(p.__)("Your stock is in good shape.",'woocommerce'),icon:Object(f.createElement)(j.a,{icon:"checkmark",size:48})},Object(p.__)("You currently have no products running low on stock.",'woocommerce'))}},{key:"renderProducts",value:function(){var e=this.props.products;return 0===e.length?this.renderEmptyCard():e.map((function(e){return Object(f.createElement)(K,{key:e.id,product:e})}))}},{key:"render",value:function(){var e=this.props,t=e.isError,n=e.isRequesting,c=e.products;if(t){var r=Object(p.__)("There was an error getting your low stock products. Please try again.",'woocommerce'),a=Object(p.__)("Reload",'woocommerce');return Object(f.createElement)(f.Fragment,null,Object(f.createElement)(_.EmptyContent,{title:r,actionLabel:a,actionURL:null,actionCallback:function(){window.location.reload()}}))}var o=n||c.length>0?Object(p.__)("Stock",'woocommerce'):Object(p.__)("No products with low stock",'woocommerce');return Object(f.createElement)(f.Fragment,null,Object(f.createElement)(w.a,{title:o}),Object(f.createElement)(_.Section,null,n?Object(f.createElement)(g.b,{className:"woocommerce-stock-activity-card",hasAction:!0,lines:1}):this.renderProducts()))}}]),n}(f.Component);Q.propTypes={products:h.a.array.isRequired,isError:h.a.bool,isRequesting:h.a.bool},Q.defaultProps={products:[],isError:!1,isRequesting:!1};t.default=Object(b.a)(Object(y.withSelect)((function(e){var t=e(E.ITEMS_STORE_NAME),n=t.getItems,c=t.getItemsError,r=t.isResolving,a={page:1,per_page:E.QUERY_DEFAULTS.pageSize,low_in_stock:!0,status:"publish"};return{products:Array.from(n("products",a).values()),isError:Boolean(c("products",a)),isRequesting:r("getItems",["products",a])}})))(Q)}}]);