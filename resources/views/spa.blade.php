<!DOCTYPE html>
    <?php
        $packageStr = file_get_contents('../package.json');
        $package = (array)json_decode($packageStr);
        $version = $package["version"];
        $filePath = "js/$version/app.js";
    ?>
<html>
    <head>
        <meta charset="utf-8">
        <title>購物網站</title>
    </head>
    <body>
        <div id="app">
            <app></app>
        </div>
        <script>window.version="{{ $version }}"</script>
        <script src="{{ asset($filePath) }}"></script>
    </body>
</html>