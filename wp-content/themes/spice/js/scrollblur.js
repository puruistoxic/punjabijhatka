/**
 * Scroller
 */
function Scroller()
{
  this.latestKnownScrollY = 0;
  this.ticking            = false;
  
}

Scroller.prototype = {
  /**
   * Initialize
   */
  init: function(o) {
    window.addEventListener('scroll', this.onScroll.bind(this), false);
    this.content  = o.content;
    this.test = o.test;
  },

  /**
   * Capture Scroll
   */
  onScroll: function() {
    this.latestKnownScrollY = window.scrollY;
    this.requestTick();
  },

  /**
   * Request a Tick
   */
  requestTick: function() {
    if( !this.ticking ) {
      window.requestAnimFrame(this.update.bind(this));
    }
    this.ticking = true;
  },

  /**
   * Update.
   */
  update: function() {
    var currentScrollY = this.latestKnownScrollY;
    this.ticking       = false;
    
    /**
     * Do The Dirty Work Here
     */
    var slowScroll = currentScrollY / 4,
        blurScroll = currentScrollY * 2;

    this.test.css({
      '-webkit-filter' : 'blur(' + slowScroll/10 + 'px)',
      '-moz-filter' : 'blur(' + slowScroll/10 + 'px)',
      '-filter' : 'blur(' + slowScroll/10 + 'px)',

    });
  }
};