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

        const customIcon = L.icon({
            iconUrl: '/assets/components/mixedmaps/images/mgr/marker-icon.png',
            shadowUrl: '/assets/components/mixedmaps/images/mgr/marker-shadow.png',

            iconSize: [40, 40], // size of the icon
            shadowSize: [41, 41], // size of the shadow
            iconAnchor: [20, 30], // point of the icon which will correspond to marker's location
            shadowAnchor: [13, 30],  // the same for the shadow
            popupAnchor:  [1, -33]
        });


        let markersGroup = L.layerGroup();
        map.addLayer(markersGroup);

        if (params.current) {
            L.marker(center, { icon: customIcon }).addTo(markersGroup);
        }

        map.on('click', function (e) {
            markersGroup.clearLayers();

            L.marker(e.latlng, { icon: customIcon }).addTo(markersGroup);
            setTvValue(params.tv, e.latlng.lat + ',' + e.latlng.lng);
        });

 
        // Autocomplete
        new Autocomplete(mapId + "-search", {
            delay: 1000,
            selectFirst: true,
            howManyCharacters: 2,

            onSearch: function ({ currentValue }) {
                const api = `https://nominatim.openstreetmap.org/search?format=geojson&limit=5&q=${encodeURI(
                    currentValue
                )}`;

                /**
                 * Promise
                 */
                return new Promise((resolve) => {
                    fetch(api)
                        .then((response) => response.json())
                        .then((data) => {
                            resolve(data.features);
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                });
            },
            // nominatim
            onResults: ({ currentValue, matches, template }) => {
                const regex = new RegExp(currentValue, "i");
                // checking if we have results if we don't
                // take data from the noResults method
                return matches === 0
                    ? template
                    : matches
                        .map((element) => {
                            return `
                <li class="loupe" role="option">
                    ${element.properties.display_name.replace(
                                regex,
                                (str) => `<b>${str}</b>`
                            )}
                </li> `;
                        })
                        .join("");
            },

            onSubmit: ({ object }) => {
                const { display_name } = object.properties;
                const cord = object.geometry.coordinates;
                // custom id for marker
                const customId = Math.random();

                const marker = L.marker([cord[1], cord[0]], {
                    title: display_name,
                    id: customId,
                    icon: customIcon
                });

                markersGroup.clearLayers();
                marker.addTo(markersGroup).bindPopup(display_name);
                map.setView([cord[1], cord[0]], 13);
                setTvValue(params.tv, cord[1] + ',' + cord[0]);

                map.eachLayer(function (layer) {
                    if (layer.options && layer.options.pane === "markerPane") {
                        if (layer.options.id !== customId) {
                            map.removeLayer(layer);
                        }
                    }
                });
            },

            onSelectedItem: ({ index, element, object }) => {
                //console.log("onSelectedItem:", index, element, object);
            },

            noResults: ({ currentValue, template }) =>
                template(`<li>No results found: "${currentValue}"</li>`),
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
    if (maps.length > 0) {
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