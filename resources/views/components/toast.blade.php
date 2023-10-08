<script>
    function showSuccessToast(event) {
        Swal.fire({
            position: 'top-right',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast'
            },
            icon: 'success',
            title: `<span style="color: white">${event.detail.message || "Opération effectuée avec succès!"}</span>`,
            toast: true,
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        });
    }

    window.addEventListener("showSuccessMessage", showSuccessToast);
    window.addEventListener("showSuccessUpload", showSuccessToast);
    window.addEventListener("showSuccessStatus", showSuccessToast);
    window.addEventListener("showSuccessRight", showSuccessToast);
</script>


<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('refreshForm', function () {
            Livewire.reload();
        });
    });
</script>

<style>
    .colored-toast.swal2-icon-success {
        background-color: #106b25 !important;
        color: #fff !important;
    }

    .colored-toast.swal2-icon-error {
        background-color: #f27474 !important;
    }

    .colored-toast.swal2-icon-warning {
        background-color: #f8bb86 !important;
    }

</style>