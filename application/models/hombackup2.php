$(document).ready(function() {
    makechart();
    function makechart() {
        $(".update_row").click(function() {
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        if (start_date <= end_date) {
            var start_end_date = {
                start_date: start_date,
                end_date: end_date
            };
        $.ajax({
            url: "fetch_data",
                type: "POST",
                cache: false,
                dataType: "JSON",
                data: start_end_date,
            success: function(data) {
                var language = [];
                var total = [];
                var color = [];

                for (var count = 0; count < data.length; count++) {
                    language.push(data[count].language);
                    total.push(data[count].total);
                    color.push(data[count].color);
                }

                var chart_data = {
                    labels: language,
                    datasets: [{
                        label: 'Vote',
                        backgroundColor: color,
                        color: '#fff',
                        data: total
                    }]
                };

                var options = {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0
                            }
                        }]
                    }
                };

                var group_chart1 = $('#pie_chart');

                var graph1 = new Chart(group_chart1, {
                    type: "pie",
                    data: chart_data
                });

                var group_chart2 = $('#doughnut_chart');

                var graph2 = new Chart(group_chart2, {
                    type: "doughnut",
                    data: chart_data
                });

                var group_chart3 = $('#bar_chart');

                var graph3 = new Chart(group_chart3, {
                    type: 'bar',
                    data: chart_data,
                    options: options
                });
            }
        })
    }

else {
            alert("Start date must be less than from end date");
        }
});