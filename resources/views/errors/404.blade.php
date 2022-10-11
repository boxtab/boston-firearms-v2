@extends('layout.errors')

@section('title', __('Not Found'))
@section('code', '404')
@section('page_wrapper_class', 'page-error page-privacy-policy page-flat')
@section('message', $text?? __('Page Not Found'))
