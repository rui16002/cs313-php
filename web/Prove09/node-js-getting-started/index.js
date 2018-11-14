var express = require('express');
var app = express();
const mailTypes = ["Letters (Stamped)1,4", "Letters (Metered)1,4", "Large Envelopes (Flats)2", "First-Class Package Service—Retail"]
const rates = {
  "Letters (Stamped)1,4": {
    "1": 0.5,
    "2": 0.71,
    "3": 0.92,
    "3.5": 1.13
  },
  "Letters (Metered)1,4": {
    "1": 0.47,
    "2": 0.68,
    "3": 0.89,
    "3.5": 1.1
  },
  "Large Envelopes (Flats)2": {
    "1": 1,
    "2": 1.21,
    "3": 1.42,
    "4": 1.63,
    "5": 1.84,
    "6": 2.05,
    "7": 2.26,
    "8": 2.47,
    "9": 2.68,
    "10": 2.89,
    "11": 3.1,
    "12": 3.31,
    "13": 3.52
  },
  "First-Class Package Service—Retail": {
    "1": 3.5,
    "2": 3.5,
    "3": 3.5,
    "4": 3.5,
    "5": 3.75,
    "6": 3.75,
    "7": 3.75,
    "8": 3.75,
    "9": 4.1,
    "10": 4.45,
    "11": 4.8,
    "12": 5.15,
    "13": 5.5
  }
}

app.set('port', (process.env.PORT || 5000));

app.use(express.static(__dirname + '/public'));

// views is directory for all template files
app.set('views', __dirname + '/views');
app.set('view engine', 'ejs');

app.get('/getRate', handleRate);

app.listen(app.get('port'), function() {
	console.log('Node app is running on port', app.get('port'));
});

function handleRate(request, response) {
	var mailType = request.query.mailType;
	var weight = Number(request.query.weight);

	// TODO: Here we should check to make sure we have all the correct parameters

	calculateRate(response, mailType, weight);
}

function calculateRate (response, mailType, weight) {
	var postage = 0;
	postage = rates[mailType][weight];

	if (!postage) {postage = "There is no rate for the given selection";}

	// Set up a JSON object of the values we want to pass along to the EJS result page
	var params = {mailType: mailType, weight: weight, postage: postage};

	// Render the response, using the EJS page "result.ejs" in the pages directory
	// Makes sure to pass it the parameters we need.
	response.render('pages/result', params);

}
