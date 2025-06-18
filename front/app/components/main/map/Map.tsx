import { useEffect } from "react";
import maplibregl from "maplibre-gl";
import polyline from "@mapbox/polyline";
import type { Coord } from "~/routes/profilSection/trajet/TrajetDetail/TrajetDetail";

type MapProps = {
  coord: Coord[];
};

export default function Map({ coord }: MapProps) {
  useEffect(() => {
    const map = new maplibregl.Map({
      container: "map",
      style: "https://basemaps.cartocdn.com/gl/positron-gl-style/style.json",
      center: [coord[0][0] ?? 2.3522, coord[0][1] ?? 48.8566],
      zoom: 12,
    });

    const isCoordSubmitted = coord.every((dep_dest) =>
      dep_dest.every((lat_lon) => lat_lon !== null)
    );
    console.log("Coordonnée rentrées:", isCoordSubmitted);

    if (isCoordSubmitted) {
      console.log("Envoi du fetch pour OpenRoute");

      fetch("https://api.openrouteservice.org/v2/directions/driving-car", {
        method: "POST",
        headers: {
          Authorization:
            "5b3ce3597851110001cf624861137ff568144cc79601aac3167bf858",
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ coordinates: coord }),
      })
        .then((res) => {
          console.log(res);
          return res.json();
        })
        .then((data) => {
          console.log(data);
          const polylineStr = data.routes[0].geometry;
          const coords = polyline
            .decode(polylineStr)
            .map(([lat, lng]) => [lng, lat]);

          map.on("load", () => {
            map.addSource("route", {
              type: "geojson",
              data: {
                type: "Feature",
                geometry: {
                  type: "LineString",
                  coordinates: coords,
                },
                properties: {},
              },
            });

            map.addLayer({
              id: "route",
              type: "line",
              source: "route",
              layout: { "line-cap": "round" },
              paint: { "line-color": "#3887be", "line-width": 5 },
            });
          });
        })
        .catch((err) => console.error("Fetch error:", err));
    }

    return () => map.remove();
  }, [coord]);

  return <div id="map" style={{ width: "70%", height: "40vh" }}></div>;
}
