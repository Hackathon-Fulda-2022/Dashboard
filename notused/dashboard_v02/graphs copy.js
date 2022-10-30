var xValues = [0,0,0,0,0,0,0,0,0,0,0,0,0];
var yValues = [0,0,0,0,0,0,0,0,0,0,0,0,0];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      borderColor: "rgba(43,0,145,1.0)",
      data: yValues
    }]
  },
  options:{}
});

function addZ(s){
  return (s < 10) ? "0" + s : "" + s;
}

setInterval(()=>{
  let connexion = new XMLHttpRequest();
    connexion.open("GET", "graphData.php?patient="+patientID+"&vital=0", false);
    connexion.send();
    let time, value, type, unit;
    eval(connexion.responseText);
    console.log(connexion.responseText);
    Chart.getChart("myChart").destroy();
    /*Chart.getChart("myChart").data.labels = time;
    Chart.getChart("myChart").data.datasets[0].data = value;
    Chart.getChart("myChart").update();*/
    new Chart("myChart", {
        type: "line",
        data: {
          labels: time,
          datasets: [{
            label: type,
            borderColor: "rgba(43,0,145,1.0)",
            data: value
          }]
        },
        options: {
          scales: {
            x:{
              title: {
                display: true,
                text: 'Zeit'
              }
            },
            y:{
              title:{
                display: true,
                text: unit
              }
            }
          },
          animation: {
            duration:0 
          }
      }
      });
}, 3000);