drawChart(patientID, 0);
drawChart(patientID, 3);

function drawChart(patientID, vitalID){

  let connexion = new XMLHttpRequest();
    connexion.open("GET", "graphData.php?patient="+patientID+"&vital="+vitalID+"", false);
    connexion.send();
    let time, value, type, unit;
    var chart = "myChart"+patientID+"_"+vitalID;
    eval(connexion.responseText);
    console.log(connexion.responseText);
    try{
    Chart.getChart(chart).destroy();}
    catch {; };
    /*Chart.getChart("myChart").data.labels = time;
    Chart.getChart("myChart").data.datasets[0].data = value;
    Chart.getChart("myChart").update();*/
    new Chart(chart, {
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
              type: 'time',
              time: {
                unit: 'hour'
                },    title: {
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


}

setInterval(()=>{
drawChart(patientID, 0);
drawChart(patientID, 3);

}, 3000);