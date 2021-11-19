{include file='Templates/Head.tpl'}
{* {include file='Templates/NavBar.tpl'} *}

<section class="table">
	<h1>{$Title}</h1>
	<h2>{$Message}</h2>
	<div class="centrar-tabla">
		<table>
			<thead class="headersimulator">
				<tr >
					<th>Usuario</th>	
					<th>Nivel de acceso</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$Users item=$user}
					<tr>
						<td>{$user->email}</a></td>
						<td data-id_rol="{$user->id_rol}">{$user->nombre_rol}</td>
						<td class="boton-tabla"><a href="/user/edit/{$user->id_user}"<button><i class="fas fa-edit fa-fw"></i></button></a></td>
						<td class="boton-tabla"><a href="/user/delete/{$user->id_user}"<button><i class="fas fa-trash fa-fw"></i></button></a></td>
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</section>

{include file='Templates/Footer.tpl'}