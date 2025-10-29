String.prototype.replaceAll  = function(s1,s2){
	return this.replace(new RegExp(s1,"gm"),s2);
}
String.prototype.md5 = function()
{
	var that = this;
	var hexcase = 0;

	function hex_md5(a) {
		return rstr2hex(rstr_md5(str2rstr_utf8(a)))
	}
	
	function rstr_md5(a) {
		return binl2rstr(binl_md5(rstr2binl(a), a.length * 8))
	}

	function rstr2hex(c) {
		try {
			hexcase
		} catch (g) {
			hexcase = 0
		}
		var f = hexcase ? "0123456789ABCDEF" : "0123456789abcdef";
		var b = "";
		var a;
		for(var d = 0; d < c.length; d++) {
			a = c.charCodeAt(d);
			b += f.charAt((a >>> 4) & 15) + f.charAt(a & 15)
		}
		return b
	}
	
	function str2rstr_utf8(c) {
		var b = "";
		var d = -1;
		var a, e;
		while(++d < c.length) {
			a = c.charCodeAt(d);
			e = d + 1 < c.length ? c.charCodeAt(d + 1) : 0;
			if(55296 <= a && a <= 56319 && 56320 <= e && e <= 57343) {
				a = 65536 + ((a & 1023) << 10) + (e & 1023);
				d++
			}
			if(a <= 127) {
				b += String.fromCharCode(a)
			} else {
				if(a <= 2047) {
					b += String.fromCharCode(192 | ((a >>> 6) & 31), 128 | (a & 63))
				} else {
					if(a <= 65535) {
						b += String.fromCharCode(224 | ((a >>> 12) & 15), 128 | ((a >>> 6) & 63), 128 | (a & 63))
					} else {
						if(a <= 2097151) {
							b += String.fromCharCode(240 | ((a >>> 18) & 7), 128 | ((a >>> 12) & 63), 128 | ((a >>> 6) & 63), 128 | (a & 63))
						}
					}
				}
			}
		}
		return b
	}

	function rstr2binl(b) {
		var a = Array(b.length >> 2);
		for(var c = 0; c < a.length; c++) {
			a[c] = 0
		}
		for(var c = 0; c < b.length * 8; c += 8) {
			a[c >> 5] |= (b.charCodeAt(c / 8) & 255) << (c % 32)
		}
		return a
	}

	function binl2rstr(b) {
		var a = "";
		for(var c = 0; c < b.length * 32; c += 8) {
			a += String.fromCharCode((b[c >> 5] >>> (c % 32)) & 255)
		}
		return a
	}

	function binl_md5(p, k) {
		p[k >> 5] |= 128 << ((k) % 32);
		p[(((k + 64) >>> 9) << 4) + 14] = k;
		var o = 1732584193;
		var n = -271733879;
		var m = -1732584194;
		var l = 271733878;
		for(var g = 0; g < p.length; g += 16) {
			var j = o;
			var h = n;
			var f = m;
			var e = l;
			o = md5_ff(o, n, m, l, p[g + 0], 7, -680876936);
			l = md5_ff(l, o, n, m, p[g + 1], 12, -389564586);
			m = md5_ff(m, l, o, n, p[g + 2], 17, 606105819);
			n = md5_ff(n, m, l, o, p[g + 3], 22, -1044525330);
			o = md5_ff(o, n, m, l, p[g + 4], 7, -176418897);
			l = md5_ff(l, o, n, m, p[g + 5], 12, 1200080426);
			m = md5_ff(m, l, o, n, p[g + 6], 17, -1473231341);
			n = md5_ff(n, m, l, o, p[g + 7], 22, -45705983);
			o = md5_ff(o, n, m, l, p[g + 8], 7, 1770035416);
			l = md5_ff(l, o, n, m, p[g + 9], 12, -1958414417);
			m = md5_ff(m, l, o, n, p[g + 10], 17, -42063);
			n = md5_ff(n, m, l, o, p[g + 11], 22, -1990404162);
			o = md5_ff(o, n, m, l, p[g + 12], 7, 1804603682);
			l = md5_ff(l, o, n, m, p[g + 13], 12, -40341101);
			m = md5_ff(m, l, o, n, p[g + 14], 17, -1502002290);
			n = md5_ff(n, m, l, o, p[g + 15], 22, 1236535329);
			o = md5_gg(o, n, m, l, p[g + 1], 5, -165796510);
			l = md5_gg(l, o, n, m, p[g + 6], 9, -1069501632);
			m = md5_gg(m, l, o, n, p[g + 11], 14, 643717713);
			n = md5_gg(n, m, l, o, p[g + 0], 20, -373897302);
			o = md5_gg(o, n, m, l, p[g + 5], 5, -701558691);
			l = md5_gg(l, o, n, m, p[g + 10], 9, 38016083);
			m = md5_gg(m, l, o, n, p[g + 15], 14, -660478335);
			n = md5_gg(n, m, l, o, p[g + 4], 20, -405537848);
			o = md5_gg(o, n, m, l, p[g + 9], 5, 568446438);
			l = md5_gg(l, o, n, m, p[g + 14], 9, -1019803690);
			m = md5_gg(m, l, o, n, p[g + 3], 14, -187363961);
			n = md5_gg(n, m, l, o, p[g + 8], 20, 1163531501);
			o = md5_gg(o, n, m, l, p[g + 13], 5, -1444681467);
			l = md5_gg(l, o, n, m, p[g + 2], 9, -51403784);
			m = md5_gg(m, l, o, n, p[g + 7], 14, 1735328473);
			n = md5_gg(n, m, l, o, p[g + 12], 20, -1926607734);
			o = md5_hh(o, n, m, l, p[g + 5], 4, -378558);
			l = md5_hh(l, o, n, m, p[g + 8], 11, -2022574463);
			m = md5_hh(m, l, o, n, p[g + 11], 16, 1839030562);
			n = md5_hh(n, m, l, o, p[g + 14], 23, -35309556);
			o = md5_hh(o, n, m, l, p[g + 1], 4, -1530992060);
			l = md5_hh(l, o, n, m, p[g + 4], 11, 1272893353);
			m = md5_hh(m, l, o, n, p[g + 7], 16, -155497632);
			n = md5_hh(n, m, l, o, p[g + 10], 23, -1094730640);
			o = md5_hh(o, n, m, l, p[g + 13], 4, 681279174);
			l = md5_hh(l, o, n, m, p[g + 0], 11, -358537222);
			m = md5_hh(m, l, o, n, p[g + 3], 16, -722521979);
			n = md5_hh(n, m, l, o, p[g + 6], 23, 76029189);
			o = md5_hh(o, n, m, l, p[g + 9], 4, -640364487);
			l = md5_hh(l, o, n, m, p[g + 12], 11, -421815835);
			m = md5_hh(m, l, o, n, p[g + 15], 16, 530742520);
			n = md5_hh(n, m, l, o, p[g + 2], 23, -995338651);
			o = md5_ii(o, n, m, l, p[g + 0], 6, -198630844);
			l = md5_ii(l, o, n, m, p[g + 7], 10, 1126891415);
			m = md5_ii(m, l, o, n, p[g + 14], 15, -1416354905);
			n = md5_ii(n, m, l, o, p[g + 5], 21, -57434055);
			o = md5_ii(o, n, m, l, p[g + 12], 6, 1700485571);
			l = md5_ii(l, o, n, m, p[g + 3], 10, -1894986606);
			m = md5_ii(m, l, o, n, p[g + 10], 15, -1051523);
			n = md5_ii(n, m, l, o, p[g + 1], 21, -2054922799);
			o = md5_ii(o, n, m, l, p[g + 8], 6, 1873313359);
			l = md5_ii(l, o, n, m, p[g + 15], 10, -30611744);
			m = md5_ii(m, l, o, n, p[g + 6], 15, -1560198380);
			n = md5_ii(n, m, l, o, p[g + 13], 21, 1309151649);
			o = md5_ii(o, n, m, l, p[g + 4], 6, -145523070);
			l = md5_ii(l, o, n, m, p[g + 11], 10, -1120210379);
			m = md5_ii(m, l, o, n, p[g + 2], 15, 718787259);
			n = md5_ii(n, m, l, o, p[g + 9], 21, -343485551);
			o = safe_add(o, j);
			n = safe_add(n, h);
			m = safe_add(m, f);
			l = safe_add(l, e)
		}
		return Array(o, n, m, l)
	}
	
	function md5_cmn(h, e, d, c, g, f) {
		return safe_add(bit_rol(safe_add(safe_add(e, h), safe_add(c, f)), g), d)
	}
	
	function md5_ff(g, f, k, j, e, i, h) {
		return md5_cmn((f & k) | ((~f) & j), g, f, e, i, h)
	}

	function md5_gg(g, f, k, j, e, i, h) {
		return md5_cmn((f & j) | (k & (~j)), g, f, e, i, h)
	}

	function md5_hh(g, f, k, j, e, i, h) {
		return md5_cmn(f ^ k ^ j, g, f, e, i, h)
	}

	function md5_ii(g, f, k, j, e, i, h) {
		return md5_cmn(k ^ (f | (~j)), g, f, e, i, h)
	}

	function safe_add(a, d) {
		var c = (a & 65535) + (d & 65535);
		var b = (a >> 16) + (d >> 16) + (c >> 16);
		return (b << 16) | (c & 65535)
	}
	
	function bit_rol(a, b) {
		return (a << b) | (a >>> (32 - b))
	};
	
	if(!that)that = '';
	return hex_md5(that);
}
var pep = {
    'version':'1.0',
    'copyright':'phpems pro',
	'brands':['撷水成文','PHPEMS'],
	'Corperation':'新乡市落笔千言网络技术有限公司',
    'width':$(window).width(),
    'height':$(window).height(),
    'countdownloop':false,
    'allowpre':true,
    'prePages':[],
    'prePage':null,
    'currentAjax':false,
    'ajaxSending':false,
    'initpage':function(page,tabindex,initscroll){
        clearInterval(pep.recordVideo);
        clearInterval(pep.countdownloop);
        clearInterval(pep.saveAnswer);
        clearInterval(pep.leftTime);
        page.find('.fineuploader').each(inituploader);
        page.find(".autoloaditem").each(function(){
            if($(this).attr('autoload') && $(this).attr('autoload') != '');
            $(this).load($(this).attr('autoload')+"&current="+$(this).attr('current'));
        });
        if(tabindex >= 0)
        {
            var cp = page.find('.page-tabs').hide().eq(tabindex).css('display','block');
            page.attr('data-index',tabindex);
            var cnt = cp.find('.page-content:first');
        }
        else
        var cnt = page.find('.page-content:first');
        if(initscroll)page.attr('data-scrolltop',0);
        if(page.attr('data-scrolltop') > 0)
        {
            cnt.scrollTop(page.attr('data-scrolltop'));
        }

        if(cnt.attr('data-scroll') == 'yes')
        {
            var loading = false;
            cnt.scroll(function(){
                var _this = $(this),
                    viewH = _this.height(),
                    contentH = _this.get(0).scrollHeight,
                    scrollTop = _this.scrollTop();
                if(pep.isTrueVar(_this.attr('data-pageurl')))
                {
                    if(scrollTop/(contentH -viewH) >= 0.99 && !loading){
                        loading = true;
                        var page = parseInt(_this.attr('data-pagenumber'));
                        if(page != page || page <= 2)page = 2;
                        $.get(_this.attr('data-pageurl')+'&page='+page+'&userhash='+Math.random(),function(data){
                            data = $.trim(data);
                            if(data != '')
                            {
                                $(data).appendTo(_this.find('.page-content:first'));
                                _this.attr('data-pagenumber',page+1);
                                loading = false;
                            }
                        });
                    }
                }
            });
        }
    },
    'isTrueVar':function(v){
        if(!v)return false;
        if("undefined" != typeof v)
        {
            if('string' == (typeof v).toLowerCase() && v == '')
            {
                return false;
            }
            return true;
        }
        else return false;
    },
	'setPageContent':function(dom){
		var pageContents = JSON.parse(localStorage.getItem('pageContents'));
		if(!pageContents)pageContents = {};
		var url = window.location.pathname + window.location.search;
		var id = url.md5();
		if(dom.find('.page-content:first').attr('data-nocache') == 'yes')
		{
			return ;
		}
		pageContents[id] = {content:dom.html(),'url':url,'tabindex':dom.attr('data-index')};
		localStorage.setItem('pageContents',JSON.stringify(pageContents));
        return true;
	},
	'getPageContent':function(id){
		var pageContents = JSON.parse(localStorage.getItem('pageContents'));
		var id = (window.location.pathname + window.location.search).md5();
		var p = pageContents[id];
		if(!p || (new Date().getTime() - p.time > 900000))p = false;
        return p;
	},
    'goPage':function(e){
        //跳转到一个目标页面
        if(e && e.preventDefault )e.preventDefault();
        if(pep.ajaxSending)return false;
        var index = parseInt($('.pages:first').attr('data-index'));
        if(index != index || index < 0 )index = 0;
        $('.pages:first').attr('data-scrolltop',$('.pages:first').find('.page-tabs').eq(index).find('.page-content:first').scrollTop());

        var o = $(this);
        if(!o.attr("data-url") || o.attr("data-url") == '')o.attr("data-url",o.attr("href"));
        if(o.attr("data-url").substring(0,7) == 'http://' || o.attr("data-url").substring(0,8) == 'https://')
        {
            window.location = o.attr("data-url");
            return;
        }
        var par = {url:o.attr("data-url"),target:o.attr("data-target"),direction:o.attr('data-direction'),page:o.attr("data-page"),title:o.attr("data-title"),'action-before':o.attr("action-before")};
        var page = false;
        if(o.attr("data-page") == 'yes')
        {
            page = pep.newPage(par.title,false,o.attr('data-direction'));
        }
        submitAjax(par,page);
    },
    'goPrePage':function(){
        //跳转到上一个页面
        if(pep.allowpre == false)
        {
            pep.mask.show('tips',{'message':'操作太快啦！'});
            window.history.pushState('','','');
            return false;
        }
        if(pep.countdownloop != null)
        {
            clearInterval(pep.countdownloop);
            pep.countdownloop = null;
        }
		var url = window.location.pathname + window.location.search;
		var id = url.md5();
		if(p = pep.getPageContent(id))
        {
			$('<div class="pages">'+p.content+'</div>').appendTo($('body'));
            pep.initpage($('.pages:last'),p.tabindex);
            $('.pages:first').addClass('pt-page-moveToRight');
            $('.pages:last').addClass('pt-page-moveFromLeft');
        }
        else
        {
			var par = {'url':url,'tabindex':p.tabindex,query:'&popstatus=back'};
            var page = pep.newPage('',true);
            submitAjax(par,page,true);
        }
    },
    'newPage':function(title,ispre,direction){
        if(!pep.isTrueVar(title))title = '正在加载';
        var page = $('<div class="pages">'+
            '<div class="page-tabs">'+
                '<div class="page-header">'+
                    '<div class="col-1"><span class="fa fa-chevron-left"></span></div>'+
                    '<div class="col-8">'+title+'</div>'+
                    '<div class="col-1" onclick=""><span class="fa fa-menu"></span></div>'+
                '</div>'+
                '<div class="page-content header text-center"><img src="files/public/img/loader.gif" style="margin-top: 0.45rem;width: 0.45rem;"/></div>'+
            '</div>'+
        '</div>');
        page.appendTo($('body'));
        if(direction == 'left')
        {
            var class1 = 'moving pt-page-moveToRight';
            var class2 = 'moving pt-page-moveFromLeft';
        }
        else
        {
            var class1 = 'moving pt-page-moveToLeft';
            var class2 = 'moving pt-page-moveFromRight';
        }
        if(ispre)
        {
            $('.pages:first').addClass('moving pt-page-moveToRight');
            $('.pages:last').addClass('moving pt-page-moveFromLeft');
        }
        else
        {
            pep.setPageContent($('.pages:first'));			
			$('.pages:first').addClass(class1);
            $('.pages:last').addClass(class2);
        }
        return page;
    },
    'mask':(function(){
        var timer = null;
        return {
            'show':function(type,target,func){
                pep.mask.remove();
                var m = $('<div class="mask"></div>');
                var msg = $(target).attr('message');
                if(!msg || msg === '')msg = '非法操作！';
                switch(type) {
                    case 'rtf':
                        var txt = '关闭';
                        if($(target).attr('btntxt'))txt = $(target).attr('btntxt');
                        var cnt = $('<div class="mask-bg"></div>'+
                            '<div class="mask-tips">'+
                            '<div class="rtf">'+
                            '<div class="info">'+msg+'</div>'+
                            '<div class="ok col-10"> '+txt+' </div>'+
                            '</div>'+
                            '</div>');
                        cnt.appendTo(m);
                        m.appendTo($('body'));
                        cnt.find('.ok').on('click',function(){
                            pep.mask.remove();
                        });
                        break;
                    case 'confirm':
                        var cnt = $('<div class="mask-bg"></div>'+
                        '<div class="mask-tips">'+
                            '<div class="confirm">'+
                                '<div class="info">'+msg+'</div>'+
                                '<div class="ok col-5"> 确定 </div>'+
                                '<div class="col-5 cancel"> 取消 </div>'+
                            '</div>'+
                        '</div>');
                        cnt.appendTo(m);
                        m.appendTo($('body'));
                        cnt.find('.cancel').on('click',pep.mask.remove);
                        if(func)
                        {
                            var c = cnt.find('.confirm');
                            c.attr('data-url',$(target).attr('data-url')).attr('data-target',$(target).attr('data-target')).attr('data-direction',$(target).attr('data-direction'));
                            c.on('click',func);
                        }
                        else
                        cnt.find('.confirm').on('click',function(){
                            pep.mask.remove();
                        });
                        break;
                    case 'warning':
                        var cnt = $('<div class="mask-bg"></div>'+
                        '<div class="mask-tips">'+
                            '<div class="alert">'+
                                '<div class="info">'+msg+'</div>'+
                                '<div class="ok">'+
                                    '确定'+
                                '</div>'+
                            '</div>'+
                        '</div>');
                        cnt.appendTo(m);
                        m.appendTo($('body'));
                        cnt.find('.ok').on('click',function(){
                            pep.mask.remove();
                            if(pep.isTrueVar($(target).attr('forwardUrl')))
                            {
                                if("undefined" != typeof target.page)
                                submitAjax({'url':$(target).attr('forwardUrl')},target.page);
                                else
                                submitAjax({'url':$(target).attr('forwardUrl')});
                            }
                        });
                        break;

                    case 'hismenu':
                        var cnt = $('<div class="mask-bg"></div>'+
                            '<div class="mask-tips">'+
                                '<div class="menu">'+
                                    '<div class="info"><a data-target="pagination" href="index.php?exam-phone-history" class="ajax">强化训练</a></div>'+
                                    '<div class="info"><a data-target="pagination" href="index.php?exam-phone-history&ehtype=1" class="ajax">模拟考试</a></div>'+
                                    '<div class="info"><a data-target="pagination" href="index.php?exam-phone-history&ehtype=2" class="ajax">正式考试</a></div>'+
                                    '<div class="cancel">取消</div>'+
                                '</div>'+
                            '</div>');
                        cnt.appendTo(m);
                        m.appendTo($('body'));
                        cnt.find('.cancel').on('click',function() {
                            pep.mask.remove();
                        });
                        break;

                    case 'bcmenu':
                        var cnt = $('<div class="mask-bg"></div>'+
                            '<div class="mask-tips">'+
                                '<div class="menu">'+
                                '<div class="info"><a data-direction="left" href="index.php?exam-phone-basics-page" class="ajax">考场首页</a></div>'+
                                '<div class="info"><a data-direction="left" href="index.php?exam-phone" class="ajax">我的考场</a></div>'+
                                '<div class="info"><a data-direction="left" href="index.php" class="ajax">返回首页</a></div>'+
                                '<div class="cancel" onclick="javascript:pep.mask.remove();">取消</div>'+
                                '</div>'+
                            '</div>');
                        cnt.appendTo(m);
                        m.appendTo($('body'));
                        break;

                    case 'loading':
                        var cnt = $('<div class="mask-bg"></div>'+
                            '<div class="mask-tips">'+
                                '<div class="loading"></div>'+
                            '</div>');
                        var circle= new Sonic({
                            width: 100,
                            height: 100,
                            stepsPerFrame: 1,
                            trailLength: 1,
                            pointDistance: .02,
                            fps: 30,
                            fillColor: '#05E2FF',
                            step: function(point, index) {

                                this._.beginPath();
                                this._.moveTo(point.x, point.y);
                                this._.arc(point.x, point.y, index * 7, 0, Math.PI*2, false);
                                this._.closePath();
                                this._.fill();

                            },
                            path: [
                                ['arc', 50, 50, 30, 0, 360]
                            ]
                        });
                        circle.play();
                        cnt.find(".loading").html(circle.canvas);
                        cnt.appendTo(m);
                        m.appendTo($('body'));
                        break;

                    default:
                        var cnt = $('<div class="mask-tips"><div class="tips">'+msg+'</div></div>');
                        cnt.appendTo(m);
                        m.appendTo($('body'));
                        timer = setTimeout(function(){
                            pep.mask.remove();
                        },1000);
                        break;
                }

            },
            'remove':function(){
                if(timer != null){
                    clearTimeout(timer);
                    timer = null;
                }
                $('.mask').remove();
            }
        };
    })()
};
function submitAjax(parms,page,ispre){
    if(!parms.query)parms.query = "";
    parms.query += "&userhash="+Math.random();
    if(parms['action-before'])eval(parms['action-before'])();
    if(parms['action-after'])eval(parms['action-after'])();
    pep.currentAjax = $.ajax({"url":parms.url,
        "type":"post",
        "data":parms.query,
        "beforeSend":function(){
            pep.ajaxSending = true;
            if(parms.target){
                pep.mask.remove();
                console.log(parms.target);
                //pep.mask.show('loading');
            }
        },
        'error':function(){
            pep.mask.show('tips',{'message':'网络异常，请检查网络设置！'});
            setTimeout(function(){
                pep.ajaxSending = false;
            },500);
        },
        'timeout':20000,
        "success":function(data){
            setTimeout(function(){
                pep.ajaxSending = false;
            },500);
            var tmp = null;
            try{
                tmp = JSON.parse(data);
            }
            catch(e)
            {}
            finally{
                if(tmp){
                    data = tmp;
                    pep.mask.remove();
                    if(parseInt(data.statusCode) == 200){
                        if(!data.time)data.time = 500;
                        if(data.message)
                        {
                            pep.mask.show('tips',data);
                        }
                        else
                        {
                            data.time = 1;
                        }
                        setTimeout(function(){
                            if(data.callbackType == 'forward')
                            {
                                if(data.forwardUrl && data.forwardUrl != '')
                                {
                                    pep.mask.remove();
                                    if(data.forwardUrl == 'reload')
                                    {
                                        var href = window.location.href;
                                        if(href && href != '')
                                        {
                                            submitAjax({'url': href,'target':$('.pages:first')[0]});
                                        }
                                    }
                                    else if(data.forwardUrl == 'back')
                                    {
                                        setTimeout(function(){history.back();},500);
                                    }
                                    else
                                    {
                                        submitAjax({'url': data.forwardUrl},page);
                                    }
                                }
                            }
                            if(data.callback)
                            {
                                eval(data.callback)();
                            }
                        },data.time);
                    }else if(parseInt(data.statusCode) == 201){
                        if(data.message)
                        {
                            pep.mask.show('tips',data);
                        }
                        if(data.callbackType == 'forward'){
                            if(data.forwardUrl && data.forwardUrl != '')
                            {
                                if(data.forwardUrl == 'reload')
                                {
                                    window.location.reload();
                                }
                                else if(data.forwardUrl == 'back')
                                {
                                    history.back(-1);
                                }
                                else
                                {
                                    window.location = data.forwardUrl;
                                }
                            }
                        }
                        else{
                            window.location = data.forwardUrl;
                        }
                    }else if(parseInt(data.statusCode) == 300){
                        data.page = page;
                        pep.mask.show('warning',data);
                    }else if(parseInt(data.statusCode) == 301){
                        setTimeout(function(){
                            pep.mask.show('warning',data);
                        },500);
                    }
                    else{
                        pep.mask.show('tips',data);
                    }
                    return;
                }
                else
                {
                    if(data)
                    {
                        if(parms.target)
                        {
                            pep.mask.remove();
                            if((typeof parms.target).toLowerCase() == 'string')
                            {
                                if(parms.target == 'pagination')
                                {
                                    $('.pages:first').html(data);
                                }
                                else
                                $('#'+parms.target).html(data);
                            }
                            else
                            {
                                $(parms.target).html(data);
                            }
                        }
                        else
                        {
                            if(!page)page = pep.newPage(parms.title,false,parms.direction);
							var inner = '<div class="pages">'+data+'</div>';
							setTimeout(function(){
                                //page.html(data);
								inner = $(inner);
                                page.replaceWith(inner);
                                pep.initpage(inner,parms.tabindex);
                                $('.mask').remove();
                            },300);
                            if(ispre != true)
                            history.pushState({'id':parms.url},parms.title,parms.url);
                        }
                    }
                    return page;
                }
            }
        }
    });
}
function xvars(x){
    var _this = this;    

    var ginkgo = function(x){
        return core(/(.)*$/gi,x);
    }

    var price = function(x){
        return core(/\d+\.*\d*$/gi,x);
    }

    var datatable = function(x){
        return core(/(\w)+/gi,x);
    }

    var keyword = function(x){
        x.value = x.value.replaceAll('，',',');
        return core(/^[\s|\S]+$/gi,x);
    }

    var english = function(x){
        return core(/^[a-z]+$/gi,x);
    }

    var userid = function(x){
        return core(/^[0-9]+$/gi,x);
    }

    var exp = function(x){
        return core(eval(x.getAttribute('exp')),x);
    }

    var qq = function(x){
        return core(/^\d{5,12}$/gi,x);
    }

    var date = function(x){
        return core(/^\d{4}-\d{1,2}-\d{1,2}$/gi,x);
    }

    var datetime = function(x){
        return core(/^\d{4}-\d{1,2}-\d{1,2}\s\d+:\d+:\d+$/gi,x);
    }

    var telphone = function(x){
        return core(/^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/gi,x);
    }

    var cellphone = function(x){
        return core(/^((\(\d{3}\))|(\d{3}\-))?13[0-9]\d{8}?$|15[89]\d{8}?$/gi,x);
    }

    var url = function(x){
        return core(/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/gi,x);
    }

    var userName = function(x){
        return core(/^[\u0391-\uFFE5|\w]{2,40}$/gi,x);
    }

    var title = function(x){
        return _this.core(/^[\u0391-\uFFE5|\w|\s|-]+$/gi,x);
    }

    var password = function(x){
        return core(/^[\s|\S]{6,}$/gi,x);
    }

    var zipcode = function(x){
        return core(/^[1-9]\d{5}$/gi,x);
    }

    var email = function(x){
        return core(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/gi,x);
    }

    var randcode = function(x){
        return core(/^\d{4}$/gi,x);
    }

    var template = function(x){
        return core(/^\w+$/gi,x);
    }

    var category = function(x){
        return core(/^,[\d|,]+$/gi,x);
    }

    var relation = function(x){
        return core(/^[\d|,|-]+$/gi,x);
    }

    var number = function(x){
        return core(/^\d+$/gi,x);
    }

    var nature = function(x){
        return core(/^[1-9]{1}[0-9]?$/gi,x);
    }
    var core = function(exp,x)
    {
        if(x.attr('type') && x.attr('type').toUpperCase() == 'FILE')
        {
            return {result:true};
        }
        var maxsize = parseInt(x.attr('max'));
        var minsize = parseInt(x.attr('min'));
        var needle = x.attr('needle');
        if( x.attr('type')!='password' && x.val())x.val(x.val().replace(/^\s+/i,'').replace(/\s+$/i,''));
        if(x.get(0).tagName.toUpperCase() == "SELECT"){
            if(needle && x.val() == ""){
                return {result:false,message:x.attr('msg')};
            }
        }

        if(x.attr('maxvalue'))
        {
            var maxv = parseInt(x.attr('maxvalue'));
            if(parseInt(x.val()) > maxv)return {result:false,message:"最大值不能超过"+x.attr('maxvalue')};
        }

        if(x.attr('minvalue'))
        {
            var minv = parseInt(x.attr('minvalue'));
            if(parseInt(x.val()) < minv)return {result:false,message:"最小值不能低于"+x.attr('minvalue')};
        }

        if(x.attr('type')=='checkbox'){
            if(needle && !x.attr('checked')){
                return {result:false,message:x.attr('msg')};
            }
        }
        else{
            if(!needle && x.val() == '')return {result:true};
        }
        if(needle && (x.val() == '' || !x.val()))
            return {result:false,message:x.attr('msg')};
        if(x.attr('equ') && x.attr('equ')!='')
        {
            if(x.val() != $('#'+x.attr('equ')).val())
            {
                return {result:false,message:x.attr('msg')};
            }
        }
        if(maxsize > 0 && x.val().length > maxsize)return {result:false,message:x.attr('msg')};
        if(minsize > 0 && x.val().length < minsize)return {result:false,message:x.attr('msg')};
        try{
            if(x.val().match(exp))return {result:true};
            else return {result:false,message:x.attr('msg')};
        }
        catch(e){
            return false;
        }
    }

    var checkvars = function(x)
    {
        if(x.attr('ajax') == 'get' || x.attr('ajax') == 'post'){
            var d = eval("({'"+x.attr('name')+"':'"+x.val()+"'})");
            var url = x.attr('url');
            var data = $.ajax({
                'url':url,
                async: false,
                'data':d
            }).responseText;
            if(data != '1')return {result:false,message:data};
        }
        try{
            if(x.attr('datatype') && x.attr('datatype') != "")
            {
                var method = eval(x.attr('datatype'));
                return method(x);
            }
            else
                return ginkgo(x);
        }
        catch(e){
            return ginkgo(x);
        }
    }
    return checkvars(x);
}
function formsubmit(){
    var _this = this;
    var status = false;
    var query;
    var target = $(_this).attr('data-target');
    if(!target || target == '')target = null;
    query = $(":input",_this).serialize()+'&userhash='+Math.random();
    $(":input",_this).not('.ckeditor').each(function(){
        var _this = this;
        var data = xvars($(this));
        if(!data.result && !status){
            $(_this).parents(".control-group").addClass("error");
            pep.mask.show('tips',data);
            status = true;
        }
    });
    if(status)return false;
    if(!$(_this).attr('action') || $(_this).attr('action') == '')return false;
    if($(_this).attr('disablebutton') == 'on'){
        $("input:submit",_this).attr('disabled','true');
        $("input:submit",_this).attr('value','正在提交……');
    };
    submitAjax({"url":$(_this).attr('action'),'title':$(_this).attr("data-title"),"query":query,"target":target,'page':$(_this).attr('data-page'),'action-before':$(_this).attr('action-before')});
    return false;
}

