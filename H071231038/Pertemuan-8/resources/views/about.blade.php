@extends('layouts.master')

@section('title', 'About Us')

@section('content')

{{-- Komponen Notifikasi --}}
<x-notification 
    title="Tentang Kami"
    message=""
    type="success " 
/>

<section id="about" class="text-center py-5">
    <div class="container">
        <h2>About Us</h2>
        <p>Kami menyediakan layanan ahli Sedot WC untuk properti residensial dan komersial. Tim kami dilengkapi dengan peralatan modern untuk menangani semua jenis masalah septic tank.</p>
    </div>
</section>

<section id="features" class="features text-center py-5">
    <div class="container">
        <h2>Our Services</h2>
        <div class="row">
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card">
                    <img src="{{ asset('images/st.jpg') }}" alt="Septic Tank Cleaning">
                    <div class="card-body">
                      <h5 class="card-title text-center">Septic Tank Cleaning</h5>
                      <p class="card-text text-center">Kami menawarkan layanan pembersihan menyeluruh untuk memastikan septic tank Anda berfungsi dengan baik.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card">
                    <img src="{{ asset('images/dr.jpg') }}" alt="Drainage Solutions">
                    <div class="card-body">
                      <h5 class="card-title text-center">Drainage Solutions</h5>
                      <p class="card-text text-center">Solusi efektif untuk pembuangan yang tersumbat atau lambat mengalir.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card">
                    <img src="{{ asset('images/24.jpg') }}" alt="Emergency Services">
                    <div class="card-body">
                      <h5 class="card-title text-center">Emergency Services</h5>
                      <p class="card-text text-center">Kami bersedia 24/7 untuk keadaan darurat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


