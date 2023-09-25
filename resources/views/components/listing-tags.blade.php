<!--MATERI BLADE TEMPLATE LARAVEL - Directive - Component - Component Digabungkan Dengan Component Lain-->
@props(['tagsCsv'])

@php
    /*
    $tags = explode(',', $tagsCsv); //tadinya begini, dia malah membawa data space di array-nya karena kan bentuk awalnya "xxx, xxx, xxx", kecuali kalo "xxx,xxx,xxx" baru bagus
    */
    $tags = explode(', ', $tagsCsv); //jadi pakai ini, bentuk "xxx, xxx, xxx" kita pisah berdasarkan tanda koma + space
@endphp

<ul class="flex">
    <!--
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
    -->
    @foreach ($tags as $tag)
        <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
            <a href="/home/?tag={{$tag}}">{{$tag}}</a>
        </li>
    @endforeach
</ul>