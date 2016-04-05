module.exports = Backbone.Model.extend({
    initialize: function() {
        "use strict";
        this.on_ready();
    },
    /**
     * Performs actions on document ready
     */
    on_ready: function() {
        "use strict";
        var self = this,
            $ = jQuery;

        $(window).on("resize",this.on_resize());
        $(window).on("load",this.on_loaded());

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
