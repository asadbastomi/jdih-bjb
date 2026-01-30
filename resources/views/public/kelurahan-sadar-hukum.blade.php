<?php
setlocale(LC_TIME, 'id_ID');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ $title ?? 'Sebaran Kelurahan Sadar Hukum' }} - JDIH Kota Banjarbaru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sebaran Kelurahan Sadar Hukum dan POSBANKUM di Kota Banjarbaru" name="description" />
    <meta content="Kota Banjarbaru" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />

    <!--Material Icon -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Custom  Css -->
    <link href="{{ asset('assets/css/landing_copy.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/headline.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
</head>

<body>
    @include('public.header')

    <!-- Page Header -->
    <section class="hero-slider animate-on-scroll fade-in-up" style="height: 40vh; min-height: 300px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <div class="text-center text-white">
                <h1 class="display-4 font-weight-bold mb-3">
                    <i class="fas fa-map-marked-alt me-3"></i>
                    {{ $judul ?? 'Sebaran Kelurahan Sadar Hukum' }}
                </h1>
                <p class="lead mb-0">
                    Peta interaktif sebaran Kelurahan Sadar Hukum dan POSBANKUM di Kota Banjarbaru
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-card">
                        <!-- Search and Filter -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label font-weight-bold">Cari Kelurahan</label>
                                    <input type="text" id="searchKelurahan" class="form-control" 
                                           placeholder="Ketik nama kelurahan..." 
                                           value="{{ $s ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label font-weight-bold">Filter Kecamatan</label>
                                    <select id="filterKecamatan" class="form-control">
                                        <option value="">Semua Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label font-weight-bold">Filter Status</label>
                                    <select id="filterStatus" class="form-control">
                                        <option value="">Semua Status</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Map Container -->
                        <div id="map" style="height: 500px; width: 100%; border-radius: 10px; margin-bottom: 15px;"></div>
                        
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p class="text-muted small mb-0">
                                    <i class="mdi mdi-information-outline"></i> Klik pada marker untuk melihat detail kelurahan sadar hukum
                                </p>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="text-primary">
                                    <i class="mdi mdi-counter"></i> Total: <span id="totalKelurahan">0</span> | 
                                    <i class="mdi mdi-check-circle"></i> Aktif: <span id="aktifKelurahan">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('public.footer')

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- javascript -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/pact.js') }}"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize map centered on Banjarbaru
        var map = L.map('map').setView([-3.4333, 114.8167], 12);
        
        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Store all markers for filtering
        var allMarkers = [];
        var allKelurahanData = [];
        
        // Custom icon for kelurahan markers
        function getKelurahanIcon(status) {
            var color = status ? '#10b981' : '#ef4444'; // Green for active, Red for inactive
            return L.divIcon({
                className: 'custom-div-icon',
                html: "<div style='background-color: " + color + "; width: 30px; height: 30px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;'><i style='color: white; font-size: 16px;' class='mdi mdi-home'></i></div>",
                iconSize: [30, 30],
                iconAnchor: [15, 15],
                popupAnchor: [0, -15]
            });
        }
        
        // Create popup content
        function createPopupContent(kelurahan) {
            var statusColor = kelurahan.is_active ? '#10b981' : '#ef4444';
            var statusText = kelurahan.is_active ? 'Aktif' : 'Tidak Aktif';
            
            return `
                <div style="min-width: 200px;">
                    <h6 style="margin: 0 0 10px 0; color: #6366f1; font-weight: 700;">${kelurahan.nama_kelurahan || 'N/A'}</h6>
                    <div style="margin-bottom: 8px;">
                        <strong>Kecamatan:</strong> ${kelurahan.nama_kecamatan || '-'}
                    </div>
                    <div style="margin-bottom: 8px;">
                        <strong>Status Sadar Hukum:</strong> 
                        <span style="color: ${statusColor}; font-weight: 600;">
                            ${statusText}
                        </span>
                    </div>
                    ${kelurahan.pos_bankum ? `
                    <div style="margin-bottom: 8px;">
                        <strong>POS BANTUAN HUKUM:</strong><br>
                        ${kelurahan.pos_bankum}
                    </div>
                    ` : ''}
                    ${kelurahan.jumlah_pos ? `
                    <div style="margin-bottom: 8px;">
                        <strong>Jumlah POS:</strong> ${kelurahan.jumlah_pos}
                    </div>
                    ` : ''}
                    ${kelurahan.keterangan ? `
                    <div style="margin-bottom: 8px;">
                        <strong>Keterangan:</strong><br>
                        <small>${kelurahan.keterangan}</small>
                    </div>
                    ` : ''}
                    <div style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #e5e7eb;">
                        <a href="/kelurahan-sadar-hukum/${kelurahan.id}" target="_blank" style="color: #6366f1; text-decoration: none; font-weight: 600;">
                            Lihat Detail <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            `;
        }
        
        // Add marker to map and track it
        function addMarker(kelurahan) {
            if (kelurahan.latitude && kelurahan.longitude) {
                var marker = L.marker([kelurahan.latitude, kelurahan.longitude], {
                    icon: getKelurahanIcon(kelurahan.is_active)
                }).addTo(map);
                
                marker.bindPopup(createPopupContent(kelurahan));
                
                // Store marker and data for filtering
                allMarkers.push({
                    marker: marker,
                    data: kelurahan
                });
                
                return marker;
            }
            return null;
        }
        
        // Load kelurahan data from API
        $.ajax({
            url: '/api/kelurahan-sadar-hukum',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log('Kelurahan data loaded:', response);
                
                // Clear existing markers
                allMarkers.forEach(function(item) {
                    map.removeLayer(item.marker);
                });
                allMarkers = [];
                allKelurahanData = [];
                
                // Populate kecamatan filter
                var kecamatans = new Set();
                
                if (response && response.data && response.data.length > 0) {
                    allKelurahanData = response.data;
                    
                    // Add markers and collect kecamatans
                    response.data.forEach(function(kelurahan) {
                        addMarker(kelurahan);
                        if (kelurahan.nama_kecamatan) {
                            kecamatans.add(kelurahan.nama_kecamatan);
                        }
                    });
                    
                    // Update kecamatan filter options
                    var selectKecamatan = $('#filterKecamatan');
                    selectKecamatan.find('option:not(:first)').remove();
                    kecamatans.forEach(function(kecamatan) {
                        selectKecamatan.append('<option value="' + kecamatan + '">' + kecamatan + '</option>');
                    });
                    
                    // Update stats
                    var total = response.data.length;
                    var aktif = response.data.filter(function(k) { return k.is_active; }).length;
                    $('#totalKelurahan').text(total);
                    $('#aktifKelurahan').text(aktif);
                    
                    // Fit bounds to show all markers
                    if (allMarkers.length > 0) {
                        var group = new L.featureGroup(allMarkers.map(function(item) { return item.marker; }));
                        map.fitBounds(group.getBounds(), { padding: [50, 50] });
                    }
                } else {
                    console.log('No kelurahan data found');
                    $('#totalKelurahan').text('0');
                    $('#aktifKelurahan').text('0');
                    
                    // Show message if no kelurahan data
                    L.marker([-3.4333, 114.8167])
                        .addTo(map)
                        .bindPopup('Belum ada data Kelurahan Sadar Hukum')
                        .openPopup();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading kelurahan data:', error);
                console.error('Status:', status);
                console.error('XHR:', xhr);
                console.error('Response:', xhr.responseText);
                
                $('#totalKelurahan').text('0');
                $('#aktifKelurahan').text('0');
                
                L.marker([-3.4333, 114.8167])
                    .addTo(map)
                    .bindPopup('Gagal memuat data Kelurahan Sadar Hukum')
                    .openPopup();
            }
        });
        
        // Filter function
        function filterMarkers() {
            var searchValue = $('#searchKelurahan').val().toLowerCase();
            var kecamatanValue = $('#filterKecamatan').val();
            var statusValue = $('#filterStatus').val();
            
            var visibleCount = 0;
            var aktifCount = 0;
            var visibleMarkers = [];
            
            allMarkers.forEach(function(item) {
                var kelurahan = item.data;
                var visible = true;
                
                // Filter by search (kelurahan name)
                if (searchValue && kelurahan.nama_kelurahan) {
                    if (kelurahan.nama_kelurahan.toLowerCase().indexOf(searchValue) === -1) {
                        visible = false;
                    }
                }
                
                // Filter by kecamatan
                if (kecamatanValue && kelurahan.nama_kecamatan !== kecamatanValue) {
                    visible = false;
                }
                
                // Filter by status
                if (statusValue !== '') {
                    var isAktif = kelurahan.is_active ? 1 : 0;
                    if (parseInt(statusValue) !== isAktif) {
                        visible = false;
                    }
                }
                
                // Show/hide marker
                if (visible) {
                    if (!map.hasLayer(item.marker)) {
                        item.marker.addTo(map);
                    }
                    visibleCount++;
                    if (kelurahan.is_active) {
                        aktifCount++;
                    }
                    visibleMarkers.push(item.marker);
                } else {
                    if (map.hasLayer(item.marker)) {
                        map.removeLayer(item.marker);
                    }
                }
            });
            
            // Update stats
            $('#totalKelurahan').text(visibleCount);
            $('#aktifKelurahan').text(aktifCount);
            
            // Fit bounds if there are visible markers
            if (visibleMarkers.length > 0) {
                var group = new L.featureGroup(visibleMarkers);
                map.fitBounds(group.getBounds(), { padding: [50, 50] });
            }
            
            // Show search result notification
            if (searchValue || kecamatanValue || statusValue) {
                var notification = $('<div>', {
                    'class': 'alert alert-info alert-dismissible fade show',
                    'css': {
                        'position': 'fixed',
                        'top': '20px',
                        'right': '20px',
                        'z-index': '9999'
                    },
                    'html': '<i class="mdi mdi-information mr-2"></i> Ditemukan ' + visibleCount + ' kelurahan<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
                });
                $('body').append(notification);
                
                setTimeout(function() {
                    if (notification.parent().length) {
                        notification.remove();
                    }
                }, 3000);
            }
        }
        
        // Debounce search
        var searchTimeout;
        $('#searchKelurahan').on('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(filterMarkers, 500);
        });
        
        // Bind filter events
        $('#filterKecamatan').on('change', filterMarkers);
        $('#filterStatus').on('change', filterMarkers);
    });
    </script>
</body>

</html>