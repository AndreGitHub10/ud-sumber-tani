<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcode</title>
</head>
<body>
    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($barcode, 'C39E', 2, 70, array(0,0,0), true)}}" alt="barcode" />
    <script>
        window.print()
    </script>
</body>
</html>