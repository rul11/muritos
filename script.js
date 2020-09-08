export function changeText(type){

	

		var layoutA = document.getElementById('layoutA');

		if(type == 0){

		var content = document.createTextNode("Este es un anuncio clasificado");
		layoutA.appendChild(content);
		setTimeout(changeText,15000,1);

		}
		else{

		layoutA.innerHTML += "Este es otro anuncio clasificado";
		setTimeout(changeText,15000,0);

		}

}