<!DOCTYPE html>
<html>
	<head>
  <title>Bootstrap-select Tests (Bootstrap 4)</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="..bootstrap-select/dist/css/bootstrap-select.css">


</head>
<body> 
	
	
	
	
	<div id="readroot" style="display: none">
		
		<input type="button" value="Remove review"
		onclick="this.parentNode.parentNode.removeChild(this.parentNode);" /><br /><br />
		
		
			<select name="ziua_saptamanii">
				<option value="luni">Luni</option>
				<option value="marti">marti</option>
				<option value="miercuri">miercuri</option>
				<option value="joi">joi</option>
				<option value="vineri">vineri</option>
				<option value="sambata">sambata</option>
				<option value="duminica">duminica</option>
			</select>
	
	
	
		<label for="slujba">Alege slujba</label>
		<select class="selectpicker form-control" name="slujba" id="slujba" data-container="body" data-live-search="true" data-hide-disabled="true">
		  <optgroup label="Liturgice">
			<option value="Sfânta Liturghie">Sfânta Liturghie</option>
			<option value="Vecernia">Vecernia</option>
			<option value="Pavecernita">Pavecernița</option>
			<option value="Utrenia">Utrenia</option>
			<option value="Litia">Litia</option>
			<option value="Pomenirea morților">Pomenirea morților</option>
			<option value="Miezonoptica">Miezonoptica</option>
			<option value="Obednița">Obednița</option>
		  </optgroup>
		  <optgroup label="Sfintele Taine">
			<option value="Taina Sfântului Botez">Taina Sfântului Botez</option>
			<option value="Taina Sfintei Cununii">Taina Sfintei Cununii</option>
			<option value="Taina Sfântului Maslu">Taina Sfântului Maslu</option>
			<option value="Taina Spovedaniei">Taina Spovedaniei</option>
			<option value="Taina Sfântului Maslu">Taina Sfântului Maslu</option>
		  </optgroup>
		  <optgroup label="Sfinți">
			<option value="Acatistul">Acatistul</option>
			<option value="Paraclisul">Paraclisul</option>
		  </optgroup>
		  <optgroup label="Rugăciuni">
			<option value="Rugăciunile de seară">Rugăciunile de seară</option>
			<option value="Rugăciunile de dimineață">Rugăciunile de dimineață</option>
			<option value="Ceasul I">Ceasul I</option>
			<option value="Ceasul III">Ceasul III</option>
			<option value="Ceasul VI">Ceasul VI</option>
			<option value="Ceasul IX">Ceasul IX</option>
		  </optgroup>
		  <optgroup label="Speciale">
			<option value="Denia">Denia</option>
			<option value="Slujba Învierii">Slujba Învierii</option>
			<option value="Cateheză">Cateheză</option>
			<option value="Seară biblică">Seară biblică</option>
			<option value="Sfințirea Apei (Aghiazma)">Sfințirea Apei (Aghiazma)</option>
			<option value="Tedeum">Tedeum</option>
			<option value="Moliftele Sf. Vasile cel Mare">Moliftele Sf. Vasile cel Mare</option>
			<option value="Citirea Psaltirii">Citirea Psaltirii</option>
			<option value="Rugăciunea lui Iisus">Rugăciunea lui Iisus</option>
		  </optgroup>
		
		</select>
	
	
	
	<p>Adăugă text opțional pentru slujbă, de exemplu: [Sfânta Liturghie] Duminica a 5-a după Rusalii, sau [Acatistul] Sfântului Nectarie, sau [Paraclisul] Maicii Domnului</p>
	<input id="ora_final" type="text" name="text_optional" value="Text optional">
	
	<textarea id="alte_observatii" name="alte_observatii">Alte observații (opțional)</textarea>
		<label for="appt">Ora start:</label>
		<input id="ora_start" type="time" name="ora_start" value="09:00">
		
		<label for="appt">Ora final:</label>
	<input id="ora_final" type="time" name="ora_final" value="10:00">
	



</div>

<form method="post" action="/cgi-bin/show_params.cgi">

		<span id="writeroot"></span>

		<input type="button" value="Adăugă zi" onclick="moreFields();"/>
		<input type="submit" value="Salvează program" />

</form>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
<script src="../bootstrap-select/dist/js/bootstrap-select.js"></script>

<script>
	
	var counter = 0;
	
	function moreFields() {
		counter++;
		var newFields = document.getElementById('readroot').cloneNode(true);
		newFields.id = '';
		newFields.style.display = 'block';
		var newField = newFields.childNodes;
		for (var i=0;i<newField.length;i++) {
			var theName = newField[i].name
			if (theName)
				newField[i].name = theName + counter;
		}
		var insertHere = document.getElementById('writeroot');
		insertHere.parentNode.insertBefore(newFields,insertHere);
	}
	
	window.onload = moreFields;
	
</script>
 
</body>
</html>
