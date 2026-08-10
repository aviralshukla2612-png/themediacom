<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use App\Models\Campaign;

function verify_seo($url, $expected_title, $expected_desc_snippet, $expected_og_image = null) {
    $req = Request::create($url, 'GET');
    $res = app()->handle($req);
    $html = $res->getContent();
    
    // Simple regex matching for verification
    preg_match('/<title>(.*?)<\/title>/', $html, $title_match);
    preg_match('/<meta name="description" content="(.*?)">/', $html, $desc_match);
    preg_match('/<meta property="og:title" content="(.*?)">/', $html, $og_title_match);
    preg_match('/<meta property="og:image" content="(.*?)">/', $html, $og_image_match);
    preg_match('/<link rel="canonical" href="(.*?)">/', $html, $canonical_match);

    $title = $title_match[1] ?? 'NOT FOUND';
    $desc = $desc_match[1] ?? 'NOT FOUND';
    $og_title = $og_title_match[1] ?? 'NOT FOUND';
    $og_image = $og_image_match[1] ?? 'NOT FOUND';
    $canonical = $canonical_match[1] ?? 'NOT FOUND';

    echo "Testing URL: $url\n";
    echo "  -> Title: " . ($title === $expected_title ? "PASS ($title)" : "FAIL ($title)") . "\n";
    echo "  -> OG Title: " . ($og_title === $expected_title ? "PASS" : "FAIL ($og_title)") . "\n";
    
    $desc_pass = str_contains($desc, $expected_desc_snippet);
    echo "  -> Description: " . ($desc_pass ? "PASS" : "FAIL (Expected snippet not found: $desc)") . "\n";
    
    if ($expected_og_image) {
        $img_pass = str_contains($og_image, $expected_og_image) && str_starts_with($og_image, 'http');
        echo "  -> OG Image: " . ($img_pass ? "PASS ($og_image)" : "FAIL ($og_image)") . "\n";
    }

    echo "  -> Canonical URL: " . (str_contains($canonical, $url) ? "PASS" : "FAIL ($canonical)") . "\n\n";
}

echo "--- SEO Verification Script ---\n\n";

// 1. Homepage (Global Fallback)
verify_seo('/', 'The Media Com | From Strategy to Street — WE EXECUTE', 'leading brand activation');

// 2. Services Page
verify_seo('/services', 'Our Services | The Media Com', 'Discover our services including');

// 3. Campaigns List
verify_seo('/campaigns', 'Our Campaigns | The Media Com', 'measurable on-ground success');

// 4. Campaign Detail
$campaign = Campaign::first();
if ($campaign) {
    $expected_title = $campaign->title . ' | The Media Com';
    $expected_desc = \Illuminate\Support\Str::limit(strip_tags($campaign->problem), 150);
    $expected_image_snippet = basename($campaign->image); // Should just verify filename exists in the full absolute URL
    
    verify_seo('/campaigns/' . $campaign->id, $expected_title, $expected_desc, $expected_image_snippet);
} else {
    echo "No campaign found to test.\n";
}
