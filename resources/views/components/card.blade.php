<!--MATERI BLADE TEMPLATE LARAVEL - Directive - Component - Component Digabungkan Dengan Component Lain-->
<!--
<div class="bg-gray-50 border border-gray-200 rounded p-6">
-->
<!--kalo seperti di atas, attribute class-nya tidak bisa di-merge (gabungkan) dengan attribute class pada tag Component-->
<!--pakailah bentuk di bawah, jadi nanti tag Component (saat memakai Component ini), bisa menambahkan class lagi menjadi di-merge (attribute lain selain class sebenarnya juga bisa)-->
<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6'])}}> <!--untuk attribute lain tinggal tambahkan saja isi array-nya-->
    <!--jadi saat penggunaan Component itu bisa ada tag penutupnya, bukan hanya tag depan-->
    <!--nah semua yg dibungkus oleh tag Component saat kita pakai, akan masuk ke area slot ini-->
    {{$slot}} 
</div>