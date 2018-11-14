var http = require('http')
var bl = require('bl')
var count = 0
var responseArr = []

function printResponses() {
  responseArr.forEach(res => {
    console.log(res);
  })
};

function httpGet(index) {
  http.get(process.argv[2 + index], function (response) {
    response.pipe(bl(function (err, data) {
      if (err) {
        return console.error(err);
      }

      responseArr[index] = data.toString();
      ++count;

      if (count === 3) {
        printResponses();
      }
    }))
  })
}

for (var i = 0; i < 3; i++) {
  httpGet(i);
}