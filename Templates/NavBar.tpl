<nav>
	<ul>
			{if !isset($smarty.session.email)}
				<li><a href="login">Login</a></li>
				<li><a href="signIn">Sign In</a></li>
			{else}
				<li><a href="logout">Logout</a></li>
			{/if}
			<li><a href="presupuestos">Lista de Presupuestos</a></li>
			<li><a href="materiales">Lista de Materiales</a></li>
			{if $smarty.session.role == "2"}
				<li><a href="usuarios">Lista de Usuarios</a></li>
			{/if}
	</ul>
</nav>