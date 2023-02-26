Aplikasi eapd disgulkarmat menggunakan laravel 9

Requirement :

-   laravel 9.37.0
-   php 8+
-   [node 16+](https://nodejs.org/en/download/)
-   composer

Package :

-   [admin lte](https://adminlte.io/themes/v3/)
-   [tailwind css v2](https://tailwindcss.com/)
-   [livewire](https://laravel-livewire.com/)
-   [rappasoft livewire-datatable](https://github.com/rappasoft/laravel-livewire-tables)
-   Laravel Echo

Notes pengembangan :

-   Gunakan kolom issues di github utk memberi tau jika ada bug atau trouble di aplikasi
-   Kolom wiki di github untuk menambah info umum seputar pengembangan aplikasi
-   Kolom discussion untuk bertanya/share seputar pengembangan

useful links :

-   Dokumentasi admin lte (github en) : https://github.com/ColorlibHQ/AdminLTE
-   Dokumentasi tailwind css (official en) : https://v2.tailwindcss.com/docs
-   Dokumentasi livewire-datatable (official rappasoft en) : https://rappasoft.com/docs/laravel-livewire-tables/v2/introduction
-   Screencast livewire (en) : https://laravel-livewire.com/screencasts

Reminder untuk expose ke local network :
Aplikasi ini sudah diatur untuk dapat mengekspose ip dan port ke local network sehingga ketika server dijalankan selama masa pengembangan, web dapat diakses dari perangkat lain caranya

jalankan perintah php artisan serve --host xxx.xxx.xxx.xxx -- port xx dan perintah npm run dev --host xxx.xxx.xxx.xxx
