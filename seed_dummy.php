<?php
$page = \App\Models\Page::where('slug', 'about')->first();
if ($page) {
    $page->content = '<p>AYKA Originals is a boutique talent management agency representing exceptional models and creatives.</p><h3>Our Mission</h3><p>We strive to redefine talent management by focusing on authenticity, diversity, and long-term career growth. We provide personalized attention to our talents, ensuring they have the support and resources needed to succeed in a competitive industry.</p><h3>Our Vision</h3><p>To be the leading global agency that connects exceptional talent with visionary brands, creating iconic and timeless campaigns.</p><h3>Join Us</h3><p>Whether you are an aspiring model, an established creative, or a brand looking for the perfect face for your next campaign, AYKA Originals is here to make it happen. Reach out to us today and let\'s create something extraordinary together.</p>';
    $page->save();
}
for($i=1; $i<=8; $i++) {
    \App\Models\Talent::firstOrCreate(['slug' => 'dummy-talent-'.$i], [
        'name' => 'Dummy Talent ' . $i,
        'category' => 'female',
        'location' => 'New York, NY',
        'height' => "5'9\"",
        'chest_bust' => '32',
        'waist' => '24',
        'hips' => '34',
        'shoe_size' => '8',
        'eye_color' => 'Brown',
        'hair_color' => 'Brown',
        'bio' => 'This is a dummy talent created for demonstration purposes.',
        'is_active' => true,
    ]);
}
for($i=1; $i<=3; $i++) {
    \App\Models\BlogPost::firstOrCreate(['slug' => 'dummy-journal-'.$i], [
        'title' => 'Dummy Journal ' . $i,
        'category' => 'Fashion',
        'content' => '<p>This is a dummy journal post created for demonstration purposes. It highlights the latest trends and insights from the fashion industry.</p>',
        'published_at' => now(),
        'is_published' => true,
        'meta_title' => 'Dummy Journal ' . $i,
        'meta_description' => 'Dummy Journal Description'
    ]);
}
echo "Dummy data created.";
