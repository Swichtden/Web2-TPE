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
						<td id="id{$user->id_user}" data-nombre_rol="{$user->nombre_rol}">{$user->nombre_rol}</td>
						<td data-id_user="{$user->id_user}" class="buttons">
							<a href="/user/edit/{$user->id_user}" class="edit"<button><i class="fas fa-edit fa-fw"></i></button></a>
							<a href="/user/delete/{$user->id_user}"<button><i class="fas fa-trash fa-fw"></i></button></a>
						</td>
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</section>

<script type='text/javascript' src='/Js/EditUser.js'></script>

{include file='Templates/Footer.tpl'}