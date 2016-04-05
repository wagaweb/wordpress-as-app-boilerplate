module.exports = Backbone.Model.extend({
    initialize: function() {
        "use strict";
        console.log("It'backend time!");
        this.do_stuff();
    },
    do_stuff: function(){
        "use strict";
    }
});