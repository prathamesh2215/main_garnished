function showClock(e) {
    var o = "";
    o = "1" == e.ssl ? '<embed src="https://secure.clocklink.com/clocks/' : '<embed src="http://www.clocklink.com/clocks/', o += e.clockfile, o += "?";
    for (prop in e) "clockfile" != prop && "width" != prop && "height" != prop && "wmode" != prop && "type" != prop && (o += "Title" == prop || "Message" == prop ? prop + "=" + e[prop] + "&" : prop + "=" + _escape(e[prop]) + "&");
    o += '" ', o += ' width="' + e.width + '"', o += ' height="' + e.height + '"', o += ' wmode="' + e.wmode + '"', o += ' type="application/x-shockwave-flash">', document.write(o)
}

function showClockHtml5(e) {
    var o = '<iframe id="ifrm" scrolling="no" frameborder="0" ';
    o += 'style="overflow:hidden;border:0;margin:0;padding:0;', o += "width:" + e.width + "px;height:" + e.height + 'px;"', o += "1" == e.ssl ? 'src="https://www.clocklink.com/html5embed.php?' : 'src="http://www.clocklink.com/html5embed.php?', o += "clock=" + e.clockfile, o += "&timezone=" + e.timezone, o += "&color=" + e.color, o += "&size=" + e.size, o += '" /></iframe>', document.write(o)
}

function _escape(e) {
    return e = e.replace(/ /g, "+"), e = e.replace(/%/g, "%25"), e = e.replace(/\?/, "%3F"), e = e.replace(/&/, "%26")
}

function showBanner(e) {
    document.write(e)
}

function isCanvasSupported() {
    var e = document.createElement("canvas");
    return !(!e.getContext || !e.getContext("2d"))
}

function homeEmbed(e) {
    var o = (new Date, new Object);
    isCanvasSupported() ? (o.clockfile = "005", o.width = 150, o.height = 150, o.color = "gray", o.size = 150, o.timezone = e, showClockHtml5(o)) : (o.clockfile = "0001-gray.swf", o.width = 150, o.height = 150, o.TimeZone = e, o.wmode = "transparent", showClock(o))
}