var countdown = function(userOptions)
{
    var h,m,s,t,options;
    var init = function()
    {
        options = userOptions;
        options.counttime = options.time*60 - options.lefttime;
        s = options.counttime%60;
        m = parseInt(options.counttime%3600/60);
        h = parseInt(options.counttime/3600);
    }

    var setval = function()
    {
        if(s >= 10)
            userOptions.sbox.html(s);
        else
            userOptions.sbox.html('0'+s.toString());
        if(m >= 10)
            userOptions.mbox.html(m);
        else
            userOptions.mbox.html('0'+ m);
        if(h >= 10)
            userOptions.hbox.html(h);
        else
            userOptions.hbox.html('0'+ h);
    }

    var step = function()
    {
        if(s > 0)
        {
            s--;
        }
        else
        {
            if(m > 0)
            {
                m--;
                s = 60;
                s--;
            }
            else
            {
                if(h > 0)
                {
                    h--;
                    m = 60;
                    m--;
                    s = 60;
                    s--;
                }
                else
                {
                    clearInterval(pep.countdownloop);
                    userOptions.finish();
                    return ;
                }
            }
        }
        setval();
    }
    init();
    pep.countdownloop = setInterval(step, 1000);
    return function(lefttime){
        options.lefttime = lefttime;
        init();
    }
};

