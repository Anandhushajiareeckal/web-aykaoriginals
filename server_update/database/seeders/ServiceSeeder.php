<?php
namespace Database\Seeders;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder {
    public function run(): void {
        Service::truncate();
        $services = [
            [
                'title' => 'Talent Management',
                'description' => 'Strategic representation for models and creatives at every career stage. We engineer iconic brands from raw talent to global recognition.',
                'content' => '<p class="svc-brand-sans" style="font-size:1.05rem;line-height:2;color:rgba(255,255,255,0.7);margin-bottom:2rem;font-weight:300">AYKA represents the vanguard of modern talent. We do not just book jobs; we cultivate long-term, culturally significant careers. Our management approach is entirely holistic, taking into account the unique trajectory, voice, and visual identity of every individual we represent.</p>
                <h3 class="svc-brand-serif" style="font-size:2rem;color:#fff;margin-bottom:1rem;font-weight:400">Our Approach</h3>
                <ul style="list-style:none;padding:0;margin-bottom:2rem">
                    <li style="margin-bottom:1rem;display:flex;gap:1rem"><span style="color:#6C63FF">✦</span> <span style="color:rgba(255,255,255,0.6)">Boutique attention to detail and personalized career mapping.</span></li>
                    <li style="margin-bottom:1rem;display:flex;gap:1rem"><span style="color:#6C63FF">✦</span> <span style="color:rgba(255,255,255,0.6)">Strategic positioning within high-fashion and luxury markets.</span></li>
                    <li style="margin-bottom:1rem;display:flex;gap:1rem"><span style="color:#6C63FF">✦</span> <span style="color:rgba(255,255,255,0.6)">End-to-end contract negotiation and brand partnership execution.</span></li>
                </ul>',
                'icon' => 'star',
                'tag' => 'Core Service',
                'sort_order' => 1,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=1000&auto=format&fit=crop',
                'banner_image' => 'https://images.unsplash.com/photo-1549460591-eb24e12e75e9?q=80&w=2000&auto=format&fit=crop'
            ],
            [
                'title' => 'Campaign Production',
                'description' => 'End-to-end campaign production for luxury fashion and beauty brands. From ideation to execution.',
                'content' => '<p class="svc-brand-sans" style="font-size:1.05rem;line-height:2;color:rgba(255,255,255,0.7);margin-bottom:2rem;font-weight:300">We produce striking visual narratives that push boundaries. Our production wing handles everything from high-end fashion editorials to global commercial campaigns, bringing together top-tier photographers, directors, and stylists.</p>
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:2rem;margin-top:2rem;">
                    <div style="border-left:1px solid #6C63FF;padding-left:1.5rem">
                        <h4 style="color:#fff;font-weight:600;margin-bottom:0.5rem">Creative Direction</h4>
                        <p style="color:rgba(255,255,255,0.5);font-size:0.9rem;line-height:1.7">We shape the visual identity of the campaign before the first frame is captured.</p>
                    </div>
                    <div style="border-left:1px solid #6C63FF;padding-left:1.5rem">
                        <h4 style="color:#fff;font-weight:600;margin-bottom:0.5rem">On-Set Execution</h4>
                        <p style="color:rgba(255,255,255,0.5);font-size:0.9rem;line-height:1.7">Seamless logistics, world-class crew sourcing, and flawless shoot management.</p>
                    </div>
                </div>',
                'icon' => 'camera',
                'tag' => 'Production',
                'sort_order' => 2,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=1000&auto=format&fit=crop',
                'banner_image' => 'https://images.unsplash.com/photo-1509631179647-0c1157db18c4?q=80&w=2000&auto=format&fit=crop'
            ],
            [
                'title' => 'Editorial Direction',
                'description' => 'Creative direction and styling for magazine editorials, lookbooks, and high-fashion spreads.',
                'content' => '<p class="svc-brand-sans" style="font-size:1.05rem;line-height:2;color:rgba(255,255,255,0.7);margin-bottom:2rem;font-weight:300">Editorial is the heartbeat of the fashion industry. Our in-house creative division crafts compelling fashion stories that resonate with modern culture, frequently featured in elite global publications.</p>
                <p style="color:rgba(255,255,255,0.5);line-height:1.9">We collaborate intimately with designers, editors, and our talent roster to create authentic, forward-thinking visual imagery that defines rather than follows trends.</p>',
                'icon' => 'edit',
                'tag' => 'Creative',
                'sort_order' => 3,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1581044777550-4cfa60707c03?q=80&w=1000&auto=format&fit=crop',
                'banner_image' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=2000&auto=format&fit=crop'
            ],
            [
                'title' => 'Brand Consulting',
                'description' => 'Strategic brand development, market positioning, and visual identity consulting for fashion entities.',
                'content' => '<p class="svc-brand-sans" style="font-size:1.05rem;line-height:2;color:rgba(255,255,255,0.7);margin-bottom:2rem;font-weight:300">In a saturated market, clarity is power. We advise emerging and established brands on cultural relevance, market positioning, and visual aesthetic alignment.</p>
                <div style="padding:2rem;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);border-radius:12px">
                    <p style="color:#fff;font-size:1.1rem;font-style:italic;margin-bottom:1rem">"AYKA\'s consulting arm transformed our visual identity into something that truly speaks to the next generation."</p>
                    <span style="font-size:0.7rem;text-transform:uppercase;letter-spacing:0.15em;color:#6C63FF">— Luxury Client</span>
                </div>',
                'icon' => 'briefcase',
                'tag' => 'Strategy',
                'sort_order' => 4,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1542038784456-1ea8e935640e?q=80&w=1000&auto=format&fit=crop',
                'banner_image' => 'https://images.unsplash.com/photo-1469334031218-e382a71b716b?q=80&w=2000&auto=format&fit=crop'
            ],
        ];
        foreach($services as $s) {
            $s['slug'] = Str::slug($s['title']);
            Service::create($s);
        }

        // Seed Service Sections (Hero & Process)
        \App\Models\ServiceSection::truncate();
        \App\Models\ServiceSection::create([
            'section_key' => 'hero',
            'heading' => 'Our <em style="font-style:italic;opacity:.8">Services</em>',
            'subheading' => 'What We Offer',
            'body' => 'From talent representation to global campaigns — we deliver at every stage of the creative journey.',
            'image_url' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=2000&auto=format&fit=crop'
        ]);
        
        \App\Models\ServiceSection::create([
            'section_key' => 'process_heading',
            'heading' => 'Our Process<br><em style="opacity:.6">Is Simple.</em>',
            'subheading' => 'How It Works',
            'body' => 'From the first conversation to global recognition — our structured approach ensures every talent reaches their full potential.'
        ]);

        \App\Models\ServiceSection::create([
            'section_key' => 'process_1',
            'subheading' => '01',
            'heading' => 'Discovery',
            'body' => 'We deep-dive into your story, ambitions, and market positioning to craft a unique roadmap.'
        ]);
        \App\Models\ServiceSection::create([
            'section_key' => 'process_2',
            'subheading' => '02',
            'heading' => 'Strategy',
            'body' => 'We align talent, brand, and market opportunity to create the most impactful path forward.'
        ]);
        \App\Models\ServiceSection::create([
            'section_key' => 'process_3',
            'subheading' => '03',
            'heading' => 'Execution',
            'body' => 'Our team activates global partnerships, secures bookings, and drives unforgettable campaigns.'
        ]);
        \App\Models\ServiceSection::create([
            'section_key' => 'process_4',
            'subheading' => '04',
            'heading' => 'Growth',
            'body' => 'Continuous reinvention ensures you stay ahead of culture, not behind it.'
        ]);
    }
}
