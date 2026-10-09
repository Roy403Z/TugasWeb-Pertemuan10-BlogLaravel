<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory memakai kumpulan artikel Laravel berbahasa Indonesia (bukan teks acak),
 * sehingga data contoh langsung terbaca seperti blog sungguhan.
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        $artikel = fake()->randomElement(self::articles());

        return [
            'title'   => $artikel['title'],
            'content' => $artikel['content'],
            'image'   => null,
        ];
    }

    /**
     * 15 artikel tentang Laravel. Dipakai oleh definition() dan DatabaseSeeder.
     *
     * @return array<int, array{title: string, content: string}>
     */
    public static function articles(): array
    {
        return [
            [
                'title' => 'Mengenal Laravel: Framework PHP untuk Web Modern',
                'content' => <<<'TXT'
                Laravel adalah framework PHP open source yang dibuat oleh Taylor Otwell dan pertama kali dirilis pada tahun 2011. Framework ini menyediakan kerangka kerja yang rapi sehingga pengembang tidak perlu membangun fondasi aplikasi dari nol, mulai dari routing, akses database, sampai keamanan dasar.

                Laravel menganut pola MVC (Model, View, Controller) dan dilengkapi banyak fitur siap pakai: Eloquent ORM, template engine Blade, migration, validasi, autentikasi, hingga alat bantu command line bernama Artisan. Sintaksnya ekspresif dan mudah dibaca, sehingga nyaman dipakai oleh pemula maupun tim profesional.

                Untuk memulai, pasang Composer lalu jalankan perintah composer create-project laravel/laravel nama-proyek. Setelah itu, php artisan serve sudah cukup untuk menjalankan aplikasi di komputer sendiri.
                TXT,
            ],
            [
                'title' => 'Memahami Pola MVC di Laravel',
                'content' => <<<'TXT'
                MVC memisahkan aplikasi menjadi tiga bagian dengan tugas masing-masing. Model mengurus data dan aturan bisnis, View mengurus tampilan, dan Controller menjadi penghubung yang menerima request lalu menentukan respons yang dikirim ke pengguna.

                Di Laravel, alurnya kira-kira begini: request masuk ke file routes/web.php, diarahkan ke method di Controller, Controller mengambil atau menyimpan data lewat Model, lalu hasilnya dikirim ke View Blade. Karena tiap bagian punya tanggung jawab jelas, kode lebih mudah dirawat dan diuji.

                Kesalahan umum pemula adalah menaruh query database dan logika panjang di View atau di route. Biasakan agar Controller tetap tipis, logika data berada di Model, dan View hanya menampilkan apa yang diberikan.
                TXT,
            ],
            [
                'title' => 'Routing di Laravel: Dari Route::get sampai Route::resource',
                'content' => <<<'TXT'
                Routing menentukan apa yang terjadi ketika pengguna membuka sebuah URL. Semua route web ditulis di routes/web.php. Method yang tersedia mengikuti HTTP: Route::get, Route::post, Route::put, Route::patch, dan Route::delete. Route juga bisa menerima parameter, misalnya /posts/{post}.

                Beri nama pada route memakai ->name('posts.show'), lalu panggil lewat helper route('posts.show', $post). Dengan begitu, jika URL berubah, kamu tidak perlu mengubah link di semua view.

                Untuk CRUD, gunakan Route::resource('posts', PostController::class). Satu baris ini membuat tujuh route sekaligus: index, create, store, show, edit, update, dan destroy. Jalankan php artisan route:list untuk melihat daftar lengkapnya. Ingat bahwa form HTML hanya mendukung GET dan POST, sehingga untuk PUT, PATCH, dan DELETE kamu perlu menambahkan @method di dalam form.
                TXT,
            ],
            [
                'title' => 'Blade: Template Engine Bawaan Laravel',
                'content' => <<<'TXT'
                Blade adalah template engine Laravel. File-nya berakhiran .blade.php dan boleh dicampur dengan HTML biasa. Blade diubah menjadi kode PHP lalu di-cache, sehingga tidak memperlambat aplikasi.

                Untuk menampilkan data, gunakan kurung kurawal ganda. Output di dalamnya otomatis di-escape sehingga aman dari serangan XSS. Sintaks {!! !!} menampilkan data tanpa escape, jadi pakai hanya untuk konten yang benar-benar tepercaya. Blade juga punya directive seperti @if, @foreach, dan @forelse yang jauh lebih rapi dibanding tag PHP biasa.

                Fitur terpenting adalah pewarisan layout. Buat satu layout master berisi navbar dan footer, lalu halaman lain cukup memakai @extends dan mengisi @section. Untuk potongan UI yang dipakai berulang, buat komponen Blade seperti x-alert atau x-card.
                TXT,
            ],
            [
                'title' => 'Eloquent ORM: Mengelola Database Tanpa Menulis SQL Manual',
                'content' => <<<'TXT'
                Eloquent adalah ORM bawaan Laravel. Setiap tabel dipetakan ke satu class Model. Model Post, misalnya, otomatis terhubung ke tabel posts berkat konvensi penamaan Laravel.

                Operasi umum menjadi sangat singkat: Post::all() untuk semua data, Post::find(1) untuk satu data, Post::where('title', 'like', '%laravel%')->get() untuk pencarian, Post::create([...]) untuk menyimpan, serta $post->update([...]) dan $post->delete() untuk mengubah dan menghapus.

                Saat memakai create atau update dengan data dari form, tentukan kolom yang boleh diisi lewat properti $fillable. Ini melindungi aplikasi dari mass assignment, yaitu kondisi ketika pengguna iseng mengirim field tambahan yang tidak kamu rencanakan. Eloquent juga mendukung scope untuk membungkus query yang sering dipakai, misalnya scopeSearch yang dipanggil sebagai ->search($kata).
                TXT,
            ],
            [
                'title' => 'Migration: Version Control untuk Struktur Database',
                'content' => <<<'TXT'
                Migration adalah file PHP yang menjelaskan struktur tabel. Dengan migration, perubahan database tercatat sebagai kode, bisa disimpan di Git, dan dijalankan ulang di komputer mana pun, sehingga seluruh anggota tim memiliki struktur database yang sama.

                Setiap migration punya method up untuk menerapkan perubahan dan method down untuk membatalkannya. Contohnya, Schema::create('posts', ...) di dalam up membuat tabel, sedangkan Schema::dropIfExists('posts') di dalam down menghapusnya.

                Perintah yang paling sering dipakai: php artisan migrate untuk menjalankan migration baru, php artisan migrate:rollback untuk membatalkan batch terakhir, dan php artisan migrate:fresh --seed untuk membangun ulang seluruh tabel beserta data contoh. Hati-hati dengan migrate:fresh karena semua tabel dihapus terlebih dahulu.
                TXT,
            ],
            [
                'title' => 'Validasi Input dengan Form Request',
                'content' => <<<'TXT'
                Data dari pengguna tidak boleh langsung dipercaya. Laravel menyediakan validasi yang bisa ditulis langsung di controller, tetapi cara yang lebih rapi adalah memakai Form Request. Buat dengan php artisan make:request PostRequest, lalu isi aturan di method rules().

                Contoh aturan: title wajib diisi, bertipe string, minimal 3 dan maksimal 150 karakter. Pesan kesalahan bawaan dapat diganti dengan bahasa Indonesia lewat method messages(). Jika validasi gagal, Laravel otomatis mengembalikan pengguna ke halaman form beserta variabel $errors dan input sebelumnya.

                Di Blade, tampilkan pesan per field dengan @error('title') dan isi ulang input dengan old('title'). Dengan Form Request, controller hanya berjalan jika data sudah lolos validasi, sehingga kodenya tetap singkat dan fokus.
                TXT,
            ],
            [
                'title' => 'Route Model Binding: Controller Jadi Lebih Singkat',
                'content' => <<<'TXT'
                Biasanya untuk menampilkan satu post kita mengambil id dari URL lalu mencarinya di database. Dengan Route Model Binding, Laravel melakukan itu secara otomatis. Cukup tulis method show(Post $post) di controller dan nama parameter pada route cocok dengan nama variabel, maka $post langsung berisi data dari database.

                Jika data dengan id tersebut tidak ada, Laravel otomatis menampilkan halaman 404 tanpa perlu kamu tulis kondisi tambahan. Ini membuat controller lebih pendek dan lebih aman dari lupa menangani data yang tidak ditemukan.

                Secara bawaan pencarian memakai kolom id. Jika ingin memakai kolom lain, misalnya slug, tulis route sebagai /posts/{post:slug}. Perlu diingat bahwa data yang sudah di-soft delete tidak ikut ditemukan kecuali route ditambah withTrashed().
                TXT,
            ],
            [
                'title' => 'Melindungi Form dari Serangan CSRF',
                'content' => <<<'TXT'
                CSRF (Cross-Site Request Forgery) adalah serangan ketika situs lain memaksa browser pengguna yang sedang login mengirim request ke aplikasi kita tanpa sepengetahuan pengguna. Tanpa perlindungan, aksi seperti menghapus data bisa dipicu dari luar.

                Laravel membuat token acak untuk setiap sesi pengguna. Token ini harus ikut dikirim pada setiap request POST, PUT, PATCH, dan DELETE. Cara termudah adalah menulis directive @csrf di dalam form, yang akan menghasilkan input hidden bernama _token. Request tanpa token yang valid ditolak dengan error 419.

                Untuk request AJAX, kirim token lewat header X-CSRF-TOKEN yang nilainya diambil dari meta tag. Jangan pernah mematikan perlindungan ini hanya karena error 419 mengganggu; periksa dulu apakah @csrf sudah terpasang di form.
                TXT,
            ],
            [
                'title' => 'Seeder dan Factory: Membuat Data Contoh dengan Cepat',
                'content' => <<<'TXT'
                Mengisi data contoh satu per satu lewat form sangat membuang waktu. Laravel menyelesaikannya dengan Factory dan Seeder. Factory mendefinisikan bentuk satu data palsu, sedangkan Seeder menjalankan factory tersebut untuk mengisi tabel.

                Buat factory dengan php artisan make:factory PostFactory. Di dalam method definition(), isi atribut seperti title dan content. Library Faker lewat helper fake() bisa menghasilkan nama, kalimat, tanggal, dan banyak jenis data lain. Setelah itu panggil Post::factory(15)->create() di dalam DatabaseSeeder.

                Jalankan seeder dengan php artisan db:seed, atau sekaligus bersama migration lewat php artisan migrate --seed. Factory juga sangat berguna di unit test karena kamu bisa membuat data uji hanya dengan satu baris kode.
                TXT,
            ],
            [
                'title' => 'Soft Delete: Menghapus Data dengan Aman',
                'content' => <<<'TXT'
                Pada penghapusan biasa, baris data hilang dari database untuk selamanya. Dengan soft delete, Laravel hanya mengisi kolom deleted_at, sehingga data tampak terhapus tetapi masih bisa dipulihkan.

                Cara mengaktifkannya ada dua langkah. Pertama, tambahkan $table->softDeletes() di migration. Kedua, pakai trait SoftDeletes di model. Setelah itu, query biasa seperti Post::all() tidak lagi menyertakan data yang sudah dihapus.

                Untuk mengelolanya tersedia beberapa method: withTrashed() menampilkan semua data, onlyTrashed() hanya yang sudah dihapus, restore() memulihkan data, dan forceDelete() menghapus permanen. Jika post punya file gambar, hapus file itu hanya ketika forceDelete dijalankan, bukan ketika soft delete.
                TXT,
            ],
            [
                'title' => 'Upload Gambar dan Storage di Laravel',
                'content' => <<<'TXT'
                Untuk mengunggah file, form harus memakai method POST dengan atribut enctype="multipart/form-data". Di controller, file dibaca lewat $request->file('image') dan disimpan dengan method store, misalnya store('posts', 'public'). Method ini mengembalikan path file yang bisa disimpan di kolom database.

                Disk public menyimpan file di storage/app/public. Folder ini belum bisa diakses dari browser, sehingga perlu dijalankan php artisan storage:link satu kali untuk membuat symbolic link ke public/storage. Setelah itu, URL file didapat lewat Storage::disk('public')->url($path).

                Jangan lupa validasi: gunakan aturan image, mimes:jpg,jpeg,png,webp, dan max:2048 (satuan kilobyte, jadi sekitar 2 MB). Saat gambar diganti, hapus file lama dengan Storage::disk('public')->delete($path) agar penyimpanan tidak penuh oleh file yang tidak terpakai.
                TXT,
            ],
            [
                'title' => 'Pagination: Membagi Data Menjadi Beberapa Halaman',
                'content' => <<<'TXT'
                Menampilkan ratusan data dalam satu halaman membuat aplikasi lambat dan sulit dibaca. Laravel membagi data dengan sangat mudah: ganti get() menjadi paginate(6) pada query, maka hasilnya otomatis dipotong menjadi 6 data per halaman.

                Di view, panggil $posts->links() untuk menampilkan tombol navigasi halaman. Method lain seperti $posts->total() memberi jumlah seluruh data, dan $posts->currentPage() memberi halaman yang sedang dibuka.

                Jika halaman memiliki fitur pencarian, tambahkan withQueryString() agar parameter seperti ?q=laravel tetap terbawa saat pindah ke halaman berikutnya. Untuk data yang sangat besar, simplePaginate() bisa dipilih karena hanya menampilkan tombol sebelumnya dan berikutnya sehingga tidak perlu menghitung total data.
                TXT,
            ],
            [
                'title' => 'Relasi Antar Tabel: hasMany dan belongsTo',
                'content' => <<<'TXT'
                Aplikasi nyata jarang hanya punya satu tabel. Sebuah blog biasanya memiliki penulis, dan satu penulis bisa memiliki banyak post. Di Eloquent, hubungan ini ditulis sebagai relasi: model User memiliki method posts() yang mengembalikan hasMany(Post::class), dan model Post memiliki method user() yang mengembalikan belongsTo(User::class).

                Di migration, tambahkan kolom penghubung dengan $table->foreignId('user_id')->constrained(). Setelah relasi didefinisikan, kamu bisa mengakses data dengan sangat natural, misalnya $user->posts atau $post->user->name.

                Waspadai masalah N+1 query: memanggil $post->user di dalam perulangan membuat Laravel menjalankan satu query untuk setiap post. Solusinya adalah eager loading, yaitu Post::with('user')->get(), yang hanya memerlukan dua query berapa pun jumlah post-nya.
                TXT,
            ],
            [
                'title' => 'Middleware: Penjaga Pintu di Depan Route',
                'content' => <<<'TXT'
                Middleware adalah lapisan yang memeriksa request sebelum sampai ke controller. Bayangkan seperti satpam: ia memutuskan apakah request boleh lanjut, dialihkan, atau ditolak. Contoh bawaan Laravel antara lain auth untuk memastikan pengguna sudah login dan throttle untuk membatasi jumlah request.

                Pemakaiannya sangat sederhana. Untuk satu route tulis ->middleware('auth'), dan untuk banyak route sekaligus gunakan Route::middleware('auth')->group(function () { ... }). Dengan cara ini halaman tulis, edit, dan hapus post hanya bisa dibuka oleh pengguna yang sudah login.

                Kamu juga bisa membuat middleware sendiri dengan php artisan make:middleware NamaMiddleware. Pada Laravel versi terbaru, middleware didaftarkan dan diatur di file bootstrap/app.php. Autentikasi seperti ini akan menjadi tahap berikutnya setelah CRUD dasar selesai.
                TXT,
            ],
        ];
    }
}
