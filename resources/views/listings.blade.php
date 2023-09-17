<!--ini kalo pake syntax PHP biasa-->
<!-- <h1><?= $heading; ?></h1>
<?php foreach ($listings as $listing): ?>
    <h2><?= $listing['title']; ?></h2>
    <p><?= $listing['description']; ?></p>
<?php endforeach; ?> -->

<!--MATERI BLADE TEMPLATE LARAVEL - Directive-->
@php
    $test = 14;
@endphp
{{$test}}

<h1>{{$heading}}</h1>

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
        <h2> <a href="home/listing/{{$listing['id']}}">{{$listing['title']}}</a> </h2>
        <p>{{$listing['description']}}</p>
    @endforeach
@else
    <p>No listings found.</p>
@endunless