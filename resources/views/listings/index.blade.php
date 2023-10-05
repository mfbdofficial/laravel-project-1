<!--ini kalo pake syntax PHP biasa-->
<!-- 
<h1><?= $heading; ?></h1>
<?php foreach ($listings as $listing): ?>
    <h2><?= $listing['title']; ?></h2>
    <p><?= $listing['description']; ?></p>
<?php endforeach; ?> 
-->

<!--MATERI BLADE TEMPLATE LARAVEL - Directive-->
<!--
@php
    $test = 14;
@endphp
{{$test}}
-->

<!--ayo pakai layout yg sudah dibuat-->
@extends('layout')

@section('content')
    <!--
    <h1>{{$heading}}</h1>
    --> 

    <!--MATERI BLADE TEMPLATE LARAVEL - Directive - Create Partials-->
    @include('partials._hero')
    @include('partials._search')

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        <!--bentuk memakai If Directive-->
        <!--  
        @if (count($listings) == 0)
            <p>No listings found.</p>
        @endif

        @foreach ($listings as $listing)
            <h2>{{$listing['title']}}</h2>
            <p>{{$listing['description']}}</p>
        @endforeach
        -->

        <!--bentuk memakai Unless Directive-->
        @unless (count($listings) == 0)    
            @foreach ($listings as $listing)
                <!--path tag <a></a> di Laravel mengacu pada base URL (dari domain awal)-->
                <!--
                <h2> <a href="/home/listing/{{$listing['id']}}">{{$listing['title']}}</a> </h2>
                <p>{{$listing['description']}}</p>
                -->
                <!--MATERI LARAVEL ELOQUENT - Collection-->
                <!--ketika berhubungan dengan database maka pakai Eloquent, lalu di Eloquent ada sesuatu yg bernama Collections-->
                <!--dengan memanfaatkan Collection, memunculkan isi data di Blade bisa seperti berikut (yg ini lebih clean code)-->
                <!--
                <h2> <a href="/home/listing/{{$listing->id}}">{{$listing->title}}</a> </h2>
                <p>{{$listing->description}}</p>
                -->

                <!--Item-->
                <!--di bagian bawah itu kita akan pakai function asset() untuk ambil assets kita seperti image dll-->
                <!--
                <div class="bg-gray-50 border border-gray-200 rounded p-6">
                    <div class="flex">
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
                </div> 
                -->
                <!--sekarang bagian di atas sudah dijadikan component-->

                <!--MATERI BLADE TEMPLATE LARAVEL - Directive - Component-->
                <!--kalo parsing datanya diisi variable, maka di depan (prefix) nama_parameter-nya dikasih tanda colon (:) seperti di bawah-->
                <x-listing-card :listing="$listing"/>
            @endforeach
        @else
            <p>No listings found.</p>
        @endunless
    </div>

    <!--MATERI PENERAPAN LARAVEL UNTUK FITUR PROJECT - Membuat Pagination-->
    <div class="mt-4 p-4">{{$listings->links()}}</div>
@endsection

<!--halaman ini memanfaatkan Component listing-card.blade.php-->