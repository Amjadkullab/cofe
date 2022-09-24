@extends('admin.layouts.master')
@section('content')
    <section class="checkout-wrapper section">
        <div class="container">
            <div id="map" style="height: 50vh"></div>
        </div>
    </section>
    <script>
        // Initialize and add the map
        function initMap(): void {
            // The location of Uluru
            const location = {
                lat: {{$delivery->lat}},
                lng: {{$delivery->lng}},
            };
            // The map, centered at Uluru
            const map = new google.maps.Map(
                document.getElementById("map") as HTMLElement, {
                    zoom: 15,
                    center: location,
                }
            );

            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: location,
                map: map,
            });
        }

        declare global {
            interface Window {
                initMap: () => void;
            }
        }
        window.initMap = initMap;
    </script>

<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQeLJHCwtgjjcuQ1Qd9so02rOfEp6zwQU&callback=initMap&v=weekly"
defer></script>
@endsection