function inituploader()
{
    var _this = this;
    var ismul = false;
    var petemplate = 'pe-template';
    var petype = 'thumb';
    var ftype = ['jpeg', 'jpg', 'gif', 'png'];
    var maxsize = '20480000';
    if($(_this).attr('attr-list') == 'true')ismul = true;
    if($(_this).attr('attr-maxsize') && $(_this).attr('attr-maxsize') != '')
    {
        maxsize = $(_this).attr('attr-maxsize');
    }
    if($(_this).attr('attr-template') &&  $(_this).attr('attr-template') != '')petemplate = $(_this).attr('attr-template');
    if($(_this).attr('attr-ftype') &&  $(_this).attr('attr-ftype') != '')ftype = $(_this).attr('attr-ftype').split(',');
    switch($(_this).attr('attr-type'))
    {
        case 'thumb':
        case 'list':
        case 'files':
            petype = $(_this).attr('attr-type');
            break;

        default:
            petype = 'thumb';
    }
    return new qq.FineUploader({
        'element': _this,
        'multiple': ismul,
        'template': petemplate,
        'request': {
            'endpoint': 'index.php?document-api-fineuploader&imgwidth=375',
            'method': 'POST'
        },
        'thumbnails': {
            'placeholders': {
                'waitingPath': 'files/public/img/loader.gif',
                'notAvailablePath': 'files/public/img/noimage.gif'
            }
        },
        'validation': {
            'sizeLimit': maxsize,
            'allowedExtensions': ftype
        },
        'deleteFile': {
            enabled: false
        },
        'callbacks': {
            'onSubmit':  function(id,  fileName)  {
                if(petype != 'list')
                {
                    $(_this).find('.qq-upload-list-selector').html('');
                    $(_this).find('.qq-upload-list-selector').eq(1).remove();
                }
            },
            'onProgress': function(id, fileName, loaded, total) {
                if (loaded < total)
                {
                    progress = Math.round(loaded / total * 100) + '%';
                    $(_this).find('.process').html(progress);
                    $(_this).find('[qq-file-id='+id+'] .qq-thumbnail-selector').css('opacity',progress/200).css('filter','grayscale(100%)');
                }
                else
                {
                    $(_this).find('.process').html('');
                    $(_this).find('[qq-file-id='+id+'] .qq-thumbnail-selector').css('opacity',0.5).css('filter','grayscale(100%)');
                }

            },
            'onComplete': function(id,fileName,responseJSON) {
                if(responseJSON.status == 'fail')
                {
                    alert(responseJSON.message);
                    $(_this).find('[qq-file-id='+id+'] .qq-edit-filename-selector').parent().find("a.btn:first").attr('href',responseJSON.thumb).removeClass('primary').html('上传失败');
                    return;
                }
                $(_this).find('[qq-file-id='+id+'] .qq-thumbnail-selector').css('opacity',1).css('filter','none').attr('src',responseJSON.thumb);
                $(_this).find('[qq-file-id='+id+'] .qq-edit-filename-selector').val(responseJSON.thumb).blur().parent().find("a.btn:first").attr('href',responseJSON.thumb).addClass('primary').html('已上传');;
                if(petype == 'list')
                {
                    var tpl = $(_this).find('.listimg').first().html().replace(/\*name\*/g,$(_this).attr('attr-name'));
                    tpl = tpl.replace(/\*value\*/g,responseJSON.thumb);
                    $('#'+$(_this).attr('attr-box')).append(tpl);
                }else if(petype == 'exam'){
					try{
						var now = Date.parse(new Date())/1000;
						initData = JSON.parse(storage.getItem('questions'));
						if(!initData)initData = new Object();
						initData[$(_this).attr('rel')] = {value:responseJSON.thumb,time:now};
						markQuestions();
					}catch{
						//
					}finally{
						//
					}
				}
            }
        }
    });
}

