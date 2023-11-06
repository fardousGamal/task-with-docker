<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-commerce | new order</title>
  
</head>

<body>
    <h1>hello {{ $vendor->name}} </h1>
    <h3> You own a product that has quantity less than 5 </h3>
    <h3> product name: #{{ $product->name}} </h3>
    <h3> product quantity: {{ $product->quantity}} </h3>
   </body>

</html>