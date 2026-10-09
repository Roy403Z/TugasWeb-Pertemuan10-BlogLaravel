<?php

namespace Database\Seeders;

use App\Models\Post;
use Database\Factories\PostFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 15 artikel Laravel (6 per halaman = 3 halaman pagination).
        // Artikel pertama dibuat paling baru, jadi tampil paling atas di daftar.
        foreach (PostFactory::articles() as $i => $artikel) {
            $tanggal = now()->subDays($i)->subHours($i);

            Post::factory()->create([
                'title'      => $artikel['title'],
                'content'    => $artikel['content'],
                'created_at' => $tanggal,
                'updated_at' => $tanggal,
            ]);
        }
    }
}
