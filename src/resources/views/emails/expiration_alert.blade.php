<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-commerce | new order</title>
  
</head>

<body>
    <h1>hello {{ $vendor->name}} </h1>
    <h3> You own a product that is about to expire </h3>
    <h3> product name: #{{ $product->name}} </h3>
    <h3> product expiration date: {{ $product->expiration_date}} </h3>
   </body>

</html>