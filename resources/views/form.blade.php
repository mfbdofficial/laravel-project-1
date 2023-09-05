<!--MATERI CROSS SITE REQUEST FORGERY - CSRF Token-->
<html>
    <head>
        <title>Say Hello</title>
    </head>
    <body>
        <!--bentuk form kalau tidak membawa data CSRF token-->
        <!--
        <form action="/form" method="post">
            <label for="name">
                <input type="text" name="name">
            </label>
            <input type="submit" value="Say Hello">
        </form>
        -->
        <!--bentuk form kalau membawa data CSRF token-->
        <form action="/form" method="post">
            <label for="name">
                <input type="text" name="name">
            </label>
            <input type="submit" value="Say Hello">
            <input type="hidden" name="_token" value={{csrf_token()}}>
        </form>
    </body>
</html>