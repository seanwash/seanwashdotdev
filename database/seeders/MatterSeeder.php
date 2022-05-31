<?php

namespace Database\Seeders;

use App\Models\Matter;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MatterSeeder extends Seeder
{
    public function run()
    {
        collect([
            [
                'label' => 'Thinking in mental models - Julian Shapiro',
                'url' => 'https://www.julian.com/blog/mental-model-examples',
                'tags' => ['Reading'],
            ],
            [
                'label' => 'How to become an expert - Julian Shapiro',
                'url' => 'https://www.julian.com/blog/craftspeople',
                'tags' => ['Reading'],
            ],
            [
                'label' => 'Greg Schier',
                'url' => 'https://schier.co',
                'tags' => ['Website'],
            ],
            [
                'label' => 'Paul Straw',
                'url' => 'https://paulstraw.com',
                'tags' => ['Website'],
            ],
            [
                'label' => 'How To Ask Questions The Smart Way',
                'url' => 'http://www.catb.org/esr/faqs/smart-questions.html',
                'tags' => ['Reading'],
            ],
            [
                'label' => 'Improve how you architect webapps',
                'url' => 'https://patterns.dev',
                'tags' => ['Reading'],
            ],
            [
                'label' => 'How my website works - Brian Lovin',
                'url' => 'https://brianlovin.com/writing/how-my-website-works',
                'tags' => ['Reading'],
            ],
            [
                'label' => 'Adam Wathan',
                'url' => 'https://adamwathan.me',
                'tags' => ['Website'],
            ],
            [
                'label' => 'Brian Lovin',
                'url' => 'https://brianlovin.com',
                'tags' => ['Website'],
            ],
            [
                'label' => 'Staff Eng Archetypes',
                'url' => 'https://leebyron.com/til/staff-eng-archetypes/',
                'tags' => ['Reading'],
            ],
            [
                'label' => 'Why You Should Start a Blog Right Now',
                'url' => 'https://guzey.com/personal/why-have-a-blog/',
                'tags' => ['Reading'],
            ],
            [
                'label' => 'The unreasonable effectiveness of one-on-ones',
                'url' => 'https://www.benkuhn.net/11',
                'tags' => ['Reading'],
            ],
            [
                'label' => 'Flow.rest',
                'url' => 'https://flow.rest',
                'tags' => ['Website'],
            ],
        ])->each(function ($bookmark) {
            $bookmark_model = Matter::factory()->bookmark()->create([
                'name' => $bookmark['label'],
                'slug' => Str::slug($bookmark['label']),
                'external_url' => $bookmark['url'],
            ]);

            collect($bookmark['tags'])->each(function ($tag) use ($bookmark_model) {
                $tag_model = Tag::updateOrCreate([
                    'name' => $tag
                ], [
                    'name' => $tag,
                    'slug' => Str::slug($tag),
                ]);

                $bookmark_model->tags()->sync([$tag_model->id]);
            });
        });

        collect([
            [
                'title' => '1Password',
                'url' => 'https://1password.com/',
                'tags' => ['Paid'],
                'description' => <<<EOD
             1Password is literally the first thing I install on every new device.
             EOD,
            ],
            [
                'title' => 'Raycast',
                'url' => 'https://1password.com/',
                'tags' => ['Free'],
                'description' => <<<EOD
             Raycast is a blazing fast, totally extendable launcher. It lets you complete tasks, calculate, share
                common links, and much more. I use it for everything from window management and controlling Apple Music
                to updating my Slack status.
             EOD,
            ],
            [
                'title' => 'Better Touch Tool',
                'url' => 'https://folivora.ai',
                'tags' => ['Paid', 'Indie'],
                'description' => <<<EOD
             While Better Touch Tool is an extremely powerful utility for MacOS, I primarily use the <a
                    href="https://docs.folivora.ai/docs/1004_hyper_key.html">hyper key feature</a>. I use the hyper key
                in conjunction with Raycast so that I can launch my most often used apps via shortcuts. For example,
                <code>hyper + t</code> will launch or focus my Terminal window, <code>hyper + i</code> will open or
                focus Intellij, etc.
             EOD,
            ],
            [
                'title' => 'CleanShot',
                'url' => 'https://cleanshot.com/',
                'tags' => ['Paid'],
                'description' => <<<EOD
             CleanShot quickly replaced MacOS's built in screenshot tooling for me. It's a one-stop shop and has
                everything I need for sharing what I'm working on with my team.
             EOD,
            ],
            [
                'title' => 'SoundSource',
                'url' => 'https://rogueamoeba.com/soundsource/',
                'tags' => ['Paid'],
                'description' => <<<EOD
             SoundSource is a MacOS app that gives you greater control over all things audio. You get a per-app audio
                mixer, and you can even add a different EQ to any audio source
             EOD,
            ],
        ])->each(function ($tool) {
            $tool_model = Matter::factory()->tool()->create([
                'name' => $tool['title'],
                'slug' => Str::slug($tool['title']),
                'external_url' => $tool['url'],
                'content' => $tool['description'],
            ]);

            collect($tool['tags'])->each(function ($tag) use ($tool_model) {
                $tag_model = Tag::updateOrCreate([
                    'name' => $tag
                ], [
                    'name' => $tag,
                    'slug' => Str::slug($tag),
                ]);

                $tool_model->tags()->sync([$tag_model->id]);
            });
        });
    }
}
