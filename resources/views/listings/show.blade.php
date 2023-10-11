<!--ayo pakai layout yg sudah dibuat-->
@extends('layout')

@section('content')
    <!--MATERI BLADE TEMPLATE LARAVEL - Directive - Create Partials-->
    @include('partials._search')

    <!--MATERI LARAVEL ELOQUENT - Model-->
    <!--
    <h2>{{$listing['title']}}</h2>
    <p>{{$listing['description']}}</p>

    <a href="/home">Back to see all listings</a>
    -->

    <a href="/home" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i>Back</a>

    <div class="mx-4">
        <!--<div class="bg-gray-50 border border-gray-200 p-10 rounded">-->
        <!--bagian tag di atas sudah diganti dengan Component-->
        <!--MATERI BLADE TEMPLATE LARAVEL - Directive - Component - Component Digabungkan Dengan Component Lain-->
        <x-card class="p-24 bg-black"> <!--entah kenapa bagian yg merge attribute class ini tidak jalan-->
            <div class="flex flex-col items-center justify-center text-center">
                <!--
                <img class="w-48 mr-6 mb-6" src="{{asset('images/no-image.png')}}" alt="">
                -->
                <!--code sudah ditimpa oleh MATERI FILE UPLOAD-->
                <!--MATERI FILE UPLOAD-->
                <!--isi attribute src di bawah yaitu operator ternary yg mengecek apakah ada property logo di hasil $listing (dari perulangan foreach $listings berasal dari database)-->
                <!--kalo ada maka diisi path data $listing->logo (dari field di database), kalo tidak ada maka pakai path logo no-image.png yg default-->
                <img class="w-48 mr-6 mb-6" src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('images/no-image.png')}}" alt="">
                <h3 class="text-2xl mb-2">{{$listing->title}}</h3>
                <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
                <!--
                <ul class="flex">
                    <li class="bg-black text-white rounded-xl px-3 py-1 mr-2">
                        <a href="#">Laravel</a>
                    </li>
                    <li class="bg-black text-white rounded-xl px-3 py-1 mr-2">
                        <a href="#">API</a>
                    </li>
                    <li class="bg-black text-white rounded-xl px-3 py-1 mr-2">
                        <a href="#">Backend</a>
                    </li>
                    <li class="bg-black text-white rounded-xl px-3 py-1 mr-2">
                        <a href="#">Vue</a>
                    </li>
                </ul>
                -->
                <!--bagian untuk tags di atas sudah diganti dengan Component (di bawah) yg kita buat-->
                <!--MATERI BLADE TEMPLATE LARAVEL - Directive - Component - Component Digabungkan Dengan Component Lain-->
                <x-listing-tags :tagsCsv="$listing->tags"/>
                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">Job Description</h3>
                    <div class="text-lg space-y-6">
                        <p>{{$listing->description}}</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At unde fugit perferendis molestiae dolorum veritatis explicabo, obcaecati, repudiandae accusantium quibusdam totam possimus omnis architecto alias! Odio dolor hic numquam sequi.</p>
                        <a href="mailto:{{$listing->email}}" class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80">
                            <i class="fa-solid fa-envelope"></i> Contact Employer
                        </a>
                        <a href="{{$listing->website}}" target="_blank" class="block bg-black text-white py-2 rounded-xl hover:opacity-80">
                            <i class="fa-solid fa-globe"></i> Visit Website
                        </a>
                    </div>
                </div>
            </div>
        </x-card>
        <!--di bawah ini cuma sisa bekas tag div di atas yg diganti dengan Component-->
        <!--</div>-->

        <!--karena sudah ada data relationship antara data listings dan users di halaman manage, jadi bagian ini harusnya tidak perlu ada-->
        <!--jadi hanya user sebagai pemilik listing-nya yang bisa melakukan update dan delete data listing milik user tersebut-->
        <!--bagian ini tidak usah (batas atas)-->
        <x-card class="mt-4 p-2 flex space-x-6">
            <!--MATERI DATABASE IN LARAVEL - UPDATE Database in Laravel-->
            <a href="/home/listings/{{$listing->id}}/edit">
                <i class="fa-solid fa-pencil"></i> Edit
            </a>

            <!--MATERI DATABASE IN LARAVEL - DELETE Database in Laravel-->
            <form method="POST" action="/home/listings/{{$listing->id}}">
                @csrf
                @method('DELETE')
                <button class="text-red-500" onclick="return confirm('Are you sure to DELETE this listing?');">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>
            </form>
        </x-card>
        <!--sampe bagian ini tidak usah (batas bawah)-->
    </div>
@endsection

<!--halaman ini memanfaatkan Component card.blade.php & listing-tags.blade.php-->