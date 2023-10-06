<!--MATERI BLADE TEMPLATE LARAVEL - Directive - Component-->
@props(['listing']) <!--bagian ini akan parsing data $listing, yg hasil dari perulangan di page utama (yg diakses) listings.blade.php kita-->
<!--untuk Directive di atas dilakukan karena bagian component ini membutuhkan data $listing tersebut-->

<!--MATERI BLADE TEMPLATE LARAVEL - Directive - Component - Component Digabungkan Dengan Component Lain-->
<!--bagian ini akan menjadi component kita (dalam Blade Templating)-->
<x-card>
    <div class="flex">
        <!--di bagian ini kita pakai function asset() untuk ambil assets kita seperti image dll-->
        <!--
        <img class="hidden w-48 mr-6 md:block" src="{{asset('images/no-image.png')}}" alt=""/>
        -->
        <!--code sudah ditimpa oleh MATERI FILE UPLOAD-->
        <!--MATERI FILE UPLOAD-->
        <!--isi attribute src di bawah yaitu operator ternary yg mengecek apakah ada property logo di hasil $listing (dari perulangan foreach $listings berasal dari database)-->
        <!--kalo ada maka diisi path data $listing->logo (dari field di database), kalo tidak ada maka pakai path logo no-image.png yg default-->
        <img class="hidden w-48 mr-6 md:block" src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('images/no-image.png')}}" alt=""/>
        <div>
            <h3 class="text-2xl">
                <a href="/home/listings/{{$listing->id}}">{{$listing->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
            <!--
            <ul class="flex">
                <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                    <a href="#">Laravel</a>
                </li>
                <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                    <a href="#">API</a>
                </li>
                <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                    <a href="#">Backend</a>
                </li>
                <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                    <a href="#">Vue</a>
                </li>
            </ul>
            -->
            <!--bagian untuk tags di atas sudah diganti dengan Component (di bawah) yg kita buat-->
            <!--MATERI BLADE TEMPLATE LARAVEL - Directive - Component - Component Digabungkan Dengan Component Lain-->
            <x-listing-tags :tagsCsv="$listing->tags"/>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
            </div>
        </div>
    </div>
</x-card>

<!--halaman ini memanfaatkan Component card.blade.php & listing-tags.blade.php-->