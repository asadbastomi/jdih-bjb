@extends('layouts.app')

@section('title', $title ?? 'Sebaran Kelurahan Sadar Hukum')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-map-marked-alt me-2"></i>
                        {{ $judul ?? 'Sebaran Kelurahan Sadar Hukum dan POSBANKUM' }}
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Search and Filter -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" id="searchKelurahan" class="form-control" 
                                       placeholder="Cari kelurahan (contoh: Sungai Tiung, Cempaka)..." 
                                       value="{{ $s ?? '' }}"
                                       onkeyup="handleSearchInput(event)">
                            </div>
                            <small class="text-muted mt-1 d-block">Ketik nama kelurahan atau kecamatan untuk mencari</small>
                        </div>
                        <div class="col-md-3">
                            <select id="filterKecamatan" class="form-select" onchange="filterData()">
                                <option value="">Semua Kecamatan</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-primary w-100" onclick="resetFilters()">
                                <i class="fas fa-undo me-2"></i>Reset
                            </button>
                        </div>
                    </div>

                    <!-- Map Container -->
                    <div class="row">
                        <div class="col-12">
                            <div id="map" style="height: 500px; width: 100%; border-radius: 8px; z-index: 1;"></div>
                        </div>
                    </div>

                    <!-- Legend -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body py-2">
                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="d-flex align-items-center">
                                            <span class="badge rounded-circle bg-success me-2" style="width: 15px; height: 15px;"></span>
                                            <small>Sadar Hukum</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge rounded-circle bg-warning me-2" style="width: 15px; height: 15px;"></span>
                                            <small>Binaan</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card border-primary">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-primary">Total Kelurahan</h5>
                                    <h2 class="display-4" id="totalKelurahan">0</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-success">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-success">Sadar Hukum</h5>
                                    <h2 class="display-4" id="totalSadarHukum">0</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-warning">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-warning">Binaan</h5>
                                    <h2 class="display-4" id="totalBinaan">0</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kelurahan List -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5 class="mb-3">Daftar Kelurahan</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kelurahan</th>
                                            <th>Kecamatan</th>
                                            <th>Kota</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="kelurahanList">
                                        <tr>
                                            <td colspan="6" class="text-center">Memuat data...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
let map;
let markers = [];
let allKelurahan = [];

// Initialize map
function initMap() {
    // Default center: Jakarta
    map = L.map('map').setView([-6.2088, 106.8456], 11);

    // Add tile layer (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Load kelurahan data
    loadKelurahanData();
}

// Load kecamatan options
async function loadKecamatanOptions() {
    try {
        const response = await fetch('/api/kecamatan');
        const data = await response.json();
        
        if (data.success && data.data) {
            const select = document.getElementById('filterKecamatan');
            const kecamatans = [...new Set(data.data.map(k => k.nama_kecamatan))].sort();
            
            kecamatans.forEach(kec => {
                const option = document.createElement('option');
                option.value = kec;
                option.textContent = kec;
                select.appendChild(option);
            });
        }
    } catch (error) {
        console.error('Error loading kecamatan options:', error);
    }
}

// Load kelurahan data from API
async function loadKelurahanData() {
    try {
        const search = document.getElementById('searchKelurahan').value;
        const kecamatan = document.getElementById('filterKecamatan').value;

        let url = route('api.kelurahan-sadar-hukum.map');
        const params = new URLSearchParams();
        if (search) params.append('search', search);
        if (kecamatan) params.append('kecamatan', kecamatan);
        if (params.toString()) url += '?' + params.toString();

        const response = await fetch(url);
        const data = await response.json();

        if (data.success) {
            allKelurahan = data.data;
            displayMarkers();
            updateStatistics();
            displayTable();
            
            // Show search result count
            if (search || kecamatan) {
                const notification = document.createElement('div');
                notification.className = 'alert alert-info alert-dismissible fade show';
                notification.style.position = 'fixed';
                notification.style.top = '20px';
                notification.style.right = '20px';
                notification.style.zIndex = '9999';
                notification.innerHTML = `
                    <i class="fas fa-info-circle me-2"></i>
                    Ditemukan ${data.data.length} kelurahan
                    <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
                `;
                document.body.appendChild(notification);
                
                // Auto-remove after 3 seconds
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 3000);
            }
        }
    } catch (error) {
        console.error('Error loading kelurahan data:', error);
        document.getElementById('kelurahanList').innerHTML = 
            '<tr><td colspan="6" class="text-center text-danger">Gagal memuat data</td></tr>';
    }
}

