<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $characters = [
            ['name' => 'Stan Marsh', 'username' => 'stan_marsh', 'display_name' => 'Stan'],
            ['name' => 'Kyle Broflovski', 'username' => 'kyle_broflovski', 'display_name' => 'Kyle'],
            ['name' => 'Eric Cartman', 'username' => 'eric_cartman', 'display_name' => 'Cartman', 'title' => 'The Coon'],
            ['name' => 'Kenny McCormick', 'username' => 'kenny_mccormick', 'display_name' => 'Kenny'],
            ['name' => 'Butters Stotch', 'username' => 'butters_stotch', 'display_name' => 'Butters', 'title' => 'Professor Chaos'],
            ['name' => 'Wendy Testaburger', 'username' => 'wendy_testaburger', 'display_name' => 'Wendy'],
            ['name' => 'Randy Marsh', 'username' => 'randy_marsh', 'display_name' => 'Randy'],
            ['name' => 'Sharon Marsh', 'username' => 'sharon_marsh', 'display_name' => 'Sharon'],
            ['name' => 'Shelley Marsh', 'username' => 'shelley_marsh', 'display_name' => 'Shelley'],
            ['name' => 'Gerald Broflovski', 'username' => 'gerald_broflovski', 'display_name' => 'Gerald'],
            ['name' => 'Sheila Broflovski', 'username' => 'sheila_broflovski', 'display_name' => 'Sheila'],
            ['name' => 'Ike Broflovski', 'username' => 'ike_broflovski', 'display_name' => 'Ike'],
            ['name' => 'Liane Cartman', 'username' => 'liane_cartman', 'display_name' => 'Liane'],
            ['name' => 'Stuart McCormick', 'username' => 'stuart_mccormick', 'display_name' => 'Stuart'],
            ['name' => 'Carol McCormick', 'username' => 'carol_mccormick', 'display_name' => 'Carol'],
            ['name' => 'Kevin McCormick', 'username' => 'kevin_mccormick', 'display_name' => 'Kevin'],
            ['name' => 'Karen McCormick', 'username' => 'karen_mccormick', 'display_name' => 'Karen'],
            ['name' => 'Token Black', 'username' => 'token_black', 'display_name' => 'Token'],
            ['name' => 'Nichole', 'username' => 'nichole', 'display_name' => 'Nichole'],
            ['name' => 'Clyde Donovan', 'username' => 'clyde_donovan', 'display_name' => 'Clyde'],
            ['name' => 'Craig Tucker', 'username' => 'craig_tucker', 'display_name' => 'Craig'],
            ['name' => 'Tweek Tweak', 'username' => 'tweek_tweak', 'display_name' => 'Tweek'],
            ['name' => 'Jimmy Valmer', 'username' => 'jimmy_valmer', 'display_name' => 'Jimmy'],
            ['name' => 'Timmy Burch', 'username' => 'timmy_burch', 'display_name' => 'Timmy'],
            ['name' => 'Bebe Stevens', 'username' => 'bebe_stevens', 'display_name' => 'Bebe'],
            ['name' => 'Heidi Turner', 'username' => 'heidi_turner', 'display_name' => 'Heidi'],
            ['name' => 'Pip Pirrup', 'username' => 'pip_pirrup', 'display_name' => 'Pip'],
            ['name' => 'Damien Thorn', 'username' => 'damien_thorn', 'display_name' => 'Damien'],
            ['name' => 'Mr. Garrison', 'username' => 'mr_garrison', 'display_name' => 'Mr. Garrison'],
            ['name' => 'Mr. Mackey', 'username' => 'mr_mackey', 'display_name' => 'Mr. Mackey'],
            ['name' => 'Officer Barbrady', 'username' => 'officer_barbrady', 'display_name' => 'Officer Barbrady'],
            ['name' => 'Mayor McDaniels', 'username' => 'mayor_mcdaniels', 'display_name' => 'Mayor McDaniels'],
            ['name' => 'Jimbo Kern', 'username' => 'jimbo_kern', 'display_name' => 'Jimbo'],
            ['name' => 'Ned Gerblansky', 'username' => 'ned_gerblansky', 'display_name' => 'Ned'],
            ['name' => 'Scott Malkinson', 'username' => 'scott_malkinson', 'display_name' => 'Scott'],
            ['name' => 'PC Principal', 'username' => 'pc_principal', 'display_name' => 'PC Principal'],
            ['name' => 'Principal Victoria', 'username' => 'principal_victoria', 'display_name' => 'Principal Victoria'],
            ['name' => 'Filmore Anderson', 'username' => 'filmore_anderson', 'display_name' => 'Filmore'],
            ['name' => 'Mr. Stotch', 'username' => 'mr_stotch', 'display_name' => 'Mr. Stotch'],
            ['name' => 'Mrs. Stotch', 'username' => 'mrs_stotch', 'display_name' => 'Mrs. Stotch'],
        ];

        $users = collect($characters)->map(function ($character) {
            $password = Str::random(16);

            return User::create([
                'name' => $character['name'],
                'username' => $character['username'],
                'display_name' => $character['display_name'],
                'title' => $character['title'] ?? null,
                'email' => $character['username'] . '@southpark.test',
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]);
        });

        $mainUser = User::create([
            'name' => 'Neuer',
            'username' => 'erstaunlicher_wunder_arsch',
            'display_name' => 'Neuer',
            'title' => 'Auch bekannt als der Erstaunliche Wunder-Arsch. Coon and Friend.',
            'email' => 'you@southpark.test',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        $samplePosts = [
            'Fantastische Neuigkeiten! Das Schnellreisesystem läuft! Zzzzzuhm!',
            'Hey, du warst da eben irgendwie ziemlich fies zu mir. Aber vermutlich tut es dir leid.',
            'Keine Spur von Scrambles im Park. Aber ich habe eine Idee. Mal sehen, ob ich recht habe!',
            'Habe gerade das neue Meerschweinchen gefüttert. Wieso guckt mich das so an?!',
            'Es gibt keinen besseren Partner. Stripe ist treu und ihm ist der Franchise-Plan egal.',
            'Ich hab hier die Befehlsgewalt, ob\'s euch passt oder nicht.',
            'Ich hab wieder was Chaotisches vor. Diesmal klappt\'s, ich schwöre.',
            'Warum passiert das immer nur mir?',
            'Ihr werdet alle für eure Frevel bezahlen.',
            'Also ich hab da mal recherchiert, und die Wahrheit ist SCHLIMMER als ihr denkt.',
            'Kann heute keiner mal normal sein? Nur einmal?',
            'Hab grad zwei Stunden mit meinem Anwalt telefoniert. Frag nicht.',
            'War heut wieder richtig anstrengend in der Schule. Jungs sind einfach kompliziert.',
            'Also GANZ ehrlich, das war doch offensichtlich meine Idee zuerst.',
            'Niemand hört mir zu, aber ich hab RECHT.',
            'Heute mal ein ruhiger Tag. Endlich.',
            'Ich mag Kühe.',
            'Man sollte echt öfter mal einfach nett zueinander sein, findet ihr nicht?',
            'Das war jetzt nicht meine Schuld, ganz klar nicht.',
            'Mensch, was für eine Woche. Braucht jemand ein Bier?',
            'Alter, ich krieg das einfach nicht hin heute.',
            'Wisst ihr was, ich glaub ich mach jetzt einfach mein eigenes Ding.',
            'Kann mal bitte jemand die Erwachsenen hier ernst nehmen?',
            'Ich hab nichts gemacht! Das war eindeutig jemand anders!',
            'Manchmal frag ich mich echt, was in dieser Stadt so abgeht.',
        ];

        $posts = $users->map(function (User $user) use ($samplePosts) {
            $post = Post::create([
                'user_id' => $user->id,
                'body' => $samplePosts[array_rand($samplePosts)],
            ]);

            Like::create(['post_id' => $post->id, 'user_id' => $user->id]);

            return $post;
        });

        $firstPost = $posts->first();
        if ($firstPost) {
            $comment = Comment::create([
                'post_id' => $firstPost->id,
                'user_id' => $users->random()->id,
                'body' => 'Alter, das ist ja krass!',
            ]);

            Comment::create([
                'post_id' => $firstPost->id,
                'user_id' => $users->random()->id,
                'parent_id' => $comment->id,
                'body' => 'Stimmt total.',
            ]);
        }

        $users->each(function (User $user) use ($mainUser) {
            $mainUser->following()->attach($user->id);
            $user->following()->attach($mainUser->id);
        });
    }
}
