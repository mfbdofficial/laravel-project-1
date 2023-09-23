<!--MATERI BLADE TEMPLATE LARAVEL - Directive - Component-->
@props(['listing']) <!--bagian ini akan parsing data $listing, yg hasil dari perulangan di page utama (yg diakses) listings.blade.php kita-->
<!--untuk Directive di atas dilakukan karena bagian component ini membutuhkan data $listing tersebut-->

<!--MATERI BLADE TEMPLATE LARAVEL - Directive - Component - Component Digabungkan Dengan Component Lain-->
<!--bagian ini akan menjadi component kita (dalam Blade Templating)-->
<x-card>
    <div class="flex">
        <!--di bagian ini kita pakai function asset() untuk ambil assets kita seperti image dll-->
        <img class="hidden w-48 mr-6 md:block" src="{{asset('images/no-image.png')}}" alt=""/>
        <div>
            <h3 class="text-2xl">
                <a href="/home/listing/{{$listing->id}}">{{$listing->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
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
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
            </div>
        </div>
    </div>
</x-card>