// Display markers on map
function displayMarkers() {
    // Clear existing markers
    markers.forEach(marker => map.removeLayer(marker));
    markers = [];

    // Add new markers
    allKelurahan.forEach(kel => {
        const color = kel.status === 'Sadar Hukum' ? 'green' : 'orange';
        const markerIcon = L.divIcon({
            className: 'custom-marker',
            html: `<div style="background-color: ${color}; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);"></div>`,
            iconSize: [20, 20],
            iconAnchor: [10, 10]
        });

        const marker = L.marker([kel.latitude, kel.longitude], { icon: markerIcon })
            .addTo(map)
            .bindPopup(`
                <div style="min-width: 280px;">
                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 12px; border-radius: 8px 8px 0 0; margin: -12px -12px 12px -12px;">
                        <h5 style="margin: 0; font-weight: 600; font-size: 16px;">${kel.nama_kelurahan}</h5>
                        <p style="margin: 4px 0 0 0; opacity: 0.9; font-size: 13px;">Kec. ${kel.nama_kecamatan}, Kota ${kel.kota || 'Banjarbaru'}</p>
                    </div>
                    <p style="margin: 8px 0;"><strong>Status:</strong> <span class="badge ${kel.status === 'Sadar Hukum' ? 'bg-success' : 'bg-warning'}" style="font-size: 12px;">${kel.status}</span></p>
                    ${kel.sk_walikota_nomor ? `<p style="margin: 8px 0; font-size: 13px;"><strong>SK Walikota:</strong> ${kel.sk_walikota_nomor}</p>` : ''}
                    ${kel.sk_gubernur_nomor ? `<p style="margin: 8px 0; font-size: 13px;"><strong>SK Gubernur:</strong> ${kel.sk_gubernur_nomor}</p>` : ''}
                    <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid #dee2e6;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span style="font-size: 13px;">📅 Agenda: <strong>${kel.agendas ? kel.agendas.length : 0}</strong></span>
                            <span style="font-size: 13px;">📊 Infografis: <strong>${kel.infografis ? kel.infografis.length : 0}</strong></span>
                        </div>
                    </div>
                    <button onclick="viewDetail(${kel.id})" class="btn btn-primary btn-sm mt-2" style="width: 100%;">
                        <i class="fas fa-eye me-1"></i> Lihat Detail
                    </button>
                </div>
            `);

        markers.push(marker);
    });

    // Fit map to show all markers
    if (markers.length > 0) {
        const group = new L.featureGroup(markers);
        map.fitBounds(group.getBounds().pad(0.1));
    }
}

// Update statistics
function updateStatistics() {
    const total = allKelurahan.length;
    const sadarHukum = allKelurahan.filter(k => k.status === 'Sadar Hukum').length;
    const binaan = allKelurahan.filter(k => k.status === 'Binaan').length;

    document.getElementById('totalKelurahan').textContent = total;
    document.getElementById('totalSadarHukum').textContent = sadarHukum;
    document.getElementById('totalBinaan').textContent = binaan;
}

// Display table
function displayTable() {
    const tbody = document.getElementById('kelurahanList');
    
    if (allKelurahan.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" class="text-center">Tidak ada data ditemukan</td></tr>';
        return;
    }

    tbody.innerHTML = allKelurahan.map((kel, index) => `
        <tr>
            <td>${index + 1}</td>
            <td>${kel.nama_kelurahan}</td>
            <td>${kel.nama_kecamatan}</td>
            <td>${kel.kota || '-'}</td>
            <td><span class="badge ${kel.status === 'Sadar Hukum' ? 'bg-success' : 'bg-warning'}">${kel.status}</span></td>
            <td>
                <button onclick="focusOnMarker(${kel.id})" class="btn btn-sm btn-outline-primary me-1" title="Lihat di Peta">
                    <i class="fas fa-map-marker-alt"></i>
                </button>
                <button onclick="viewDetail(${kel.id})" class="btn btn-sm btn-outline-info" title="Lihat Detail">
                    <i class="fas fa-eye"></i>
                </button>
            </td>
        </tr>
    `).join('');
}

// Handle search input with debounce
let searchTimeout;
function handleSearchInput(event) {
    clearTimeout(searchTimeout);
    
    // Trigger search on Enter key
    if (event.key === 'Enter') {
        loadKelurahanData();
        return;
    }
    
    // Auto-search after 500ms of typing
    searchTimeout = setTimeout(() => {
        loadKelurahanData();
    }, 500);
}

// Filter data
function filterData() {
    loadKelurahanData();
}

// Reset filters
function resetFilters() {
    document.getElementById('searchKelurahan').value = '';
    document.getElementById('filterKecamatan').value = '';
    loadKelurahanData();
}

// Focus on marker
function focusOnMarker(id) {
    const kel = allKelurahan.find(k => k.id === id);
    if (kel) {
        map.setView([kel.latitude, kel.longitude], 15);
        const marker = markers.find(m => m.getLatLng().lat === kel.latitude && m.getLatLng().lng === kel.longitude);
        if (marker) {
            marker.openPopup();
        }
    }
}

// View detail
function viewDetail(id) {
    window.location.href = route('kelurahan-sadar-hukum.detail', { id: id });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    initMap();
    loadKecamatanOptions();
});
</script>

<style>
.custom-marker {
    background: transparent;
}
#map {
    border: 2px solid #dee2e6;
}
</style>
@endsection