// content of index.js
const http = require('http')
const port = 3000
const url = require('url')
const homePage = '/Home'
const getData = '/getData'
const aboveNbeyond = '/AboveNbeyond'

//Callback function
const requestHandler = (request, response) => {
	console.log(request.url)
	var q = url.parse(request.url, true)
	if (q.pathname == homePage)
	{
		response.writeHead(200, {'Content-Type': 'text/html'});
		response.write("<h1>Welcome to the Home Page</h1>")
		response.end()
	}
	else if (q.pathname == getData)
	{
		obj = {name: "Josue Ruiz", class: "Cs313"}
		JSONresponse = JSON.stringify(obj)
		response.writeHead(200, {"Content-Type": "application/json"})
		response.end(JSONresponse)
	}  
	else if (q.pathname == aboveNbeyond) 
	{
		var query = q.query;
		response.writeHead(200, {'Content-Type': 'text/html'});
		if (query.month == 1 && query.day == 5){
			response.write("<h1>Happy Birthday!!!</h1>")
		}
		else
		{
			response.write("<h1>Not your Birthday yet</h1>")
		}
		response.end()
	}
	else
	{
		response.writeHead(404, {"Content-Type": "text/html"})
		response.end()
	}
}

const server = http.createServer(requestHandler)

server.listen(port, (err) => {
	if (err) {
		return console.log('something bad happened', err)
	}

	console.log(`server is listening on ${port}`)
})