<!-- resources/views/contact.blade.php -->
@extends('layouts.master')

@section('title', 'Contact Us')
@section('message', 'Silakan hubungi kami melalui form di bawah ini untuk pertanyaan lebih lanjut.')

@section('content')
<x-notification 
    title="Perhatian!"
    message="Halaman ini sedang dalam pengembangan. Beberapa fitur mungkin belum tersedia."
    type="warning" 
/>

<section id="contact" class="text-center py-5">
    <div class="container">
        <form class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email">
            </div>
            <div class="col-12">
                <label for="message" class="form-label">Pesan</label>
                <textarea class="form-control" id="message" rows="4"></textarea>
            </div>
            <div class="col-12">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</section>
@endsection

