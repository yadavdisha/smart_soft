<!DOCTYPE html>
<html>
<head>
  <title>Invoice</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
<style type="text/css">
html,body{
  min-width:100%;
  min-height:100%;
}
  
  .invoice-header,.company-info,.buyer-info{
    text-align: center;
  }
  .seller-info,.general-info,.company-info,.buyer-info > div,.tax-info>div,.invoice-footer{
    border:1px solid;

  }

  .seller-info span{
 margin-left:17%;
  }
  .order-details,.transport-details,.invoice-footer{
    padding:3%;
    
  }


</style>
</head>
<body>

@include('partials.invoice.header')
@include('partials.invoice.billing')
@include('partials.invoice.content')
@include('partials.invoice.footer')

</body>
</html>
