!function(e){e.fn.easeScroll=function(t){!function(){function a(){var e=!1;e&&d("keydown",i),S.keyboardSupport&&!e&&s("keydown",i)}function o(){if(document.body){var e=document.body,t=document.documentElement,o=window.innerHeight,r=e.scrollHeight;if(M=document.compatMode.indexOf("CSS")>=0?t:e,v=e,a(),H=!0,top!=self)x=!0;else if(r>o&&(e.offsetHeight<=o||t.offsetHeight<=o)){var n=!1,i=function(){n||t.scrollHeight==document.height||(n=!0,setTimeout(function(){t.style.height=document.height+"px",n=!1},100))};if(t.style.height="auto",setTimeout(i,10),M.offsetHeight<=o){var l=document.createElement("div");l.style.clear="both",e.appendChild(l)}}S.fixedBackground||k||(e.style.backgroundAttachment="scroll",t.style.backgroundAttachment="scroll")}}function r(e,t,a,o){if(o||(o=1e3),p(t,a),1!=S.accelerationMax){var r=+new Date,n=r-N;if(n<S.accelerationDelta){var i=(1+30/n)/2;i>1&&(i=Math.min(i,S.accelerationMax),t*=i,a*=i)}N=+new Date}if(A.push({x:t,y:a,lastX:0>t?.99:-.99,lastY:0>a?.99:-.99,start:+new Date}),!C){var l=e===document.body,c=function(){for(var r=+new Date,n=0,i=0,u=0;u<A.length;u++){var s=A[u],d=r-s.start,f=d>=S.animationTime,p=f?1:d/S.animationTime;S.pulseAlgorithm&&(p=g(p));var m=s.x*p-s.lastX>>0,h=s.y*p-s.lastY>>0;n+=m,i+=h,s.lastX+=m,s.lastY+=h,f&&(A.splice(u,1),u--)}l?window.scrollBy(n,i):(n&&(e.scrollLeft+=n),i&&(e.scrollTop+=i)),t||a||(A=[]),A.length?L(c,e,o/S.frameRate+1):C=!1};L(c,e,0),C=!0}}function n(e){H||o();var t=e.target,a=u(t);if(!a||e.defaultPrevented||f(v,"embed")||f(t,"embed")&&/\.pdf/i.test(t.src))return!0;var n=e.wheelDeltaX||0,i=e.wheelDeltaY||0;return n||i||(i=e.wheelDelta||0),!S.touchpadSupport&&m(i)?!0:(Math.abs(n)>1.2&&(n*=S.stepSize/120),Math.abs(i)>1.2&&(i*=S.stepSize/120),r(a,-n,-i),void e.preventDefault())}function i(e){var t=e.target,a=e.ctrlKey||e.altKey||e.metaKey||e.shiftKey&&e.keyCode!==z.spacebar;if(/input|textarea|select|embed/i.test(t.nodeName)||t.isContentEditable||e.defaultPrevented||a)return!0;if(f(t,"button")&&e.keyCode===z.spacebar)return!0;var o,n=0,i=0,l=u(v),c=l.clientHeight;switch(l==document.body&&(c=window.innerHeight),e.keyCode){case z.up:i=-S.arrowScroll;break;case z.down:i=S.arrowScroll;break;case z.spacebar:o=e.shiftKey?1:-1,i=-o*c*.9;break;case z.pageup:i=.9*-c;break;case z.pagedown:i=.9*c;break;case z.home:i=-l.scrollTop;break;case z.end:var s=l.scrollHeight-l.scrollTop-c;i=s>0?s+10:0;break;case z.left:n=-S.arrowScroll;break;case z.right:n=S.arrowScroll;break;default:return!0}r(l,n,i),e.preventDefault()}function l(e){v=e.target}function c(e,t){for(var a=e.length;a--;)E[K(e[a])]=t;return t}function u(e){var t=[],a=M.scrollHeight;do{var o=E[K(e)];if(o)return c(t,o);if(t.push(e),a===e.scrollHeight){if(!x||M.clientHeight+10<a)return c(t,document.body)}else if(e.clientHeight+10<e.scrollHeight&&(overflow=getComputedStyle(e,"").getPropertyValue("overflow-y"),"scroll"===overflow||"auto"===overflow))return c(t,e)}while(e=e.parentNode)}function s(e,t,a){window.addEventListener(e,t,a||!1)}function d(e,t,a){window.removeEventListener(e,t,a||!1)}function f(e,t){return(e.nodeName||"").toLowerCase()===t.toLowerCase()}function p(e,t){e=e>0?1:-1,t=t>0?1:-1,(D.x!==e||D.y!==t)&&(D.x=e,D.y=t,A=[],N=0)}function m(e){if(e){e=Math.abs(e),T.push(e),T.shift(),clearTimeout(B);var t=T[0]==T[1]&&T[1]==T[2],a=h(T[0],120)&&h(T[1],120)&&h(T[2],120);return!(t||a)}}function h(e,t){return Math.floor(e/t)==e/t}function w(e){var t,a,o;return e*=S.pulseScale,1>e?t=e-(1-Math.exp(-e)):(a=Math.exp(-1),e-=1,o=1-Math.exp(-e),t=a+o*(1-a)),t*S.pulseNormalize}function g(e){return e>=1?1:0>=e?0:(1==S.pulseNormalize&&(S.pulseNormalize/=w(1)),w(e))}var v,b=e.extend({frameRate:60,animationTime:1e3,stepSize:120,pulseAlgorithm:!0,pulseScale:8,pulseNormalize:1,accelerationDelta:20,accelerationMax:1,keyboardSupport:!0,arrowScroll:50,touchpadSupport:!0,fixedBackground:!0},t),y={frameRate:b.frameRate,animationTime:b.animationTime,stepSize:b.stepSize,pulseAlgorithm:b.pulseAlgorithm,pulseScale:b.pulseScale,pulseNormalize:b.pulseNormalize,accelerationDelta:b.accelerationDelta,accelerationMax:b.accelerationMax,keyboardSupport:b.keyboardSupport,arrowScroll:b.arrowScroll,touchpadSupport:b.touchpadSupport,fixedBackground:b.fixedBackground,excluded:""},S=y,k=!1,x=!1,D={x:0,y:0},H=!1,M=document.documentElement,T=[120,120,120],z={left:37,up:38,right:39,down:40,spacebar:32,pageup:33,pagedown:34,end:35,home:36},S=y,A=[],C=!1,N=+new Date,E={};setInterval(function(){E={}},1e4);var B,K=function(){var e=0;return function(t){return t.uniqueID||(t.uniqueID=e++)}}(),L=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||function(e,t,a){window.setTimeout(e,a||1e3/60)}}(),R=/chrome|iPad/i.test(window.navigator.userAgent),q="onmousewheel"in document;q&&R&&(s("mousedown",l),s("mousewheel",n),s("load",o))}()}}(jQuery);