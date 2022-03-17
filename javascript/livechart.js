$(document).ready(function () {
    // showGraph();
    
});

$.ajax({
url: 'graph.php',
type: 'GET',
// this was what I needed to make it work.
dataType: 'json',
success:function(data){

var bidAmount = [];
var bidType = [];

for(var i in data){
    bidAmount.push(data[i].bidEarning);
    bidType.push(data[i].auction_type);
}

var ChartData = {
    labels: bidType,
    datasets: [
        {
        label: ['Graph Of Earnings'],
        fillColor: "rgba(0,0,255,1)",
        strokeColor: "rgb(56, 253, 243)",
        pointColor: "rgba(255, 255, 255, 1)",
        pointStrokeColor: "rgba(0,0,255,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(0,0,255,1)",
        data:bidAmount
        },
        
    ] 
};

var ctx = $('#myChart');

var barGraph = new Chart(ctx, {
    type:'line',
    data: ChartData,
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return '$' + value;
                    }
                }
            }]
        }
    }
});

},
error:function(data){
console.log(data);
}

});
