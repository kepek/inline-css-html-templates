<?php
// Clean Cache
if (function_exists('opcache_reset')) {
	opcache_reset();
}
// Ussing CSS to Inline Styles
use \TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
// Using HTMLMinify
use \zz\Html\HTMLMinify;
// Set Templates
$templates = @glob('templates/*.html');
// Has Mod_Rewrite?
$mod_rewrite = function_exists('apache_get_modules') ? in_array('mod_rewrite', apache_get_modules()) : (getenv('HTTP_MOD_REWRITE') == 'On' ? true : false);
?>
<?php if (isset($_GET['template'])): ?>
<?php
	// Set Debug Mode
	$debug = isset($_GET['debug']) && $_GET['debug'] !== 'false' ? true : false;
	// Set Path
	$path = dirname(__FILE__) . '/templates/';
	// Set Template
	$template = isset($_GET['template']) ? $_GET['template'] . '.html' : false;
	$template = file_exists($path . $template) ? $template : false;
	// Autoload
	require 'vendor/autoload.php';
	// Set CSS to Inline Styles
	$cssToInlineStyles = new CssToInlineStyles();
	// Report All Errors
	error_reporting(E_ALL);
	// Display Errors
	ini_set('display_errors', '1');
	if ($template) {
		// Set Twig Loader
		$loader = new Twig_Loader_Filesystem($path);
		// Set Twig
		$twig = new Twig_Environment($loader);
		// Set Filename
		$filename = basename($template, '.html');
		// Set LESS
		$less = new lessc;
		// Compile LESS
		$less->checkedCompile(('templates/' . $filename . '.less'), ('templates/' . $filename . '.css'));
		// Set JSON
		$json = $filename . '.json';
		// Set Stylesheet
		$stylesheet = $filename . '.css';
		// Set Data
		$data = file_exists('templates/' . $json) ? json_decode(file_get_contents(dirname(__FILE__) . '/templates/' . $json ), true) : array('data' => false);
		// Add Debug Data
		if ($debug) {
			$data = array_merge($data, array('debug' => $debug));
		}
		// Set Page URL
		$base_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http');
		$base_url .= '://' . $_SERVER['HTTP_HOST'];
		$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),'',$_SERVER['SCRIPT_NAME']);
		// Add Some Template Data
		$data = array_merge($data, array(
			'filename' => $filename,
			'base_url' => $base_url . 'templates/',
			'stylesheet_url' => $base_url . 'templates/' . $stylesheet,
		));
		// Set HTML
		$html = $twig->render($template, $data);
		// Default Mode
		if (!$debug) {
			// Set HTML
			$cssToInlineStyles->setHTML($html);
			// Set CSS
			$css = file_exists('templates/' . $stylesheet) ? file_get_contents('templates/' . $stylesheet) : null;
			$cssToInlineStyles->setCSS($css);
			// Render Template
			$html = $cssToInlineStyles->convert();
			// Minify HTML [OPTIMIZATION_SIMPLE, OPTIMIZATION_ADVANCED]
			$HTMLMinify = new HTMLMinify($html, array('optimizationLevel' => HTMLMinify::OPTIMIZATION_SIMPLE));
			// Output
			echo $HTMLMinify->process();
		}
		// Debug Mode
		else {
			// Output
			echo $html;
		}
	}
?>
<?php else: ?>
	<!doctype html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<title>Inline CSS &amp; HTML Templates</title>
		</head>
		<body>
			<h1>Inline CSS &amp; HTML Templates</h1>
			<?php if (count($templates) > 0): ?>
				<ol>
					<?php foreach ($templates as $template): ?>
						<li>
							<a href="<?php echo ( $mod_rewrite ? 'templates/'. basename($template, '.html') . '.html' : '?' . http_build_query(array('template' => basename($template, '.html'))) ); ?>">
								<?php echo basename($template); ?>
							</a>
							|
							<a href="<?php echo ( $mod_rewrite ? 'templates/'. basename($template, '.html') . '.html?debug=true' : '?' . http_build_query(array('template' => basename($template, '.html'), 'debug' => true)) ); ?>">
								(debug)
							</a>
						</li>
					<?php endforeach; ?>
				</ol>
			<?php endif; ?>
			<hr>
			<p>
				&copy; 2014 <a href="http://github.com/kepek">@kepek</a>
			</p>
		</body>
	</html>
<?php endif; ?>