function confirmDialog(){
    var _this = this;
    var href = $(_this).attr('href');
    $(_this).attr('href','javascript:;');
    if(!pep.isTrueVar($(_this).attr('data-url')))
    $(_this).attr('data-url',href);
    if($(_this).hasClass('formconfirm'))
    {
        pep.mask.show('confirm',_this,function(){
            $(_this).parents('form:first').submit();
        });
    }
    else
    {
        pep.mask.show('confirm',_this,pep.goPage);
    }
}

function combox(){
    var _this = this;
    if($(_this).attr("target") && ($(_this).attr("target") != "")){
        console.log($(_this));
        var url = $(_this).attr("refUrl").replace(/{value}/,$(_this).val());
        if($(_this).attr('valuefrom') && ($(_this).attr('valuefrom') != "")){
            var t = $(_this).attr('valuefrom').split("|");
            for(i=0;i<t.length;i++)
            {
                url = url.replace(eval("/{"+t[i]+"}/gi"),$('#'+t[i]).val());
            }
        }
        submitAjax({'url':url,'target':$(_this).attr("target")});
        if($(_this).attr("callback") && $(_this).attr("callback") != "")
        {
            eval($(_this).attr("callback"))($(_this));
        }
    }
}
function cleardata()
{
    $('body').removeData();
}
$(function(){
    $(".autoloaditem").each(function(){
        if($(this).attr('autoload') && $(this).attr('autoload') != '')
            $(this).load($(this).attr('autoload')+"&current="+$(this).attr('current'));
    });
    $("body").delegate("a.ajax","click",pep.goPage);
    $("body").delegate("a.confirm","click",confirmDialog);
    $("body").delegate("form","submit",formsubmit);
    $('body').delegate('.page-footer .menu','click',function(){
        var _this = $(this);
        var index = _this.index();
        pep.initpage(_this.parents('.pages:first'),index,true);
    });
    $('.fineuploader').each(inituploader);
    $("body").delegate("select.combox","change",combox);
	$("body").delegate(".pages","animationstart webkitAnimationStart oAnimationStart",function(){
        if($(this).hasClass('moving'))
        {
            pep.allowpre = false;
        }
    });
	$("body").delegate(".pages","animationend webkitAnimationEnd oAnimationEnd",function(){
        $(this).removeClass('pt-page-moveFromRight').removeClass('pt-page-moveToRight').removeClass('pt-page-moveFromLeft').removeClass('pt-page-moveToLeft').removeClass("moving");
        if($(".pages").length > 1){
            $('.pages:first').remove();
        }
        pep.allowpre = true;
    });
    pep.initpage($('.pages:first'));
    window.addEventListener("hashchange", function(e) {
		return false;
    }, false);
    window.addEventListener("popstate", function(e) {
        if(pep.isTrueVar($('.pages:first').find('.page-content:first').attr('data-callback')))
        {
            $('body').removeData();
            eval($('.pages:first').find('.page-content:first').attr('data-callback'))();
        }
        else if($('.pages:first').find('.page-content:first').attr('data-refresh') == 'yes')
        {
            $('body').removeData();
            pep.goPrePage();
        }
        else
        {
            pep.goPrePage();
        }
    }, false);
})