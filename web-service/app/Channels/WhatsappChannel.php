<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class   WhatsappChannel
{
  /**
   * Send the given notification.
   *
   * @param  mixed  $notifiable
   * @param  \Illuminate\Notifications\Notification  $notification
   * @return void
   */
  public function send($notifiable, Notification $notification)
  {
    // Get the target (phone number) and the message
    $target = $notifiable->routeNotificationFor('whatsapp');
    $message = $notification->toWhatsapp($notifiable);

    // Check if target and message are provided
    if (!$target || !$message) {
      return; // Or handle the error appropriately
    }

    // Call the sendMessage function
    $response = $this->sendMessage($target, $message);

    // Handle the response, log or throw exception if necessary
    if (!$response['success']) {
      // Log the error or handle it in another way
        Log::error('Failed to send WhatsApp message', [
            'error' => $response['error'],
            'target' => $target,
            'message' => $message,
        ]);
    }
  }

  /**
   * Send a message using the Fonnte API.
   *
   * @param  string  $target
   * @param  string  $message
   * @return array
   */
  private function sendMessage(string $target, string $message)
  {
    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => 'https://api.fonnte.com/send',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => [
        'target' => $target,
        'message' => $message,
        'countryCode' => '62',
      ],
      CURLOPT_HTTPHEADER => [
        'Authorization: ' . env('FONNTE_TOKEN'),
      ],
    ]);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
      $error_msg = curl_error($curl);
      curl_close($curl);
      return ['success' => false, 'error' => $error_msg];
    }

    curl_close($curl);
    return ['success' => true, 'response' => $response];
  }
}