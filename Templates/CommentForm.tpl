<form id="commentForm" class="vertical-form" data-id_presupuesto="{$Budget[0]->id_cliente}">
	<select type="select" name="Puntaje" required>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
	</select>
	<textarea placeholder="Comentario" type="text" name="Comentario" rows="5" cols="50" required></textarea>
	<input type="submit" value="Agregar Comentario">
</form>