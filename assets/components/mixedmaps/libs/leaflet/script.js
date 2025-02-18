Ext.onReady(function () {

    function initializeMap(mapId, center, zoom, tv) {
        const map = L.map(mapId).setView(center, zoom);

        // Add a tile layer (e.g., OpenStreetMap tiles)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        let markersGroup = L.layerGroup();
        map.addLayer(markersGroup);

        map.on('click', function(e){
            markersGroup.clearLayers();

            L.marker(e.latlng).addTo(markersGroup);
            setTvValue(tv, e.latlng.lat + ',' + e.latlng.lng);
        });

        return map;
    }

    function setTvValue(tv, value) {
        document.getElementById(tv).value = value;
    }


    const maps = document.querySelectorAll('.mixedmaps__map__inner');
    if(maps) {
        maps.forEach(map => {
            const mapId = map.id;
            const center = map.dataset.mixedmapsCenter.split(',').map(Number);
            const zoom = map.dataset.mixedmapsZoom;
            const tv = map.dataset.mixedmapsTv;
            initializeMap(mapId, center, zoom, tv);
        });
    }

});