$('document').ready(function () {
    $.ajax({
        type: "POST",
        url: "chart.php",
        dataType: "json",
        success: function (data) {
            
            // for (var i in data) {
            //     console.log(data[i].tickets)
            // }
            var nomearray = [];
            var ticketsarray = [];
            for (var i = 0; i < data.length; i++) {
                
                nomearray.push(data[i].nome);
                ticketsarray.push(data[i].tickets);
                
            }
            
            grafico(nomearray,ticketsarray);

        }
    });


})

