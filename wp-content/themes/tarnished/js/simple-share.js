/* 
 Document   : Share JS
 Created on : May 29, 2013, 11:48:17 AM
 Author     : mcassella, Chenjie Yang
 Description:
 Simple Share links creates share URLs for each social network without having heavy scripts on the page. 
 */

//Shared Count API
jQuery.sharedCount = function(url, fn) {
    url = encodeURIComponent(url || location.href);
    var arg = {
        url: "//" + (location.protocol == "https:" ? "sharedcount.appspot" : "api.sharedcount") + ".com/?url=" + url,
        cache: true,
        dataType: "json"
    };
    if ('withCredentials' in new XMLHttpRequest) {
        arg.success = fn;
    }
    else {
        var cb = "sc_" + url.replace(/\W/g, '');
        window[cb] = fn;
        arg.jsonpCallback = cb;
        arg.dataType += "p";
    }
    return jQuery.ajax(arg);
};

jQuery.sharedCount(location.href, function(data) {
    //jQuery("#tweets").text(data.Twitter); jQuery("#likes").text(data.Facebook.like_count);
    //jQuery("#plusones").text(data.GooglePlusOne);
    jQuery(".simpleShare span").text((data.GooglePlusOne + data.Twitter + data.Facebook.like_count + data.StumbleUpon + data.Pinterest)).fadeIn();

});

// Twitter stuff
var mention = "";
var hashes = "";

jQuery(function() {
    //Get all the data to create share URLs
    //Set defaul window height and width
    var wheight = 450;
    var wwidth = 600;

    //We get the URL of the link
    var loc = jQuery(location).attr('href'); //jQuery(this).attr('href');
    loc = loc.replace(/#/g, "%23");
    //We get the title of the link
    //var title = jQuery('meta[property="og:title"]').attr("content");
    //if (typeof title === 'undefined') {
        title = jQuery('h1').text();
    //}
    title = title.replace(/ /g, "%20"); 
    title = title.replace(/#/g, "%23");

    //Pinterest vars
    var isVideo = "";
    if (jQuery('meta[property="og:video"]').length > 0) {isVideo = "&is_video=yes";}
    //if (!isVideo) {isVideo = "";} // If there is no tag or its undefined set it to no
    var imgURL = jQuery('meta[name="og:image"]').attr("content");

    //Facebook Description
    var description = jQuery('meta[property="og:description"]').attr("content");

// Create all the social share links on page load GO!
    jQuery(".simpleShare a, #simpleShare a").each(function() {
        var a = jQuery(this);

        //We get shortened URL using Bitly API
        var shortenURL = function(shortenURL)
        {
            var url=loc;
            var username="mixjunkies";
            var key="R_65a8398072ee08136a55a9c5baaae10f";
            jQuery.ajax({
                url:"http://api.bit.ly/v3/shorten",
                data:{longUrl:url,apiKey:key,login:username},
                dataType:"jsonp",
                success: shortenURL
            });
            if (!mention && $(a).attr("data-mention")) {
                                                mention = $(a).attr("data-mention") + " ";
                                        } else if (!mention && $('meta[name="twitter:site"]').attr("content")) {
                                                mention = $('meta[name="twitter:site"]').attr("content") + " ";
                                        }
                                        title = title.replace(/\|/g, "%7C").replace(/\#/g, "%23").replace(/\&/g, "%26");
                                        shareURL = "http://twitter.com/intent/tweet?status=" + title + " " + mention + loc;
                                        if (a.parent().hasClass("scode")) {
                                                wheight = a.parent().attr("height");
                                                wwidth = a.parent().attr("width");
                                        } else {	
                                                wheight = 440;
                                                wwidth = 550;
                                        }
                                        $(a).attr("href", shareURL).attr("width", wwidth).attr("height", wheight);
        };


        //We apply the shortened URL and assign share URLs for each
        shortenURL(function(data) {
            var shortURL = data.data.url;
            
            var shareURL = "none";

            if (a.hasClass("gp") || a.hasClass('gog')) {
                shareURL = "https://plus.google.com/share?url=" + loc;
                wheight = 400;
                wwidth = 550;

            } else if (a.hasClass("pin")) {
                shareURL = "http://pinterest.com/pin/create/bookmarklet/?media=" + imgURL + "&url=" + loc + "&title=" + title + isVideo + "&description=" + description;
                wheight = 360;
                wwidth = 800;

            } else if (a.hasClass("fb")) {

                shareURL = "https://www.facebook.com/sharer/sharer.php?s=100&p[url]=" + loc + "&p[images][0]=" + imgURL + "&p[title]=" + title + "&p[summary]=" + description;
                wheight = 420;
                wwidth = 560;

            } else if (a.hasClass("tw") || a.hasClass('twit')) {
                //Get the Twitter mention if it doesn't exist set it to blank
                if (!mention) {
                    mention = jQuery(a).attr("data-mention") + " ";
                }

                // Get Twitter hashes NOT IN USE
                if (!hashes) {
                    hashes = jQuery(a).attr("data-hash");
                }
                if (!shortURL) {
                    shortURL = loc;
                }
                shareURL = "http://twitter.com/intent/tweet?status=" + title + " " + mention + shortURL;
                wheight = 440;
                wwidth = 550;
            }
            // Inject the share URL into the links
            jQuery(a).attr("href", shareURL).attr("width", wwidth).attr("height", wheight);
        });
    });
    //END .each

// Now we create the pop up functionality
    // link selector and pop-up window size
    var Config = {
        // Need the id for older versions
        Link: ".simpleShare .fb, .simpleShare .gog, .simpleShare .pin ",
    };

    // add handler links
    var slink = document.querySelectorAll(Config.Link);
    for (var i = 0; i < slink.length; i++) {
        slink[i].onclick = PopupHandler;
    }

    // create popup
    function PopupHandler(e) {

        e = (e ? e : window.event);
        var t = (e.target ? e.target : e.srcElement);

        //window size
        var wheight = jQuery(this).attr("height");
        var wwidth = jQuery(this).attr("width");

        // popup position
        var
                px = Math.floor(((screen.availWidth || 1024) - wwidth) / 2),
                py = Math.floor(((screen.availHeight || 700) - wheight) / 2);

        // open popup
        var popup = window.open(t.href, "social",
                "width=" + wwidth + ",height=" + wheight +
                ",left=" + px + ",top=" + py +
                ",location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1");
        if (popup) {
            popup.focus();
            if (e.preventDefault)
                e.preventDefault();
            e.returnValue = false;
        }

        return !!popup;
    }
// END pop up stuff
});
//END DOC READY