google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart(){
    $.getJSON('http://pmon01.skp-dp.sde.dk/shoe-size-collection/api/sscInfo/read.php', function(data){
        var chartData = new google.visualization.DataTable();
        chartData.addColumn('number', 'Skostørrelse');
        chartData.addColumn('number', 'Antal');

        $.each(data.records, function(key, val){
            chartData.addRow(
                [parseFloat(val.shoe_size), getOccurrence(data.records, val.shoe_size, 'shoe_size')]
            );
        });
        var options = {
            'title':'Hyppighed af skostørrelser', 
            'width':$(window).width()*0.33, 
            'height':$(window).height()*0.5,
            'hAxis':{
                'viewWindow': {
                    'min': getMin(data.records, 'shoe_size'),
                    'max': getMax(data.records, 'shoe_size')
                },
                'ticks': getEveryUnique(data.records, 'shoe_size')
            },
            'vAxis':{
                'ticks': getEveryUnique(getOccurrences(data.records, 'shoe_size'), 'count')
            }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(chartData, options);
    });
}

function getOccurrence(json, value, property){
    var count = json.filter(function(d){return d[property] === value}).length;

    return count;
}

function getOccurrences(json, property){
    counts = [];
    
    for(var i = 0; i < json.length; i++){
        counts.push({
            "count": getOccurrence(json, json[i][property], property)
        });
    }

    // Clean
    counts = Array.from(new Set(counts));
    
    console.log(counts);
    return counts;
}

function getMax(json, property){
    return Math.max.apply(Math, json.map(function(o){return o[property]}));
}

function getMin(json, property){
    return Math.min.apply(Math, json.map(function(o){return o[property]}));
}

function getEveryUnique(json, property){
    var arr = [];
    var shoesizearr = [];

    for(var i = 0; i < json.length; i++){
        arr.push(parseInt(json[i][property]));
    }

    shoesizearr = Array.from(new Set(arr));
    console.log(shoesizearr);
    return shoesizearr;
}