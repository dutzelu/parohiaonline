<div id="readroot" style="display: none">

	<input type="button" value="Remove review"
		onclick="this.parentNode.parentNode.removeChild(this.parentNode);" /><br /><br />

	<input name="cd" value="title" />

	<select name="rankingsel">
		<option>Rating</option>
		<option value="excellent">Excellent</option>
		<option value="good">Good</option>
		<option value="ok">OK</option>
		<option value="poor">Poor</option>
		<option value="bad">Bad</option>
	</select><br /><br />

	<textarea rows="5" cols="20" name="review">Short review</textarea>
	<br />Radio buttons included to test them in Explorer:<br />
	<input type="radio" name="something" value="test1" />Test 1<br />
	<input type="radio" name="something" value="test2" />Test 2

</div>

<form method="post" action="/cgi-bin/show_params.cgi">

	<span id="writeroot"></span>

	<input type="button" value="Adăugă zi" onclick="moreFields();"/>
	<input type="submit" value="Salvează program" />

</form>

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