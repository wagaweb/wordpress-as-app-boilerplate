module.exports = Backbone.Model.extend({
    initialize: function() {
        "use strict";
        var self = this,
            $ = jQuery;
        $(window).resize(function(){
            self.on_resize();
        });
        this.on_ready();
        $(window).on("load",this.on_loaded());
    },
    /**
     * Performs actions on document ready
     */
    on_ready: function() {
        "use strict";
        var self = this,
            $ = jQuery;

        //Begin edit here
    },
    /**
     * Performs actions on window resize
     */
    on_resize: function(){
        "use strict";
        var self = this,
            $ = jQuery;

        //Begin edit here
        console.log("Resized");
    },
    /**
     * Perform actions on window load
     */
    on_loaded: function(){
        "use strict";
        var self = this,
            $ = jQuery;

        //Begin edit here
        console.log("Loaded");
    }
});
