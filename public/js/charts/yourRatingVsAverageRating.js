var data = {
    labels: ["Agression", "Agility", "Composure", "Corners", "Creativity"],
    datasets: [
        {
            label: "Average Rating",
            fillColor: "rgba(100,100,200,0.2)",
            strokeColor: "rgba(100,100,255,0.5)",
            pointColor: "rgba(0,0,255,0.5)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [3, 3, 3, 3, 3]
        },
        {
            label: "Your Rating",
            fillColor: "rgba(200,100,100,0.2)",
            strokeColor: "rgba(250,100,100,0.5)",
            pointColor: "rgba(255,0,0,0.5)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [4, 3, 4, 2, 5]
        }
    ]
};

var options = {
    //Boolean - Whether to show lines for each scale point
    scaleShowLine : true,

    //Boolean - Whether we show the angle lines out of the radar
    angleShowLineOut : true,

    //Boolean - Whether to show labels on the scale
    scaleShowLabels : false,

    // Boolean - Whether the scale should begin at zero
    scaleBeginAtZero : true,

    //String - Colour of the angle line
    angleLineColor : "rgba(0,0,0,.1)",

    //Number - Pixel width of the angle line
    angleLineWidth : 1,

    //String - Point label font declaration
    pointLabelFontFamily : "'Arial'",

    //String - Point label font weight
    pointLabelFontStyle : "bold",

    //Number - Point label font size in pixels
    pointLabelFontSize : 10,

    //String - Point label font colour
    pointLabelFontColor : "#666",

    //Boolean - Whether to show a dot for each point
    pointDot : true,

    //Number - Radius of each point dot in pixels
    pointDotRadius : 3,

    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth : 1,

    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius : 20,

    //Boolean - Whether to show a stroke for datasets
    datasetStroke : true,

    //Number - Pixel width of dataset stroke
    datasetStrokeWidth : 2,

    //Boolean - Whether to fill the dataset with a colour
    datasetFill : true,

    //String - A legend template
    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
}

// <!> this part needs to go before the new chart statement below <!>
// Get the context of the canvas element we want to select
var ctx = document.getElementById("myChart").getContext("2d");

// creates the new chart on the canvas supplied in the ctx.
// options array as second argument.  see chartjs docs.
new Chart(ctx).Radar(data, options);
