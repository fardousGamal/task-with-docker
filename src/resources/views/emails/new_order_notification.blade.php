<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-commerce | new order</title>
  
</head>

<body>
    <h1>hello {{ $vendor->name}} </h1>
    <h3> you have new order </h3>
    <h3> order id: #{{ $order->id}} </h3>
    <h3> totla price: {{ $order->total_price}} </h3>
   </body>

</html>