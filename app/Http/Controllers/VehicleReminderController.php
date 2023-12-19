<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VehicleReminderController extends Controller
{
    public function usersReminder()
    {
        try {
            $vehicles = Vehicle::with(['user'])
                ->whereDate('tax_period', '<', now()->addMonth())
                ->orWhereDate('stnk_period', '<', now()->addMonth())
                ->get();

            foreach ($vehicles as $vehicle) {
                if ($vehicle->user && $vehicle->user->phone) {
                    $this->handleMessage($vehicle);
                } else {
                    continue;
                }
            }

            return Redirect::back()->with('success', 'Reminders sent successfully!');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Failed to send reminders. Please try again later.');
        }
    }

    public function userReminder(Vehicle $vehicle)
    {
        try {
            $this->handleMessage($vehicle);
            return Redirect::back()->with('success', "Reminder sent successfully to {$vehicle->user->name}!");
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Failed to send reminder. Please try again later.');
        }
    }

    private function handleMessage(Vehicle $vehicle)
    {
        $token = env('FONNTE_API');
        $url = 'https://api.fonnte.com/send';

        $message = "Hai {$vehicle->user->name}!\n\n";
        $message .= "Ini adalah pengingat untuk membayar *Pajak dan Stnk* kendaraan Anda. Pastikan untuk melakukannya tepat waktu agar menghindari denda yang mungkin timbul.\n\n";
        $message .= "*Detail Kendaraan*\n";
        $message .= "Nomor Polisi : {$vehicle->license_plate}\n";
        $message .= "Merek : {$vehicle->brand->name}\n";
        $message .= "Kategori : " . ucfirst($vehicle->category->label()) . "\n"; // Format huruf kapital di awal
        $message .= "Model : {$vehicle->model}\n";
        $message .= "Tahun : {$vehicle->year}\n";
        $message .= "Pajak : " . now()->parse($vehicle->tax_period)->format('d M Y') . "\n"; // Format tanggal d M Y
        $message .= "STNK : " . now()->parse($vehicle->stnk_period)->format('d M Y') . "\n\n"; // Format tanggal d M Y
        $message .= "Ingat, keamanan dan kenyamanan Anda adalah prioritas kami. Jangan ragu untuk menghubungi kami jika Anda memerlukan bantuan atau informasi lebih lanjut.\n\n";
        $message .= "Terima kasih atas perhatiannya,\n";
        $message .= "Tim Layanan.🚗\n";

        $postData = [
            'target' => $vehicle->user->phone,
            'message' => $message,
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($postData), // Menggunakan http_build_query untuk mengubah array ke format query string
            CURLOPT_HTTPHEADER => [
                'Authorization: ' . $token,
            ],
        ]);

        curl_exec($curl);
        curl_close($curl);
    }
}
