<?php
//Autor : 
//Web: 
//Vesion: 1.0
//

if(isset($_GET['q'])){ //consultamos si tiene informacion el get
	//agregar configuraciondes para idiomas es ingles frase etc.....
	$texto = $_GET['q'];
	buscar_google($texto); // traducir el texto con api de google (idioma1,idioma2,texto)
	
}else{
	echo 'No hay datos';
	die();
}

function buscar_google($word){
	
	//configuracion del traductor
	$de = 'es'; //idioma de origen idioma1
	$a =  'en'; //idioma a salida  idioma2
	
	
	//generando url para consultar por get en google api
$url = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl='.$de.'&tl='.$a.'&dt=t&q='.urlencode($word);

    if ($word != '') { //preguntar si la palabra tiene algo
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //Ejecutando la navegacion de php y guardadon resultados en $curlout
        $curlout = curl_exec($ch);
        curl_close($ch);		
    }
	$json_data = json_decode($curlout); // decodifcando json a arreglo
    $traduccion = $json_data[0][0][0]; //datos recibidos 
	mostrar_xml($traduccion);
	
}

function mostrar_xml($traduccion){
//	Generar archivo XML -> LEER VBS	
header('Content-type: text/xml'); //codificar en xml

//implemetar la traduccion
		$contenido =  '
		<rss version="2.0">
		<channel>
		 <title>traductor 1.0</title>
		 <description><![CDATA[ Esta aplipliacion fue hecha por  ]]></description>
		<link>https://www.twitch.tv/</link> 

				<item>
					<title>'.$traduccion.'</title>
					<link>https://www.twitch.tv/</link>
							<description><![CDATA[]]></description>
						<category></category>

				</item>
		 </channel>
		</rss>
		';	

echo $contenido; //mostrar elk cotenido;		
}

?>

