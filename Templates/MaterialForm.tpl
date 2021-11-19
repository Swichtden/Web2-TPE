{include_once file='Templates/Head.tpl'}
{* {include_once file='Templates/NavBar.tpl'} *}

{if $role == 2}
	<section>
		{if $Edit}<h1>{$Title}</h1>{/if}
		<form class="materialform" {if $Edit}action="editMaterial" {else}action="createMaterial"{/if} method="post">
			{if $Edit}<input type="hidden" name="id_material" value="{$Material[0]->id_material}">{/if}
			<label for="Material">Material:</label>
			<input type="text" id="Material" name="Material" {if $Edit}value="{$Material[0]->nombre_material}{/if}">
			<label for="Precio">Monto:</label>
			<input type="text" id="Precio" name="Precio" {if $Edit}value="{$Material[0]->precio_material}{/if}">
			<label for="Descripcion">Material:</label>
			<textarea id="Descripcion" name="Descripcion" rows="10" cols="50">{if $Edit}{$Material[0]->descripcion_material}{/if}</textarea>
			<input type="submit" {if $Edit}value="Editar"{else}value="Agregar"{/if}>
		</form>
	</section>
{else}
	<h3>Usted no tiene permisos para realizar esta accion!</h3>
	<a href="login">Acceda aqui para loguearse</a>
{/if}

{include file='Templates/Footer.tpl'}