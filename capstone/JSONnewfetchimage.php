<?php
// The XML data file with whitespace such as tabs
$xml_file = "catalog.xml";
// Load xml data.
$xml = file_get_contents($xml_file);
// Strip whitespace between xml tags
// Convert CDATA into xml nodes.
$xml = simplexml_load_string($xml);
// Return JSON.
echo json_encode($xml);
?>