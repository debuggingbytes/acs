@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Whoops, something went wrong on our servers. The error has been reported to the website administrator. Please try again later.'))
