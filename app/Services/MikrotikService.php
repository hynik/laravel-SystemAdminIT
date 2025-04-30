<?php

namespace App\Services;
use App\Models\Router;
use RouterOS\Client;
use RouterOS\Query;

class MikrotikService
{
    public function connect($router)
    {
        $client = new Client([
            'host' => $router->ip_address,
            'user' => $router->username,
            'pass' => $router->password,
            'port' => $router->port,
            'timeout' => 5,
        ]);

        return $client;
    }

    public function getInterfaces($router): array
    {
        try {
            $client = $this->connect($router);
            $query = new Query('/interface/print');
            return $client->query($query)->read();
        } catch (\Exception $e) {
            return ['error' => 'Gagal koneksi: ' . $e->getMessage()];
        }
    }

    public function getTrafficStats($router, $interface): array
    {
        try{
            $client = $this->connect($router);

            $query = new Query('/interface/monitor-traffic');
            $query->equal('interface', $interface);
            $query->equal('once', 'true');

            return $client->query($query)->read();
        }catch (\Exception $e) {
            return ['error' => 'Gagal koneksi: ' . $e->getMessage()];
        }
    }

    public function getInterfaceTraffic(Router $router, string $interface): array
    {
        try {
            $client = $this->connect($router);
            $query = new Query('/interface/monitor-traffic');
            $query->equal('interface', $interface)->equal('once', true);

            $data = $client->query($query)->read();
            if (empty($data)) {
                return ['error' => 'Tidak ada data dari router'];
            }

            return $data[0];
        } catch (\Exception $e) {
            return ['error' => 'Gagal: ' . $e->getMessage()];
        }
    }

}
