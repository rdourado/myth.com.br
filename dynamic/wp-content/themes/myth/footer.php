	<hr>
	<footer id="foot">
		<form action="<?php echo home_url( '/wp-content/plugins/newsletter/do/subscribe.php' ); ?>" method="post" id="newsform" onsubmit="return newsletter_check(this)">
			<fieldset>
				<legend>Receba nossas novidades e fique por dentro do universo Myth!</legend>
				<p class="field field-nome">
					<label for="field-nome">Nome</label><br>
					<input type="text" name="nn" id="field-nome" placeholder="nome" required aria-required="true">
				</p>
				<p class="field field-email">
					<label for="field-email">Email</label><br>
					<input type="email" name="ne" id="field-email" placeholder="email" required aria-required="true">
				</p>
				<p class="field field-estado">
					<label for="field-estado">Estado</label><br>
					<input type="text" name="np1" id="field-estado" placeholder="estado" required aria-required="true" maxlength="2">
				</p>
				<p class="field field-submit">
					<button type="submit" id="field-submit">Enviar</button>
				</p>
			</fieldset>
		</form>
		<p id="collection"><img src="<?php t_url(); ?>/img/inverno-2013.png" alt="Inverno 2013 Myth" width="211" height="34"></p>
		<p id="mg"><a href="http://mgstudio.com.br/" target="_blank">by MG studio</a></p>
	</footer>
	<script src="http://maps.googleapis.com/maps/api/js?key=MY_KEY&amp;sensor=false"></script>
	<!-- WP/ --><?php wp_footer(); ?><!-- /WP -->
</body>
</html>