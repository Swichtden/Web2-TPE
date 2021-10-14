{include file='Templates/Header.tpl'}

<section class="table">
    <h1>{$Title}</h1>
	{if $Edit}
		<form action="editDB" method="post">
			<input type="hidden" name="id_cliente" value="{$Budget[0]->id_cliente}">
			<label for="Cliente">Cliente:</label>
			<input type="text" id="Cliente" name="Cliente" value="{$Budget[0]->nombre_cliente}">
			<label for="Monto">Monto:</label>
			<input type="text" id="Monto" name="Monto" value="{$Budget[0]->monto}">
			<label for="Material">Material:</label>
			<input type="text" id="Material" name="Material" value="{$Budget[0]->nombre_material}">
			<input type="submit" value="Editar">
		</form>
	{else}
		<ul>
			<li>Cliente: {$Budget[0]->nombre_cliente}</li>
			<li>Monto: {$Budget[0]->monto}</li>
			<li>Material: {$Budget[0]->nombre_material}</li>
		</ul>
	{/if}
</section>

{include file='Templates/Footer.tpl'}