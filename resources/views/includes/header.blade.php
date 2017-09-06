<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}} | {{$page}}</title>

    <!-- ========== Css Files ========== -->
    <link href="{{ URL::asset('css/root.css') }}" rel="stylesheet" />

</head>

<body class="<?php echo isset($class) ? $class : "default"; ?>" > 
    <!-- Start Page Loading -->
    <div class="loading"><img src="{{ URL::asset('img/loading.gif') }}" alt="loading-img"></div>
    <!-- End Page Loading -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->