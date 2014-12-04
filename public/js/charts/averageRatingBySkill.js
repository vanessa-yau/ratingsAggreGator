function createBarChart(labelArray, averageData, yourData, canvas) {
    // this function takes an array of strings for labels, two arrays of numbers for
    // values the user entered and average values, and an id of the canvas.

    // the data array is set based on whether or not the user has rated,
    // or just wnats to see the average.

    var data = {
        labels: labelArray,
        datasets: [
            {
                label: "Average Rating",
                fillColor: "rgba(0,0,255,0.2)",
                strokeColor: "rgba(0,0,255,0.5)",
                pointColor: "rgba(0,0,255,0.5)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: averageData
            }
        ]
    };

    if(yourData[0] != 0){
        data.datasets.push({
            label: "Your Rating",
            fillColor: "rgba(255,0,0,0.2)",
            strokeColor: "rgba(255,0,0,0.5)",
            pointColor: "rgba(255,0,0,0.5)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: yourData
        });
    }

    var options = {
        //String - A legend template
        legendTemplate :    '<ul>'
                            +'<% for (var i=0; i<datasets.length; i++) { %>'
                                +'<li>'
                                    +'<span style=\"color:<%=datasets[i].strokeColor%>\">'
                                        +'<% if (datasets[i].label) { %><%= datasets[i].label %><% } %>'
                                    +'</span>'
                                +'</li>'
                            +'<% } %>'
                            +'</ul>'
    }

    // <!> this part needs to go before the new chart statement below <!>
    // Get the context of the canvas element we want to select
    var ctx = document.getElementById(canvas).getContext("2d");

    // creates the new chart on the canvas supplied in the ctx.
    // options array as second argument.  see chartjs docs.
    var radar = new Chart(ctx).Bar(data, options);
    document.getElementById("barLegend").innerHTML = radar.generateLegend();
}
