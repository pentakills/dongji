// 配置项
window.CustomerID = 0;
window.CustomerTYPE = 'pc';
window.configQuickbar = {

    fonts: {
        eot: '/template/pc/skin/fonts/iconfont.eot',
        woff: '/template/pc/skin/fonts/iconfont.woff',
        ttf: '/template/pc/skin/fonts/iconfont.ttf',
        svg: '/template/pc/skin/fonts/iconfont.svg'
    }
};
// 初始化事件
// 返回顶部
window.Quickbar_backtoTop = function () {
    document.body.scrollTop = 0;
};
document.getElementById("quickbar-backtotop") !== null ? document.getElementById("quickbar-backtotop").addEventListener('click', function () {
    window.Quickbar_backtoTop();
}, false) : null;
// 展示栏目导航
window.Quickbar_showCategories = function () {
};
document.getElementById("quickbar-showcats") !== null ? document.getElementById("quickbar-showcats").addEventListener('click', function () {
    window.Quickbar_showCategories();
}, false) : null;
// 分享
window.Quickbar_share = function () {
};
document.getElementById("quickbar-share") !== null ? document.getElementById("quickbar-share").addEventListener('click', function () {
    window.Quickbar_share();
}, false) : null;
;


// 加载字体
//var iconfontStyle = document.createElement('style');
//iconfontStyle.setAttribute('type', 'text/css');
//iconfontStyle.setAttribute('rel', 'stylesheet');
//iconfontStyle.setAttribute('rev', 'stylesheet');
//iconfontStyle.innerHTML = '@font-face {font-family: "iconfont"; src: url("'+configQuickbar.fonts.eot+'");/* IE9*/ src: url("'+configQuickbar.fonts.eot+'?#iefix") format("embedded-opentype"), /* IE6-IE8 */ url("'+configQuickbar.fonts.woff+'") format("woff"),/* chrome、firefox */ url("'+configQuickbar.fonts.ttf+'") format("truetype"),/* chrome、firefox、opera、Safari, Android, iOS 4.2+*/ url("'+configQuickbar.fonts.svg+'#iconfont") format("svg");/* iOS 4.1- */}'
//	+'.iconfont{font-family:"iconfont" !important;font-size:16px;font-style:normal;-webkit-font-smoothing: antialiased;-webkit-text-stroke-width: 0.2px;-moz-osx-font-smoothing: grayscale;}';
//(document.head || document.getElementsByTagName('head')[0]).appendChild(iconfontStyle);
var iconfontStyle = document.createElement('div');
iconfontStyle.innerHTML = '_<style type="text/css" rel="stylesheet" rev="stylesheet">@font-face {font-family: "iconfont"; src: url("' + configQuickbar.fonts.eot + '");/* IE9*/ src: url("' + configQuickbar.fonts.eot + '?#iefix") format("embedded-opentype"), /* IE6-IE8 */ url("' + configQuickbar.fonts.woff + '") format("woff"),/* chrome、firefox */ url("' + configQuickbar.fonts.ttf + '") format("truetype"),/* chrome、firefox、opera、Safari, Android, iOS 4.2+*/ url("' + configQuickbar.fonts.svg + '#iconfont") format("svg");/* iOS 4.1- */}' + '.iconfont{font-family:"iconfont" !important;font-size:16px;font-style:normal;-webkit-font-smoothing: antialiased;-webkit-text-stroke-width: 0.2px;-moz-osx-font-smoothing: grayscale;}</style>';
iconfontStyle.removeChild(iconfontStyle.firstChild);
(document.head || document.getElementsByTagName('head')[0]).appendChild(iconfontStyle.firstChild);

// 加载访问次数
if (document.getElementById("article-viewcount") !== null) {
    window.viewcountCallback = function (json) {
        if (json.err == 0) {
            document.getElementById("article-viewcount").innerHTML = json.data.viewcount;
        } else {
            console.log(json.msg);
        }
    };
    var viewcountData = document.createElement('script');
    viewcountData.setAttribute('type', 'text/javascript');
    viewcountData.setAttribute('src', configQuickbar.viewcounturl.replace('0000', CustomerID) + '?callback=viewcountCallback&url=' + location.href);
    viewcountData.onload = viewcountData.onreadystatechange = function () {
        viewcountData.parentNode.removeChild(viewcountData);
    };
    (document.head || document.getElementsByTagName('head')[0]).appendChild(viewcountData);
}