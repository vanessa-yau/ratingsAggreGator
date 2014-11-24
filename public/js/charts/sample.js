var data = [
            {
                value: 300,
                color:"#F7464A",
                highlight: "#FF5A5E",
                label: "Red"
            },
            {
                value: 50,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "Green"
            },
            {
                value: 100,
                color: "#FDB45C",
                highlight: "#FFC870",
                label: "Yellow"
            },
            {
                value: 100,
                color: "#949FB1",
                highlight: "#A8B3C5",
                label: "Grey"
            },
            {
                value: 120,
                color: "#4D5360",
                highlight: "#616774",
                label: "Dark Grey"
            }

        ];

        // <!> this part needs to go before the new chart statement below <!>

        // Get the context of the canvas element we want to select
        var ctx = document.getElementById("myChart").getContext("2d");
        var myNewChart = new Chart(ctx).PolarArea(data);
        
        // creates the new chart on the canvas supplied in the ctx.
        // options array as second argument.  see chartjs docs.
        new Chart(ctx).PolarArea(data);

        // when page is loaded, change colours of skill rating boxes as apt.
        function colourStatPanels() {
            var stats = $('.stat-panel');
            $.each( stats, function(stat){
                // get numerical statistic as text
                var statVal = $(stats[stat]).find('h3').text();
                // get the correct substring not '/5'
                var roundedStat = statVal.substring(0, statVal.length-2);
                // convert the string to number
                var roundedStat = Number(roundedStat);
                
                // if statement adds approprate class to panels depending on value of skill.
                if(roundedStat <= 2){
                    $(stats[stat]).removeClass().addClass('stat-panel panel status panel-danger');
                } else if( 2 < roundedStat && roundedStat < 4){
                    $(stats[stat]).removeClass().addClass('stat-panel panel status panel-warning');
                } else {
                    $(stats[stat]).removeClass().addClass('stat-panel panel status panel-success');
                }
            });
        }