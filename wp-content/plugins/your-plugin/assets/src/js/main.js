jQuery(document).ready(function($) {
    "use strict";
    if (shopPluginData.isAdmin) {
        /*************
         *************
         * ADMIN
         *************
         *************/
        var dashboard = require("./controllers/dashboard.js");
        new dashboard();
    }else{
        /*************
         *************
         * PUBLIC
         *************
         *************/
        var frontend = require("./controllers/frontend.js");
        new frontend();
    }
});