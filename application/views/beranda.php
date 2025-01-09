<div class="content-padder content-background">
    <div class="uk-section-small uk-section-default header">
        <div class="uk-container uk-container-large">
            <h2><span class="ion-speedometer"></span> Beranda</h2>
            <p>
                Selamat Datang, <?=$this->session->userdata('nama')?>, <?=$judul?>
            </p>
        </div>
    </div>
    <div class="uk-section-small">
        <div class="uk-container uk-container-large">
            <!-- Tambahkan style untuk elemen map -->
            <div id="mapid" style="height: 500px; width: 100%;"></div>
        </div>
    </div>
</div>

<!-- Pastikan Anda memuat Leaflet CSS dan JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script type="text/javascript">
    var data = <?php 
        // Encode data ke JSON agar lebih aman untuk parsing di JavaScript
        echo json_encode(array_map(function($r) {
            return [
                "lokasi" => [floatval($r->latitudeRs), floatval($r->longitudeRs)],
                "kecamatan" => $r->kecamatanRs,
                "nama" => $r->namaRs,
                "tempat" => $r->lokasiRs,
                "kategori" => $r->kategoriRs
            ];
        }, !empty($rs) ? $rs : []));
    ?>;

    // Inisialisasi peta
    var map = L.map('mapid').setView([5.179722, 97.141495], 10);
    

    // Tambahkan layer peta
    L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
        attribution: 'Map data &copy; <a href="http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}">OpenStreetMap</a> contributors'
    }).addTo(map);

    var markersLayer = L.layerGroup().addTo(map);

    // Definisikan ikon
    var iconMapping = {
        "Swasta": L.icon({
            iconUrl: '<?=base_url('public/icon/rs1.png')?>',
            iconSize: [25, 25]
        }),
        "Negeri": L.icon({
            iconUrl: '<?=base_url('public/icon/rs1.png')?>',
            iconSize: [25, 25]
        })
        // Tambahkan ikon lainnya jika diperlukan
    };

    var defaultIcon = L.icon({
        iconUrl: '<?=base_url('public/icon/default.png')?>', // Default icon jika kategori tidak dikenali
        iconSize: [30, 30]
    });

    // Tambahkan marker ke peta
    data.forEach(function (item) {
        var icon = iconMapping[item.kategori] || defaultIcon;

        // Tambahkan marker ke layer
        var marker = L.marker(L.latLng(item.lokasi), { icon: icon });
        marker.bindPopup(
            '<b>Kecamatan:</b> ' + item.kecamatan + '<br>' +
            '<b>Lokasi:</b> ' + item.tempat + '<br>' +
            '<b>Nama:</b> ' + item.nama
        );
        markersLayer.addLayer(marker);
    });
</script>
