<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Murito Digital</title>

</head>
<body>

<div id="layoutAnuncios">
	<div id="row1">

			<div id="layoutA"></div>

			<div id="layoutB"></div>
	</div>
	<div id="row2">

		<div id="layoutC"></div>

	</div>
</div>
<div id="layoutVideo"></div>


<script  type="text/javascript">

var jsonConfig;
var indiceGlobal = 0;


function getContent(content, callback){

	var request = new XMLHttpRequest();
	request.open('GET', content,true);
	

	request.onreadystatechange = function() {

		if(request.readyState === 4) {
	  

		    if(request.status === 200) { 

		    	callback(request.responseText);

		    }

		}

	}

	request.send(null);


}

function init(){

	getContent('config.json',function(response){

		jsonConfig = JSON.parse(response);
		var duracionTotal = jsonConfig['duracionTotal']
		var contenidos = jsonConfig['contenidos'];

		run(contenidos,0);
		


	});


}


function run(bloques,indice){

	console.log('Indice '+indice);
	console.log('Total '+bloques.length);
	
	var layout1 = document.getElementById('layoutA');
	var layout2 = document.getElementById('layoutB');
	var layout3 = document.getElementById('layoutC');

	var layoutAnuncios = document.getElementById('layoutAnuncios');
	var layoutVideo = document.getElementById('layoutVideo');


	if(indice<=bloques.length-1){

	var contenido = bloques[indice];
	var duracion = contenido['duracion'];
	var contenidos = contenido['contenidos'];

	indice++;
	console.log('Llamar '+indice);
	setTimeout(run,duracion*1000,jsonConfig['contenidos'], indice);

	if(contenidos.length > 1){

		layoutAnuncios.style.display = 'block';
		layoutVideo.style.display = 'none';

		if(contenidos[0]['tipo'] == 'A'){

			if(contenidos[0]['url']!=''){
				
				getContent(contenidos[0]['url'], function(response){


					layout1.innerHTML = response;


				});

			}


		}
		if(contenidos[1]['tipo'] == 'B'){

			if(contenidos[1]['url']!=''){
				
				getContent(contenidos[1]['url'], function(response){


					layout2.innerHTML = response;


				});

			}


		}
		if(contenidos[2]['tipo'] == 'C'){


			if(contenidos[2]['url']!=''){
				
				getContent(contenidos[2]['url'], function(response){


					layout3.innerHTML = response;


				});

			}

		}

	}
	else{

		layoutAnuncios.style.display = 'none';
		layoutVideo.style.display = 'block';

		if(contenidos[0]['tipo'] == 'D'){

			if(contenidos[0]['url']!=''){
				
				getContent(contenidos[0]['url'], function(response){


					layoutVideo.innerHTML = response;


				});

			}


		}

	}
	
	}
	else{


		setTimeout(run,duracion*1000,jsonConfig['contenidos'], 0);



	}

}
	
init();


</script>


</body>
</html>