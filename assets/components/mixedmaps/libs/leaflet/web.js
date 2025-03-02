if(mixedMapsConfig) {

    Object.keys(mixedMapsConfig).forEach(key => {

        let mixedmap = mixedMapsConfig[key]; 

        let mapId = mixedmap.mapId;
        let locations = mixedmap.data;
        let mapCenter = mixedmap.mapCenter;
        let mapParams = mixedmap.params || '';

        if(mapId && mapCenter) {
            let map = L.map(mapId).setView(mapCenter, mapParams.zoom || 13);

            if(mapParams.scrollWheelZoom === false) {
                map.scrollWheelZoom.disable();
            }

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors',
                mapParams
            }).addTo(map);  

            locations.forEach((location) => { 
                L.marker(location.coordinates.split(','))
                    .addTo(map)
                   .bindPopup(`<b>${location.name}</b><br>${location.address}`);
            });
        }
        
    });
}
