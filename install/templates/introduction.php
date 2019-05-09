<h3>Introduction</h3>

<p>Sie installieren gerade <b><?php  echo $product; ?></b> (Version: <?php echo $productVersion; ?>) das von <b><?php echo $company; ?></b> entwickelt wurde.</p>
<form method="post">
	<input type="hidden" name="nextStep" value="eula">
	<button type="submit" class="button positive">
		<img src="css/blueprint/plugins/buttons/icons/tick.png" alt=""/> Start
	</button>
</form>
