Ext.onReady(function () {

    /**
     * Initializes a Leaflet map with the given id and parameters.
     * @param {string} mapId - The id of the map element.
     * @param {object} params - An object with the following properties:
     *  - center: A string of the form "lat,lng" of the center of the map.
     *  - zoom: The zoom level of the map.
     *  - tv: The id of the MODx TV element to update when the user clicks on the map.
     *  - current: If true, a marker will be added at the center of the map.
     * @return {L.Map} The Leaflet map object.
     */
    function initializeMap(mapId, params) {
        const center = (params.center).split(',') || [55.75100886267972, 37.61757471804167];
        const map = L.map(mapId).setView(center, params.zoom);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        let markersGroup = L.layerGroup();
        map.addLayer(markersGroup);

        if(params.current) {
            L.marker(center).addTo(markersGroup);
        }

        map.on('click', function(e){
            markersGroup.clearLayers();

            L.marker(e.latlng).addTo(markersGroup);
            setTvValue(params.tv, e.latlng.lat + ',' + e.latlng.lng);
        });

        return map;
    }


    /**
     * Sets the value of a MODx TV input element.
     * @param {string} tv - The id of the TV input element.
     * @param {string} value - The value to set for the TV input element.
     */

    function setTvValue(tv, value) {
        document.getElementById(tv).value = value;
    }


    const maps = document.querySelectorAll('.mixedmaps__map__inner');
    if(maps) {
        maps.forEach(map => {
            const mapId = map.id; 
            const params = {
                center: map.dataset.mixedmapsCenter,
                zoom: map.dataset.mixedmapsZoom,
                tv: map.dataset.mixedmapsTv,
                current: map.dataset.mixedmapsCurrent || false
            };
            initializeMap(mapId, params);
        });
    }

});