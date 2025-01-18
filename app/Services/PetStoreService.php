<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

/**
 * Serwis odpowiedzialny za komunikację z API Petstore
 */
class PetStoreService
{
    // Bazowy URL do API Petstore
    private string $baseUrl = 'https://petstore.swagger.io/v2';

    /**
     * Zwraca skonfigurowanego klienta HTTP
     * @return \Illuminate\Http\Client\PendingRequest
     */
    private function getHttpClient()
    {
        // Próbujemy użyć certyfikatu, jeśli się nie uda, używamy withoutVerifying
        $certPath = base_path(env('CURL_CA_BUNDLE'));
        
        if (file_exists($certPath)) {
            return Http::withOptions([
                'verify' => $certPath
            ]);
        }
        
        // Fallback na withoutVerifying jeśli nie ma certyfikatu
        return Http::withoutVerifying();
    }

    /**
     * Pobiera wszystkie zwierzęta z API
     * Łączy statusy available, pending i sold w jednym zapytaniu
     */
    public function getAllPets()
    {
        try {
            // Wykonujemy zapytanie GET do endpointu findByStatus z parametrami wszystkich statusów
            $response = $this->getHttpClient()
                ->get($this->baseUrl . '/pet/findByStatus', [
                    'status' => 'available,pending,sold'
                ]);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            throw new Exception('Nie udało się pobrać listy zwierząt');
        } catch (Exception $e) {
            throw new Exception('Błąd podczas pobierania danych: ' . $e->getMessage());
        }
    }

    /**
     * Pobiera pojedyncze zwierzę po ID
     * @param int $id ID zwierzęcia
     */
    public function getPet($id)
    {
        try {
            // Wykonujemy zapytanie GET do endpointu /pet/{id}
            $response = $this->getHttpClient()
                ->get($this->baseUrl . '/pet/' . $id);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            throw new Exception('Nie znaleziono zwierzęcia');
        } catch (Exception $e) {
            throw new Exception('Błąd podczas pobierania danych: ' . $e->getMessage());
        }
    }

    /**
     * Tworzy nowe zwierzę w API
     * @param array $data Dane zwierzęcia (name, status, category, photoUrls)
     */
    public function createPet(array $data)
    {
        try {
            // Wykonujemy zapytanie POST do endpointu /pet z danymi zwierzęcia
            $response = $this->getHttpClient()
                ->post($this->baseUrl . '/pet', $data);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            throw new Exception('Nie udało się dodać zwierzęcia');
        } catch (Exception $e) {
            throw new Exception('Błąd podczas dodawania: ' . $e->getMessage());
        }
    }

    /**
     * Aktualizuje dane zwierzęcia w API
     * @param array $data Zaktualizowane dane zwierzęcia (id, name, status, category, photoUrls)
     */
    public function updatePet(array $data)
    {
        try {
            // Wykonujemy zapytanie PUT do endpointu /pet z zaktualizowanymi danymi
            $response = $this->getHttpClient()
                ->put($this->baseUrl . '/pet', $data);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            throw new Exception('Nie udało się zaktualizować danych zwierzęcia');
        } catch (Exception $e) {
            throw new Exception('Błąd podczas aktualizacji: ' . $e->getMessage());
        }
    }

    /**
     * Usuwa zwierzę z API
     * @param int $id ID zwierzęcia do usunięcia
     */
    public function deletePet($id)
    {
        try {
            // Wykonujemy zapytanie DELETE do endpointu /pet/{id}
            $response = $this->getHttpClient()
                ->delete($this->baseUrl . '/pet/' . $id);
            
            if ($response->successful()) {
                return true;
            }
            
            throw new Exception('Nie udało się usunąć zwierzęcia');
        } catch (Exception $e) {
            throw new Exception('Błąd podczas usuwania: ' . $e->getMessage());
        }
    }
} 