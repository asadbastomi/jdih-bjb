<script>
    function incrementDownload(id, kategori) {
        if (typeof $ !== 'undefined') {
            $.ajax({
                type: 'POST',
                url: '{{ route('client-download') }}',
                data: {
                    id: id,
                    kategori: kategori,
                    _token: '{{ csrf_token() }}'
                }
            });
        }
    }
</script>
