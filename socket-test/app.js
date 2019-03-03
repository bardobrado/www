const app = require('express')();
const http = require('http').Server(app);

app.get('/', function(req, res) {
    res.sendFile(__dirname +'/index.html');
});

http.listen(3000, function(){
    console.log("Listening on port 3000");
});