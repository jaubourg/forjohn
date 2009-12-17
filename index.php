<html>
<?php if (!isset($_GET["type"])) { ?>
	<body>
		<ul>
			<li><a href="?type=getScript">$.getScript + $.ready</a></li>
			<li><a href="?type=require">$.require</a></li>
			<li><a href="?type=require&nofail=">$.require (no failing request)</a></li>
		</ul>
	</body>
<?php } else { ?>
	<head>
		<style>
			div { float: clear }
			ul { float: left; border: 1px solid black; margin: 10px; padding: 10px }
			li { list-style: none; border: 1px dotted black; margin: 0; padding: 0 }
			b { color: green }
			.selected b { color: orange }
			body { background: #ddd }
		</style>
		<script type="text/javascript" language="javascript" src="jquery.js"></script>
		<script type="text/javascript" language="javascript" src="common-<?= $_GET["type"] ?>.js"></script>
		<script type="text/javascript" language="javascript" src="common.js"></script>
		<?php for ($i=1; $i<=4; $i++) { ?>
			<script type="text/javascript" language="javascript" src="module<?= $i ?>.js"></script>
		<?php } ?>
		<?php if ( ! isset($_GET["nofail"] ) ) { ?>
			<script type="text/javascript" language="javascript" src="failing-module.js"></script>
		<?php } ?>
		<script>
			jQuery(function() {
				$("body").css("background-color","white");
			});
		</script>
	</head>
	<body>
		<?php for ($i=1; $i<=4; $i++) { ?>
			<div style="float: clear">
				<ul id="container<?= $i ?>">
				<?php for ($j=1; $j<10; $j++) { ?>
					<li>Line (<?= $i ?>, <?= $j ?>)</li>
				<?php } ?>
				</ul>
			</div>
		<?php } ?>
	</body>
<?php } ?>
</html>