<!DOCTYPE html>
<html>
    <head>
        <title>GIS RUMAH SAKIT DI KOTA LHOKSEUMAWE</title>

        <meta charset="UTF-8">
        <meta name="description" content="Clean and responsive administration panel">
        <meta name="keywords" content="Admin,Panel,HTML,CSS,XML,JavaScript">
        <meta name="author" content="Erik Campobadal">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?= base_url('public/images/logo.png') ?>">

        <link rel="stylesheet" href="<?= base_url('public/css/uikit.min.css') ?>" />
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="<?= base_url('public/css/style.css') ?>" />
        <link rel="stylesheet" href="<?= base_url('public/css/notyf.min.css') ?>" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('public/js/uikit.min.js') ?>"></script>
        <script src="<?= base_url('public/js/uikit-icons.min.js') ?>"></script>

        <!-- Leaflet -->
        <link rel="stylesheet" href="<?= base_url('public/leaflet/leaflet.css') ?>" />
        <script src="<?= base_url('public/leaflet/leaflet.js') ?>"></script>

        <!-- Leaflet Search -->
        <link rel="stylesheet" href="<?= base_url('public/leaflet-cari/src/leaflet-search.css') ?>" />
        <script src="<?= base_url('public/leaflet-cari/src/leaflet-search.js') ?>"></script>

        <style>
            #mapid {
                height: 700px;
            }
                .uk-navbar-container {
                background-color: #800080; /* Warna ungu terang */
            }
            
        </style>
    </head>
    <body>
        <div class="uk-navbar-container tm-navbar-container uk-active">
            <div class="uk-container uk-container-expand">
                <nav uk-navbar>
                    <div class="uk-navbar-left">
                        <a href="#" class="uk-navbar-item uk-logo">
                            <img width="40" src="<?= base_url('public/images/hospital.png') ?>" /> 
                            &nbsp; TITIK RUMAH SAKIT DI KOTA LHOKSEUMAWE
                        </a>
                    </div>
                    <div class="uk-navbar-right">
                        <div class="uk-navbar-item">
                            <a class="uk-button uk-button-default" href="#modal-center" uk-toggle>HOME</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="uk-container uk-container-large">
            <article class="uk-comment uk-comment-warning">
                <div id="mapid"></div>
            </article>

            <script type="text/javascript">
                // Data rs
                var data = [
                    <?php foreach ($rs as $r): ?>
                    {
                        lokasi: [<?= $r->latitudeRs ?>, <?= $r->longitudeRs ?>],
                        kecamatan: "<?= $r->kecamatanRs ?>",
                        nama: "<?= $r->namaRs ?>",
                        tempat: "<?= $r->lokasiRs ?>",
                        kategori: "<?= $r->kategoriRs ?>"
                    },
                    <?php endforeach; ?>
                ];

                // Inisialisasi peta
                var map = L.map('mapid').setView([5.179722, 97.141495], 10);

                // Tile layer
                L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
                attribution: 'Map data &copy; <a href="http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}">OpenStreetMap</a> contributors'
                }).addTo(map);
                // Layer untuk marker
                var markersLayer = new L.LayerGroup().addTo(map);

                // Kontrol pencarian
                var controlSearch = new L.Control.Search({
                    position: 'topleft',
                    layer: markersLayer,
                    initial: false,
                    zoom: 15,
                    marker: false
                }).addTo(map);

                // Ikon Rumah Sakit
                var icons = {
                    hospital: L.icon({ iconUrl: '<?= base_url('public/icon/rs.webp') ?>', iconSize: [30, 30] }),
                    };

                // Tambahkan marker ke peta
                data.forEach(function(item) {
                    var icon = icons[item.kategori] || L.icon({ iconUrl: '<?= base_url('public/icon/default.png') ?>', iconSize: [30, 30] });
                    var marker = L.marker(item.lokasi, { icon: icon, title: item.kecamatan })
                        .bindPopup(`<b>Kecamatan:</b> ${item.kecamatan}<br><b>Lokasi:</b> ${item.tempat}<br><b>Nama:</b> ${item.nama}`);
                    markersLayer.addLayer(marker);
                });
            </script>
        </div>
    </body>
</html>
