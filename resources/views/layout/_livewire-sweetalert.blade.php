<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('notification', ({ message, type, refresh }) => {
            Swal.fire({
                icon: type === 'success' ? 'success' : (type === 'error' ? 'error' : 'info'),
                title: message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: refresh ? 1500 : 3000,
                timerProgressBar: true,
            }).then(() => {
                if (refresh) {
                    window.location.reload();
                }
            });
        });
    });
</script>
