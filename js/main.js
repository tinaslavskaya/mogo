	function loadFunc() {}

	function resizeFunc() {}

	function scrollFunc() {}

	function getAllClasses(e, t) {
	    function i(e) { for (var t = e.length, i = 0, n = [], o = 0; t > o; o++) { for (var a = 0; i > a && n[a] !== e[o];) a++;
	            a == i && (n[i++] = e[o]) } return n } for (var n = [], o = [], a = $(e).find($("*")), r = 0; r < a.length; r++) { var s = a[r],
	            l = s.className; if (l.length > 0) { var d = l.split(" "),
	                g = d.length; if (1 === g) o.push("." + d[0] + " {");
	            else { for (var c = "." + d[0] + " {", A = 1; A < d.length; A++) c += " &." + d[A] + " { }";
	                o.push(c) } } } var p = i(o);
	    p.forEach(function(e) { for (var t = !1, i = e.split("&"), o = 0; o < n.length; ++o) { var a = n[o].split("&"); if (a[0] == i[0]) { t = !0; for (var r = 0; r < i.length; ++r) a.indexOf(i[r]) < 0 && a.push(i[r]);
	                n[o] = a.join("&") } } t || n.push(e) }); for (var r = 0; r < n.length; r++) $("<div>" + n[r] + " }</div>").appendTo(t) }
	var $body, windowHeight, windowWidth, $userMenuButt, mediaPoint1 = 1024,
	    mediaPoint2 = 768,
	    mediaPoint3 = 480,
	    mediaPoint4 = 320;
	$(document).ready(function(e) { 
		$body = e("body"), $menuTrigger = e("#menu_trigger"), windowWidth = e(window).width(), 
		windowHeight = e(window).height(), getAllClasses("html", ".elements_list"), 
		$menuTrigger.on("click", function() { $body.hasClass("menu_open") ? ($body.removeClass("menu_open"), 
		e(this).removeClass("active_mod")) : ($body.addClass("menu_open"), e(this).addClass("active_mod")) }), 
		e(".accordion_content").hide(), 
		e(".accordion_title").click(function() { e(this).parent().toggleClass("active").siblings().removeClass("active"), 
		e(".accordion_content").slideUp(), e(this).next().is(":visible") || e(this).next().slideDown() }),
	    e(".testimonials").bxSlider({ pager: !1, prevText: "", nextText: "" }) }), $(window).on("load", function() { loadFunc() 
	}), 
    $(window).on("resize", function() { resizeFunc() }), $(window).on("scroll", function() { scrollFunc() });