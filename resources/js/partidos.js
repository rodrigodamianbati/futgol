function showResult() {
  var email_parcial = document.getElementById('buscador_jugador').value;
  var resultado_busqueda = "";
  var resultado_arreglo = [];
  var br = document.createElement("br");
  if (email_parcial.length==0) {
    console.log('entre al 0');
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  
  if (email_parcial.length!=0) {
    $.ajax({
      url: "/futgol/partidos/buscar_jugador",
      data: 'email_parcial='+email_parcial,
      type: 'POST',
      dataType: 'json',
      success:function(response) {
       
        console.log('hay response');

        //lista de jugadores
        $.each(response, function(idx, obj) {
          //resultado_busqueda=resultado_busqueda+((obj.email));
          resultado_arreglo.push(((obj.email)));
        });
       
        console.log(resultado_arreglo);
        //agrego al cartelito en vivo
        $( "#buscador_jugador" ).autocomplete({
          source: resultado_arreglo
        });
        //document.getElementById("livesearch").innerHTML=resultado_busqueda;
        //document.getElementById("livesearch").style.border="1px solid #A5ACB2";
      },
      error:function(response){
        resultado_busqueda = "No hay resultado...";
        document.getElementById("livesearch").innerHTML=resultado_busqueda;
        document.getElementById("livesearch").style.border="1px solid #A5ACB2";
      }
    });
  }

 
}

$( document ).ready(function() {



document.getElementById("reglas").addEventListener("input", function() {
  var reglas;
  var id_partido;
  var data = {};
  var arrayJsonObj = [];
  var jsonObj;

  reglas= $('#reglas').text();
  id_partido= $('#id_partido').val();
  data['reglas'] = reglas;
  data['id_partido'] = id_partido;

  form = new FormData();

  form.append('reglas', reglas);
  form.append('id_partido', id_partido);

  //arrayJsonObj.push(data);

  //jsonObj = JSON.stringify(arrayJsonObj);

  console.log(jsonObj);
  $.ajax({
    url: '../editarreglas',
    data: form,
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    //dataType: 'json',
    success:function(response) {
      
    }
  });
}, false);


 
});
