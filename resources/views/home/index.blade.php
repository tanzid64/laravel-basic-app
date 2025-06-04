@extends('home.base')

@section('home')

  @include('home.layout.hero')
  @include('home.layout.features')
  @include('home.layout.clarifies')
  @include('home.layout.financial')
  @include('home.layout.usability')
  @include('home.layout.testimonial')
  @include('home.layout.faq')
  @include('home.layout.start-new')

@endsection
