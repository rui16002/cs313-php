var http = require('http')
var bl = require('bl');

var myBL = new bl(function(err, myBL){
    console.log(myBL.length);
    console.log(myBL.toString());
});

var url = process.argv[2];
http.get(url, function(response){
    response.pipe(myBL);
    response.on('end', function(){
        myBL.end();
    });
});