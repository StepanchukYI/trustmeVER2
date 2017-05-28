/**
 * Created by Illya on 21.05.2017.
 */
function func() {
    console.log("Clicked");
    var str = "WebSocket";
    //var socket = new WebSocket("ws://echo.websocket.org");
    var socket = new WebSocket("ws://localhost:8080");
    socket.onmessage = function(e) {
        console.log(e.data);
    };

    socket.onopen = function(e) {
        console.log("Opened");
        socket.send(str);
    };

    socket.onerror = function (e) {
      console.log(e);
    };
}