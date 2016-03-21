// Modules
var express = require('express');
var path = require('path');
var request = require('request');
var d3 = require('d3');
var lineChart=require('./linechart');

var getLineChart = function (params){
var chart = lineplot()
	.data(params.data)
	.width
	.height
	xAxisLabel
