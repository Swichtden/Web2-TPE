<form class="budgetform" {if $Edit}action="editPresupuesto" {else}action="createPresupuesto"{/if} method="post">
	{if $Edit}<input type="hidden" name="id_cliente" value="{$Budget[0]->id_cliente}">{/if}
	<label for="Cliente">Cliente:</label>
	<input type="text" id="Cliente" name="Cliente" {if $Edit}value="{$Budget[0]->nombre_cliente}{/if}">
	<label for="Monto">Monto:</label>
	<input type="text" id="Monto" name="Monto" {if $Edit}value="{$Budget[0]->monto}{/if}">
	<label for="Material">Material:</label>
	<select name="Material" id="Material" required>
	{foreach from=$Materiales item=$material}
				<option value="{$material->id_material}">{$material->nombre_material}</option>
		{/foreach}
			</select>
			
	{* <input type="text" id="Material" name="Material" {if $Edit}value="{$Budget[0]->nombre_material}{/if}"> *}
	<input type="submit" {if $Edit}value="Editar"{else}value="Agregar"{/if}>
</form>