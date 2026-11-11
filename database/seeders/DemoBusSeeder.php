<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Route as BusRoute;
use App\Models\Schedule;
use App\Models\Seat;
use App\Models\Terminal;
use Illuminate\Database\Seeder;

class DemoBusSeeder extends Seeder
{
    public function run(): void
    {
        $semarang = Terminal::firstOrCreate(['terminal_name' => 'Terminal Mangkang'], ['city' => 'Semarang', 'address' => 'Semarang, Jawa Tengah']);
        $jogja = Terminal::firstOrCreate(['terminal_name' => 'Terminal Giwangan'], ['city' => 'Yogyakarta', 'address' => 'Yogyakarta']);
        $route = BusRoute::firstOrCreate(
            ['origin_terminal_id' => $semarang->id, 'destination_terminal_id' => $jogja->id],
            ['distance' => 130, 'estimated_duration' => 180]
        );
        $bus = Bus::firstOrCreate(['bus_number' => 'CAN-001'], [
            'bus_name' => 'CAN Executive 01', 'bus_type' => 'Executive', 'capacity' => 20, 'status' => 'active'
        ]);

        for ($i = 1; $i <= 20; $i++) {
            $row = chr(65 + intdiv($i - 1, 4));
            $seatNo = $row . (((($i - 1) % 4) + 1));
            Seat::firstOrCreate(['bus_id' => $bus->id, 'seat_number' => $seatNo], ['seat_type' => 'regular']);
        }

        Schedule::firstOrCreate([
            'bus_id' => $bus->id,
            'route_id' => $route->id,
            'departure_time' => now()->addDays(2)->setTime(8, 0),
        ], [
            'arrival_time' => now()->addDays(2)->setTime(11, 0),
            'price' => 100000,
            'status' => 'available',
        ]);
    }
}
