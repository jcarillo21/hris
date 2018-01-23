<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}} | {{$page}}</title>
	<link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css" rel="stylesheet"/>
	<link href="{{ URL::asset('css/root.css') }}" rel="stylesheet" />
	<link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
	<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
</head>
<body>
    <div class="loading"><img src="{{ URL::asset('img/loading.gif') }}" alt="loading-img"></div>
