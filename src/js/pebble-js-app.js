var show_week = 0;
var show_month = 0;
var version = "1.1.2";

function logVariables() {
	console.log("        show_week: " + show_week);
	console.log("        show_month: " + show_month);
}

Pebble.addEventListener("ready", function() {
        console.log("Ready Event");
        
        show_week = localStorage.getItem("show_week");
        if (!show_week) {
                show_week = 1; // Default: Show week numbers
        }
        show_month = localStorage.getItem("show_month");
        if (!show_month) {
                show_month = 1; // Default: Show months
        }
        
        logVariables();
                                                
        Pebble.sendAppMessage(JSON.parse('{"show_week":'+show_week+',"show_month":'+show_month+'}'));

});

Pebble.addEventListener("showConfiguration", function(e) {
        console.log("showConfiguration Event");

        logVariables();
                                                
        Pebble.openURL("http://www.torstenaugustsson.com/pebble/today/settings.php?" +
                                 "show_week=" + show_week +
                                 "&show_month=" + show_month +
                                 "&version=" + version );
});

Pebble.addEventListener("webviewclosed", function(e) {
        console.log("Configuration window closed");
        console.log(e.type);
        console.log(e.response);

        var configuration = JSON.parse(e.response);
        Pebble.sendAppMessage(configuration);
        
        show_week = configuration["show_week"];
        localStorage.setItem("show_week", show_week);

        show_month = configuration["show_month"];
        localStorage.setItem("show_month", show_month);

});

