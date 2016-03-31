<?php
session_start(); 
;?>
<meta charset="utf-8">
<LINK href="../../public/css/interface.css" rel="stylesheet" type="text/css" />
<LINK href="../../public/css/flat-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../public/js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="../../public/js/interface.js"></script>
<style> /* set the CSS */

body { font: 12px Arial;}

path { 
    stroke: steelblue;
    stroke-width: 2;
    fill: none;
}

.axis path,
.axis line {
    fill: none;
    stroke: grey;
    stroke-width: 1;
    shape-rendering: crispEdges;
}
</style>
<body>
<script src="http://d3js.org/d3.v3.min.js"></script>
<script>
// Set the dimensions of the canvas / graph
var margin = {top: 30, right: 20, bottom: 30, left: 50},
    width = 600 - margin.left - margin.right,
    height = 270 - margin.top - margin.bottom;

// Parse the date / time
//var parseDate = d3.time.format("%d-%b-%y").parse;
var parseDate = d3.time.format("%Y-%m-%d %H:%M:%S").parse;
// Set the ranges
var x = d3.time.scale().range([0, width]);
var y = d3.scale.linear().range([height, 0]);

// Define the axes
var xAxis = d3.svg.axis().scale(x)
    .orient("bottom").ticks(5);

var yAxis = d3.svg.axis().scale(y)
    .orient("left").ticks(5);

// Define the line
var valueline = d3.svg.line()
    .x(function(d) { return x(d.date); })
    .y(function(d) { return y(d.RealPower); });
   
// Adds the svg canvas
var svg = d3.select("body")
    .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
    .append("g")
        .attr("transform", 
              "translate(" + margin.left + "," + margin.top + ")");

// Get the data
d3.json("datad.php", function(error, data) {
    data.forEach(function(d) {
        d.date = parseDate(d.date);
        d.RealPower = +d.RealPower;
	d.ApparentPower = +d.ApparentPower;
   
    });
    //});

    // Scale the range of the data
    x.domain(d3.extent(data, function(d) { return d.date; }));
    y.domain([0, d3.max(data, function(d) { return d.RealPower; })]);

    // Add the valueline path.
    svg.append("path")
        .attr("class", "line")
	.attr("d", valueline(data));
    svg.append("circle")
        .attr("class", "dot")
	.attr("d", valueline(data));
    svg.selectAll("dot")
	.data(data)
    .enter().append("circle")
	.attr("r", 3.5)
	.attr("cx",function(d) { return x(d.date); })
	.attr("cy", function(d) { return y(d.RealPower); }); 
    // Add the X Axis
    svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);

    // Add the Y Axis
    svg.append("g")
        .attr("class", "y axis")
        .call(yAxis);

});
</script>
<div> 
<div class="display" id="powerDisplay">Power Used:<?php echo $_SESSION['powerused'];?></div>
<div class="display" id="costDisplay">Power Cost: <?php echo $_SESSION['powercostd'];?></div>
  <button class="btn btn-block btn-lg btn-primary" 
  type="button" onClick="parent.location='http://localhost/smartplug/New/Smartplug/interface/views/Hour/graph.php'">Hour</button>
  <button class="btn btn-block btn-lg btn-primary" 
  type="button" onClick="parent.location='http://localhost/smartplug/New/Smartplug/interface/views/Week/graphw.php'">Week</button>
<button class="btn btn-block btn-lg btn-primary" 
	  type="button" onClick="parent.location='http://localhost:3000'">Return</button>

<script src="displayd.php" ></script>

</div>
</body>
