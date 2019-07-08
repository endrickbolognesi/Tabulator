
<?php
require __DIR__.'/../vendor/autoload.php';
$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));
$name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
if (!$name) {
    $name = "Mercury, Venus, Mars, Jupiter, Saturn, Uranus & Neptune.";
}
echo $twig->render('index.twig', array(
    'name' => $name,
));