<img src="https://maps.googleapis.com/maps/api/staticmap?zoom={{ config('pilot.googlemaps.zoom') }}&size=400x100&maptype=roadmap&@foreach($data->getCoordinates() as $point)markers=color:red%7C{{ $point['lat'] }},{{ $point['lng'] }}&center={{ $point['lat'] }},{{ $point['lng'] }}@endforeach&key={{ config('pilot.googlemaps.key') }}"/>