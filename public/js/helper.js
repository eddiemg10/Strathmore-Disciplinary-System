// Disable scrolling. Useful when using modal forms

function stopScroll() {
    // lock scroll position, but retain settings for later
    var scrollPosition = [
        self.pageXOffset ||
            document.documentElement.scrollLeft ||
            document.body.scrollLeft,
        self.pageYOffset ||
            document.documentElement.scrollTop ||
            document.body.scrollTop,
    ];
    var html = jQuery("html"); // it would make more sense to apply this to body, but IE7 won't have that
    html.data("scroll-position", scrollPosition);
    html.data("previous-overflow", html.css("overflow"));
    html.css("overflow", "hidden");
    window.scrollTo(scrollPosition[0], scrollPosition[1]);
}

function resumeScroll() {
    var html = jQuery("html");
    var scrollPosition = html.data("scroll-position");
    html.css("overflow", html.data("previous-overflow"));
    window.scrollTo(scrollPosition[0], scrollPosition[1]);
}
