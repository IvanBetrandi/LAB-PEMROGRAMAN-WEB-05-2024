@extends('layouts.master')

@section('title', 'Home')

@section('content')
<x-notification :type="'success'" :title="'Welcome!'" :message="'Thank you for visiting our website! We offer professional septic tank services.'" />
<section id="home" class="hero text-center">
    <div class="container">
        <h1>Jasa Sedot WC Profesional</h1>
        <h3>Fast, Reliable, and Affordable Solutions for Your Septic Tank Needs</h3>
    </div>
</section>

<!-- Add Notification Component -->

@endsection

