<?php
	header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
	header("Pragma: no-cache"); // HTTP 1.0.
	header("Expires: 0"); // Proxies.
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}} | {{$page}}</title>

    <!-- ========== Css Files ========== -->
	<link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css" rel="stylesheet"/>
	<link href="{{ URL::asset('css/root.css') }}" rel="stylesheet" />
	
	<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
</head>

<body>
    <!-- Start Page Loading -->
    <div class="loading"><img src="{{ URL::asset('img/loading.gif') }}" alt="loading-img"></div>
    <!-- End Page Loading -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->