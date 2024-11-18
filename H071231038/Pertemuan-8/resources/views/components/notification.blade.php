{{-- resources/views/components/notification.blade.php --}}
<div class="alert alert-{{ $type ?? 'info' }} alert-dismissible fade show" role="alert">
    <strong>{{ $title ?? 'Notification' }}</strong> {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
